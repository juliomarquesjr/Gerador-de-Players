<?php

	
	//include configuration file
	require "config.php";
	
	//decode data
	if ($_GET["data"])
		parse_str(base64_decode($_GET["data"]), $_GET);
	
	//create server instance
	$dbpm = new DBPlayerManager($config);
        $debug='true';
	$dbpm->debug = $_GET["debug"] == "true"? true : false;
	
	//querystring overrides
	if ($dbpm->config["allowOverride"]) {
		
		if ($_GET["host"]) {
			$dbpm->config["stations"]["override"] = array(
				"host" => $_GET["host"],
				"port" => $_GET["port"]? $_GET["port"] : 8000,
				"uri" => $_GET["uri"]? $_GET["uri"] : "/",
				"password" => $_GET["password"]? $_GET["password"] : ""
			);
			
			$dbpm->config["defaultStation"] = "override";
			
		}else{
			$stationId = $_GET["station"]? $_GET["station"] : $dbpm->config["defaultStation"];
			
			//parse allowed station list from given station id
			if ($stationId == "all") {
				$stationId = array_shift(array_keys($dbpm->config["stations"])); //get id of first station
			
			}elseif (preg_match("/,/", $stationId)) {
				$stationIds = preg_split("/\s*,\s*/", $stationId);
				$filteredStations = array();
				$stationId = "";
				
				foreach ($stationIds as $cStationId) {
					$cStationId = trim($cStationId);
					
					//TEMP ignore alternates
					$cStationId = preg_replace("/\/.+$/", "", $cStationId);
			
					$stationConfig = $dbpm->getStation($cStationId);
					
					if ($stationConfig) {
						if (!$stationId)
							$stationId = $cStationId;
							
						$filteredStations[$cStationId] = $stationConfig;
					}
				}
				
				$dbpm->config["stations"] = $filteredStations;
				
			}elseif ($stationId) {
				//TEMP ignore alternates
				$stationId = preg_replace("/\/.+$/", "", $stationId);
				
				$station = $dbpm->getStation($stationId);
				
				if ($station)
					$dbpm->config["stations"] = array($stationId => $station);
				else
					$dbpm->config["stations"] = array();
			}
			
			if ($stationId)
				$dbpm->config["defaultStation"] = $stationId;
		}
		
		if ($_GET["format"])
			$dbpm->config["stations"][$dbpm->config["defaultStation"]]["format"] = $_GET["format"];
			
		if ($_GET["language"])
			$dbpm->config["defaultLanguage"] = $_GET["language"];
	}
	
	if ($_GET["cache"])
		$dbpm->config["useCache"] = $_GET["cache"] == "false"? false : true;
	
	if ($_GET["extended"] == "true")
		$dbpm->config["downloadTrackInfo"] = true;
		
	//output response
	try {
		if ($_GET["proxy"] == "true")
			$dbpm->proxyServer();
		else {
			if ($_GET["config"] == "true")
				$xml = $dbpm->getConfigInfo();
			elseif ($_GET["mail"] == "true")
				$xml = $dbpm->mail($_GET["recipient"], $_GET["subject"], $_POST);
			elseif ($_GET["track"])
				$xml = $dbpm->getTrackInfo($_GET["track"], $_GET["format"]? $_GET["format"] : $station['format']);
			elseif ($_GET["minimal"] == "true")
				$xml = $dbpm->getStationInfo($stationId, "minimal", $_GET["since"]);
			else
				$xml = $dbpm->getStationInfo($stationId, "", $_GET["since"]);
		}
		
	}catch (Exception $e) {
		$xml = '<?xml version="1.0" standalone="yes" ?><response><error>'.$e->getMessage().'</error></response>';
	}
	
	if ($xml){
		header("Content-Type: text/xml\r\n");
		print $xml;
	}
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++
	class DBPlayerManager{
		public $config;
		public $debug = false;
		public $version = 1.1;
		
		public function __construct($config) {
			if ($this->debug)
				error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
			else
				error_reporting(0);
				
			set_time_limit(60);
			
			$this->config = $config;
			
			//validations
			if (!$this->config["cache"]["path"]){
				$this->config["cache"]["path"] = sys_get_temp_dir();
				
				if (!$this->config["cache"]["path"])
					$this->config["cache"]["path"] = ".";
			}
			
			if (!isset($this->config["cache"]["timeout"]))
				$this->config["cache"]["timeout"] = 86400;
		}
		
		public function mail($to, $subject, $content) {
			if (!$to)
				$to = $this->config["defaultEmail"];
				
			if (!$subject)
				$subject = $this->config["defaultEmailSubject"];
			
			if (!$subject)
				$subject = $_SERVER["HTTP_HOST"]." Form Mail";
			
			if (!$content)
				$content = $_POST;
				
			if (!$content)
				$content = array();
			
			//content
			$content["url"] = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			$content["ip"] = $_SERVER["REMOTE_ADDR"];
				
			//subject
			$subject = preg_replace("/\r|\n|(%0a)|(%0d)/i", "", stripslashes($subject));
				
			//headers
			$headers = "";
			
			if ($content["email"]){
				$headers .= "Reply-To: ".preg_replace("/\r|\n|(%0a)|(%0d)/i", "", stripslashes($content["email"]))."\r\n";
				$headers .= "Return-Path: ".preg_replace("/\r|\n|(%0a)|(%0d)/i", "", stripslashes($content["email"]))."\r\n";
			}
			//else
			//	$headers .= "From: anonymous@".$_SERVER["HTTP_HOST"]."\n";
			
			//body
			$body = "";	
			foreach ($content as $name => $value)
				$body .= strtoupper($name).": ".preg_replace("/\r|\n|(%0a)|(%0d)/i", "", stripslashes($value))."\n";
			
			//send mail
			$ok = mail($to, $subject, $body, $headers);
			
			return '<?xml version="1.0" standalone="yes" ?><response><result>'.($ok? 'mail_sent' : 'mail_error').'</result></response>';
		}
		
		public function proxyServer($stationId) {
			//inits
			ob_end_clean();
			set_time_limit(0);
			if (session_id())
				session_write_close();
				
			$station = $this->getStation($stationId);
			
			//request
			$request = 'GET '.$station["uri"].' HTTP/1.0'."\r\n"; 
			$request .= 'Host: '.$station["host"]."\r\n"; 
			$request .= 'User-Agent: Proxy (DBPlayerManager '.$this->version.'; http://danielbrinca.com)'."\r\n"; 
			$request .= 'Icy-MetaData:1'."\r\n"; 
			$request .= "Connection: close\r\n\r\n";
			
			$f = @fsockopen($station["host"], $station["port"], $nError, $strError, 30);
			
			if (!$f)
				throw new Exception("connect_error");
			
			fputs($f, $request);
			
			//read headers
			$bitrate = 0;
			$chunk = "";
			$headers = "";
			
			do{
				$chunk = trim(fgets($f));
				
				if ($chunk){
					//autodetect bitrate
					if (preg_match('/icy-br:(\d+)/', $chunk, $res))
						$bitrate = intval($res[1]) * 1000;
						
					if (preg_match('/content-type:(\S+)/i', $chunk, $res))
						header("Content-Type: ".$res[1]);
				}
				
				$headers .= $chunk."\r\n";
				
					
			}while ($chunk && !feof($f));
			
			print $headers;
			flush();
			
			//buffer
			if ($this->config["bufferSeconds"] && $bitrate){
				print fread($f, round($bitrate/8 * intval($this->config["bufferSeconds"])));
				flush();
			}
			
			//read stream
			$length = 2048;
			$delay = $bitrate? round((1000000 / ($bitrate / 8 / $length)) * .9) : 75000; 
			$elapsed = microtime(true);
			
			while (!feof($f)){
				$start = microtime(true);
				
				print fread($f, $length);
				flush();
				
				/*if (($start - $elapsed) > 5){
					$elapsed = $start;
				}*/
				
				//delay next cycle to prevent cpu from clogging
				//$actualDelay = floor(($delay - ($end - $start)*1000000)*.8);
				if ($delay)
					usleep($delay);
			}
			
			fclose($f);
		}
		
		public function getConfigXml($config){
			$output = "";
		
			//main
			if (isset($config["defaultLanguage"])) $output .= '<defaultLanguage>'.htmlspecialchars($config["defaultLanguage"], null, null, true).'</defaultLanguage>';
			if (isset($config["defaultStation"])) $output .= '<defaultStation>'.htmlspecialchars($config["defaultStation"], null, null, true).'</defaultStation>';
			if (isset($config["defaultEmail"])) $output .= '<defaultEmail>'.htmlspecialchars($config["defaultEmail"], null, null, true).'</defaultEmail>';
			if (isset($config["defaultEmailSubject"])) $output .= '<defaultEmailSubject>'.htmlspecialchars($config["defaultEmailSubject"], null, null, true).'</defaultEmailSubject>';
			if (isset($config["facebook"])) $output .= '<facebook>'.htmlspecialchars($config["facebook"], null, null, true).'</facebook>';
			if (isset($config["twitter"])) $output .= '<twitter>'.htmlspecialchars($config["twitter"], null, null, true).'</twitter>';
			if (isset($config["about"])) $output .= '<about>'.htmlspecialchars($config["about"], null, null, true).'</about>';
			if (isset($config["aboutLabel"])) $output .= '<aboutLabel>'.htmlspecialchars($config["aboutLabel"], null, null, true).'</aboutLabel>';
			
			//misc
			if (isset($config["preferredConnectionType"])) $output .= '<preferredConnectionType>'.htmlspecialchars($config["preferredConnectionType"], null, null, true).'</preferredConnectionType>';
			if (isset($config["autoplay"])) $output .= '<autoplay>'.($config["autoplay"]? 'true' : 'false').'</autoplay>';
			if (isset($config["trackUpdateDelay"])) $output .= '<trackUpdateDelay>'.intval($config["trackUpdateDelay"]).'</trackUpdateDelay>';
			if (isset($config["trackPollInterval"])) $output .= '<trackPollInterval>'.intval($config["trackPollInterval"]).'</trackPollInterval>';
			if (isset($config["tickerUpdateInterval"])) $output .= '<tickerUpdateInterval>'.intval($config["tickerUpdateInterval"]).'</tickerUpdateInterval>';
			if (isset($config["maxTracks"])) $output .= '<maxTracks>'.intval($config["maxTracks"]).'</maxTracks>';
			if (isset($config["defaultTrackTitleFormat"])) $output .= '<defaultTrackTitleFormat>'.htmlspecialchars($config["defaultTrackTitleFormat"], null, null, true).'</defaultTrackTitleFormat>';
			if (isset($config["getAlbum"])) $output .= '<getAlbum>'.($config["getAlbum"]? 'true' : 'false').'</getAlbum>';
			if (isset($config["linkAlbumToStore"])) $output .= '<linkAlbumToStore>'.($config["linkAlbumToStore"]? 'true' : 'false').'</linkAlbumToStore>';
			if (isset($config["popup"])) $output .= '<popup>'.htmlspecialchars($config["popup"], null, null, true).'</popup>';
			if (isset($config["preloadTracks"])) $output .= '<preloadTracks>'.($config["preloadTracks"]? 'true' : 'false').'</preloadTracks>';
			
			if (isset($config["reconnectSeconds"])) $output .= '<reconnectSeconds>'.intval($config["reconnectSeconds"]).'</reconnectSeconds>';
			if (isset($config["detectTrackChange"])) $output .= '<detectTrackChange>'.($config["detectTrackChange"]? 'true' : 'false').'</detectTrackChange>';
			
			//display
			if (isset($config["display"])){
				$output .= '<display>';
				
				if (isset($config["display"]["miniCover"])) $output .= '<miniCover>'.($config["display"]["miniCover"]? 'true' : 'false').'</miniCover>';
				if (isset($config["display"]["stationName"])) $output .= '<stationName>'.($config["display"]["stationName"]? 'true' : 'false').'</stationName>';
				if (isset($config["display"]["listeners"])) $output .= '<listeners>'.($config["display"]["listeners"]? 'true' : 'false').'</listeners>';
				if (isset($config["display"]["genre"])) $output .= '<genre>'.($config["display"]["genre"]? 'true' : 'false').'</genre>';
				if (isset($config["display"]["contentType"])) $output .= '<contentType>'.($config["display"]["contentType"]? 'true' : 'false').'</contentType>';
				if (isset($config["display"]["bitrate"])) $output .= '<bitrate>'.($config["display"]["bitrate"]? 'true' : 'false').'</bitrate>';
				if (isset($config["display"]["popup"])) $output .= '<popup>'.($config["display"]["popup"]? 'true' : 'false').'</popup>';
				if (isset($config["display"]["contact"])) $output .= '<contact>'.($config["display"]["contact"]? 'true' : 'false').'</contact>';
				if (isset($config["display"]["facebook"])) $output .= '<facebook>'.($config["display"]["facebook"]? 'true' : 'false').'</facebook>';
				if (isset($config["display"]["twitter"])) $output .= '<twitter>'.($config["display"]["twitter"]? 'true' : 'false').'</twitter>';
				if (isset($config["display"]["historySection"])) $output .= '<historySection>'.($config["display"]["historySection"]? 'true' : 'false').'</historySection>';
				if (isset($config["display"]["stationsSection"])) $output .= '<stationsSection>'.($config["display"]["stationsSection"]? 'true' : 'false').'</stationsSection>';
				if (isset($config["display"]["contactSection"])) $output .= '<contactSection>'.($config["display"]["contactSection"]? 'true' : 'false').'</contactSection>';
				
				$output .= '</display>';
			}
			
			//amazon
			if (isset($config["amazon"])){
				$output .= '<amazon>';
				if (isset($config["amazon"]["associate"])) $output .= '<associate>'.htmlspecialchars($config["amazon"]["associate"], null, null, true).'</associate>';
				$output .= '</amazon>';
			}
			
			//restrictions
			if (isset($config["restrictions"])){
				$output .= '<restrictions>';
				if (isset($config["restrictions"]["dateLimit"])) $output .= '<dateLimit>'.htmlspecialchars($config["restrictions"]["dateLimit"], null, null, true).'</dateLimit>';
				if (isset($config["restrictions"]["siteLock"])) $output .= '<siteLock>'.htmlspecialchars($config["restrictions"]["siteLock"], null, null, true).'</siteLock>';
				$output .= '</restrictions>';
			}
			
			return $output;
		}
		
		public function getConfigInfo($includeStationInfo = true, $includeStationList = true, $includeLanguagePacks = true) {
		
			$output = '<settings>';
			$output .= $this->getConfigXml($this->config);
			$output .= '</settings>';
			
			//station info
			if ($includeStationInfo && $this->getStation($this->config["defaultStation"]))
				$output .= $this->getStationInfo($this->config["defaultStation"], "", 0, false);
				
			//station list
			if ($includeStationList){
				$output .= '<stations>';
				
				foreach ($this->config["stations"] as $id => $station){
					//get station data with defaults applied
					$station = $this->getStation($id);
					
					$output .= '<station>';
					
					$output .= '<id>'.$id.'</id>';
					
					$overrides = array();
					
					foreach ($station as $name => $value){
						if (!$name)
							continue;
					
						switch ($name){
							case "type": $output .= '<type>'.$station["type"].'</type>'; break;
							case "host": $output .= '<host>'.htmlspecialchars($station["host"], null, null, true).'</host>'; break;
							case "port": $output .= '<port>'.$station["port"].'</port>'; break;
							case "uri": $output .= '<uri>'.htmlspecialchars($station["uri"], null, null, true).'</uri>'; break;
							case "policy": $output .= '<policy>'.htmlspecialchars($station["policy"], null, null, true).'</policy>'; break;
							case "format": $output .= '<format>'.htmlspecialchars($station["format"], null, null, true).'</format>'; break;
							case "logo": $output .= '<logo>'.htmlspecialchars($station["logo"], null, null, true).'</logo>'; break;
							case "name": $output .= '<name>'.htmlspecialchars($station["name"], null, null, true).'</name>'; break;
							case "genre": $output .= '<genre>'.htmlspecialchars($station["genre"], null, null, true).'</genre>'; break;
							case "website": $output .= '<website>'.htmlspecialchars($station["website"], null, null, true).'</website>'; break;
							case "proxy": $output .= '<proxy>'.$station["proxy"].'</proxy>'; break;
							case "url": $output .= '<url>'.htmlspecialchars($station["url"], null, null, true).'</url>'; break;
							case "private": $output .= '<private>'.($station["private"]? "true" : "false").'</private>'; break;
							case "password": 
								break; //ignore
							default:
								$overrides[$name] = $value;
						}
					}
					
					if (count($overrides) > 0)
						$output .= '<overrides>'.$this->getConfigXml($overrides).'</overrides>';
					
					$output .= '</station>';
				}
				
				$output .= '</stations>';
			}
			
			//language packs
			if ($includeLanguagePacks && $this->config["defaultLanguage"]){
				$langPath = $this->config["languagesPath"].DIRECTORY_SEPARATOR.$this->config["defaultLanguage"].".xml";
				if (file_exists($langPath))
					$output .= '<languages>'.preg_replace("/\<\?xml.+\?\>\s*/iU", "", file_get_contents($langPath)).'</languages>';
			}
			
			return '<?xml version="1.0" standalone="yes" ?><response>'.$output.'</response>';
		}
		
		public function getStation($stationId){
			if (!$stationId)
				$stationId = $this->config["defaultStation"];
			
			if ($stationId)
				$station = $this->config["stations"][$stationId];
			
			//check integration script to see if we have a match for this station id
			if (!$station && $stationId && file_exists($this->config["stationIntegrationScript"])){
				$_GET["station"] = $stationId;
				$station = include $this->config["stationIntegrationScript"];
			}
			
			if (!$station)
				return false;
			
			//defaults
			if ($station["url"]){
				$oUrl = parse_url($station["url"]);
				
				if (!$station["host"])
					$station["host"] = $oUrl["host"];
				
				if (!$station["port"])
					$station["port"] = $oUrl["port"];
				
				if (!$station["password"])
					$station["password"] = $oUrl["pass"];
					
				if (!$station["uri"])	
					$station["uri"] = $oUrl["path"];
			}
			
			if (!$station["type"])
				$station["type"] = "shoutcast";
			
			if (!$station["host"])
				$station["host"] = $_SERVER["HTTP_HOST"];
				
			if (!$station["port"])
				$station["port"] = 8000;
				
			if (!$station["uri"])
				$station["uri"] = "/";
			
			if ($station["proxy"] === true)
				$station["proxy"] = "true";
				
			return $station;
		}
		
		public function getStationInfo($stationId, $type, $sinceTs, $wrapXmlResponse = true) {
			$station = $this->getStation($stationId);
			
			if (!$station)
				throw new Exception("invalid_station");
			
			try {
				if ($type == "minimal")
					$xml = $this->getShoutcastData($station, "minimal");
				else
					$xml = $this->getShoutcastData($station, "all");
					
			}catch(Exception $e){
				return "";
			}
			
			$output = '<server>';
			
			//connection info
			$output .= '<type>shoutcast</type>';
			
			$output .= '<host>'.($station["host"]? $station["host"] : $_SERVER["HTTP_HOST"]).'</host>';
			$output .= '<port>'.($station["port"]? $station["port"] : 8000).'</port>';
			$output .= '<uri>'.htmlspecialchars($station["uri"]? $station["uri"] : "/", null, null, true).'</uri>';
			
			$output .= '<policy>'.htmlspecialchars($station["policy"]? $station["policy"] : "http://".($station["host"]? $station["host"] : $_SERVER["HTTP_HOST"])."/crossdomain.xml", null, null, true).'</policy>';
			$output .= '<format>'.htmlspecialchars($station["format"]? $station["format"] : $station["defaultTrackTitleFormat"], null, null, true).'</format>';
			$output .= '<logo>'.htmlspecialchars($station["logo"]? $station["logo"] : "", null, null, true).'</logo>';
			
			//server/stream info
			if ($xml->VERSION)
				$output .= '<version>'.$xml->VERSION.'</version>';
			
			if ($xml->CONTENT)
				$output .= '<content>'.$xml->CONTENT.'</content>';
			
			if ($xml->BITRATE)
				$output .= '<bitrate>'.($xml->BITRATE * 1000).'</bitrate>';
			
			if (isset($xml->STREAMSTATUS))
				$output .= '<status>'.$xml->STREAMSTATUS.'</status>';
				
			if ($xml->CURRENTLISTENERS)
				$output .= '<listeners>'.$xml->CURRENTLISTENERS.'</listeners>';
			
			//station info
			if ($xml->SERVERGENRE)
				$output .= '<genre>'.htmlspecialchars($xml->SERVERGENRE, null, null, true).'</genre>';
			
			if ($xml->SERVERURL)
				$output .= '<url>'.htmlspecialchars($xml->SERVERURL, null, null, true).'</url>';
			
			if ($xml->SERVERTITLE)
				$output .= '<title>'.htmlspecialchars($xml->SERVERTITLE, null, null, true).'</title>';
				
			$output .= '</server>';
				
			//tracks
			if ($xml->SONGHISTORY) {
				$output .= '<tracks>';
				
				foreach ($xml->SONGHISTORY->SONG as $song){
					if ($song->PLAYEDAT && $sinceTs && (int)$song->PLAYEDAT <= strtotime($sinceTs))
						continue;
				
					$output .= '<track>';
					
					if ($song->PLAYEDAT)
						$output .= '<played>'.date("Y-m-d H:i:s", (string)$song->PLAYEDAT).'</played>';
					
					//get track info (from amazon)
					if ($this->config["downloadTrackInfo"]){
						
						try{
							$trackInfo = $this->getTrackInfo((string) $song->TITLE, $station["format"], false);
								
						}catch(Exception $e){
							//just ignore
						}
					}
					
					if ($trackInfo)
						$output .= $trackInfo;
					else
						$output .= '<title>'.htmlspecialchars($song->TITLE, null, null, true).'</title>';
						
					$output .= '</track>';
				}
				
				$output .= '</tracks>';
			}
			
			if ($wrapXmlResponse)
				return '<?xml version="1.0" standalone="yes" ?><response>'.$output.'</response>';
			else
				return $output;
		}
		
		private function parseTrackTitle($title, $format, $strictMatch = true){
			//create a pattern out of the given format
			$formatRe = preg_quote($format);
			$formatRe = preg_replace("/\s*((%ignore)|(%0))\s*/i", '(.+)', $formatRe);
			$formatRe = preg_replace("/\s*((%artist)|(%1))\s*/i", '(.+)', $formatRe);
			$formatRe = preg_replace("/\s*((%title)|(%2))\s*/i", '(.+)', $formatRe);
			$formatRe = preg_replace("/\s*((%album)|(%3))\s*/i", '(.+)', $formatRe);
			$formatRe = preg_replace("/\s*((%year)|(%4))\s*/i", '(.+)', $formatRe);
			
			//if the pattern doesn't match the title, trim off the last segment (it may be cut off if the string is too long)
			if (!preg_match("/^".$formatRe."$/iU", $title, $res)){
				
				if ($strictMatch)
					$formatRe = substr($formatRe, 0, strrpos($formatRe, '(.+)')).'.*';
				else
					$formatRe = substr($formatRe, 0, strrpos($formatRe, '(.+)', -strrpos($formatRe, '(.+)') + 1)).'(.+)';
				
				//if it still doesn't match, fail
				if (!preg_match("/^".$formatRe."$/iU", $title, $res))
					return false;
			}
			
			//identify each segment with its corresponding type
			if (!preg_match_all("/%(\w+)/", $format, $res2))
				return false;
			
			$output = array();
			foreach ($res2[1] as $index => $type){
				if ($type == "0" || $type == "ignore") continue;
				if ($type == "1") $type = "artist";
				if ($type == "2") $type = "album";
				if ($type == "3") $type = "title";
				if ($type == "4") $type = "year";
				
				$output[strtolower($type)] = $res[$index + 1];
			}
			
			return $output;
		}
		
		public function getTrackInfo($title, $trackFormat = "", $wrapXmlResponse = true){
			
			$cacheKey = md5($title);
			if ($cache = $this->getCache($cacheKey)){
				if ($wrapXmlResponse)
					return '<?xml version="1.0" standalone="yes" ?><response>'.$cache.'</response>';
				else
					return $cache;
			}
			
			$output = '<source>'.htmlspecialchars($title, null, null, true).'</source>';
			
			//try to parse title with given format
			if ($trackFormat){
				$parsedTitle = $this->parseTrackTitle($title, $trackFormat);
				
				//if (!$parsedTitle)
				//	$parsedTitle = $this->parseTrackTitle($title, $trackFormat, false);
			}
			
			//if no format was given, or if it failed to match, try to autodetect
			if (!$trackFormat || !$parsedTitle){
				$parsedTitle = $this->parseTrackTitle($title, "%artist - %album - %title");
				
				if (!$parsedTitle)
					$parsedTitle = $this->parseTrackTitle($title, "%artist - %title");
			}
			
			if (!$parsedTitle)
				throw new Exception("unparsable_title");
			
			//compose title segments into api search commands
			foreach ($parsedTitle as $type => $value){
				$value = $this->cleanKeywords($value);
			
				if (!$value)
					continue;
					
				switch ($type){
					case "artist": $commands["Artist"] = $value; break;
					case "album": $commands["Title"] = $value; break;
					case "title": $commands["Keywords"] = $value; break;
				}
			}
			if ($commands["Title"] && $commands["Keywords"])
				unset($commands["Keywords"]);
			
			$xml = $this->getAmazonData($commands);
				
			if (!$xml || (string) $xml->Items->Request->IsValid != "True")
				throw new Exception("invalid_request");
				
			if ((int) $xml->Items->TotalResults <= 0)
				throw new Exception("not_found");
			
			//get first item
			$item = $xml->Items->Item[0];
			
			if (!$item)
				throw new Exception("no_item");
				
			//add search parameters
			$output .= '<search>';
			if ($commands["Artist"]) $output .= '<artist>'.htmlspecialchars($commands["Artist"], null, null, true).'</artist>';
			if ($commands["Title"]) $output .= '<title>'.htmlspecialchars($commands["Title"], null, null, true).'</title>';
			if ($commands["Keywords"]) $output .= '<keywords>'.htmlspecialchars($commands["Keywords"], null, null, true).'</keywords>';
			$output .= '</search>';
				
			//start parsing results
			if ($item->ASIN)
				$output .= '<id>'.$item->ASIN.'</id>';
				
			if ($item->ItemAttributes){
					
				if (!$parsedTitle["artist"] && $item->ItemAttributes->Artist)
					$parsedTitle["artist"] = (string) $item->ItemAttributes->Artist;
					
				if (!$parsedTitle["album"] && $item->ItemAttributes->Title)
					$parsedTitle["album"] = (string) $item->ItemAttributes->Title;
					
				if (!$parsedTitle["year"] && $item->ItemAttributes->ReleaseDate)
					$parsedTitle["year"] = date("Y", strtotime((string) $item->ItemAttributes->ReleaseDate));
				
				if ($item->ItemAttributes->Publisher)
					$output .= '<publisher>'.htmlspecialchars($item->ItemAttributes->Publisher, null, null, true).'</publisher>';
					
				if ($item->ItemAttributes->ListPrice)
					if ($item->ItemAttributes->ListPrice->FormattedPrice)
						$output .= '<price>'.$item->ItemAttributes->ListPrice->FormattedPrice.'</price>';
			}
				
			//song info
			if ($parsedTitle["artist"])
				$output .= '<artist>'.htmlspecialchars($parsedTitle["artist"], null, null, true).'</artist>';
				
			if ($parsedTitle["album"])
				$output .= '<album>'.htmlspecialchars($parsedTitle["album"], null, null, true).'</album>';
			
			if ($parsedTitle["title"])
				$output .= '<title>'.htmlspecialchars($parsedTitle["title"], null, null, true).'</title>';
			
			if ($parsedTitle["year"])
				$output .= '<year>'.$parsedTitle["year"].'</year>';
			
			if ($item->DetailPageURL && $this->config['linkAlbumToStore'])
				$output .= '<url>'.$item->DetailPageURL.'</url>';
			
			//image
			if ($item->LargeImage)
				$output .= '<image>'.$item->LargeImage->URL.'</image>';
			elseif ($item->MediumImage)
				$output .= '<image>'.$item->MediumImage->URL.'</image>';
			elseif ($item->SmallImage)
				$output .= '<image>'.$item->SmallImage->URL.'</image>';
					
			//save cache
			$this->setCache($cacheKey, $output);
			
			if ($wrapXmlResponse)
				return '<?xml version="1.0" standalone="yes" ?><response>'.$output.'</response>';
			else
				return $output;
		}
		
		
		private function cleanKeywords($keywords, $safeMode=false){
			$output = $keywords;
		
			//clean up key
			$output = preg_replace("/&\w+;/", " ", $output); //remove html special chars
			
			if (!$safeMode)
				$output = preg_replace("/[\[\{\(].+[\]\}\)]/i", " ", $output); //remove text between parenthisis, brackets, etc
				
			$output = preg_replace("/\[|\{|\(|\]|\}|\)|,/", " ", $output); //remove unwanted characters such as parenthisis, brackets, etc
			
			if (!$safeMode)
				$output = preg_replace("/(19|2)\d{2,3}/", "", $output); //remove years
				
			//$output = preg_replace("/[^a-z0-9']/i", " ", $output); //remove non-usable chars
			
			if (!$safeMode)
				$output = preg_replace("/(feat|feat\.|f\.).+$/i", " ", $output); //remove feat. text
			
			if (!$safeMode)
				$output = preg_replace("/(\s+|^)(and|or|&)(\s+|$)/i", " ", $output); //remove specific words
			
			
			$output = trim(preg_replace("/\s+/", " ", $output)); //remove extra white-space
			
			if (strlen($output) <= 2)
				if (!$safeMode)
					return $this->cleanKeywords($keywords, true);
				else
					return "";
			
			return $output;
		}
		
		//get shoutcast xml data (type may be: all (default), main, web, listeners, history, or minimal (short version))
		private function getShoutcastData($station, $type = "all") {
			
			if (!$station)
				throw new Exception("invalid_station");
			
			//validate server data
			$host = $station["host"]? $station["host"] : $_SERVER["HTTP_HOST"];
			$port = $station["port"]? $station["port"] : 8000;
			
			$output = "";
			
			if ($type == "minimal") {
				$uri = "/7.html";
				
				$response = $this->httpRequest($uri, $host, $port);
				
				if (preg_match("/<body>(\d+),(\d+),(\d+),(\d+),(\d+),(\d+),(.+?)<\/body>/i", $response["body"], $res)) {
					
					$output = '<?xml version="1.0" standalone="yes" ?><SHOUTCASTSERVER>';
					$output .= '<CURRENTLISTENERS>'.$res[1].'</CURRENTLISTENERS>';
					$output .= '<PEAKLISTENERS>'.$res[3].'</PEAKLISTENERS>';
					$output .= '<MAXLISTENERS>'.$res[4].'</MAXLISTENERS>';
					$output .= '<REPORTEDLISTENERS>'.$res[5].'</REPORTEDLISTENERS>';
					$output .= '<SONGHISTORY><SONG><TITLE>'.$res[7].'</TITLE></SONG></SONGHISTORY>';
					$output .= '<STREAMSTATUS>'.$res[2].'</STREAMSTATUS>';
					$output .= '<BITRATE>'.$res[6].'</BITRATE>';
					$output .= '</SHOUTCASTSERVER>';
				}
				
			}elseif ($station["password"]) {
				$uri = "/admin.cgi?mode=viewxml&pass=".$station["password"];
			
				switch ($type) {
					case "main": $uri .= "&page=1"; break;
					case "web": $uri .= "&page=2"; break;
					case "listeners": $uri .= "&page=3"; break;
					case "history": $uri .= "&page=4"; break;
					default: $uri .= "&page=0"; break;
				}
				
				//get xml data
				$response = $this->httpRequest($uri, $host, $port);
				
				$output = $response["body"];
				
			}else{
				//TODO parse info from public html pages
			}
			
			if ($output)
				return new SimpleXMLElement(utf8_encode($output));
			else
				return false;
		}
		
		private function getAmazonData($commands) {
			
			//if commands is a string, assume they refer to keywords on a music search
			if (is_string($commands)) {
				$keywords = $commands;
				$commands = array();
				$commands["Keywords"] = $keywords;
			}elseif (is_array($commands)){
				foreach ($commands as $label => $value)
					if (!$value)
						unset($commands[$label]);
			}
			
			if (count($commands) <= 0)
				return false;
			
			//add base commands
			$commands["Service"] = "AWSECommerceService";
			$commands["Version"] = "2011-04-01";
			$commands["AssociateTag"] = $this->config["amazon"]["associate"];
			$commands["AWSAccessKeyId"] = $this->config["amazon"]["key"];
			$commands["Timestamp"] = gmdate("Y-m-d\TH:i:s.Z\Z");
			
			//required commands
			if (!$commands["Operation"])
				$commands["Operation"] = "ItemSearch";
			
			if (!$commands["SearchIndex"])
				$commands["SearchIndex"] = "Music";
			
			if (!$commands["ResponseGroup"])
				$commands["ResponseGroup"] = "ItemAttributes,Images";
			
			//sort commands
			ksort($commands);
			
			//create request
			$host = "ecs.amazonaws.com";
			$uri = "/onca/xml";
			$qs = "";
			
			$i = 0;
			foreach ($commands as $name => $value){
				$qs .= $name."=".rawurlencode($value);
				if ($i++ < (count($commands) - 1))
					$qs .= "&";
			}
			
			//add signature
			$qs .= "&Signature=".rawurlencode(base64_encode(hash_hmac("sha256", "GET\n".$host."\n".$uri."\n".$qs, $this->config["amazon"]["secret"], true)));
			
			//get xml data
			$response = $this->httpRequest($uri."?".$qs, $host);
			
			return new SimpleXMLElement($response["body"]);
		}
		
		private function httpRequest($uri, $host, $port = 80, $headers, $socketTimeout, $readTimeout = 1) {
			
			if (!$socketTimeout)
				$socketTimeout = $this->config["socketTimeout"];
				
			if (!$socketTimeout)
				$socketTimeout = 15;
		
			if (!$host) 
				$host = $_SERVER["HTTP_HOST"];
			
			if (!$port)
				$port = 80;
				
			//request
			$request = 'GET '.$uri.' HTTP/1.1'."\r\n"; 
			$request .= 'Host: '.$host."\r\n"; 
			$request .= 'User-Agent: Mozilla (DBServer v1; http://danielbrinca.com)'."\r\n"; 
			$request .= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'."\r\n"; 
			$request .= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.3'."\r\n"; 
			$request .= 'Accept-Encoding: gzip,deflate'."\r\n"; 
			$request .= 'Cache-Control: max-age=0'."\r\n"; 
			
			if ($headers)
				$request .= is_array($headers)? implode("\r\n", $headers)."\r\n" : $headers;
			
			$request .= "\r\n";
			
			$f = @fsockopen($host, $port, $nError, $strError, $socketTimeout);
			
			if (!$f)
				throw new Exception("connect_error");
			
			if ($readTimeout)
				stream_set_timeout($f, $readTimeout);
			
			fputs($f, $request);
			
			$response = "";
			while ($chunk = fgets($f))
				$response .= $chunk;
				
			/*while (!feof($f)) {
				$chunk = fgets($f, 2048);
				$response .= $chunk;
			}*/
			
			fclose($f);
			
			if (!preg_match("/^(.+?)\r\n\r\n(.*)$/s", $response, $res))
				return false;
				
			$headers = $res[1];
			$body = $res[2];
			
			//decode transfer
			if (preg_match("/^\s*Transfer-Encoding:\s*(.+)$/im", $headers, $res))
				switch ($res[1]) {
					case "chunked":
						$size = "";
						$decoded = "";
						for ($i = 0; $i < strlen($body); $i++) {
							if ($body { $i } == "\n") {
								$size = hexdec($size);
								$decoded .= substr($body, $i + 1, $size);
								$i += $size;
								$size = "";
								
							}else if ($body { $i } != "\r")
								$size .= $body { $i };
						}
						
						$body = $decoded;
						break;
				}
			
			//decode content
			if (preg_match("/^\s*Content-Encoding:\s*(.+)$/im", $headers, $res))
				switch (strtolower(trim($res[1]))) {
				//	case "gzip": $body = gzdecode($body); break;
				//	case "deflate": $body = gzdeflate($body); break;	
				}
			
			return array("headers" => $headers, "body" => $body);
		}
		
		public function getCache($key, $timeout){
			if (!$this->config["useCache"] || $this->debug)
				return false;
		
			if (!isset($timeout))
				$timeout = $this->config["cache"]["timeout"];
				
			$path = $this->config["cache"]["path"].DIRECTORY_SEPARATOR.$key.".cache";
			
			if (filemtime($path) >= (mktime() - $timeout))
				return unserialize(file_get_contents($path));
			else
				return false;
		}
		
		public function setCache($key, $data){
			if (!$this->config["useCache"])
				return false;
			
			$path = $this->config["cache"]["path"].DIRECTORY_SEPARATOR.$key.".cache";
			
			file_put_contents($path, serialize($data));
			
			//trigger cache cleanup
			if (rand(0, 100) == 1)
				$this->clearCache($this->config["cache"]["timeout"]);
		}
		
		public function clearCache($timeout = 0){
			$d = opendir($this->config["cache"]["path"]);
			
			while($fileName = readdir($d))
				if (preg_match("/\.cache$/", $fileName) && filemtime($fileName) <= (mktime() - $timeout))
					unlink($this->config["cache"]["path"].DIRECTORY_SEPARATOR.$fileName);
			
			closedir($d);
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	if (!function_exists('sys_get_temp_dir')){
		function sys_get_temp_dir(){
			// Try to get from environment variable
			if ( !empty($_ENV['TMP']) )
				return realpath( $_ENV['TMP'] );
			else if ( !empty($_ENV['TMPDIR']) )
				return realpath( $_ENV['TMPDIR'] );
			else if ( !empty($_ENV['TEMP']) )
				return realpath( $_ENV['TEMP'] );
			else{
				$temp_file = tempnam( md5(uniqid(rand(), TRUE)), '' );
				if ($temp_file){
					$temp_dir = realpath( dirname($temp_file) );
					unlink( $temp_file );
					return $temp_dir;
					
				}else
					return FALSE;
			}
		}
	}
	
	//function by [katzlbtjunk at hotmail dot com] (taken from http://php.net/manual/en/function.gzdecode.php)

?>
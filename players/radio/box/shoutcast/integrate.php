<?php
/************************************************************************
	Copyright Daniel Brinca 2011 - All Rights Reserved
	Permitted use only with explicit license by http://danielbrinca.com
*************************************************************************/
/*
	This file is meant as an example of integration with a backend or cms,
	which can be used to override the default config.php settings for any 
	station that is not defined on it's station list.
	
	Of course that, to be of any real use, you must edit and modify it to 
	suit your	own needs, according to your own environment.
	
	Everything here is arbitrary, since all that is expected from this script
	is to return an array with the station parameters, in the same format as 
	if it was defined on config.php's station list.
*/

$stationId = trim($_GET["station"]);
$separator = "|";

//make sure we have a valid station id
if (!$stationId) {
	if ($_GET["username"] && $_GET["port"])
		$stationId = trim($_GET["username"].$separator.$_GET["port"]);
	else
		return false;
}
	
//parse stations
$stations = preg_split("/\s*,\s*/", $stationId);

if (count($stations) == 0)
	return false;

//check if there are any alternate servers defined
$servers = preg_split("/\s*\/\s*/", $stations[0]);

foreach ($servers as $serverId){
	//parse username/port from given station id
	if (preg_match("/^(.+)(\\".$separator."|:)(\d+)$/U", $serverId, $res)) {
		$username = $res[1];
		$port = $res[3];
	}
	
	if (!$username || !$port)
		continue;
	
	//get server info
	$other = 1;
	try {
		//get server info [YOU HAVE TO CHANGE THIS WITH YOUR OWN CODE]
		if (file_exists("../src/common.php")){
			include_once '../src/common.php';
			
			$info = getstats($username, $port);
		}
		
	}catch (Exception $e) {
		return false;
	}
		
	//quit if server is invalid, down or full [ADAPT THIS TO YOUR OWN DATA FORMAT]
	if (!$info || $info["s_status"] != 1 || $info["s_users"] == $info["s_max"])
		continue;
	
	//create station entry (used in calling script) [HERE YOU MAY OVERRIDE ANY CONFIG.PHP STATION PARAMETER]
	$station = array(
		"url" => $info["g_url"],
		"password" => $info["Password"],
		"website" => $info["s_url"],
		"defaultEmail" => $info["Email"]
	);

	if ($_GET["debug"] == "true") {
		print "<pre>";
		print_r($_GET);
		print_r($station);
		print_r($info);
		print "</pre>";
	}

	//return station array to be used by manager.php (which then validates, adds to config, etc)
	return $station;
}

return false;
?>
<?php
session_start();
	//Config options - edit at will (if you're not sure about a setting, leave it as is)
	$config = array();
	
	//main options
	$config["defaultStation"] = "Radio Viola de Ouro"; //the default station to load
	$config["defaultEmail"] = "elzobsantos@hotmail.com"; //the default email address to where form mails are sent
	$config["defaultEmailSubject"] = "PLAYER"; //the default email address to where form mails are sent
	$config["facebook"] = "https://www.facebook.com/"; //url for facebook button
	$config["twitter"] = "http://twitter.com/"; //url for twitter button
	$config["about"] = "#"; //url of developer site, and/or with player info
	$config["aboutLabel"] = "Mais Informações"; //label of about context menu item (if emtpy uses the about url as label)
	$config["defaultLanguage"] = "pt"; //the language pack to load on startup (leave blank to use the built-in language pack)
	
	//code for ads on the popup page (leave emtpy for no ads)
	$config["ads"] = '
	'; 
	
	//misc options
	$config["preferredConnectionType"] = "socket"; //which type of connection to use when connecting to the shoutcast server (can be socket, tcp, proxy, or auto)
	$config["autoplay"] = $_SESSION['ip']; //whether the player should start playing automatically
	$config["trackUpdateDelay"] = 20; //how many seconds to wait before displaying a track, after detecting a track change
	$config["trackPollInterval"] = 20; //how many seconds between each status request (used to detect if the track has changed)
	$config["tickerUpdateInterval"] = 30; //how many seconds until the ticker updates automatically to a generic message (song, station, stream, etc)
	$config["maxTracks"] = 20; //maximum number of tracks to keep in history
	$config["defaultTrackTitleFormat"] = ""; //the default track format, used if the station does not define its own format
	$config["getAlbum"] = true; //whether to fetch the album automatically when a track changes or an history item is clicked
	$config["linkAlbumToStore"] = true; //whether to link the album cover to the store (amazon) link (if available)
	$config["popup"] = "popup,600,250"; //javascript function to call (format: function_name, param_1, .., param_n; eg. "popup,728,304")
	$config["preloadTracks"] = true; //whether to automatically fetch albums for all tracks in the history
	$config["reconnectSeconds"] = 0; //will allow the player to reconnect automatically (if the stream goes down) after the specified number of seconds (if 0, changes to the next station immediately)
	
	//manager options
	$config["stationIntegrationScript"] = ""; //the path of an external php script that should supply station information for unconfigured stations
	$config["languagesPath"] = "var/languages"; //the path (from this file) to the directory holding the language pack files
	$config["useCache"] = false; //whether to cache requests or not
	$config["allowOverride"] = true; //whether to allow querystring parameters to override configuration options
	$config["downloadTrackInfo"] = true; //whether to download extended track info/album art automatically for every song
	$config["socketTimeout"] = 10; //amount of seconds that each external connection will wait for a response, until it gives up
	$config["bufferSeconds"] = 5; //will delay playback until the specified number of seconds of the stream have been loaded, to ensure a smooth playing experience
	
	//display options (for header, ticker, etc)
	$config["display"] = array();
	$config["display"]["miniCover"] = true; //whether to display the album cover on the mini player
	$config["display"]["stationName"] = true; //whether to display the station name 
	$config["display"]["listeners"] = true; //whether to display the stream listeners count
	$config["display"]["genre"] = true; //whether to display the station genre
	$config["display"]["contentType"] = true; //whether to display the stream content type (aac, mp3, etc)
	$config["display"]["bitrate"] = true; //whether to display the stream bitrate (shown in Kbps)
	$config["display"]["popup"] = true; //whether to display the popup button (that opens the full player)
	$config["display"]["contact"] = true; //whether to display the contact button
	$config["display"]["facebook"] = true; //whether to display the facebook button
	$config["display"]["twitter"] = true; //whether to display the twitter button
	$config["display"]["historySection"] = true; //whether to display the history (recently played) section
	$config["display"]["stationsSection"] = true; //whether to display the station list section (only shown if there is more than one station configured)
	$config["display"]["contactSection"] = true; //whether to display the contact form section
	
	//amazon options
	$config["amazon"] = array();
	$config["amazon"]["associate"] = "fre08-20"; //associate tag
	$config["amazon"]["key"] = "AKIAJWZLE4H3QIJINM7Q"; //web services api public key
	$config["amazon"]["secret"] = "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"; //web services api secret key
	
	//cache options
	$config["cache"] = array();
	$config["cache"]["path"] = "var/cache"; //path to directory that holds the cache files (defaults to system temp dir)
	$config["cache"]["timeout"] = 86400; //how many seconds before the cached data expires and needs to be refreshed (defaults to 1 day)
	
	//restrictions
	$config["restrictions"] = array();
	$config["restrictions"]["dateLimit"] = ""; //if set, the player will stop working after the specified date (preferred format: yyyy-mm-dd)
	$config["restrictions"]["siteLock"] = ""; //a comma separated list of domain names the player is allowed to run on (supports * wildcards)
	
	//predefined stations
	$config["stations"] = array();
	/*
		Each station element must have a key with its id, and contain some or all of the following options:		
			type (shoutcast): server type (currently only shoutcast is supported)
			host (domain): server host name (defaults to this same host)
			port (int): server port (defaults to 8000)
			uri (path): path to server playlist (defaults to /)
			password (string): admin password (to access xml info)
			policy (url): url to flash policy file (defaults to http://host/crossdomain.xml)
			format (string): track format (like "%artist - %title", or "%1 - %2")
			logo (url): url to station logo image
			name: station name (overrides default stream name)
			genre: station genre (overrides default stream genre)
			website (url): url of the website to link to when the logo is clicked
			proxy (true | false | url): whether to use a proxy with this server or not, and / or an alternate manager url (if true, uses the default manager)
			url (server url): an alternate way to specify server configuration, by specifying all parameters in one url (e.g. http://admin:secret@radio.com:8000/playlist.lst)
			private (true | false): if private, the station is loaded but hidden from the station pane
			alternates (string): comma separated list with urls of alternate servers, should the main server be down or full
			<any other config option>: overrides the default value of the specified config option for this station only
	*/


	//sample station for demo purposes only, replace with your own on a live environment
	$config["stations"]["main"] = array( 
		"host" => $_SESSION['ip'],
		"port" => $_SESSION['port'],
		"password" => "changeme",
		"logo" => "http://player.radio.br/clientes/r2_9-62/logo.png",
	);
	
	
?>
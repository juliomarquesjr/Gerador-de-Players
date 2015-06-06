<?php
	/************************************************************************
		Copyright Daniel Brinca 2011 - All Rights Reserved
		Permitted use only with explicit license by http://danielbrinca.com
	*************************************************************************/
	/*
		Accepted querystring parameters (all are optional):
			station: the id of a station to use, taken from the stations list
		Example: debug.php?station=danielbrincacom
	*/
	
	//station
	$station = $_GET["station"];
	
	//base path
	$basePath = 'http://'.$_SERVER["HTTP_HOST"].preg_replace("/\/$/", "", dirname($_SERVER["SCRIPT_NAME"]));
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DB Player Debug</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<style type="text/css">
		html, body { height:100%; background-color: #999; }
		body { margin: 0px; font-size: 11px; font-family: Arial; color: #222; }
		
	</style>
</head>
<body>
	
	<div id="playerContainer" class="player">
		<script type="text/javascript"><!--
		var config = {
			defaultStation : "<?=$station ?>",
			autoplay : "false",
			mode : "debug",
			path : "<?=$basePath ?>/AACplayer.swf?v=<?=filemtime('AACplayer.swf') ?>"
		};
		//-->
		</script>
		<script type="text/javascript" src="<?=$basePath ?>/player.js?v=<?=filemtime("player.js") ?>"></script>
	</div>	
	
</body>
</html>
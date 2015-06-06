<?php
	/************************************************************************
		Copyright Daniel Brinca 2011 - All Rights Reserved
		Permitted use only with explicit license by http://danielbrinca.com
	*************************************************************************/
	/*
		Accepted querystring parameters (all are optional):
			station: the id of a station to use, taken from the stations list
			mode (mini | large): the type of player being displayed
			autoplay (true | false): overrides the default autoplay option
			
		Example: iframe.php?station=danielbrincacom&autoplay=true
	*/
	
	//station
	$station = $_GET["station"];
	
	//mode
	$mode = $_GET["mode"];
	
	if (!$mode)
		$mode = "mini";
	
	//autoplay
	$autoplay = $_GET["autoplay"];
	
	//base path
	$basePath = 'http://'.$_SERVER["HTTP_HOST"].preg_replace("/\/$/", "", dirname($_SERVER["SCRIPT_NAME"]));
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DB Media Player</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<style type="text/css">
		html, body { background-color: #999; }
		body { margin: 0px; font-size: 0px; }
	</style>
</head>
<body>
	<div id="playerContainer" class="player">
		<script type="text/javascript"><!--
		var config = {
			defaultStation : "<?=$station ?>",
			autoplay : "<?=$autoplay ?>",
			mode : "<?=$mode ?>"
		};
		//-->
		</script>
		<script type="text/javascript" src="<?=$basePath ?>/player.js?v=<?=filemtime("player.js") ?>"></script>
	</div>
</body>
</html>
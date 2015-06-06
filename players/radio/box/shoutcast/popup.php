<?php
	/************************************************************************
		Copyright Daniel Brinca 2011 - All Rights Reserved
		Permitted use only with explicit license by http://danielbrinca.com
	*************************************************************************/
	/*
		Accepted querystring parameters (all are optional):
			data: base64 encoded querystring variables
			<all embed parameters>
			
		Example: popup.php?station=danielbrincacom&autoplay=true
		
		Change log:
			2011-08-07: v1.0
				- Initial release
	*/
	include_once "config.php";
	
	//decode data
	if ($_GET["data"])
		parse_str(base64_decode($_GET["data"]), $_GET);
	
	//popup overrides
	unset($_GET["containerId"]);
	unset($_GET["width"]);
	unset($_GET["height"]);
	$_GET["mode"] = "large";
	$_GET["autoplay"] = ($_GET["autoplay"] == "false")? "false" : "true";
	$_GET['embedCallback'] = "onEmbed";
	
	if ($_GET['station'])
		$_GET['defaultStation'] = $_GET['station'];
	
	//base path
	$basePath = 'http://'.$_SERVER["HTTP_HOST"].preg_replace("/\/$/", "", dirname($_SERVER["SCRIPT_NAME"]));
	
	//override default config with station data
	if ($_GET["defaultStation"]) {
		$defaultStationId = trim(array_shift(explode(',', $_GET["defaultStation"])));
		foreach ($config['stations'][$defaultStationId] as $name => $value)
			$config[$name] = $value;
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>AACplayer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<style type="text/css">
		html, body { height:100%; background-color: #999; }
		body { margin:0px; font-size: 11px; font-family: Arial; color: #222; }
		#banner { text-align: center; }
	</style>
	
	<script type="text/javascript">
		function onEmbed(e){
			if (e.success)
				resize(swfobject.getObjectById(e.id));
		}
	
		function resize(obj){
			<?
			if ($_GET['popupResizable'] == "false")
				print "return; //disabled by config option";
			?>
			if (!obj || typeof obj == "undefined" || obj == null || (typeof obj == "object" && obj.id != "dbPlayer_1"))
				if (typeof swfobject != "undefined")
					obj = swfobject.getObjectById("dbPlayer_1");
			
			if (obj && typeof obj.width != "undefined" && typeof obj.height != "undefined") {
				var ratio = obj.width / obj.height;
				obj.width = window.innerWidth;
				obj.height = obj.width / ratio;
			}
			
		}
		
		window.onresize = resize;
	</script>
</head>
<body onload="resize()">
	<div id="banner">
		<?=$config["ads"] ?>
	</div>
	
	<div class="player">
		<script type="text/javascript"><!--
		var config = {
			<?
			$vars = array();
			foreach ($_GET as $name => $value)
				$vars[] = '"'.$name.'" : "'.$value.'"';
			
			print join(",", $vars);
			?>
		};
		//-->
		</script>
		<script type="text/javascript" src="<?=$basePath ?>/player.js?v=<?=filemtime("player.js") ?>"></script>
	</div>
	
</body>
</html>
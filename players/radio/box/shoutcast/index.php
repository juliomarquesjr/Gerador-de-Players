<?php
session_start();

$radio_stream = explode(":", @$_GET['radio']);

$_SESSION['ip'] = $radio_stream[0];
$_SESSION['port'] = $radio_stream[1];
$_SESSION['autoplay'] = @$_GET['autoplay'];
	
	$stations = array();
	$stations["all"] = "All";
	
	
	//+++++++++++++++++++++++++++++++++++++++++++
	// CODE - Don't edit unless you know what you're doing
	//+++++++++++++++++++++++++++++++++++++++++++
	
	//station
	$station = $_GET["station"];
	
	if (!$station)
		$station = 'main';
	
	
	//base path
	$basePath = 'http://'.$_SERVER["HTTP_HOST"].preg_replace("/\/$/", "", dirname($_SERVER["SCRIPT_NAME"]));
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>
	<?=$defaultStation ?>
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="language" content="pt" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<style type="text/css">
		html, body { height:100%; background-color: #999; }
		body {
	margin: 10px;
	font-size: 11px;
	font-family: Arial;
	color: #222;
	background-color: xxFFFF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
		
		#codeContainer { margin: 10px 0px; padding: 5px; color: #333; border: 1px solid #888; background: #E0FFFF/*#BBB*/; }
		
		h2 { margin-top: 40px; color: #000;}
		h3 { margin-top: 20px; color: #000;}
		
		form { padding: 0px 10px; }
		
		a { color: #005E8A; }
		
		p {margin: 2px 20px; }
	</style>
	
	<script type="text/javascript">
		function refresh(skipPlayerRefresh){
			var form = document.getElementById("embedForm");
			
			var code = "<div class=\"player\">\r\n";
			code += "\t<script type=\"text/javascript\"><!-"+"-\r\n";
			code += "\t\tvar config = {\r\n";
			
			if (form.volume.value != "100")
				code += "\t\t\t\"volumeLevel\" : \"" + form.volume.value + "\",\r\n";
			
			if (form.colors.value)
				code += "\t\t\t\"colors\" : \"" + form.colors.value + "\",\r\n";
			
			if (form.mode.value == "mini" && !form.miniCover.checked)
				code += "\t\t\t\"width\" : \"250\",\r\n";
			
			if (form.language.value)
				code += "\t\t\t\"defaultLanguage\" : \"" + form.language.value + "\",\r\n";
				
			code += "\t\t\t\"defaultStation\" : \"" + form.station.value + "\",\r\n";
			code += "\t\t\t\"autoplay\" : \"" + (form.autoplay.checked? "true" : "false") + "\",\r\n";
			code += "\t\t\t\"mode\" : \"" + form.mode.value + "\"\r\n";
			
			code += "\t\t}\r\n";
			code += "\t//-"+"->\r\n";
			code += "\t</"+"script>\r\n";
			code += "\t<script type=\"text/javascript\" src=\"<?=$basePath ?>/player.js\"></"+"script>\r\n";
			code += "</div>";
			
			var codeContainer = document.getElementById("codeContainer");
			codeContainer.value = code;
			//selectCode();
			
			if (!skipPlayerRefresh){
				dbPlayer_instances = undefined;
				
				new DBPlayer({
					station : (!form.station.value || form.station.value == "all")? "<?=$station ?>" : form.station.value,
					autoplay : form.autoplay.checked? "true" : "false",
					mode : form.mode.value,
					width : (form.mode.value == "large")? 600 : (form.miniCover.checked? 300 : 250),
					volume : form.volume.value,
					colors : form.colors.value,
					language : form.language.value
				}, "playerContainer");
			}
		}
		
		function selectCode(){
			var codeContainer = document.getElementById("codeContainer");
			codeContainer.focus();
			codeContainer.select();
		}
		
	</script>
	
</head>
<body>
	
	<div id="playerContainer" class="player"></div>	
	<script type="text/javascript"><!--
	var config = {
		defaultStation : "<?=$station ?>",
		autoplay : "true",
		mode : "mini",
		defaultLanguage : "pt",
		containerId : "playerContainer"
	};
	//-->
	</script>
	<script type="text/javascript" src="<?=$basePath ?>/player.js?v=<?=filemtime("player.js") ?>"></script>
	
</body>
</html>
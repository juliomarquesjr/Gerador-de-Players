<?php


$ip=$_GET["ip"];
$port=$_GET["porta"];
$streamid=$_GET["id"];

$shoutcastversion=$_GET[versao];

if(empty($shoutcastversion) || empty($ip) || empty($port)){
	echo "
	<div class='riga'><div class='riq_stats'><div class='text_stats'>
	<p class='status'>$label8</p>
	</div></div></div>"; 
	die;
	}
if($shoutcastversion == "1"){
	$open = @fsockopen("$ip","$port");
	if ($open) { 
		fputs($open,"GET /7.html HTTP/1.1\nUser-Agent:Mozilla\n\n"); 
		$read = fread($open,1000); 
		$text = explode("content-type:text/html",$read); 
		$text = explode(",",$text[1]); 
	}else{ 
		$er="<div class='riga'><div class='riq_stats'><div class='text_stats'><p class='status'>$error</p></div></div></div>"; 
	} 

if ($text[1]==1) { $state1 = "Up"; } else { $state1 = "Down"; } 
if ($er) { echo $er; exit; } 
if ($text[1]==1) {
echo "
<div class='riga'><div class='riq_stats'><div class='text_stats'>
<p class='status'><b>$label1</b></p>$text[6] </p>
</div></div></div>";

} else { echo "
<div class='riga'><div class='riq_stats'><div class='text_stats'>
<p class='status'>$label7</p>
</div></div></div>"; }
}
if($shoutcastversion == "2"){
	$obj = simplexml_load_file('http://' . $ip . ':' . $port . '/stats?sid=' . $streamid);
	if($obj && isset($obj->CURRENTLISTENERS)){
		$currentlisteners = $obj->CURRENTLISTENERS;
		$peaklisteners = $obj->PEAKLISTENERS;
		$uniquelisteners = $obj->UNIQUELISTENERS;
		$maxlisteners = $obj->MAXLISTENERS;
		$currentsong = $obj->SONGTITLE;
		$bitrate = $obj->BITRATE;
		echo $loginKey;
		echo "
		<div class='riga'><div class='riq_stats'><div class='text_stats'>
		<p class='status'>$currentsong</p>
		</div></div></div>";
	}
}
?> 


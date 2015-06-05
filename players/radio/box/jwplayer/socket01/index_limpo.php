<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
      

    <title>AO VIVO</title>
    <style type="text/css">
    body {
	background-color: transparent;
}
    </style>
</head>
    <body>
<table width="200" border="0" cellspacing="0">
  <tr>
    <td width="17"></td>
    <td width="21">&nbsp;</td>
    <td width="156">
      <div id='player'>carregando</div>
    </td>
  </tr>
</table>

<?  

$res = array_filter(explode("http://", $radio));

$dados= $res[1];

$portaradio = array_filter(explode(":", $dados));

$HOST= $portaradio[0];

$ANALISAPORTA= $portaradio[1];

$barra = '/';
	
	$result = str_replace($barra, "", $ANALISAPORTA);

$PORTA= $result;



$url=$radio;

$player=$HOST.':'.$PORTA;

ini_set("allow_url_fopen", 1); //função habilitada 
    
ini_set("user_agent", "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)");
$html = file_get_contents($radio);

if( strstr($html,"audio/aacp")){

//se aac nao faz nada
// echo "RADIO  AACP";
 
 //
 
}else{
	
	//INICIA PLAYER MP3
	
	$redirect = "http://www.ciclanohost.com.br/players/mp3/index.php?radio=$radio";
 

 header("location:$redirect");
	
	
	

}



  ?> 
<script type='text/javascript' src='jwplayer.js'></script>


<script type='text/javascript'>
						  
  jwplayer('player').setup({
    'flashplayer': 'player2.swf',
    'file': 'socket://<? echo $player; ?>/;stream.nsv',
	 "shows": {
          "streamTimer": { "enabled": true, "tickRate": 100 }
    },

	'skin': 'elegante.zip',
	'bufferlength': '5',
    'volume': '80',
    'src': '5.3.swf',
	'stretching': 'none',
	'controls': 'false',
	'metaData': 'true',
	'rtmpbuster': 'rtmp://flash1.ciclanohost.com.br/buster',
    'autostart': 'true',
	'provider': 'shoutcast.swf',
    'controlbar': 'bottom',

	 'wmode' : 'transparent',
	
    'width': '90',
    'height': '29'

  });

</script>

</body>
</html>
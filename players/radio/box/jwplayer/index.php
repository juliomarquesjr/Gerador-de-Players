<?  

$res = array_filter(explode("http://", $_GET['radio']));

$dados= $res[1];

$portaradio = array_filter(explode(":", $dados));

$HOST= $portaradio[0];

$ANALISAPORTA= $portaradio[1];

$barra = '/';
	
	$result = str_replace($barra, "", $ANALISAPORTA);

$PORTA= $result;


$url=$_GET['radio'];


$player=$HOST.':'.$PORTA;



  ?> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
      

    <title>AO VIVO</title>
    <style type="text/css">
    body {
	background-color: #<?php echo @$_GET['cor']; ?>;;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    </style>
</head>
    <body>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>



<table>
    
  <tr>      
      <td width="200px">
        <div style="margin-right: -100px" id='player'>            
        </div>
    </td>   
    
  </tr>  
</table>


<script type='text/javascript' src='jwplayer.js'></script>


<script type='text/javascript'>
						  
  jwplayer('player').setup({
    'flashplayer': 'player2.swf',
    'file': 'socket://<? echo @$_GET['radio']; ?>/;stream.nsv',
    //'file': 'socket://70.38.41.128:8030/;stream.nsv',
	 "shows": {
          "streamTimer": { "enabled": true, "tickRate": 100 }
    },

	'skin': 'ciclanohost.zip',
	'bufferlength': '5',
        'volume': '50',
        'src': '5.3.swf',
	'stretching': 'none',
	'controls': 'false',
	'metaData': 'true',
	'rtmpbuster': 'rtmp://flash1.ciclanohost.com.br/buster',
        'autostart': 'true',
	'provider': 'shoutcast.swf',
        'controlbar': 'bottom',
	'wmode' : 'transparent',
	'primary' : 'flash',
	'width': '190',
        'height': '24'
  }
  );

</script>

</body>
</html>
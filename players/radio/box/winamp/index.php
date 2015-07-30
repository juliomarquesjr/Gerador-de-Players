<?
if (isset($_GET['autoplay'])) {
    $autoplay = $_GET['autoplay'];
}

$res = array_filter(explode("http://", $_GET['radio']));

$dados = $res[1];

$portaradio = array_filter(explode(":", $dados));

$HOST = $portaradio[0];

$ANALISAPORTA = $portaradio[1];

$barra = '/';

$result = str_replace($barra, "", $ANALISAPORTA);

$PORTA = $result;



$url = $_GET['radio'];

if ($versao == '1') {


    $versao = '1';
}

if ($versao == '2') {

    $versao = '2';
}

if ($versao == '') {

    $versao = '1';
}

$player = $HOST . ':' . $PORTA;

ini_set("allow_url_fopen", 1); //fun��o habilitada 

ini_set("user_agent", "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)");
$html = file_get_contents($_GET['radio']);

if (strstr($html, "audio/aac")) {

//se aac nao faz nada
// echo "RADIO  AACP";
//
 
} else {

    //INICIA PLAYER MP3
    //$redirect = "http://www.ciclanohost.com.br/players/mp3/index.php?radio=$url";
// header("location:$redirect");
//echo $url;	
}


//////stats


$name = "";     // Change "Your Radio name" with your Radio name.
$ip = $ip;    // Change with your Server Radio IP
$port = $porta;     // Change with your Server Radio Port
$shoutcastversion = $versao;  // Define your SHOUTcast Server version (1 and 2 supported)
$streamid = "1";    // This is needed only if you run SHOUTcast Server 2

$enableicons = "0";    // If you set to "1" the value, you enable the icons with the link for listen the Web Radio with another Media Player
$iconquick = "1";     // QuickTime: if you set to "1" the value, you show in the Stats the icon with the link for these media player
$iconamp = "1";     // WinAmp: if you set to "1" the value, you show in the Stats the icon with the link for these media player
$iconvlc = "1";      // VLC: if you set to "1" the value, you show in the Stats the icon with the link for these media player
$iconitunes = "1";     // iTunes: if you set to "1" the value, you show in the Stats the icon with the link for these media player
$iconwmp = "1";     // Windows Media Plyer: if you set to "1" the value, you show in the Stats the icon with the link for these media player

/* ===================================================+
  || # Preferences & Languages
  |+=================================================== */
$reloadtime = "10";    // Change with the seconds what you want for the automatic reload of the information
$language = "en";     // Change with the language you want. Check the documentation to find out what's available
$theme = "default";    // Change the theme that most prefer among those available (you can find them in the documentation) - default, green, 
$icontheme = "dark";   // Change the theme for icons that most prefer among those available (you can find them in the documentation) - dark, light 
///////////////////
?> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>


        <title>AO VIVO</title>
        <style type="text/css">
            body {
                background-color: transparent;
                margin-left: 0px;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
            }
        </style>
    </head>
    <body>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>

        <script type="text/javascript">
            $(function() {
                var autoref = function() {
                    $('#radio_musica').load('musica.php?ip=<?php echo "$HOST"; ?>&porta=<?php echo "$PORTA"; ?>&versao=<?php echo "$versao"; ?>&id=<?php echo "$streamid"; ?>').fadeIn("fast");
                };
                setInterval(autoref, <?php echo $reloadtime * 1000; ?>);
                autoref();
            });
        </script>

        <table  border="0" cellpadding="0" cellspacing="0" style="background-image: url(fundo1.png); background-repeat:no-repeat; height: 40px; width: 250px; font-family: Verdana, Geneva, sans-serif; font-size: 9px; font-weight: bold; text-align: center;  ">
            <tr>
                <td width="33"><div id='player'></div>

                </td>
                <td width="34"><a href="<? echo $_GET['radio']; ?>/listen.pls" target="_blank"><img src="winamp.png" width="22" height="24" alt="Winamp"></a></td>
                <td>

            <MARQUEE 
                direction="left" SCROLLDELAY="300" loop="1000" width="90%"><div style="  font-family: Verdana, Geneva, sans-serif; font-size: 9px; padding-top: 5px;  text-align: center;"  id="radio_musica">
                </div></MARQUEE>    </td>
    </tr>
</table>


<script type='text/javascript' src='jwplayer.js'></script>


<script type='text/javascript'>

    jwplayer('player').setup({
        'flashplayer': 'player2.swf',
        'file': 'socket://<? echo $player; ?>/;stream.nsv',
        "shows": {
            "streamTimer": {"enabled": true, "tickRate": 100}
        },
        'skin': 'ciclanohost.zip',
        'bufferlength': '5',
        'volume': '80',
        'src': '5.3.swf',
        'stretching': 'none',
        'controls': 'false',
        'metaData': 'true',
        'rtmpbuster': 'rtmp://flash1.ciclanohost.com.br/buster',
        'autostart': '<?php if($autoplay == 'false'){ echo 'false'; } else { echo 'true'; }; ?>',
        'provider': 'shoutcast.swf',
        'controlbar': 'bottom',
        'wmode': 'transparent',
        'primary': 'flash',
        'width': '70',
        'height': '35'
    }
    );

</script>

</body>
</html>
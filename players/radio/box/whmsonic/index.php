<?

if (isset($_GET['autoplay'])) {
    $autoplay = $_GET['autoplay'];
}


if (isset($_GET['userFaceboock'])) {
    $userFaceboock = $_GET['userFaceboock'];
}
if (isset($_GET['userTwitter'])) {
    $userTwitter = $_GET['userTwitter'];
}

$useragent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('|MSIE ([0-9].[0-9]{1,2})|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'IE';
} elseif (preg_match('|Opera/([0-9].[0-9]{1,2})|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Opera';
} elseif (preg_match('|Firefox/([0-9\.]+)|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Firefox';
} elseif (preg_match('|Chrome/([0-9\.]+)|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Chrome';
} elseif (preg_match('|Safari/([0-9\.]+)|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Safari';
} else {
    // browser not recognized!
    $browser_version = 0;
    $browser = 'other';
}
// print "browser: $browser $browser_version";

if ($browser == 'IE') {


    echo '<script type="text/javascript">
	  <!--
	  window.location = "http://www.ciclanohost.com.br/players/semrtmp/ie_player.php?radio=';
    echo $radio;
    echo '"
	  //-->
	  </script>
	  ';
}
//echo $browser;
?>
<html>
<head>
    <title>Ao vivo</title>

    <style>
        body {
            margin:0;
            padding:0;
            background-color: #<?php echo @$_GET['cor']; ?>;
        }
    </style>
</head>
<script type="text/javascript" src="player.js"></script>
<script type="text/javascript">
    new WHMSonic({
        path: "WHMSonic.swf",
        source: "<? echo $_GET['radio']; ?>",
        volume: 90,
        autoplay: <?php if($autoplay == 'false'){ echo 'false'; } else { echo 'true'; }; ?>,
        width: 372,
        height: 60,
        twitter: "https://twitter.com/<?php if(isset($userTwitter)){ echo $userTwitter; } ?>",
        facebook: "http://www.facebook.com/<?php if(isset($userFaceboock)){ echo $userFaceboock; } ?>",
        logo: "http://www.ciclanohost.com.br",
    });
</script>
</html>
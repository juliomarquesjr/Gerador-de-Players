
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <title>Ciclano Host - Player Grant</title>


    <style>
        body {
            margin:0;
            padding:0;
            background-color: #<?php echo @$_GET['cor']; ?>;
        }
    </style>
    <!-- must have -->
    <link href="audio4_html5.css" rel="stylesheet" type="text/css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <!-- and new libraries to use lastfm -->
    <script type="text/javascript" src="js/lastfm.api.md5.js"></script>
    <script type="text/javascript" src="js/lastfm.api.js"></script>
    <script type="text/javascript" src="js/lastfm.api.cache.js"></script>
    <!-- and new libraries to use lastfm -->
    <script type="text/javascript" src="js/swfobject.js"></script>
    <script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>
    <script src="js/jquery.touchSwipe.min.js" type="text/javascript"></script>
    <script src="js/audio4_html5.js" type="text/javascript"></script>
    <!-- must have -->


    <script>
        jQuery(function() {

            jQuery('#audio4_html5_white').audio4_html5({
                playerWidth:500,
                skin: 'whiteControllers',
                initialVolume:0.5,
                responsive:true,
                showRadioStation:false,
                showTitle:false,
                showPlaylistOnInit:false,<!----asas-->

                beneathTitleBackgroundColor_VisiblePlaylist:"#c55151",
                beneathTitleBackgroundOpacity_VisiblePlaylist:0,
                beneathTitleBackgroundColor_HiddenPlaylist:"#c55151",
                beneathTitleBackgroundOpacity_HiddenPlaylist:0,
                beneathTitleBackgroundBorderColor:"#000000",
                beneathTitleBackgroundBorderWidth:3,

                selectedCategMarginBottom:0,

                playlistTopPos:-35,
                playlistPadding:0,
                playlistBgColor:'#000000'
            });


        });
    </script>

</head>

<body bgcolor="#999999">

<div class="audio4_html5">
    <audio id="audio4_html5_white" preload="metadata">
        <div class="xaudioplaylist">
            <ul>
                <li class="xradiostream">http://<?php echo $_GET['radio']; ?>/;</li>
            </ul>
        </div>
        No HTML5 audio playback capabilities for this browser. Use <a href="https://www.google.com/intl/en/chrome/browser/">Chrome Browser!</a>
    </audio>
</div>
<br style="clear:both;">
</body>
</html>

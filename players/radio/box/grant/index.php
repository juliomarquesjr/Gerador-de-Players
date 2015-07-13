
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <title>Example</title>


    <style>
        body {
            margin:0;
            padding:0;
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
                playerWidth:470,
                skin: 'blackControllers',
                initialVolume:0.5,
                responsive:true,
                volumeOnColor: '#cccccc',
                showPlaylistOnInit:false,
                showRadioStation:false,
                showTitle:false,
                imageBorderColor:'#ffffff',
                frameBehindPlayerColor: '#ffffff',

                beneathTitleBackgroundColor_VisiblePlaylist:"#c55151",
                beneathTitleBackgroundOpacity_VisiblePlaylist:0,
                beneathTitleBackgroundColor_HiddenPlaylist:"#c55151",
                beneathTitleBackgroundOpacity_HiddenPlaylist:0,
                beneathTitleBackgroundBorderColor:"#000000",
                beneathTitleBackgroundBorderWidth:3,

                categoryRecordBgOffColor:'#ffffff',
                categoryRecordBgOnColor:'#ffffff',
                categoryRecordBottomBorderOffColor:'#e7e7e7',
                categoryRecordBottomBorderOnColor:'#e7e7e7',
                categoryRecordTextOffColor:'#777777',
                categoryRecordTextOnColor:'#e80000',

                selectedCategBg: '#e80000',
                selectedCategOffColor: '#000000',
                selectedCategOnColor: '#FFFFFF',
                selectedCategMarginBottom:0,


                playlistTopPos:-35,
                playlistPadding:10,
                playlistBgColor:'#ffffff',
                playlistRecordBgOffColor:'#ffffff',
                playlistRecordBgOnColor:'#FFFFFF',
                playlistRecordBottomBorderOffColor:'#e7e7e7',
                playlistRecordBottomBorderOnColor:'#e7e7e7',
                playlistRecordTextOffColor:'#777777',
                playlistRecordTextOnColor:'#e80000',

                searchAreaBg: '#515151',
                searchInputBorderColor:'#515151'

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

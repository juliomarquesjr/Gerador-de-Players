<!DOCTYPE html>
<html lang="pt-BR">

<head>
<link type="text/css" rel="stylesheet" href="http://radiojovempop.com/template/player/style-frame.css" media="screen" charset="utf-8"/>
</head>
<body>

<div class="flash">
<style type="text/css">
  #player-flow{
display:block;
width:295px;
min-width:295px;
height:55px;
}
</style>

<script src="flowplayer-flash/flowplayer-3.2.12.1a.min.1377724914.js"></script>
  <script src="flowplayer-flash/flowplayer.ipad-3.2.12.min.1377177111.js"></script>
  <div id="player-flow" class="players"></div>
  <script type="text/javascript">
    flowplayer("player-flow", {src:"flowplayer-3.2.16.swf",wmode: "opaque"},{
      plugins: {
        rtmp: {
          url: "flowplayer.rtmp-3.2.12.swf",
          netConnectionUrl: "rtmp://server88.ciclanohost.com.br/ciclano",
          failOverDelay: 4000
        },
                controls: {
          scrubber: false,
          fullscreen: false,
          autoHide: false,
          height: 55,
          timeFontSize: 27,
          backgroundColor: "#000000",
          backgroundGradient: [0.3, 0]
        }
      },
      clip: {
        autoPlay: true,
        url: "http://174.142.198.110:8026",
        provider: "rtmp",
        live: true,
        ipadUrl: "http://174.142.198.110:8026/;stream.aac"
      },
      play: null
    }).ipad();
  </script>
</body>

</html>
            
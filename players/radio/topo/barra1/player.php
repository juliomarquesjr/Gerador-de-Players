<!DOCTYPE html>

<head>
    <meta charset="utf-8"/>
    <title>Player para Rádio - Ciclano Host</title>
    <script type="text/javascript" src="ajax-streaming.js"></script>
    <script type="text/javascript" src="javascript.js"></script>
    <style>
        body {
            background: #<?php echo @$_GET['cor']; ?>;
            margin: 0px auto;
            overflow: hidden;
        }

        #player {
            width: 800px;
            height: 35px;
            margin: 0px auto;
        }

        #player-controle {
            width: 220px;
            height: 35px;
            text-align: left;
            float: left
        }

        #player-musica {
            width: 430px;
            height: 35px;
            text-align: left;
            padding-top: 10px;
            float: left;
            cursor: pointer
        }

        #player-links {
            height: 35px;
            text-align: right;
            padding-top: 10px;
            float: right
        }

        .texto_padrao {
            color: #FFFFFF;
            font-family: Geneva, Arial, Helvetica, sans-serif;
            font-size: 11px;
            font-weight: normal;
        }
    </style>
</head>

<body>
<div id="player">
    <div id="player-controle">

        <embed src="http://cdn.srvstm.com/player-topo.swf" width="90" height="35" wmode="transparent"
               allowscriptaccess="always" allowfullscreen="true"
               flashvars="servidor=http://<?php echo @$_GET['ip'] ?>:<?php echo @$_GET['porta'] ?>/&rtmp=rtmp://flash1.ciclanohost.com.br/ciclano&autostart=true"
               type="application/x-shockwave-flash" style="padding-top:5px;"/>
        </embed>&nbsp;&nbsp;&nbsp;<img src="img/img-player-vu-meter.gif" width="100" height="30"
                                       align="top"/>
    </div>

    <div id="player-musica"><span class="texto_padrao"><strong><?php echo @$_GET['n_radio']; ?></strong>&nbsp;<span
            id="musica_atual"></span></div>


    <div id="player-links"><a href="http://<?php echo @$_GET['ip']; ?>:2199/tunein/<?php echo @$_GET['user']; ?>.pls""><img
            src="img/icones/img-icone-player-winamp.png" width="16" height="16" border="0"
            align="absmiddle"/></a>&nbsp;<a href="http://<?php echo @$_GET['ip']; ?>:2199/tunein/<?php echo @$_GET['user']; ?>.asx"><img
            src="img/icones/img-icone-player-mediaplayer.png" width="16" height="16" border="0"
            align="absmiddle"/></a>&nbsp;<a href="http://<?php echo @$_GET['ip']; ?>:2199/tunein/<?php echo @$_GET['user']; ?>.ram"><img
            src="img/icones/img-icone-player-realplayer.png" width="16" height="16" border="0"
            align="absmiddle"/></a></div>


</div>

<script type="text/javascript">
    function get_host() {

        var url = location.href;
        url = url.split("http://www.ciclanohost.com.br");

        return url[2];

    }

</script>

</body>

</html>

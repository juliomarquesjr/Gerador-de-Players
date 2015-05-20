<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="content-type" content="text/html;charset=iso-8859-1"/>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Player para Rádio - Ciclano Host</title>
    <script type="text/javascript" src="ajax-streaming.js"></script>
    <script type="text/javascript" src="javascript.js"></script>
    <style>
        body {
            background: #000000;
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

    <div id="player-musica"><span class="texto_padrao" onclick="abrir_popup_letra();"><strong>Tocando Agora:</strong>&nbsp;<span
            id="musica_atual"></span></div>


    <div id="player-links"><a href="http://<?php echo @$_GET['ip']; ?>:2199/tunein/<?php echo @$_GET['user']; ?>.pls""><img
            src="img/icones/img-icone-player-winamp.png" width="16" height="16" border="0"
            align="absmiddle"/></a>&nbsp;<a href="http://<?php echo @$_GET['ip']; ?>:2199/tunein/<?php echo @$_GET['user']; ?>.asx"><img
            src="img/icones/img-icone-player-mediaplayer.png" width="16" height="16" border="0"
            align="absmiddle"/></a>&nbsp;<a href="http://<?php echo @$_GET['ip']; ?>:2199/tunein/<?php echo @$_GET['user']; ?>.ram"><img
            src="img/icones/img-icone-player-realplayer.png" width="16" height="16" border="0"
            align="absmiddle"/></a></div>


</div>

<div id="aqui" style="border:5px dotted; padding:20px">
    Aqui entra o que vou pegar de outra página via ajax
    <p />
    <a href="#" onclick="xmlhttp.send(null); this.style.display='none';">Clique aqui para pegar o conteudo da página inicial deste site</a>
</div>
<p />
<script type="text/javascript">
    // <!--

    try{
        var xmlhttp = new XMLHttpRequest();
    } catch (error) {
        try {
            var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (error) {
            var xmlhttp = false;
        }
    }

    xmlhttp.open("GET", "http://174.142.97.107:8102/7",true);
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) {
            document.getElementById("aqui").innerHTML = xmlhttp.responseText;
        }
    }

    // -->
</script>

<script type="text/javascript">
    function get_host() {

        var url = location.href;
        url = url.split("http://www.ciclanohost.com.br");

        return url[2];

    }
    //pagCarregada = window.open("http://174.142.97.107:8102/7");

    //document.getElementById('musica_atual').innerHTML = pagCarregada;

</script>

</body>

</html>

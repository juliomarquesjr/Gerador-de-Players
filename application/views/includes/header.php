<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Gerador de Player">
    <meta name="author" content="Ciclano Host">

    <title>Ciclano Host - Gerador de Player</title>

    <link href="<?php echo base_url('assets/css/style.default.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.default.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery.tagsinput.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/toggles.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/bootstrap-timepicker.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/colorpicker.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/dropzone.css'); ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/codemirror/codemirror.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/codemirror/theme/ambiance.css'); ?>">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
    <![endif]-->
</head>
<body>

<header>
    <div class="headerwrapper collapsed">
        <div class="header-left">
            <a href="index.html" class="logo">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt=""/>
            </a>

            <div class="pull-right">
                <a href="#" class="menu-collapse">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
        <!-- header-left -->

        <div class="header-right">
        </div>
        <!-- header-right -->

    </div>
    <!-- headerwrapper -->
</header>

<section>
    <div class="mainwrapper collapsed">
        <div class="leftpanel">
            <h5 class="leftpanel-title">Selecione uma opção</h5>
            <ul class="nav nav-pills nav-stacked">
                <li class="parent"><a href="#"><i class="fa fa-facebook"></i> <span>Facebook Player</span></a>
                    <ul class="children">
                        <li><a href="<?php echo base_url('gerador/facebook_radio'); ?>">Streaming Web Rádio</a></li>
                        <li><a href="<?php echo base_url('gerador/facebook_tv'); ?>">Streaming para Web TV</a></li>
                    </ul>
                </li>
                <li class="parent"><a href="#"><i class="fa fa-music"></i> <span>Web Rádio</span></a>
                    <ul class="children">
                        <li><a href="#">Topo site (Barra)</a></li>
                        <li><a href="#">HTML 5</a></li>
                        <li><a href="#">Box (Caixa)</a></li>
                    </ul>
                </li>

                <li class="parent"><a href="#"><i class="fa fa-video-camera"></i> <span>Web TV</span></a>
                    <ul class="children">
                        <li><a href="#">JWPlayer 6</a></li>
                        <li><a href="#">JWPlayer 5</a></li>
                    </ul>
                </li>
                <li><a href="http://player.radio.br/gerador/" target="_blank"><i class="fa fa-lightbulb-o"></i> <span>Gerador de Players - V1</span></a>
                </li>
            </ul>
        </div>


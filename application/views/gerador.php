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

            <!-- media -->
            <h5 class="leftpanel-title">Selecione uma opção</h5>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-facebook"></i> <span>Facebook Player</span></a></li>
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
        <!-- leftpanel -->

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-facebook"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li><a href="#">Gerador</a></li>
                            <li><?php echo $t_pagina; ?></li>
                        </ul>
                        <h4><?php echo $titulo; ?></h4>
                    </div>
                </div>
                <!-- media -->

            </div>
            <div class="contentpanel">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns" style="display: none;">
                            <a href="#" class="panel-minimize tooltips" data-toggle="tooltip" title=""
                               data-original-title="Minimize Panel"><i class="fa fa-minus"></i></a>
                            <a href="#" class="panel-close tooltips" data-toggle="tooltip" title=""
                               data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                        </div>
                        <!-- panel-btns -->
                        <h4 class="panel-title">Informações da Rádio</h4>

                    </div>
                    <div class="panel-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <select id="select-basic" data-placeholder="Choose One" class="width300">
                                    <option value="">Selecione o Servidor</option>
                                    <optgroup label="Centova Cast">
                                        <option value="centova.ciclanohost.com.br">Centova</option>
                                        <option value="centova2.ciclanohost.com.br">Centova 2</option>
                                        <option value="centova3.ciclanohost.com.br">Centova 3</option>
                                        <option value="centova4.ciclanohost.com.br">Centova 4</option>
                                    </optgroup>
                                    <optgroup label="WHMSonic">
                                        <option value="radios6.ciclanohost.com.br">Radios 6</option>
                                        <option value="radios8.ciclanohost.com.br">Radios 8</option>
                                        <option value="radios9.ciclanohost.com.br">Rádios 9</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="porta">Porta</label>
                                <input type="number" class="form-control" id="porta" placeholder="Porta" required="required">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="img_url">Password</label>
                                <input type="url" class="form-control" id="img_url" placeholder="URL Imagem">
                            </div>
                            <!-- form-group -->

                            <button type="button" class="btn btn-primary mr5" onclick="javascript:gerar_codigo();">Gerar Player</button>

                        </form>
                    </div>

                </div>
                <!-- panel -->
                <div class="row" style="display: none" id="gerador">
                <div class="panel panel-default" >
                    <div class="panel-heading">
                        <h5 class="panel-title">Código do Player</h5>

                        <p>Copie o código abaixo e cole em sua linha do tempo ou página. Após alguns instantes o
                            Facebook irá montar o player.</p>
                    </div>
                    <div class="panel-body" id="codigo"><code>http://player.radio.br/v2/players/facebook/</code></div>

                </div>

            </div></div>
            <!-- pageheader -->
            <div class="contentpanel">
                <!-- CONTENT GOES HERE -->
            </div>
            <!-- contentpanel -->
        </div>
    </div>
    <!-- mainwrapper -->
</section>

<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/retina.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.cookies.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/jquery.autogrow-textarea.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mousewheel.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.tagsinput.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toggles.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/colorpicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dropzone.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/codemirror/codemirror.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/codemirror/formatting.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/codemirror/mode/xml.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/codemirror/mode/javascript.js'); ?>"></script>
<script>
    jQuery(document).ready(function () {

        // Tags Input
        jQuery('#tags').tagsInput({width: 'auto'});

        // Textarea Autogrow
        jQuery('#autoResizeTA').autogrow();

        // Spinner
        var spinner = jQuery('#spinner').spinner();
        spinner.spinner('value', 0);

        // Form Toggles
        jQuery('.toggle').toggles({on: true});

        // Time Picker
        jQuery('#timepicker').timepicker({defaultTIme: false});
        jQuery('#timepicker2').timepicker({showMeridian: false});
        jQuery('#timepicker3').timepicker({minuteStep: 15});

        // Date Picker
        jQuery('#datepicker').datepicker();
        jQuery('#datepicker-inline').datepicker();
        jQuery('#datepicker-multiple').datepicker({
            numberOfMonths: 3,
            showButtonPanel: true
        });

        // Input Masks
        jQuery("#date").mask("99/99/9999");
        jQuery("#phone").mask("(999) 999-9999");
        jQuery("#ssn").mask("999-99-9999");

        // Select2
        jQuery("#select-basic, #select-multi").select2();
        jQuery('#select-search-hide').select2({
            minimumResultsForSearch: -1
        });

        function format(item) {
            return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined) ? "" : item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
        }

        // This will empty first option in select to enable placeholder
        jQuery('select option:first-child').text('');

        jQuery("#select-templating").select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });

        // Color Picker
        if (jQuery('#colorpicker').length > 0) {
            jQuery('#colorSelector').ColorPicker({
                onShow: function (colpkr) {
                    jQuery(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                    jQuery('#colorpicker').val('#' + hex);
                }
            });
        }

        // Color Picker Flat Mode
        jQuery('#colorpickerholder').ColorPicker({
            flat: true,
            onChange: function (hsb, hex, rgb) {
                jQuery('#colorpicker3').val('#' + hex);
            }
        });


    });
</script>
<script>

    CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: {name: "xml", alignCDATA: true},
        lineNumbers: true
    });

    CodeMirror.fromTextArea(document.getElementById("code2"), {
        mode: {name: "javascript"},
        lineNumbers: true,
        theme: 'ambiance'
    });

    var editor = CodeMirror.fromTextArea(document.getElementById("code3"), {
        mode: {name: "javascript"},
        lineNumbers: true,
    });
    CodeMirror.commands["selectAll"](editor);

    function getSelectedRange() {
        return {from: editor.getCursor(true), to: editor.getCursor(false)};
    }

    function autoFormatSelection() {
        var range = getSelectedRange();
        editor.autoFormatRange(range.from, range.to);
    }

    function commentSelection(isComment) {
        var range = getSelectedRange();
        editor.commentRange(isComment, range.from, range.to);
    }

    jQuery(document).ready(function () {

        jQuery('.autoformat').click(function () {
            autoFormatSelection();
        });

        jQuery('.comment').click(function () {
            commentSelection(true);
        });

        jQuery('.uncomment').click(function () {
            commentSelection(false);
        });

    });

</script>
<script>
    function gerar_codigo(){
        document.getElementById('gerador').style.display = 'inline';
        codigo = document.getElementById('codigo');
        servidor = document.getElementById('select-basic').value;
        porta = document.getElementById('porta').value;
        img = document.getElementById('img_url').value;

        codigo.innerHTML = "<code>http://player.radio.br/v2/players/facebook/player.php$ip=" + servidor + "&porta=" + porta + "&logo=" + img +"</code>";
    }
</script>
</body>
</html>

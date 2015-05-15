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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
    <![endif]-->
</head>

<body>

<header>
    <div class="headerwrapper">
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
    <div class="mainwrapper">
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
                        <li><a href="code-editor.html">JWPlayer 6</a></li>
                        <li><a href="general-forms.html">JWPlayer 5</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-lightbulb-o"></i> <span>Gerador de Players V1</span></a></li>
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

                        <p>Basic form with a class name of <code>.form-inline</code>.</p>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <select id="select-basic" data-placeholder="Choose One" class="width300">
                                    <option value="">Selecione o Servidor</option>
                                    <optgroup label="Centova Cast">
                                        <option value="CA">Centova</option>
                                        <option value="NV">Centova 2</option>
                                        <option value="OR">Centova 3</option>
                                        <option value="WA">Centova 4</option>
                                    </optgroup>
                                    <optgroup label="WHMSonic">
                                        <option value="AZ">Radios 6</option>
                                        <option value="CO">Radios 8</option>
                                        <option value="ID">Rádios 9</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Porta">
                            </div>
                            <!-- form-group -->

                            <button type="submit" class="btn btn-primary mr5">Gerar Player</button>

                        </form>
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->

            </div>
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

</body>
</html>

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-music"></i>
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
            <div class="row">
            <div class="contentpanel col-md-6">

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
                        <form class="form-horizontal form-bordered">

                                <div class="form-group col-sm-10">
                                <label class="control-label" for="exampleInputPassword2">Players disponíveis</label><br>
                                <select id="select-search-hide" data-placeholder="Choose One" class="width300" onclick="javascript:atualiza_img();">
                                    <option value="">Selecione o Player</option>
                                    <option value="whmsonic">WHMSonic</option>
                                    <option value="html5">Padrão HTML5</option>
                                    <option value="jwplayer">JW Player 5</option>
                                    <option value="grant">Grant - Branco</option>
                                    <option value="grant2">Grant - Preto</option>
                                    <option value="winamp">Winamp</option>
                                    <option value="shoutcast">ShoutCast Player</option>
                                </select>
                                </div>

                            <div class="form-group col-sm-10">
                                <label class="control-label" for="exampleInputPassword2">Servidores</label><br>
                                <select id="select-basic" data-placeholder="Choose One" class="width300">
                                    <option value="">Selecione o Servidor</option>
                                    <optgroup label="Centova Cast">
                                        <option value="centova.ciclanohost.com.br">Centova</option>
                                        <option value="centova2.ciclanohost.com.br">Centova 2</option>
                                        <option value="centova3.ciclanohost.com.br">Centova 3</option>
                                        <option value="centova4.ciclanohost.com.br">Centova 4</option>
                                        <option value="centova6.ciclanohost.com.br">Centova 6</option>
                                        <option value="centova8.ciclanohost.com.br">Centova 8</option>
                                        <option value="centova10.ciclanohost.com.br">Centova 10</option>
                                        <option value="centova11.ciclanohost.com.br">Centova 11</option>
                                        <option value="centova12.ciclanohost.com.br">Centova 12</option>
                                        <option value="centova13.ciclanohost.com.br">Centova 13</option>
                                        <option value="centova14.ciclanohost.com.br">Centova 14</option>
                                        <option value="centova15.ciclanohost.com.br">Centova 15</option>
                                        <option value="centova16.ciclanohost.com.br">Centova 16</option>
                                        <option value="54.207.10.173">Centova BR 1</option>
                                    </optgroup>
                                    <optgroup label="WHMSonic">
                                        <option value="184.107.58.100">WHMSonic 2</option>
                                        <option value="174.142.176.108">WHMSonic 6</option>
                                        <option value="174.142.210.40">WHMSonic 7</option>
                                        <option value="72.55.180.91">WHMSonic 8</option>
                                        <option value="72.55.156.25">WHMSonic 9</option>
                                    </optgroup>
                                </select>
                                </div>

                            <div class="form-group col-sm-4">
                                <label class="control-label" for="porta">Porta</label>
                                <input type="text" class="form-control" id="porta" required="required">
                            </div>

                            <div class="form-group col-sm-5">
                                <label class="control-label" for="exampleInputPassword2">Cor do fundo</label><br/>
                                <input type="text" name="colorpicker" class="form-control colorpicker-input" placeholder="#000000" id="colorpicker" value="#000000"/>
                                        <span id="colorSelector" class="colorselector">
                                            <span></span>
                                        </span>
                            </div>

                            <div class="form-group col-sm-12">
                            <div class="ckbox ckbox-default">
                                <input type="checkbox" value="1" id="checkboxDefault" />
                                <label for="checkboxDefault">Inicial Automáticamente</label>
                            </div>
                            </div>

                        </form>
                    </div>
                    <div class="panel-footer"><button type="button" class="btn btn-default mr5" onclick="javascript:gerar_codigo();">Gerar Player</button></div>


                </div>
                <!-- panel -->
                
                <div class="row" style="display: none" id="gerador">
                <div class="panel panel-default" >
                    <div class="panel-heading">
                        <h5 class="panel-title">Código do Player</h5>

                        <p>Copie o código abaixo para seu site</p>
                    </div>
                    <div class="panel-body" id="codigo">

                </div>

            </div></div>
            <!-- pageheader -->
            <div class="contentpanel">
                <!-- CONTENT GOES HERE -->
            </div>
            <!-- contentpanel -->
        </div>

            <div class="contentpanel col-md-4" id="prev">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns" style="display: none;">
                            <a href="#" class="panel-minimize tooltips" data-toggle="tooltip" title=""
                               data-original-title="Minimize Panel"><i class="fa fa-minus"></i></a>
                            <a href="#" class="panel-close tooltips" data-toggle="tooltip" title=""
                               data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                        </div>
                        <!-- panel-btns -->
                        <h4 class="panel-title">Imagem do Player</h4>

                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal form-bordered">
                            <img  id="img_previa" src="" border="0" hidden="true"/ >
                        </form>
                    </div>
                </div>

                <!-- panel -->

                <div class="row" style="display: none" id="gerador">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            <h5 class="panel-title">Código do Player</h5>

                            <p>Copie o código abaixo para seu site</p>
                        </div>
                        <div class="panel-body" id="codigo">

                        </div>
                    </div></div>
                <!-- pageheader -->
                <div class="contentpanel">
                    <!-- CONTENT GOES HERE -->
                </div>
                <!-- contentpanel -->
            </div>
             </div>
    </div>
    <!-- mainwrapper -->
</section>
<script src="<?php echo base_url("assets/js/geradorPlayerBox.js");?>"></script>

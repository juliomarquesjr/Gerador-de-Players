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

                                <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Player</label>
                                <select id="select-search-hide" data-placeholder="Choose One" class="width300" onclick="javascript:atualiza_img();">
                                    <option value="">Selecione o Player</option>
                                    <option value="html5">Padrão HTML5</option>
                                </select>
                                </div>

                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Selecione o Servidor</label>
                                <select id="select-basic" data-placeholder="Choose One" class="width300">
                                    <option value="">Selecione o Servidor</option>
                                    <optgroup label="Centova Cast">
                                        <option value="centova.ciclanohost.com.br">Centova</option>
                                        <option value="184.107.58.100">Centova 2</option>
                                        <option value="67.205.76.171">Centova 3</option>
                                        <option value="174.142.198.110">Centova 4</option>
                                        <option value="67.205.85.209">Centova 6</option>
                                        <option value="72.55.180.91">Centova 8</option>
                                        <option value="67.205.96.231">Centova 10</option>
                                        <option value="72.55.171.237">Centova 11</option>
                                        <option value="70.38.41.128">Centova 12</option>
                                        <option value="70.38.9.243">Centova 13</option>
                                        <option value="174.142.175.230">Centova 14</option>
                                        <option value="54.207.74.143">Centova 15</option>
                                        <option value="184.172.113.139">Centova 16</option>
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

                            <div class="form-group col-sm-5">
                                <label class="control-label" for="porta">Porta</label>
                                <input type="number" class="form-control" id="porta" required="required">
                            </div>

                            <div class="form-group col-sm-5">
                                <label class="control-label" for="usuario">Usuário Centova</label>
                                <input type="url" class="form-control" id="usuario">
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
                        <h4 class="panel-title">Prévia do Player</h4>

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
    <!-- mainwrapper -->
</section>
<script>
    function gerar_codigo() {
        document.getElementById('gerador').style.display = 'inline';
        codigo = document.getElementById('codigo');
        servidor = document.getElementById('select-basic').value;
        porta = document.getElementById('porta').value;
        usuario = document.getElementById('usuario').value;
        player = document.getElementById('select-search-hide').value;

        url = location.href;
        url = url.split('/');
        diretorio = url[3];
        url = url[2];

        if(player == "padrao"){
            link = "&#60;audio controls autoplay&#62;<br/>&#60;soucer src=\"http://" + servidor + ":" + porta + "/;\" type=\"audio/mpeg\"&#62;" + "<br/>Seu navegador não possui suporte<br />&#60;/audio&#62;";
        } else {
            link = "&#60;iframe src=http://"+ url + "/" + diretorio +"/players/radio/topo/" + player + "/player.php?ip=" + servidor + "&porta=" + porta + "&user=" + usuario + "&#62;&#60;/iframe&#62;";

        }

    codigo.innerHTML = "<code>"+ link +"</code>";
    }

    function atualiza_img(){
        url = location.href;
        url = url.split('/');
        diretorio = url[3]
        url = url[2];

        document.getElementById('img_previa').src = "http://" + url + "/" + diretorio + "/assets/images/players/" + document.getElementById('select-search-hide').value + ".png";
        document.getElementById('img_previa').hidden = false;
    }

</script>

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
                    <h4 class="panel-title">Informações da TV</h4>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered">

                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Selecione o Servidor</label>
                            <select id="select-basic" data-placeholder="Choose One" class="width300">
                                <option value="">Selecione o Servidor</option>
                                <optgroup label="WSE Manager">
                                    <option value=""></option>
                                    <option value="206.191.148.33">WSE 2</option>
                                    <option value="174.142.115.234">WSE 3</option>
                                    <option value="206.191.148.31">WSE 4</option>
                                    <option value="wse5.player.tv.br">WSE 5</option>
                                    <option value="70.38.71.93">WSE 6</option>
                                    <option value="206.191.148.69">WSE 7</option>
                                    <option value="wse8.player.tv.br">WSE 8</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="control-label" for="nome_tv">Nome da TV</label>
                            <input type="text" class="form-control" id="nome_tv">
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="control-label" for="nome_app">Nome da Aplicação</label>
                            <input type="text" class="form-control" id="nome_app">
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="control-label" for="img_url">Link da Imagem</label>
                            <input type="text" class="form-control" id="img_url">
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

    </div>
</div>
<!-- mainwrapper -->
</section>

<script>
    function gerar_codigo(){
        document.getElementById('gerador').style.display = 'inline';
        codigo = document.getElementById('codigo');
        servidor = document.getElementById('select-basic').value;
        stream = document.getElementById('nome_app').value;
        titulo = document.getElementById('nome_tv').value;
        img = document.getElementById('img_url').value;

        codigo.innerHTML = "<code>https://ciclanohost.com.br/apps/faceboook_tv/index.php?rtmp=rtmp://" + servidor + ":1935&stream=" + stream +"&titulo=" + titulo.replace(/ /g, "%20") + "&logo=" + img +"</code>";
    }
</script>

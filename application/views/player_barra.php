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
<script>
    function gerar_codigo(){
        document.getElementById('gerador').style.display = 'inline';
        codigo = document.getElementById('codigo');
        servidor = document.getElementById('select-basic').value;
        porta = document.getElementById('porta').value;
        img = document.getElementById('img_url').value;

        codigo.innerHTML = "<code>http://player.radio.br/v2/players/facebook/player.php?ip=" + servidor + "&porta=" + porta + "&logo=" + img +"</code>";
    }
</script>

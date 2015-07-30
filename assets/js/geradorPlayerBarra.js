function gerar_codigo(){
    url = location.href;
    url = url.split('/');
    diretorio = url[3]
    url = url[2];

    document.getElementById('gerador').style.display = 'inline';
    codigo = document.getElementById('codigo');
    servidor = document.getElementById('select-basic').value;
    porta = document.getElementById('porta').value;
    usuario = document.getElementById('usuario').value;
    player = document.getElementById('select-search-hide').value;
    nome_radio = document.getElementById('n_radio').value;
    cor = document.getElementById('colorpicker').value;
    cor = cor.replace(/#/g, '');

    link = "&#60;iframe src=\"http://"+ url + "/" + diretorio +"/players/radio/topo/" + player + "/player.php?ip=" + servidor + "&porta=" + porta + "&user=" + usuario + "&n_radio=" + nome_radio + "&cor=" + cor +"\"&#62;&#60;/iframe&#62;";

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
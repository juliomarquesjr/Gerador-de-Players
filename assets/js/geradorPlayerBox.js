function gerar_codigo() {
    url = location.href;
    url = url.split('/');
    diretorio = url[3]
    url = url[2];

    document.getElementById('gerador').style.display = 'inline';

    codigo = document.getElementById('codigo');

    servidor = document.getElementById('select-basic').value;
    porta = document.getElementById('porta').value;
    player = document.getElementById('select-search-hide').value;
    autostart = document.getElementById('checkboxDefault').checked;
    cor = document.getElementById('colorpicker').value;
    cor = cor.replace(/#/g, '');
    var tamanho = tamanho_player(player);


    link = "&#60;iframe src=\"http://" + url + "/" + diretorio + "/players/radio/box/" + player + "/index.php?radio=" + servidor + ":" + porta + "" +
    "&autoplay=" + autostart + "&cor=" + cor + "\" scrolling=\"no\" " + " " + tamanho +
    " frameborder=\"0\"&#62;&#60;/iframe&#62;";

    codigo.innerHTML = "<code>" + link + "</code>";


}

function tamanho_player(player) {

    switch (player) {
        case "whmsonic":
            return "width=\"372\" height=\"60\"";
            break;
        case "jwplayer":
            return "width=\"480\" height=\"220\"";
            break;
        case "shoutcast":
            return "width=\"300\" height=\"50\"";
            break;
        case "grant":
            return "width=\"470\" height=\"130\"";
            break;
        case "grant2":
            return "width=\"470\" height=\"130\"";
            break;

        default:
            return "";
            break;
    }
}

function atualiza_img() {
    url = location.href;
    url = url.split('/');
    diretorio = url[3]
    url = url[2];

    document.getElementById('img_previa').src = "http://" + url + "/" + diretorio + "/assets/images/players/" + document.getElementById('select-search-hide').value + ".png";
    document.getElementById('img_previa').hidden = false;

}
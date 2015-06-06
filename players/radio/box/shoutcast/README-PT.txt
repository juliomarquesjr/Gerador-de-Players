COMO INSTALAR O PLAYER
Para instalar, basta copiar todos os ficheiros e directorias para uma directoria apropriada no servidor da p�gina.
Por favor edite o ficheiro config.php e leia os coment�rios para aprender sobre cada op��o de configura��o.
Note que a directoria var ter� de ter permiss�es de escrita no servidor (ou ent�o aponte a op��o "cache/path" em config.php para outro sitio).

*IMPORTANTE*: No config.php, por favor certifique-se que actualiza o API key/secret da Amazon com a sua pr�pria (ou o player poder� deixar de funcionar correctamente se esta for alterada mais tarde)

Se o servidor de r�dio suportar um socket policy server na porta 843, ent�o o player dever� trabalhar sem mais demoras nem problemas.
Se n�o, ter� de copiar os ficheiros AACplayer.swf e crossdomain.xml para uma directoria no servidor de r�dio, e adicionar a op��o "path" a apontar para esse endere�o, na op��es de javascript (ex. "path": "http://ipshoutcast/caminho/para/AACplayer.swf").


INSTALANDO UM SOCKET POLICY SERVER
Para os maiores benef�cios, � altamente recomendado que instale um Socket Policy Server no mesmo computador onde corre o seu servidor de r�dio.
Com este player dever� ter recebido um pacote com todos os ficheiros necess�rios, incluindo instru��es.


UTILIZA��O
Para embutir o player na sua p�gina de internet, poder�:
	- Simplesmente embutir o ficheiro AACplayer.swf, como qualquer outro ficheiro flash (use vari�veis flashvars ou querystring para controlar a configura��o)
	- Use a biblioteca player.js para embutir o player din�micamente (veja index.php para um exemplo funcional)
	- Use um iframe na sua p�gina a apontar para iframe.php
	

EMBUTIR DIN�MICAMENTE (USANDO JAVASCRIPT)
Poder� embutir o player em qualquer p�gina, simplesmente usando o seguinte c�digo:

<div class="player">
	<script type="text/javascript"><!--
		var config = {
			<parametro1> : "<valor1>",
			...
			<parametro_n> : "<valor_n>"
		}
	//-->
	</script>
	<script type="text/javascript" src="http://dominio.com/caminho/para/player.js"></script>
</div>

Os par�metros actualmente reconhecidos s�o:
	volume, volumeLevel: o n�vel inicial do volume (0-100)
	station, defaultStation: o id da esta��o a carregar inicialmente (separe m�ltiplas esta��es com v�rgulas)
	language, lang, defaultLanguage: o c�digo de 2 letras do idioma a carregar (en, pt, ro, etc)
	autoplay: se dever� iniciar a reprodu��o autom�ticamente logo que o player carregue (true), ou se deve esperar pela ordem do utilizador (false)
	mode: o modo pode ser "mini", "large" (grande) or "debug"
	colors: uma lista de cores separadas por v�rgulas, opcionalmente com identificadores no formato: primaryColor=<cor>,secondaryColor=<cor>,backgroundColor=<cor>,controlBackgroundColor=<cor>,tickerBackgroundColor=<cor>,tickerShadowColor=<cor>
	displayMiniCover: se deve mostrar a capa do �lbum na vers�o mini (true ou false)
	displayPopup: se deve mostrar na vers�o mini o bot�o de popup da vers�o maior (true ou false)
	displayContact: se deve mostrar o bot�o de contacto (true ou false)
	displayFacebook: se deve mostrar o bot�o facebook (true ou false)
	displayTwitter: se deve mostrar o bot�o twitter (true ou false)
	url: a url de base em que todos os endere�os relativos s�o baseados (usa autom�ticamente o caminho de player.js se n�o especificado)
	path: o endere�o para o ficheiro swf (AACplayer.swf)
	manager: o endere�o do ficheiro gestor (manager.php)
	proxy: se true activa o modo proxy, false desactiva-o explicitamente, ou pode ser o endere�o de um script de proxy alternativo (se diferente de proxy.php)
	containerId: o id do elemento html que vai conter o player (se n�o especificado, � criado um autom�ticamente)
	width: o comprimento do player (aten��o: a skin actual n�o est� preparada para ser redimensionada pelo que isto poder� n�o funcionar correctamente)
	height: a altura do player (aten��o: a skin actual n�o est� preparada para ser redimensionada pelo que isto poder� n�o funcionar correctamente)
	popupUrl: o endere�o da vers�o grande do player, a ser usada no popup
	popupWidth: o comprimento da janela popup
	popupHeight: a altura da janela popup
	popupResizable: se � permitido redimensionar a janela de popup (por omiss�o � true)
	embedCallback: uma fun��o javascript a chamar quando o player acaba de carregar
	bgcolor: a cor de fundo, em formato html
	wmode: o modo de janela do swf (pode ser direct, window, opaque, transparent)


ESTRUTURA
	var/ (precisa de permiss�es de escrita)
		cache/ (ficheiros tempor�rios)
		images/ (imagens de logos para esta��es)
	AACplayer.swf (o ficheiro principal do player)
	config.php (o ficheiro principal de configura��o)
	crossdomain.xml (ficheiro de autoriza��o para Flash)
	debug.php (usado para verifica��o de erros)
	iframe.php (uma vers�o simples, apropriada para ser usada com iframes)
	index.php (uma p�gina de demonstra��o do player, demonstrando uma maneira de embutir com javascript)
	integrate.php (um exemplo de um script de integra��o externa)
	manager.php (o script de gest�o do player)
	player.js (a biblioteca javascript para permitir embutir o player numa p�gina externa)
	popup.php (a vers�o grande, em popup)
	proxy.php (apenas um atalho para manager.php)
	

FAQ (Perguntas Frequentes)
	- Por que h� um atraso de 20s antes da reprodu��o come�ar?
		Provavelmente n�o est� dispon�vel um socket policy server no servidor da r�dio, pelo que o player tem de esperar que a tentativa de liga��o seja terminada, antes de tentar outros m�todos.
		Para resolver, por favor certifique-se que o socket policy server est� instalado e a correr correctamente, ou mude o par�metro preferredConnectionType de config.php para "tcp", ou "proxy" (n�o recomendado).
	- Que tipo de sobrecarga isto imp�e ao servidor de r�dio?
		Se estiver dispon�vel um socket policy server, nenhuma.
		De outro modo, se estiver a utilizar o modo tcp, o servidor ter� de ser sondado a cada 20 segundos (configur�vel).
	- Porqu� o socket policy server e quais os seus benef�cios?
		Como uma medida de seguran�a, o Flash requer um socket policy server para que se possa aceder ao stream, a fim de descodificar os dados AAC.
		Ter um socket policy server dispon�vel significa que o player come�a mais r�pidamente, detecta a mudan�a de pista instantaneamente, n�o imp�e nenhum tipo de sobrecarga no servidor, e pode ser utilizado a partir de qualquer sitio ou dominio sem configura��o adicional.
	- Como posso instalar um socket policy server?
		Por favor veja as instru��es que acompanham o pacote respectivo, enviado junto com o player.
		Se estiver disposto a partilhar os dados de acesso SSH comigo, n�o me importo de o fazer por si.
	- Se n�o tiver acesso ao servidor de r�dio, que posso fazer para instalar o socket policy server?
		Devia contactar o apoio t�cnico a empresa que lhe fornece o servi�o de streaming, e perguntar-lhes o que poder�o fazer quanto a esta situa��o.
		Se quiser pode enviar-lhes o pacote do policy server que veio junto com o player, ou redireccion�-los para mim (http://danielbrinca.com).
	- N�o consigo instalar um socket policy server, h� outra solu��o?
		Sim, pode subir os ficheiros AACplayer.swf e crossdomain.xml para o servidor da r�dio, adicionando o par�metro path �s op��es de javascript de modo a apontar para o novo endere�o do ficheiro swf (ex. "path": "http://ipshoutcast/caminho/para/AACplayer.swf").
	- A reprodu��o p�ra ao fim de 30s ou 30m, o que est� a acontecer?
		Est� provavelmente a utilizar o modo proxy, que serve apenas para fins de demonstra��o, e n�o deveria ser utilizado num servidor de produ��o.
		Por favor configure um socket policy server ou suba os ficheiros swf e crossdomain para o servidor de r�dio.
	- Como posso definir um logo para a minha esta��o?
		Adicione o par�metro "logo" na configura��o da esta��o em config.php, e aponte-o para uma url da imagem (ex. "logo" => "http://caminho.para/imagem.png")
	- Que formatos s�o suportados para o logo?
		Tudo o que seja lido pelo Flash, incluindo png, gif, jpg e swf
	- Como posso mudar o tamanho da janela de popup?
		Edite o par�metro "popup" em config.php para um valor do tipo "popup,largura,altura" (ex. "popup,600,250" para uma janela com 600x250 pixels)
	- Posso redistribuir o player para os meus clientes de streaming?
		Sim, mas ter� de adquirir uma licen�a Reseller, mesmo que n�o esteja a planear revender a terceiros.
		As licen�as Premium/Business s�o destinadas apenas para esta��es de r�dio privadas, que perten�am a um mesmo dono ou grupo.
	- Fala a minha l�ngua?
		At� ao momento posso dar suporte t�cnico em Ingl�s, Portugu�s e Espanhol.
		
	
LICEN�A
Todo o trabalho excepto bibliotecas externas tem direitos de reprodu��o ao autor, Daniel Brinca (http://danielbrinca.com).
A vers�o Premium � apenas para uso pessoal, podendo ser usada em mais do que um dom�nio, mas obriga a que todas as esta��es configuradas perten�am ao mesmo dono.
Se quiser distribuir ou revender o player, ou se � um provedor de streaming e quer disponibilizar o player aos seus clientes, ent�o ter� de adquirir o pacote Reseller (mais informa��es em http://danielbrinca.com/aacplayer).

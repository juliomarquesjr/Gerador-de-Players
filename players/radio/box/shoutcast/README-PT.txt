COMO INSTALAR O PLAYER
Para instalar, basta copiar todos os ficheiros e directorias para uma directoria apropriada no servidor da página.
Por favor edite o ficheiro config.php e leia os comentários para aprender sobre cada opção de configuração.
Note que a directoria var terá de ter permissões de escrita no servidor (ou então aponte a opção "cache/path" em config.php para outro sitio).

*IMPORTANTE*: No config.php, por favor certifique-se que actualiza o API key/secret da Amazon com a sua própria (ou o player poderá deixar de funcionar correctamente se esta for alterada mais tarde)

Se o servidor de rádio suportar um socket policy server na porta 843, então o player deverá trabalhar sem mais demoras nem problemas.
Se não, terá de copiar os ficheiros AACplayer.swf e crossdomain.xml para uma directoria no servidor de rádio, e adicionar a opção "path" a apontar para esse endereço, na opções de javascript (ex. "path": "http://ipshoutcast/caminho/para/AACplayer.swf").


INSTALANDO UM SOCKET POLICY SERVER
Para os maiores benefícios, é altamente recomendado que instale um Socket Policy Server no mesmo computador onde corre o seu servidor de rádio.
Com este player deverá ter recebido um pacote com todos os ficheiros necessários, incluindo instruções.


UTILIZAÇÃO
Para embutir o player na sua página de internet, poderá:
	- Simplesmente embutir o ficheiro AACplayer.swf, como qualquer outro ficheiro flash (use variáveis flashvars ou querystring para controlar a configuração)
	- Use a biblioteca player.js para embutir o player dinâmicamente (veja index.php para um exemplo funcional)
	- Use um iframe na sua página a apontar para iframe.php
	

EMBUTIR DINÂMICAMENTE (USANDO JAVASCRIPT)
Poderá embutir o player em qualquer página, simplesmente usando o seguinte código:

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

Os parâmetros actualmente reconhecidos são:
	volume, volumeLevel: o nível inicial do volume (0-100)
	station, defaultStation: o id da estação a carregar inicialmente (separe múltiplas estações com vírgulas)
	language, lang, defaultLanguage: o código de 2 letras do idioma a carregar (en, pt, ro, etc)
	autoplay: se deverá iniciar a reprodução automáticamente logo que o player carregue (true), ou se deve esperar pela ordem do utilizador (false)
	mode: o modo pode ser "mini", "large" (grande) or "debug"
	colors: uma lista de cores separadas por vírgulas, opcionalmente com identificadores no formato: primaryColor=<cor>,secondaryColor=<cor>,backgroundColor=<cor>,controlBackgroundColor=<cor>,tickerBackgroundColor=<cor>,tickerShadowColor=<cor>
	displayMiniCover: se deve mostrar a capa do álbum na versão mini (true ou false)
	displayPopup: se deve mostrar na versão mini o botão de popup da versão maior (true ou false)
	displayContact: se deve mostrar o botão de contacto (true ou false)
	displayFacebook: se deve mostrar o botão facebook (true ou false)
	displayTwitter: se deve mostrar o botão twitter (true ou false)
	url: a url de base em que todos os endereços relativos são baseados (usa automáticamente o caminho de player.js se não especificado)
	path: o endereço para o ficheiro swf (AACplayer.swf)
	manager: o endereço do ficheiro gestor (manager.php)
	proxy: se true activa o modo proxy, false desactiva-o explicitamente, ou pode ser o endereço de um script de proxy alternativo (se diferente de proxy.php)
	containerId: o id do elemento html que vai conter o player (se não especificado, é criado um automáticamente)
	width: o comprimento do player (atenção: a skin actual não está preparada para ser redimensionada pelo que isto poderá não funcionar correctamente)
	height: a altura do player (atenção: a skin actual não está preparada para ser redimensionada pelo que isto poderá não funcionar correctamente)
	popupUrl: o endereço da versão grande do player, a ser usada no popup
	popupWidth: o comprimento da janela popup
	popupHeight: a altura da janela popup
	popupResizable: se é permitido redimensionar a janela de popup (por omissão é true)
	embedCallback: uma função javascript a chamar quando o player acaba de carregar
	bgcolor: a cor de fundo, em formato html
	wmode: o modo de janela do swf (pode ser direct, window, opaque, transparent)


ESTRUTURA
	var/ (precisa de permissões de escrita)
		cache/ (ficheiros temporários)
		images/ (imagens de logos para estações)
	AACplayer.swf (o ficheiro principal do player)
	config.php (o ficheiro principal de configuração)
	crossdomain.xml (ficheiro de autorização para Flash)
	debug.php (usado para verificação de erros)
	iframe.php (uma versão simples, apropriada para ser usada com iframes)
	index.php (uma página de demonstração do player, demonstrando uma maneira de embutir com javascript)
	integrate.php (um exemplo de um script de integração externa)
	manager.php (o script de gestão do player)
	player.js (a biblioteca javascript para permitir embutir o player numa página externa)
	popup.php (a versão grande, em popup)
	proxy.php (apenas um atalho para manager.php)
	

FAQ (Perguntas Frequentes)
	- Por que há um atraso de 20s antes da reprodução começar?
		Provavelmente não está disponível um socket policy server no servidor da rádio, pelo que o player tem de esperar que a tentativa de ligação seja terminada, antes de tentar outros métodos.
		Para resolver, por favor certifique-se que o socket policy server está instalado e a correr correctamente, ou mude o parâmetro preferredConnectionType de config.php para "tcp", ou "proxy" (não recomendado).
	- Que tipo de sobrecarga isto impõe ao servidor de rádio?
		Se estiver disponível um socket policy server, nenhuma.
		De outro modo, se estiver a utilizar o modo tcp, o servidor terá de ser sondado a cada 20 segundos (configurável).
	- Porquê o socket policy server e quais os seus benefícios?
		Como uma medida de segurança, o Flash requer um socket policy server para que se possa aceder ao stream, a fim de descodificar os dados AAC.
		Ter um socket policy server disponível significa que o player começa mais rápidamente, detecta a mudança de pista instantaneamente, não impõe nenhum tipo de sobrecarga no servidor, e pode ser utilizado a partir de qualquer sitio ou dominio sem configuração adicional.
	- Como posso instalar um socket policy server?
		Por favor veja as instruções que acompanham o pacote respectivo, enviado junto com o player.
		Se estiver disposto a partilhar os dados de acesso SSH comigo, não me importo de o fazer por si.
	- Se não tiver acesso ao servidor de rádio, que posso fazer para instalar o socket policy server?
		Devia contactar o apoio técnico a empresa que lhe fornece o serviço de streaming, e perguntar-lhes o que poderão fazer quanto a esta situação.
		Se quiser pode enviar-lhes o pacote do policy server que veio junto com o player, ou redireccioná-los para mim (http://danielbrinca.com).
	- Não consigo instalar um socket policy server, há outra solução?
		Sim, pode subir os ficheiros AACplayer.swf e crossdomain.xml para o servidor da rádio, adicionando o parâmetro path às opções de javascript de modo a apontar para o novo endereço do ficheiro swf (ex. "path": "http://ipshoutcast/caminho/para/AACplayer.swf").
	- A reprodução pára ao fim de 30s ou 30m, o que está a acontecer?
		Está provavelmente a utilizar o modo proxy, que serve apenas para fins de demonstração, e não deveria ser utilizado num servidor de produção.
		Por favor configure um socket policy server ou suba os ficheiros swf e crossdomain para o servidor de rádio.
	- Como posso definir um logo para a minha estação?
		Adicione o parâmetro "logo" na configuração da estação em config.php, e aponte-o para uma url da imagem (ex. "logo" => "http://caminho.para/imagem.png")
	- Que formatos são suportados para o logo?
		Tudo o que seja lido pelo Flash, incluindo png, gif, jpg e swf
	- Como posso mudar o tamanho da janela de popup?
		Edite o parâmetro "popup" em config.php para um valor do tipo "popup,largura,altura" (ex. "popup,600,250" para uma janela com 600x250 pixels)
	- Posso redistribuir o player para os meus clientes de streaming?
		Sim, mas terá de adquirir uma licença Reseller, mesmo que não esteja a planear revender a terceiros.
		As licenças Premium/Business são destinadas apenas para estações de rádio privadas, que pertençam a um mesmo dono ou grupo.
	- Fala a minha língua?
		Até ao momento posso dar suporte técnico em Inglês, Português e Espanhol.
		
	
LICENÇA
Todo o trabalho excepto bibliotecas externas tem direitos de reprodução ao autor, Daniel Brinca (http://danielbrinca.com).
A versão Premium é apenas para uso pessoal, podendo ser usada em mais do que um domínio, mas obriga a que todas as estações configuradas pertençam ao mesmo dono.
Se quiser distribuir ou revender o player, ou se é um provedor de streaming e quer disponibilizar o player aos seus clientes, então terá de adquirir o pacote Reseller (mais informações em http://danielbrinca.com/aacplayer).

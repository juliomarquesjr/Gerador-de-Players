HOW TO INSTALL THE PLAYER
To install, simply copy all the files and folders to an appropriate folder on the website server.
Please edit config.php and read the comments to learn about each configuration option.
Please note that the var directory on the server must have write permissions (or point the setting "cache/path" on config.php to somewhere else).

*IMPORTANT*: On config.php, please make sure to at least update the Amazon's Web Services API key/secret (or the player may stop working if I change my key/secret later on).

If the broadcasting server supports a socket policy server on port 843, the player should work instantly without any further hassle.
If not, you'll have to copy the AACplayer.swf and crossdomain.xml files to a folder on the broadcasting server, and link them to the javascript embedding options, by specifying the path parameter set to your swf's url (e.g. "path": "http://shoutcastip/path/to/AACplayer.swf").


INSTALLING A SOCKET POLICY SERVER
For the best performance and added benefits, it is highly recommended to install a Socket Policy Server on the same machine as your broadcasting server.
With this player you should have received another package with all the necessary files, along with instructions.


USAGE
To embed the player on a website, you may:
	- Simply embed the AACplayer.swf file, like any other flash file (use flashvars or querystring variables to control the configuration parameters)
	- Use the player.js library to embed the player dynamically (see index.php for a working example)
	- Place an iframe on your website and link it to iframe.php


EMBEDDING DYNAMICALLY (WITH JAVASCRIPT)
You may embed the player on any page, simply by pasting the following code (after editing it to your needs).

<div class="player">
	<script type="text/javascript"><!--
		var config = {
			<parameter1> : "<value1>",
			...
			<parameter_n> : "<value_n>"
		}
	//-->
	</script>
	<script type="text/javascript" src="http://domain.com/path/to/player.js"></script>
</div>

The currently allowed embed parameters are the following:
	volume, volumeLevel: the start percentage of the volume bar (0-100)
	station, defaultStation: the station to load (separate multiple stations with commas)
	language, lang, defaultLanguage: the 2-letter language code to load (en, pt, ro, etc)
	autoplay: whether to start playing the stream once the player is loaded (true) or wait for user interaction (false)
	mode: may be "mini", "large" or "debug"
	colors: a comma separated list of html colors, optionally with identifiers in the format: primaryColor=<color>,secondaryColor=<color>,backgroundColor=<color>,controlBackgroundColor=<color>,tickerBackgroundColor=<color>,tickerShadowColor=<color>
	displayMiniCover: whether to display the cover image on the mini version of the player (true or false)
	displayPopup: whether to display the large version popup button (true or false)
	displayContact: whether to display the contact button (true or false)
	displayFacebook: whether to display the facebook button (true or false)
	displayTwitter: whether to display the twitter button (true or false)
	url: the base url used to prepend to all relative paths (taken automatically from the embed script location if not specified)
	path: the path to the player swf file
	manager: the path to the manager script
	proxy: either true to activate the proxy feature, false to deactivate it, or the path to a proxy script (if different from proxy.php)
	containerId: the id of the html element used to contain the player (if not specified, one will be created automatically)
	width: the width of the player (warning: the current skin isn't made to stretch, so this may not work correctly)
	height: the height of the player (warning: the current skin isn't made to stretch, so this may not work correctly)  
	popupUrl: the url of the player's large version, to be used when opening the popup
	popupWidth: the width of the popup window
	popupHeight: the height of the popup window
	popupResizable: whether to resize the large player to the popup window's width (defaults to true)
	embedCallback: a javascript function to call when the player has been loaded
	bgcolor: the background color of the player's swf, in html format
	wmode: the mode of the player's swf (can be direct, window, opaque, transparent)


STRUCTURE
	var/ (must have write permissions)
		cache/ (cache and temporary files)
		images/ (station logos used by the player)
		data/ (stores generated config files)
	AACplayer.swf (the main player flash file)
	config.php (the main configuration file)
	crossdomain.xml (flash security file, should be placed at the web root of the domain hosting the player)
	debug.php (used for debugging purposes)
	iframe.php (a version of the player suitable for embedding through an iframe)
	index.php (the main mock-up page of the player, showing a way to embed using javascript)
	integrate.php (an example of an external integration script)
	manager.php (the main work horse of the player)
	player.js (a library to embed the player on the target or external sites)
	popup.php (the popup version of the player)
	proxy.php (just an alias of manager.php)
	

FAQ
	- Why is there a 20s delay before playback is started?
		This means that there is not a policy server running on the broadcasting server, so the player has to wait until the connection times out, before trying out other methods.
		To solve this, please make sure that the socket policy server is installed and running properly, or change the preferredConnectionType parameter of config.php to "tcp", or "proxy" (not recommended).
	- What kind of overhead does this incur on the server?
		If a socket policy server is available on the broadcasting server, none.
		Otherwise, if using the tcp connection method, the server has to be polled every 20 seconds (configurable).
	- Why the socket policy server and what are its benefits?
		As a security measure, Flash requires a socket policy server to be able to access the stream, which is required to decode the AAC data.
		Having a socket policy server available means that the player starts faster, detects track changes instantly, imposes no server overhead and can be used from any domain or website without any further configuration.
	- How can I install the socket policy server?
		Please refer to the instructions in the package bundled with player.
		If you are willing to send me the SSH login details, I don't mind doing it for you.
	- I don't have access to the broadcasting server, what can I do to install a socket policy server?
		You should contact your provider's tech support team and ask them what they can do for you.
		You can send them the policy-server files bundled with the player, or refer them to me (http://danielbrinca.com).
	- I can't install a socket policy server, is there any other workaround?
		Yes, you may upload the AACplayer.swf and crossdomain.xml files to the broadcasting server, and add a path parameter to the javascript embedding options pointing to the location of the swf file (e.g. "path": "http://shoutcastip/path/to/AACplayer.swf")
	- Playback stops after 30s or 30m, what is happening?
		You're probably using the proxy mode which is provided only for demo/debug purposes, and is not recommended for use on a production server.
		Please either configure the socket policy server or upload the swf and crossdomain files to the broadcasting server.
	- How do I define a logo for my station?
		Just define the logo parameter on the station configuration, and point it to an url of the image (e.g. "logo" => "http://path.to/image.png")
	- What formats are supported for the logo?
		Everything that is readable by Flash, including png, gif, jpg and swf
	- How can I change the popup window size?
		Edit the "popup" parameter on config.php to a value such as "popup,width,height" (e.g. "popup,600,250" for a 600x250 pixel window)
	- May I redistribute the player to my streaming clients?
		Yes, but you will have to purchase a Reseller license, even if you're not planning on selling it.
		The Premium/Business licenses are only meant for privately owned radio stations, belonging to the same owner or group.
	- Can you speak my language?
		At this time I can provide support in English, Portuguese and Spanish.

	
LICENSE
All the work except for linked libraries is copy right of the author, Daniel Brinca (http://danielbrinca.com).
The premium version is for personal use only, and can be used in one or more domains, but the broadcasting station or stations must be owned by the same person or group.
If you want to distribute or resell the player, or if you're a streaming provider and want to make the player available for your clients, you will have to purchase the Reseller package (more info at http://danielbrinca.com/aacplayer).
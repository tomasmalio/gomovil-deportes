<?php
	require_once __DIR__.'/bootstrap.php';

	/* Widget */
	$widget = new Widgets();
	
	/* Declare of extensions directory */
	define('EXTENSIONS_URL', '/extensions', true);

	/* Mobile Detection */
	$detect = new Mobile_Detect();
	define('IS_MOBILE', $detect->isMobile(), true);
	
	$assets = ['css' => [], 'js' => []];

	use GoMovil\Assets;
	use GoMovil\Db;

	/* Db Connection */
	$db = new Db();
	$db->setUsername('gomovil_db');
	$db->setPassword('g0m0v1lc0');
	$db->setDsn('mysql:dbname=gosports_dev;host=db.gomovil.co');
	$db->connect();

	/* Getting section / subsection / subsection */
	$section 	= $_GET['section'];
	$subsection = $_GET['subsection'];
	
	/* Identify the client */
	$domain 	= $_SERVER['HTTP_HOST'];
	(!isset($section)) ? $section = 'home' : '';

	$db->prepare("select * from client c where url = '" . $domain . "' and c.status = 1");
	$db->execute();
	$client = $db->fetch();

	$db->prepare("select sc.* from section s, section_client sc where s.name = '".$section."' and s.id = sc.section_id AND client_id = '" . $client['id'] . "' and s.status = 1 and sc.status = 1");
	$db->execute();
	$section = $db->fetch();

	$db->prepare("select * from section_extension se, extension e where se.section_client_id = '" . $section['id'] . "' and se.extension_id = e.id and se.status = 1");
	$db->execute();
	$sectionExtensions = $db->fetchAll();

	/**
	 * Creating the extension
	 */
	$widgets = [];
	foreach ($sectionExtensions as $extension) {
		$extensionName 	= str_replace(' ', '', lcfirst($extension['name']));
		$objetName 		= str_replace(' ', '', $extension['name']);
		$variable 		= lcfirst($objetName);
		$widget			= 'widget'.$objetName;
		
		// Directory of the extension
		$file = basename((glob(__DIR__.'/'.EXTENSIONS_URL.'/'.$extensionName.'/*.php'))[0]);
		
		// Import the extesion
		require_once __DIR__.'/'.EXTENSIONS_URL.'/'. $extensionName .'/'.$file;
		
		// Construction of the extension and building for our platform
		$$variable 						= new $objetName();
		$$widget 						= $$variable->renderView(); 
		$assetExtension 				= $$variable->assets();
		array_push($assets['css'], $assetExtension['css']);
		array_push($assets['js'], $assetExtension['js']);
		$widgets[$widget]['content'] 	= $$widget;
		$widgets[$widget]['position'] 	= $extension['position'];
	}

	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');
	
	echo $template->render([
		'assetsStyle'				=> (new Assets())->generateAssets($assets['css']),
		'assetsJs'					=> (new Assets())->generateAssets($assets['js']),
		'widgets'					=> $widgets
	]);
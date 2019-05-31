<?php
	require_once __DIR__.'/bootstrap.php';
	
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

	/* Getting sections */
	$s 	= $_GET['s'];

	/* Filters */
	foreach($_GET as $key => $value) {
		$filters[] = $value;
	}
	
	/* Identify the client */
	$domain 	= $_SERVER['HTTP_HOST'];
	(!isset($s) && (!isset($s) && !isset($ss))) ? $s = 'home' : '';

	/**
	 * Client definitions
	 */
	$db->prepare("select c.*, cy.code as country_code, cy.name as country_name from client c, country cy where url = '" . $domain . "' and c.country_id = cy.id and c.status = 1");
	$db->execute();
	$client = $db->fetch();
	define('COUNTRY_CODE', $client['country_code'], true);
	define('COUNTRY_NAME', $client['country_name'], true);
	
	$keywords[] = '{@countryName}';
	$keywordsChange[] = COUNTRY_NAME;

	// Sections
	$db->prepare("select sc.*, c.data as content_external from section s, section_client sc, content c where s.name = '".$s."' and s.id = sc.section_id and sc.content_id = c.id and client_id = '" . $client['id'] . "' and s.status = 1 and sc.status = 1");
	$db->execute();
	$section = $db->fetch();

	/**
	 * Naming sections & subsections
	 */
	if (isset($section['parent_id'])) {
		$findSection = $section['parent_id'];
		$flag = true;
	
		do {
			$db->prepare("select sc.*, s.name from section s, section_client sc where sc.id = '".$findSection."' and s.id = sc.section_id AND client_id = '" . $client['id'] . "' and s.status = 1 and sc.status = 1");
			$db->execute();
			$subsection = $db->fetch();

			$findSection = $subsection['parent_id'];
		
			$keywords[] = '{@'.$subsectionTitle.'Section}';
			$keywordsChange[] = utf8_encode($subsection['title']);
			$subsectionTitle .= 'Sub';
			if (!isset($findSection)) {
				$flag = false;
			}
		} while ($flag);
	}
	// Looking forward for more info in external content with language
	$findingNamingContent = json_decode(utf8_encode(str_replace($keywords, $keywordsChange, $section['content_external'])),true);
	
	for ($i = 0; $i < count($filters); $i++) {	
		// Naming filters for internal use
		$keywords[] = '{@filter'.$i.'}';
		$keywordsChange[] = $filters[$i];

		// Setting naming to use in the front page
		$keywords[] = '{@'.$subsectionTitle.'Section}';
		if ($i == 0 || $i == 1) {
			$keywordsChange[] = $findingNamingContent['title'][$filters[$i]][COUNTRY_CODE];
		} else {
			$keywordsChange[] = (isset($findingNamingContent[$s][$filters[$i - 1]][$filters[$i]]['name'][COUNTRY_CODE])) ? $findingNamingContent[$s][$filters[$i - 1]][$filters[$i]]['name'][COUNTRY_CODE] : $findingNamingContent[$s][$filters[$i - 1]][$filters[$i]]['name']['default'];
		}
		$subsectionTitle .= 'Sub';
	}
	print_r($keywords);
	print_r($keywordsChange);

	// Extensions for the section
	$db->prepare("select * from section_extension se, extension e where se.section_client_id = '" . $section['id'] . "' and se.extension_id = e.id and se.status = 1 ORDER BY se.position ASC");
	$db->execute();
	$sectionExtensions = $db->fetchAll();

	/**
	 * Widgets Constructor
	 */
	$widgets = [];
	$i = 1;

	foreach ($sectionExtensions as $extension) {
		$extensionName 	= str_replace(' ', '', lcfirst($extension['name']));
		$objetName 		= str_replace(' ', '', $extension['name']);
		$variable 		= lcfirst($objetName);
		$widget			= 'widget'.$objetName;
		
		try {
			// Directory of the extension
			$file = __DIR__.'/'.EXTENSIONS_URL.'/'. $extensionName .'/'. basename((glob(__DIR__.'/'.EXTENSIONS_URL.'/'.$extensionName.'/*.php'))[0]);
			
			/**
			 * Validate that the extension exists in our server
			 **/
			if (file_exists($file)) {
				// Import the extesion
				require_once $file;

				// Construction of the extension and building for our platform
				$options = null;
				if (isset($extension['options']) && $extension['options'] != NULL) {
					$options = json_decode($extension['options'], true);
				}
				if (isset($extension['styles']) && $extension['styles'] != NULL) {
					$options = array_merge($options, json_decode($extension['styles'], true));
				}

				/**
				 * Content
				 * We validate if the extensions has external content and from the client
				 */
				$extensionContent = null;
				if (isset($section['content_id']) && (isset($extension['content']) && $extension['content'] != '') && (isset($extension['external_content']) && $extension['external_content'] != '')) {
					$insert = utf8_encode(str_replace($keywords, $keywordsChange, $extension['content']));
					$external = utf8_encode(str_replace($keywords, $keywordsChange, $section['content_external']));
					$extensionContent = json_encode(array_merge(json_decode($insert, true), json_decode($external, true)));
				} elseif (isset($section['content_id']) && !isset($extension['content']) && isset($extension['external_content'])) {
					$extensionContent = utf8_encode(str_replace($keywords, $keywordsChange, $section['content_external']));
				} else {
					$extensionContent = utf8_encode(str_replace($keywords, $keywordsChange, $extension['content']));
				}

				$json = [
					'modelView' => $extension['model_name'],
					'data' => [
						'content' => ($extensionContent != NULL) ? json_decode($extensionContent, true) : [],
						'options' => $options,
					],
				];
				$$variable 						= new $objetName($json);
				$$widget 						= $$variable->renderView(); 
				$assetExtension 				= $$variable->assets();
				array_push($assets['css'], $assetExtension['css']);
				array_push($assets['js'], $assetExtension['js']);
				$widgets['widget'.$i]['content'] 	= $$widget;
				$widgets['widget'.$i]['position'] 	= $extension['position'];
				$i++;
			} else {
				echo "<script>console.log('Error in extension ".$objetName."')</script>";
			}
		} catch (Exception $e) {
			echo 'Error '. $e->getMessage();
		}
	}

	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');
	
	echo $template->render([
		'title'						=> str_replace($keywords, $keywordsChange, utf8_encode($section['title'])),
		'assetsStyle'				=> (new Assets())->generateAssets($assets['css']),
		'assetsJs'					=> (new Assets())->generateAssets($assets['js']),
		'widgets'					=> $widgets,
		'template'					=> (isset($section['layout_id'])) ? $section['layout_id'] : 1,
	]);
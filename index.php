<?php
	require_once __DIR__.'/bootstrap.php';
	ini_set('display_errors', 1);
	
	/* Directory */
	define('ROOTPATH', __DIR__);

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
	(!isset($s) && (!isset($s) && !isset($ss))) ? $s = '' : '';

	session_start();
	if (isset($_POST['ageControl'])) {
		$_SESSION['age_control'] = true;
		header('Location: ' . $_POST['url']);
		exit;
	}

	/**
	 * Client definitions
	 */
	$db->prepare("select c.*, cy.code as country_code, cy.name as country_name, l.value as language, z.zone_name from client c, country cy, language l, zone z where url like '%" . $domain . "%' and c.country_id = cy.id and c.language_id = l.id and c.zone_id = z.id and c.status = 1");
	$db->execute();
	$client = $db->fetch();

	// If the client doesn't exit we redirect to generic HTML Error page
	if (empty($client)) {
		header('Location: error.html');
		exit;
	}
	
	/**
	 * Define Global
	 * 
	 * CLIENT_NAME
	 * COUNTRY_CODE
	 * COUNTRY_NAME
	 */
	define('CLIENT_NAME', str_replace(' ', '', strtolower($client['name'])), true);
	define('COUNTRY_CODE', $client['country_code'], true);
	define('COUNTRY_NAME', $client['country_name'], true);

	/* Definition of the time zone */
	date_default_timezone_set($client['zone_name']);
	setlocale(LC_TIME, explode('_', $client['language'])[0] .'_'. strtoupper(explode('_', $client['language'])[0]));
	
	$keywords[] = '{@countryName}';
	$keywordsChange[] = COUNTRY_NAME;
	$keywords[] = '{@countryCode}';
	$keywordsChange[] = COUNTRY_CODE;

	/**********************************
	 * 			SECTIONS
	 **********************************/
	$db->prepare("select sc.*, c.data as content_external, s.name as section_name, s.uri as uri, sc.age_control as age_control from section s, section_client sc left join content c on c.id = sc.content_id where s.uri = '".$s."' and s.id = sc.section_id and client_id = '" . $client['id'] . "' and s.status = 1 and sc.status = 1");
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

	// Looking forward for more info in external content by language
	$findingNamingContent = json_decode(utf8_encode(str_replace($keywords, $keywordsChange, $section['content_external'])),true);
	
	if (count($filters) > 1) {

		for ($i = 0; $i < count($filters) && count($filters) > 1; $i++) {
			$keywords[] = '{@filter'.$i.'}';
			switch ($i) {
				case 0:
					foreach ($findingNamingContent as $k => $find) {
						if ($k == 'titles') {
							foreach ($find as $key => $finding) {
								if (strtolower($finding[COUNTRY_CODE]) == $filters[$i]) {
									$keywordsChange[] = $key;
									$keywords[] = '{@'.$subsectionTitle.'Section}';
									$keywordsChange[] = $finding[COUNTRY_CODE];
									$flag = true;
									break;
								}
							}
						}	
					}
					break;
				case 1:
					$flag = false;
					foreach ($findingNamingContent as $k => $find) {
						foreach ($find as $key => $finding) {
							if (isset($finding[COUNTRY_CODE])) {
								if (strtolower($finding[COUNTRY_CODE]) == $filters[$i]) {
									$keywordsChange[] = $key;
									$keywords[] = '{@'.$subsectionTitle.'Section}';
									$keywordsChange[] = $finding[COUNTRY_CODE];
									$flag = true;
								}
								if ($flag) {break; };
							}
							if ($flag) {break; };
						}
						if ($flag) {break; };
					}
					if (!$flag) {
						$keywordsChange[] = $filters[$i];
					}
					break;
				default:
					$flag = false;
					foreach ($findingNamingContent as $k => $find) {
						foreach ($find as $key => $finding) {
							if (isset($finding[$filters[$i]])) {
								$keywordsChange[] = $filters[$i];
								$keywords[] = '{@'.$subsectionTitle.'Section}';
								$keywordsChange[] = (isset($finding[$filters[$i]]['name'][COUNTRY_CODE])) ? $finding[$filters[$i]]['name'][COUNTRY_CODE] : $finding[$filters[$i]]['name']['default'];
								$flag = true;
							}
							if ($flag) {break; };
						}
						if ($flag) {break; };
					}
					if (!$flag) {
						$keywordsChange[] = $filters[$i];
					}
					if (substr_count($filters[$i], '-') >= 2) {
						$keywords[] = '{@'.$subsectionTitle.'Section}';
						if (strpos($filters[$i], 'vs') !== false) {
							$keywordsChange[] = str_replace('Vs', 'vs', ucwords(str_replace('-', ' ', $filters[$i])));
						} else {
							$keywordsChange[] = ucfirst(str_replace('-', ' ', $filters[$i]));
						}
					}
					break;
			}
			if ($flag) {
				$subsectionTitle .= 'Sub';
			}
		}
	} else {
		$keywords[] = '{@filter0}';
		$keywordsChange[] = $filters[0];
	}

	/**********************************
	 * 			MENU
	 **********************************/
	$db->prepare("select sc.id, sc.title as title, sc.age_control, s.uri as url from section_client sc, section s where sc.section_id = s.id and sc.client_id = '" . $client['id'] . "' and sc.parent_id is null and sc.menu_display IS NOT NULL and s.status = 1 and sc.status = 1 ORDER BY sc.menu_display ASC");
	$db->execute();
	$menu_principal = $db->fetchAll();

	$menu = [];
	foreach ($menu_principal as $item) {

		/**
		 * Object 			menu_display if it's not null we you use for order menu buttons
		 * @* @param Object var Description
		 */
		$db->prepare("select sc.title as title, s.name as url, c.data as content, sc.menu_display as display 
		from section_client sc, section s, content c 
		where sc.section_id = s.id 
		and sc.client_id = '" . $client['id'] . "' 
		and sc.parent_id = '".$item['id']."' 
		and sc.content_id = c.id
		/*and sc.menu_display = 1*/
		and s.status = 1 
		and sc.status = 1");
		$db->execute();
		$items = $db->fetchAll();
		
		/**
		 * 
		 */
		if (count($items) > 0) {
			$submenu = [];
			/**
			 * Getting the info from the content  to create subitem
			 * associate the url of the child of the parent
			 * and search inside the content
			 */
			foreach ($items as $subitem) {
				$array = json_decode(utf8_encode(str_replace($keywords, $keywordsChange, $subitem['content'])), true);
				$titles = $array['titles'];
				// Creating content inside the menu
				foreach ($array as $key => $items) {
					if ($key == $subitem['url']) {
						foreach ($items as $k => $value) {
							$array[$subitem['url']][$titles[$k][COUNTRY_CODE]] = $value;
							unset($array[$subitem['url']][$k]);
						}
						break;
					}
				}
				if (is_array($array[$subitem['url']])) {
					$submenu[] = [
						'url' 	=> strtolower($titles[$subitem['url']][COUNTRY_CODE]),
						'title' => str_replace($keywords, $keywordsChange, utf8_encode($subitem['title'])),
						'display' => (isset($subitem['display']) && $subitem['display']) ? true : false,
						'items' => $array[$subitem['url']],
					];
				}
			}
		}
		$menu[] = [
			'url' 	=> $item['url'],
			'title' => str_replace($keywords, $keywordsChange, utf8_encode($item['title'])),
			'submenu' => $submenu,
			'age_control' => $item['age_control']
		];
		unset($submenu);
	}
	
	// print_r($keywords);
	// print_r($keywordsChange);
	// var_dump($menu);
	// exit;

	/**********************************
	 * 			CUSTOMIZATION
	 **********************************/
	$db->prepare("select * from customization c where c.client_id = '" . $client['id'] . "' and c.status = 1");
	$db->execute();
	$customization = $db->fetch();

	$assetsConstructor = new Assets($client['name'], $client['id'], $customization);
	$globalStyle = '/css/styles.'.CLIENT_NAME.'.min.css?v=' . date('YmdHis', strtotime($customization['modify_date']));
	
	/**********************************
	 * 			EXTENSIONS
	 **********************************/
	if (IS_MOBILE) {
		$db->prepare("select *, se.id as idExtension, se.content as extensionContent 
		from section_extension se, extension e 
		where se.section_client_id = '" . $section['id'] . "' 
		and se.extension_id = e.id 
		and se.status = 1 ORDER BY se.position_mobile ASC");
	} else {
		$db->prepare("select *, se.id as idExtension, se.content as extensionContent 
		from section_extension se, extension e 
		where se.section_client_id = '" . $section['id'] . "' 
		and se.extension_id = e.id 
		and se.status = 1 ORDER BY se.position ASC");
	}
	$db->execute();
	$sectionExtensions = $db->fetchAll();

	// Widgets Constructor
	$widgets = [];
	$i = 1;

	foreach ($sectionExtensions as $extension) {

		if (isset($extension['external_content']) && $extension['external_content'] != '') {
			$db->prepare("select * from content c where c.id = '" . $extension['external_content'] . "' and c.status = 1");
			$db->execute();
			$externalContent = $db->fetch();
		}

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
				$options = [];
				if (isset($extension['options']) && $extension['options'] != NULL) {
					$options = json_decode($extension['options'], true);
				}

				if (isset($extension['scripts']) && $extension['scripts'] != NULL) {
					$arrayScripts['scripts'][0] = json_decode($extension['scripts'], true);
					$options = array_merge($options, $arrayScripts);
					unset($arrayScripts);
				}

				if (isset($extension['styles']) && $extension['styles'] != NULL) {
					$arrayStyles['styles'] = json_decode($extension['styles'], true);
					$options = array_merge($options, $arrayStyles);
					unset($arrayStyles);
				}

				/**
				 * Content
				 * We validate if the extensions has external content and from the client
				 */
				$extensionContent = null;
				if (isset($section['content_id']) && (isset($extension['content']) && $extension['content'] != '') && (isset($extension['external_content']) && $extension['external_content'] != '')) {
					$insert = utf8_encode(str_replace($keywords, $keywordsChange, $extension['content']));
					$external = utf8_encode(str_replace($keywords, $keywordsChange, $externalContent['data']));
					$extensionContent = json_encode(array_merge(json_decode($insert, true), json_decode($external, true)));
				} 
				
				elseif (isset($section['content_id']) && !isset($extension['content']) && isset($extension['external_content'])) {
					$extensionContent = utf8_encode(str_replace($keywords, $keywordsChange, $externalContent['data']));
				} 
				
				else {
					$extensionContent = utf8_encode(str_replace($keywords, $keywordsChange, $extension['content']));
				}

				$json = [
					'id'			=> $extension['idExtension'],
					'clientName'	=> CLIENT_NAME,
					'modelView' 	=> $extension['model_name'],
					'viewName' 		=> (isset($extension['view_name'])) ? $extension['view_name'] : '',
					'data' => [
						'content' 	=> ($extensionContent != NULL) ? json_decode($extensionContent, true) : [],
						'options'	=> $options,
					],
				];

				try {
					$$variable 						= new $objetName($json);
				} catch (Exception $e) {
					$$variable = null;
				}
				if ($$variable != null) {
					$$widget 				= $$variable->renderView(); 

					/**
					 * Assets generator of extension
					 * 
					 * If we modify the styles or de scripts we 
					 * generate the compile and minify.
					 * If not we look forward for the old files 
					 * generated before
					 */
					if (isset($extension['modify_status']) && $extension['modify_status']) {

						$assetExtension 	= $$variable->assets(strtotime($extension['modify_date']));
						
						$assetCss = '';
						$assetScript = '';
						foreach ($assetExtension['css'] as $css) {
							$assetCss .= $css.',';
						}
						foreach ($assetExtension['js'] as $js) {
							$assetScript .= $js.',';
						}
						$assetCss = rtrim($assetCss,',');
						$assetScript = rtrim($assetScript,',');
						
						// Update the new info for the section extension
						$db->prepare("UPDATE section_extension 
									  SET modify_date = '".date('Y-m-d H:i:s')."', 
									  modify_status = '0',
									  styles_files = '".$assetCss."',
									  scripts_files = '".$assetScript."'
									  WHERE id = ".$extension['idExtension'].";");
						$db->execute();
					} else {
						if ($extension['styles_files'] != '') {
							$assetExtension['css'] 	= explode(',', $extension['styles_files']);
						} else {
							$assetExtension['css'] = [];
						}
						if ($extension['scripts_files'] != '') {
							$assetExtension['js'] 	= explode(',', $extension['scripts_files']);
						} else {
							$assetExtension['js'] = [];
						}
					}

					array_push($assets['css'], $assetExtension['css']);
					array_push($assets['js'], $assetExtension['js']);
					$widgets['widget'.$i]['content'] 	= $$widget;
					if (IS_MOBILE) {
						$widgets['widget'.$i]['position'] 	= $extension['position_mobile'];
					} else {
						$widgets['widget'.$i]['position'] 	= $extension['position'];
					}
				}
				$i++;
			} else {
				// Problem with extension
				echo "<script>console.log('Error in extension ".$objetName."')</script>";
			}
		} catch (Exception $e) {
			echo 'Error '. $e->getMessage();
		}
	}

	// if (IS_MOBILE) {
	//$ampStyles = $assetsConstructor->generateAssetsAmp($assets['css']);
	// // }

	// print_r($ampStyles);
	// exit;

	/**
	 * Render view
	 */
	if (isset($client['amp']) && $client['amp']) {
		$template 		= $twig->load('generateIndexAmp.tpl.html');
		$assetsStyle 	= $assets['css'];
		$assetsJs 		= $assetsConstructor->generateAssets($assets['js']);
	} else {
		$template 		= $twig->load('generateIndex.html');
		$assetsStyle 	= $assetsConstructor->generateAssets($assets['css']);
		$assetsJs 		= $assetsConstructor->generateAssets($assets['js']);
	}
	
	echo $template->render([
		'title'						=> str_replace($keywords, $keywordsChange, utf8_encode($section['title'])),
		'globalStyle'				=> $globalStyle,
		// 'assetsStyle'				=> $assetsConstructor->generateAssets($assets['css']),
		// 'assetsJs'					=> $assetsConstructor->generateAssets($assets['js']),
		'assetsStyle'				=> $assetsStyle,
		'assetsJs'					=> $assetsJs,
		'widgets'					=> $widgets,
		'template'					=> ($section['age_control'] && !$_SESSION['age_control']) ? '-age-control' : ((isset($section['layout_id'])) ? $section['layout_id'] : 1),
		'logo'						=> $client['logo'],
		'menu'						=> $menu,
		'country'					=> COUNTRY_CODE,
		'url'						=> $_SERVER['REQUEST_URI'],
	]);
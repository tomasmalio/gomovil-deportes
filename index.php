<?php
	require_once __DIR__.'/bootstrap.php';
	//ini_set('display_errors', 1);

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
	use Phpfastcache\CacheManager;
	use Phpfastcache\Config\ConfigurationOption;
	//use GoMovil\AmpRemoveUnusedCss;

	/* Db Connection */
	include 'include/db.php';

	/* Getting sections */
	(isset($_GET['s'])) ? $s = $_GET['s'] : $s = '';

	/* Filters */
	$filters = [];
	foreach($_GET as $key => $value) {
		$filters[] = $value;
	}

	/* Identify the client */
	$domain 	= $_SERVER['HTTP_HOST'];
	(!isset($s) && (!isset($s) && !isset($ss))) ? $s = '' : '';

	$cacheNameSection = '';
	foreach ($filters as $filter) {
		$cacheNameSection .= $filter;
	}

	($cacheNameSection == '') ? $cacheNameSection = 'home' : '';

	// Setup File Path on your config files
	// Please note that as of the V6.1 the "path" config 
	// can also be used for Unix sockets (Redis, Memcache, etc)
	CacheManager::setDefaultConfig(new ConfigurationOption([
		'path' => ROOTPATH . '/files', // or in windows "C:/tmp/"
	]));

	// In your class, function, you can call the Cache
	$InstanceCache = CacheManager::getInstance('files');

	/**********************************
	 * 			CLIENT
	 **********************************/
	// Try to get CLIENT from cache
	$CachedClient = $InstanceCache->getItem('client');
	if (!$CachedClient->isHit()) {
		// Charge client info to cache
		$db->prepare("select c.*, cy.code as country_code, cy.name as country_name, l.value as language, z.zone_name from client c, country cy, language l, zone z where url like '%" . $domain . "%' and c.country_id = cy.id and c.language_id = l.id and c.zone_id = z.id and c.status = 1");
		$db->execute();
		$clientSql = $db->fetch();

		$CachedClient->set($clientSql)->expiresAfter(604800);
		$InstanceCache->save($CachedClient);
	}
	$client = $CachedClient->get();
	
	// Sessions
	session_start();

	$_SESSION['clientConfig'] = json_decode($client['config']);

	// Delete everything
	//$InstanceCache->clear();
	
	/* Security control */
	if (isset($_POST['subscriptionId']) && isset($_POST['token'])) {
		if (isset($client['security_endpoint']) && $client['security_endpoint'] <> '') {
			$return = @file_get_contents($client['security_endpoint']);
			// If there's response we set the suscribe session
			if (strpos($http_response_header[0], "200")) {
				$_SESSION['suscribe'] = true;
			} 
			// Redirect to the page before
			else {
				header('Location: '.$_SERVER['HTTP_REFERER']);
			}
		}
		// There's not security endpoint define
		else {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}
	}

	/* Age control */
	if (isset($_POST['ageControl'])) {
		$_SESSION['age_control'] = true;
		header('Location: ' . $_POST['url']);
		exit;
	}

	// If the client doesn't exit we redirect to generic HTML Error page
	if (empty($client)) {
		header('Location: error.html');
		exit;
	}
	
	/**
	 * Define Global
	 * 
	 * DOMAIN
	 * CLIENT_NAME
	 * COUNTRY_CODE
	 * COUNTRY_NAME
	 */
	define('DOMAIN', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']);
	define('CLIENT_NAME', str_replace(' ', '', strtolower($client['name'])), true);
	define('COUNTRY_CODE', $client['country_code'], true);
	define('COUNTRY_NAME', $client['country_name'], true);
	define('DATE_TIMEZONE', $client['zone_name']);
	define('LOCAL_TIME', explode('_', $client['language'])[0] .'_'. strtoupper(explode('_', $client['language'])[0]));

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
	// Try to get SECTION from cache
	$key = 'section'. $s;
	$CachedSection = $InstanceCache->getItem($key);

	if (!$CachedSection->isHit()) {
		// Charge section info to cache
		$db->prepare("select sc.*, c.data as content_external, s.name as section_name, s.uri as uri, sc.age_control as age_control, sc.security_id 
					from section s, section_client sc 
					left join content c on c.id = sc.content_id 
					where s.uri = '".$s."' 
					and s.id = sc.section_id 
					and client_id = '" . $client['id'] . "' 
					and s.status = 1 
					and sc.status = 1");
		$db->execute();
		$sectionSql = $db->fetch();

		$CachedSection->set($sectionSql)->expiresAfter(86400);
		$InstanceCache->save($CachedSection);
	}
	$section = $CachedSection->get();

	// If the client doesn't exit we redirect to generic HTML Error page
	if (empty($section)) {
		header('Location: error.html');
		exit;
	}

	// Security validation
	if (isset($section['security_id']) && $section['security_id'] && !$_SESSION['suscribe']) {
		$db->prepare("select * from security s where s.id = ". $section['security_id'] ." and s.status = 1");
		$db->execute();
		$security = $db->fetch();
		$_SESSION['suscribe'] = false;
		if ($security) {
			header('Location: '.$security['address']);
		}
	}
	/**
	 * Naming sections & subsections
	 */
	if (isset($section['parent_id'])) {
		$findSection = $section['parent_id'];
		$flag = true;
	
		do {
			/**********************************
			 * 			SUBSECTIONS
			 **********************************/
			// Try to get SUBSECTION from cache
			$CachedSubSection = $InstanceCache->getItem('subsection');

			if (!$CachedSubSection->isHit()) {
				$db->prepare("select sc.*, s.name from section s, section_client sc where sc.id = '".$findSection."' and s.id = sc.section_id AND client_id = '" . $client['id'] . "' and s.status = 1 and sc.status = 1");
				$db->execute();
				$subsectionSql = $db->fetch();

				$CachedSubSection->set($subsectionSql)->expiresAfter(86400);
				$InstanceCache->save($CachedSubSection);
			}
			$subsection = $CachedSubSection->get();

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
								if ((strtolower($finding[COUNTRY_CODE]) == $filters[$i]) || (strtolower($finding['default']) == $filters[$i])) {
									$keywordsChange[] = $key;
									$keywords[] = '{@'.$subsectionTitle.'Section}';
									$keywordsChange[] = (isset($finding[COUNTRY_CODE]) ? $finding[COUNTRY_CODE] : $finding['default']);
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
							if (isset($finding[COUNTRY_CODE]) || isset($finding['default'])) {
								if ((strtolower($finding[COUNTRY_CODE]) == $filters[$i]) || (strtolower($finding['default']) == $filters[$i])) {
									$keywordsChange[] = $key;
									$keywords[] = '{@'.$subsectionTitle.'Section}';
									$keywordsChange[] = (isset($finding[COUNTRY_CODE]) ? $finding[COUNTRY_CODE] : $finding['default']);
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
		if (isset($filters[0])) {
			$keywords[] = '{@filter0}';
			$keywordsChange[] = $filters[0];
		}
	}

	/**********************************
	 * 			MENU
	 **********************************/
	// Try to get MENU from cache
	$CachedMenu = $InstanceCache->getItem('menu');
	
	if (!$CachedMenu->isHit()) {
		$db->prepare("select sc.id, sc.title as title, sc.age_control, s.uri as url 
					from section_client sc, section s 
					where sc.section_id = s.id 
					and sc.client_id = '" . $client['id'] . "' 
					and sc.parent_id is null 
					and sc.menu_display IS NOT NULL 
					and s.status = 1 
					and sc.status = 1 
					ORDER BY sc.menu_display ASC");
		$db->execute();
		$menuPrincipalSql = $db->fetchAll();

		$CachedMenu->set($menuPrincipalSql)->expiresAfter(604800);
		$InstanceCache->save($CachedMenu);
	}
	$menuPrincipal = $CachedMenu->get();

	$menu = [];

	
	foreach ($menuPrincipal as $item) {

		/**
		 * Object 			menu_display if it's not null we you use for order menu buttons
		 * @* @param Object var Description
		 */
		/**
		 * Try to get MENU_ITEMS from cache
		 */
		$key = 'menuItems' . $item['id'];
		$CachedMenuItems = $InstanceCache->getItem($key);

		if (!$CachedMenuItems->isHit()) {
			$db->prepare("select sc.title as title, s.name as url, c.data as content, sc.menu_display as display 
						from section_client sc, section s, content c 
						where sc.section_id = s.id 
						and sc.client_id = '" . $client['id'] . "' 
						and sc.parent_id = '".$item['id']."' 
						and sc.content_id = c.id
						and s.status = 1 
						and sc.status = 1");
			$db->execute();
			$itemsSql = $db->fetchAll();
			
			$CachedMenuItems->set($itemsSql)->expiresAfter(604800);
			$InstanceCache->save($CachedMenuItems);
		}
		$items = $CachedMenuItems->get();

		/**
		 * Generate the items for the menu item
		 */
		$submenu = [];
		if (count($items) > 0) {
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
							if (isset($titles[$k][COUNTRY_CODE])) {
								$array[$subitem['url']][$titles[$k][COUNTRY_CODE]] = $value;
							} else {
								$array[$subitem['url']][$titles[$k]['default']] = $value;
							}
							unset($array[$subitem['url']][$k]);
						}
						break;
					}
				}
				if (isset($array[$subitem['url']]) && is_array($array[$subitem['url']])) {
					$submenu[] = [
						'url' 		=> (isset($titles[$subitem['url']][COUNTRY_CODE]) ? strtolower($titles[$subitem['url']][COUNTRY_CODE]) : strtolower($titles[$subitem['url']]['default'])),
						'title' 	=> str_replace($keywords, $keywordsChange, utf8_encode($subitem['title'])),
						'display' 	=> (isset($subitem['display']) && $subitem['display']) ? true : false,
						'items' 	=> $array[$subitem['url']],
					];
				}
			}
		}
		$menu[] = [
			'url' 			=> $item['url'],
			'title' 		=> str_replace($keywords, $keywordsChange, utf8_encode($item['title'])),
			'submenu' 		=> $submenu,
			'age_control' 	=> $item['age_control']
		];
		unset($submenu);
	}

	// print_r($keywords);
	// print_r($keywordsChange);

	/**********************************
	 * 			CUSTOMIZATION
	 **********************************/
	/**
	* Try to get CUSTOMIZATION from cache
	*/
	$CachedCustomization = $InstanceCache->getItem('customization');

	if (!$CachedCustomization->isHit()) {
		$db->prepare("select * from customization c where c.client_id = '" . $client['id'] . "' and c.status = 1");
		$db->execute();
		$customizationSql = $db->fetch();

		$CachedCustomization->set($customizationSql)->expiresAfter(604800);
		$InstanceCache->save($CachedCustomization);
	}
	$customization = $CachedCustomization->get();

	/**
	* Try to get GENERAL ASSETS from cache
	*/
	$CachedAsssets = $InstanceCache->getItem('assets');

	if (!$CachedAsssets->isHit()) {
		$assetsConstructorBase = new Assets($client['name'], $client['id'], $customization);

		$CachedAsssets->set($assetsConstructorBase)->expiresAfter(86400);
		$InstanceCache->save($CachedAsssets);
	}
	$assetsConstructor = $CachedAsssets->get();

	$globalStyle = '/css/styles.'.CLIENT_NAME.'.min.css?v=' . date('YmdHis', strtotime($customization['modify_date']));
	
	/**********************************
	 * 			EXTENSIONS
	 **********************************/
	/**
	* Try to get SECTION EXTENSIONS from cache
	*/
	if (IS_MOBILE) {
		$key = 'sectionExtensionsMobile'. $section['id'];
		$CachedSectionExtensionsMobile = $InstanceCache->getItem($key);
	
		if (!$CachedSectionExtensionsMobile->isHit()) {
			$db->prepare("select *, se.id as idExtension, se.content as extensionContent 
			from section_extension se, extension e 
			where se.section_client_id = '" . $section['id'] . "' 
			and se.extension_id = e.id 
			and se.status = 1 
			ORDER BY se.position_mobile ASC");
			$db->execute();
			$sectionExtensionsSql = $db->fetchAll();

			$CachedSectionExtensionsMobile->set($sectionExtensionsSql)->expiresAfter($section['time_cache']);
			$InstanceCache->save($CachedSectionExtensionsMobile);
		}
		$sectionExtensions = $CachedSectionExtensionsMobile->get();
	
	} else {
		$key = 'sectionExtensions'. $section['id'];
		$CachedSectionExtensions = $InstanceCache->getItem($key);
	
		if (!$CachedSectionExtensions->isHit()) {
			$db->prepare("select *, se.id as idExtension, se.content as extensionContent 
			from section_extension se, extension e 
			where se.section_client_id = '" . $section['id'] . "' 
			and se.extension_id = e.id 
			and se.status = 1 
			ORDER BY se.position ASC");
			$db->execute();
			$sectionExtensionsSql = $db->fetchAll();

			$CachedSectionExtensions->set($sectionExtensionsSql)->expiresAfter($section['time_cache']);
			$InstanceCache->save($CachedSectionExtensions);
		}
		$sectionExtensions = $CachedSectionExtensions->get();
	}
	
	// Widgets Constructor
	$widgets = [];
	$i = 1;
	
	/**
	 * Getting info of the section
	 */
	foreach ($sectionExtensions as $extension) {

		if (isset($extension['external_content']) && $extension['external_content'] != '') {
			/**
			* Try to get EXTERNAL CONTENT from cache
			*/
			$key = 'externalContent'.$extension['external_content'];
			$CachedExternalContent = $InstanceCache->getItem($key);

			if (!$CachedExternalContent->isHit()) {
				$db->prepare("select * 
							from content c 
							where c.id = '" . $extension['external_content'] . "' 
							and c.status = 1");
				$db->execute();
				$externalContentSql = $db->fetch();

				$CachedExternalContent->set($externalContentSql)->expiresAfter(604800);
    			$InstanceCache->save($CachedExternalContent);
			}
			$externalContent = $CachedExternalContent->get();
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
				if ((isset($extension['content']) && $extension['content'] != '') && (isset($extension['external_content']) && $extension['external_content'] != '')) {
					$insert = utf8_encode(str_replace($keywords, $keywordsChange, $extension['content']));
					$external = utf8_encode(str_replace($keywords, $keywordsChange, $externalContent['data']));
					$extensionContent = json_encode(array_merge(json_decode($insert, true), json_decode($external, true)));
				} 
				
				elseif (!isset($extension['content']) && isset($extension['external_content'])) {
					$extensionContent = utf8_encode(str_replace($keywords, $keywordsChange, $externalContent['data']));
				} 
				
				else {
					$extensionContent = utf8_encode(str_replace($keywords, $keywordsChange, $extension['content']));
				}
				/**
				* Try to get WIDGET JSON from cache
				*/
				$key = 'widgetJson'. $variable . $extension['idExtension'] . $cacheNameSection;
				$CachedWidgetJson = $InstanceCache->getItem($key);

				if (!$CachedWidgetJson->isHit()) {
					$jsonGenerator = [
						'id'			=> $extension['idExtension'],
						'clientName'	=> CLIENT_NAME,
						'modelView' 	=> $extension['model_name'],
						'viewName' 		=> (isset($extension['view_name'])) ? $extension['view_name'] : '',
						'data' => [
							'content' 	=> ($extensionContent != NULL) ? json_decode($extensionContent, true) : [],
							'options'	=> $options,
						],
					];

					$CachedWidgetJson->set($jsonGenerator)->expiresAfter(86400);
					$InstanceCache->save($CachedWidgetJson);
				}
				$json = $CachedWidgetJson->get();

				try {
					/**
					* Try to get OBJECT WIDGET from cache
					*/
					$key = 'objectWidget'.$variable . $extension['idExtension'] . $cacheNameSection;
					$CachedObjectWidget = $InstanceCache->getItem($key);
					
					if (!$CachedObjectWidget->isHit()) {
						$variableObjectWidget = new $objetName($json);

						$CachedObjectWidget->set($variableObjectWidget)->expiresAfter(86400);
    					$InstanceCache->save($CachedObjectWidget);
					}
					$$variable = $CachedObjectWidget->get();

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

						$assetExtension = $$variable->assets(strtotime($extension['modify_date']));
						
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

	/**********************************
	 * 			METATAGS
	 **********************************/

	require_once __DIR__.''.EXTENSIONS_URL.'/metaTags/MetaTags.php';
	$json = [
		'clientName'	=> CLIENT_NAME,
		'data' => [
			'content' 	=> [
				'title' 			=> str_replace($keywords, $keywordsChange, utf8_encode($section['title'])),
				'description' 		=> str_replace($keywords, $keywordsChange, utf8_encode($section['description'])),
				'image'				=> isset($section['image']) ? $section['image'] : '',
				'url'				=> $_SERVER['HTTP_HOST'],
				'keywords'			=> isset($section['keywords']) ? $section['keywords'] : '',
				'twitterAccount'	=> isset($client['twitter_account']) ? $client['twitter_account'] : '',
				'facebookAccount'	=> isset($client['facebook_account']) ? $client['facebook_account'] : '',
				'facebookAppAId'	=> isset($client['facebook_app_id']) ? $client['facebook_app_id'] : '',
				'type'				=> '',
				'card'				=> 'summary',
			],
		],
	];
	$metatags = new MetaTags($json);
	$metatag = $metatags->renderView(); 

	/**
	 * Render view
	 */
	if (isset($client['amp']) && $client['amp']) {
		
		$template 		= $twig->load('generateIndexAmp.tpl.html');
		$assetsGeneral['css'] = [];
		array_push($assetsGeneral['css'], ['less/bootstrap-amp.min.css']);
		// array_push($assetsGeneral['css'], ['https://use.fontawesome.com/releases/v5.7.0/css/all.css']);
		array_push($assetsGeneral['css'], ['assets/slidebars/slidebars.min.css?v=20190701']);
		array_push($assetsGeneral['css'], ['assets/swiper/css/swiper.min.css?v=20190701']);
		array_push($assetsGeneral['css'], [''.$globalStyle.'']);
		// $assetsStyle	= '';
		$assetsStyle	= '';
		$assetsStyle 	.= $assetsConstructor->generateAssetsAmp($assetsGeneral['css']);
		$assetsStyle 	.= $assetsConstructor->generateAssetsAmp($assets['css']);
		$assetsStyle 	= str_replace('!important', '', $assetsStyle);

		$assetsJs 		= $assetsConstructor->generateAssets($assets['js']);
		$htmlContent = $template->render([
			'title'						=> str_replace($keywords, $keywordsChange, utf8_encode($section['title'])),
			'googleAnalytics'			=> isset($client['google_analytics']) ? $client['google_analytics'] : '',
			'globalStyle'				=> $globalStyle,
			'assetsStyle'				=> $assetsStyle,
			'assetsJs'					=> $assetsJs,
			'metatags'					=> $metatag,
			'widgets'					=> $widgets,
			'template'					=> ($section['age_control'] && !$_SESSION['age_control']) ? '-age-control' : ((isset($section['layout_id'])) ? $section['layout_id'] : 1),
			'logo'						=> $client['logo'],
			'menu'						=> $menu,
			'country'					=> COUNTRY_CODE,
			'url'						=> $_SERVER['REQUEST_URI'],
			'urlCanonical'				=> $_SERVER['HTTP_HOST'],
		]);
		// print_r($htmlContent);
		// exit;
		/* Amp Remove Unused CSS */
		if ($htmlContent) {
			$ampRemoveUnusedCSS = new AmpRemoveUnusedCss();
			$ampRemoveUnusedCSS->process($htmlContent);
			echo $ampRemoveUnusedCSS->result();
		}
		
		// echo $htmlContent;
		// $tmp = new AmpRemoveUnusedCss();
		// $css_minified = $tmp->minify($assetsStyle);
		// print_r($css_minified);

	} 
	
	/* Desktop */
	else {
		$template 		= $twig->loadTemplate('generateIndex.html');
		$assetsStyle 	= $assetsConstructor->generateAssets($assets['css']);
		$assetsJs 		= $assetsConstructor->generateAssets($assets['js']);

		echo $template->render([
			'title'						=> str_replace($keywords, $keywordsChange, utf8_encode($section['title'])),
			'googleAnalytics'			=> isset($client['google_analytics']) ? $client['google_analytics'] : '',
			'globalStyle'				=> $globalStyle,
			'assetsStyle'				=> $assetsStyle,
			'assetsJs'					=> $assetsJs,
			'metatags'					=> $metatag,
			'widgets'					=> $widgets,
			'template'					=> ($section['age_control'] && !$_SESSION['age_control']) ? '-age-control' : ((isset($section['layout_id'])) ? $section['layout_id'] : 1),
			'logo'						=> $client['logo'],
			'menu'						=> $menu,
			'country'					=> COUNTRY_CODE,
			'url'						=> $_SERVER['REQUEST_URI'],
			'urlCanonical'				=> $_SERVER['HTTP_HOST'],
		]);
	}
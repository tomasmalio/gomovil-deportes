<?php
	require_once __DIR__.'/bootstrap.php';

	/* Widget */
	$widget = new Widgets();
	
	/* Declare of extensions directory */
	$GLOBALS['extensions_url'] = '/extensions';

	use GoMovil\Assets;

	/* Mobile Detection */
	$detect = new Mobile_Detect();
	$GLOBALS['isMobile'] = $detect->isMobile();
	
	$assets = ['css' => [], 'js' => []];
	
	$tournamentName = $_GET['tournament'];
	$tournamentType = $_GET['type'];

	/****************************************
	 * NEXT MATCHES
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesNext/MatchesNext.php';
	$matchesNextJson = [
		'modelView' => 'MatchesNextTournament',
		'data' => [
			'title' => 'Próximos partidos',
			'linkCalendar' => '#',
			'titleCalendar' => 'Ver calendario',
			'content' => [
				'from' => [
					'date' => date('Y-m-d'), 
					'time' => '00:00:00'
				],
				'football' => [
					'name' => 'Fútbol',
					'url' => 'futbol',
					'icon_name' => 'fas fa-futbol football',
					'display' => true,
					//'items' => 2,
					'tournaments' => [
						[
							'name' => 'Liga BBVA',
							'step' => 'Jornada 34',
							'url' => '#',
							'matches' => [
								[
									'datetime' => '2019-04-25 15:30:00',
									'team_local' => 'Sevilla',
									'team_visit' => 'Rayo Vallecano',
									'team_image_local' => 'images/football/spain/sevilla.png',
									'team_image_visit' => 'images/football/spain/rayo-vallecano.png',
									'url' => '#',
								],
								[
									'datetime' => '2019-04-25 15:30:00',
									'team_local' => 'Real Sociedad',
									'team_visit' => 'Villareal',
									'team_image_local' => 'images/football/spain/real-sociedad.png',
									'team_image_visit' => 'images/football/spain/villa-real.png',
									'url' => '#',
								],
								[
									'datetime' => '2019-04-25 16:30:00',
									'team_local' => 'Getafe',
									'team_visit' => 'Real Madrid',
									'team_image_local' => 'images/football/spain/getafe.png',
									'team_image_visit' => 'images/football/spain/real-madrid.png',
									'url' => '#',
								],
							]
						]
					],
				],
			],
		],
	];
	$nextMatches	= new MatchesNext($matchesNextJson);
	$widgetMatchesNext 	= $nextMatches->renderView();
	$assetMatchesNext = $nextMatches->assets();
	array_push($assets['css'], $assetMatchesNext['css']);
	array_push($assets['js'], $assetMatchesNext['js']);
	$displayMatchesNext = true;
	
	/****************************************
	 * SCORES LIST
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/scoresList/ScoresList.php';
	$scoresListJson = [
		'data' => [
			'content' => [
				'type' => 'virales',
			]
		]
	];
	$scoresList = new ScoresList($socialPostsJson);
	$widgetScoresList 	= $scoresList->renderView();
	$assetScoresList = $scoresList->assets();
	array_push($assets['css'], $assetScoresList['css']);
	array_push($assets['js'], $assetScoresList['js']);
	$displayScoresList = true;

	/****************************************
	 * NEWS GOOGLE
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsGoogle/NewsGoogle.php';
	$newsGoogleJSON = [
		'data' => [
			'content' => [
				'numberOfNews' => '5',
				// 'countryCode' => 'PE',
				'country' => 'Peru',
				'search' => 'Fútbol Deportes',
				'newsWithImages' => true,
			],
			'options' => [
				'content' => [
					'display' => [
						'description' => false,
						'source' => true,
					]
				],
				'slider' => [
					'desktop' 	=> [
						'display' 		=> false,
					],
					'mobile' 	=> [
						'display' 		=> true,
					],
				],
				'items' => [
					'desktop' 	=> 5,
					'mobile' 	=> 5,
				],
			],	
		]
	];
	$newsGoogle	= new NewsGoogle($newsGoogleJSON);
	$widgetNewsGoogle = $newsGoogle->renderView();
	$assetNewsGoogle = $newsGoogle->assets();
	array_push($assets['css'], $assetNewsGoogle['css']);
	array_push($assets['js'], $assetNewsGoogle['js']);
	$displayNewsGoogle = true;

	/****************************************
	 * SOCIAL POSTS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/socialPosts/SocialPosts.php';
	$socialPostsJson = [
		'data' => [
			'content' => [
				'type' => 'virales',
			]
		]
	];
	$socialPosts = new SocialPosts($socialPostsJson);
	$widgetSocialPosts 	= $socialPosts->renderView();
	$assetSocialPosts = $socialPosts->assets();
	array_push($assets['css'], $assetSocialPosts['css']);
	array_push($assets['js'], $assetSocialPosts['js']);
	$displaySocialPosts = true;

	/**
	 * Render view
	 */
	$template = $twig->load('generateFootball.html');

	echo $template->render([
		'assetsStyle'				=> (new Assets())->generateAssets($assets['css']),
		'assetsJs'					=> (new Assets())->generateAssets($assets['js']),
		'widgetMatchesNext'			=> [
											'content'		 		=> $widgetMatchesNext,
											'display'				=> $displayMatchesNext,
		],
		'widgetScoresList'			=> [
											'content'		 		=> $widgetScoresList,
											'display'				=> $displayScoresList,
		],
		'widgetNewsGoogle'			=> [
											'content'		 		=> $widgetNewsGoogle,
											'display'				=> $displayNewsGoogle,
		],
		'widgetSocialPosts'			=> [
											'content'		 		=> $widgetSocialPosts,
											'display'				=> $displaySocialPosts,
		],
	]);
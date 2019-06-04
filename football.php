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

	/****************************************
	 * LEAGUES LIST
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/leaguesList/LeaguesList.php';
	$leaguesListJson = [
		'data' => [
			'title' => ['ligas' => 'Ligas', 'copas' => 'Copas', 'selecciones' => 'Seleccionado'],
			'options' => [
				'slider' => [
					'desktop' => [
						'display' => false,
					],
					'mobile' => [
						'display' => true,
					],
				],
			],
			'content' => [
				'tournaments' => [
					'ligas' => [
						'liga-bbva' => [
							'name' => 'Liga BBVA', 
							'image' => 'http://image.futmovil.com/league/liga_espannola_degoles.png',
						],
						'campeonato-desentralizado' => [
							'name' => 'Campeonato Desentralizado', 
							'image' => 'http://image.futmovil.com/league/ligaperu_degoles.png',
						],
						'serie-a-italia' => [
							'name' => 'Serie A Italia', 
							'image' => 'http://image.futmovil.com/league/ligaitalia_degoles.png',
						],
						'premier-league' => [
							'name' => 'Premier League',
							'image' => 'http://a.espncdn.com/combiner/i?img=/i/leaguelogos/soccer/500/23.png&w=40&h=40&transparent=true',
						],
						'bundesliga' => [
							'name' => 'Bundesliga',
							'image' => 'http://a.espncdn.com/combiner/i?img=/i/leaguelogos/soccer/500/10.png&w=40&h=40&transparent=true',
						],
						'france-ligue-1' => [
							'name' => 'France Ligue 1',
							'image' => 'https://a.espncdn.com/combiner/i?img=/i/leaguelogos/soccer/500/9.png&h=80&w=80&scale=crop',
						],
						'liga-mexicana' => [
							'name' => 'Liga Mexicana',
							'image' => 'https://www.fmsite.net/applications/downloads/interface/legacy/screenshot.php?path=/monthly_2017_09/i.png.13b8a5d98c509e61e9ea6272188a79e3.png',
						],
						'super-liga-argentina-2018' => [
							'name' => 'Super Liga Argentina 2018',
							'image' => 'http://image.futmovil.com/league/superligaargentina_2018.png',
						],
						
						
					],
					'copas' => [
						'copa-libertadores' => [
							'name' => 'Copa Libertadores',
							'image' => 'http://image.futmovil.com/league/copalibertadores.png',
						],
						'champions-league' => [
							'name' => 'Champions League',
							'image' => 'http://image.futmovil.com/league/escudo-champions.png',
						],
						'copa-sudamericana' => [
							'name' => 'Copa Sudamericana',
							'image' => 'http://image.futmovil.com/league/copasudamericana_degoles.png',
						],
					],
					'selecciones' => [
						'conmebol' => [
							'name' => 'Conmebol',
							'image' => 'https://a.espncdn.com/combiner/i?img=/i/leaguelogos/soccer/500/65.png&h=80&w=80&scale=crop',
						],
						'uefa' => [
							'name' => 'UEFA',
							'image' => 'http://a.espncdn.com/combiner/i?img=/i/leaguelogos/soccer/500/2310.png&w=40&h=40&transparent=true',
						],
					],
				]
			],
		],
	];
	$leaguesList = new LeaguesList($leaguesListJson);
	$widgetLeaguesList 	= $leaguesList->renderView();
	$assetLeaguesList = $leaguesList->assets();
	array_push($assets['css'], $assetLeaguesList['css']);
	array_push($assets['js'], $assetLeaguesList['js']);
	$displayLeaguesList = true;

	/****************************************
	 * NEXT MATCHES
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesNext/MatchesNext.php';
	$matchesNextJson = [
		'modelView' => 'MatchesNextNba',
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
	 * NEWS GOOGLE
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsGoogle/NewsGoogle.php';
	$newsGoogleJSON = [
		'data' => [
			'content' => [
				'numberOfNews' => '5',
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
		'widgetLeaguesList'			=> [
											'content'		 		=> $widgetLeaguesList,
											'display'				=> $displayLeaguesList,
		],
		'widgetMatchesNext'			=> [
											'content'		 		=> $widgetMatchesNext,
											'display'				=> $displayMatchesNext,
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
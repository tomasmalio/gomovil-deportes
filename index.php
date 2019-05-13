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
	 * META TAGS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/metaTags/MetaTags.php';
	$widgetMetaTags = (new MetaTags())->renderView();
	$displayMetaTags = true;

	/****************************************
	 * FEATURED NEWS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsFeatured/NewsFeatured.php';
	$newsFeatured = new NewsFeatured();
	$widgetNewsFeatured = $newsFeatured->renderView();
	$assetNewsFeatured = $newsFeatured->assets();
	array_push($assets['css'], $assetNewsFeatured['css']);
	array_push($assets['js'], $assetNewsFeatured['js']);
	$displayNewsFeatured = false;

	/****************************************
	 * MATCHES FEATURED 
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesFeatured/MatchesFeatured.php';
	$matchesFeaturedJson = [
		'data' => [
			'label' => 'Partido destacado',
			'titleVote' => '¿Qué equipo va a ganar?',
			'options' => [
				'slider' => [
					'desktop' 	=> [
						'display' 		=> true, 
						'pagination'	=> true,
						'navigation'	=> true,
					],
					'mobile' 	=> [
						'display' 		=> true, 
						'pagination'	=> true,
						'navigation'	=> true,
					]
				],
				'items' => [
					'desktop' 	=> 2,
					'mobile' 	=> 2,
				],
			],
			'content' => [
				'type' => 'football',
			]
		]
	];
	$matchesFeatured = new MatchesFeatured($matchesFeaturedJson);
	$widgetMatchesFeatured = $matchesFeatured->renderView();
	$assetMatchesFeatured = $matchesFeatured->assets();
	array_push($assets['css'], $assetMatchesFeatured['css']);
	array_push($assets['js'], $assetMatchesFeatured['js']);
	$displayMatchesFeatured = true;

	/****************************************
	 * NEWS LIST
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsList/NewsList.php';
	$newsListJson = [
		'data' => [
			'options' => [
				'slider' => [
					'desktop' 	=> [
						'display' 		=> true,
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
	$newsList = new NewsList($newsListJson);
	$widgetNewsList = $newsList->renderView();
	$assetNewsList = $newsList->assets();
	array_push($assets['css'], $assetNewsList['css']);
	array_push($assets['js'], $assetNewsList['js']);
	$displayNewsList = true;

	/****************************************
	 * NEXT MATCHES
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesNext/MatchesNext.php';
	$matchesNextJson = [
		'modelView' => 'MatchesNextNba',
		'data' => [
			'titleNextMatches' => 'Próximos partidos',
			'linkCalendar' => ['url' => '#', 'name' => 'Ver calendario'],
			'content' => [
				'from' => [
					'date' => date('Y-m-d'), 
					'time' => '00:00:00'
				],
				'football' => [
					'name' => 'Fútbol',
					'url' => 'futbol',
					'icon_name' => 'fas fa-futbol football',
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
									// 'status' => 'live',
									// 'match_time' => [
									// 	'minutes' => 80,
									// 	'seconds' => 80,
									// ],	
									// 'score' => [
									// 	'gol_local' => 3,
									// 	'gol_visit' => 3,
									// ],
									// 'penalties' => [
									// 	'gol_local' => 4,
									// 	'gol_visit' => 2,
									// 	'quantity' => 5,
									// ],
									'url' => '#',
								],
								[
									'datetime' => '2019-04-25 15:30:00',
									'team_local' => 'Real Sociedad',
									'team_visit' => 'Villareal',
									'team_image_local' => 'images/football/spain/real-sociedad.png',
									'team_image_visit' => 'images/football/spain/villa-real.png',
									// 'status' => 'live',
									// 'match_time' => [
									// 	'minutes' => 40,
									// 	'seconds' => 55,
									// ],
									// 'score' => [
									// 	'gol_local' => 0,
									// 	'gol_visit' => 0,
									// ],
									// 'penalties' => [
									// ],
									'url' => '#',
								],
								[
									'datetime' => '2019-04-25 16:30:00',
									'team_local' => 'Getafe',
									'team_visit' => 'Real Madrid',
									'team_image_local' => 'images/football/spain/getafe.png',
									'team_image_visit' => 'images/football/spain/real-madrid.png',
									// 'status' => 'end',
									// 'match_time' => [
									// ],
									// 'score' => [
									// 	'gol_local' => 0,
									// 	'gol_visit' => 0,
									// ],
									// 'penalties' => [
									// ],
									'url' => '#',
								],
							]
						]
					],
				],
				'basket' => [
					'name' => 'Basket',
					'url' => 'basket',
					'icon_name' => 'fas fa-basketball-ball basket',
					'tournaments' => [
						// [
						// 	'name' => 'Conferencia',
						// 	'step' => '',
						// 	'url' => '#',
						// ],
					]
				],
				'tenis' => [
					'name' => 'Tenis',
					'url' => 'tenis',
					'icon_name' => 'fas fa-baseball-ball tenis',
					'tournaments' => [
						[
							'name' => 'Barcelona Open Banc Sabadell',
							'step' => 'Individual Masculino / Ronda 3',
							'type' => 'single',
							'url' => '#',
							'matches' => [
								[
									'datetime' => '2019-04-25 17:00:00',
									'player_first' => 'Daniil Medvedev',
									'player_second' => 'Mackenzie McDonald',
									'player_image_first' => 'http://a.espncdn.com/i/flags/20x13/rus.gif',
									'player_image_second' => 'http://a.espncdn.com/i/flags/20x13/usa.gif',
									//'status' => 'live',
									'score' => [
										'sets' => 3,
										'player_first' => [
											1 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
											2 => [
												// 'point' => 2, 
											],
											3 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
										],
										'player_second' => [
											1 => [
												// 'point' => 6, 
												// 'tie_break' => 5,
											],
											2 => [
												// 'point' => 6, 
											],
											3 => [
												// 'point' => 6, 
												// 'tie_break' => 4,
											],
										],
									],
									'url' => '#',
								],
								[
									'datetime' => '2019-04-25 17:00:00',
									'player_first' => 'Felix Auger-Aliassime',
									'player_second' => 'Kei Nishikori',
									'player_image_first' => 'http://a.espncdn.com/i/flags/20x13/can.gif',
									'player_image_second' => 'http://a.espncdn.com/i/flags/20x13/jpn.gif',
									'status' => '',
									'score' => [
										'sets' => 3,
										'player_first' => [
											1 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
											2 => [
												// 'point' => 2, 
											],
											3 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
										],
										'player_second' => [
											1 => [
												// 'point' => 6, 
												// 'tie_break' => 5,
											],
											2 => [
												// 'point' => 6, 
											],
											3 => [
												// 'point' => 6, 
												// 'tie_break' => 4,
											],
										],
									],
									'url' => '#',
								],
							],
						],
						[
							'name' => 'Hungarian Open',
							'step' => 'Individual Masculino / Ronda 2',
							'type' => 'single',
							'url' => '#',
							'matches' => [
								[
									'datetime' => '2019-04-25 17:00:00',
									'player_first' => 'Radu Albot',
									'player_second' => 'Filip Krajinovic',
									'player_image_first' => 'http://a.espncdn.com/i/flags/20x13/mda.gif',
									'player_image_second' => 'http://a.espncdn.com/i/flags/20x13/srb.gif',
									//'status' => 'live',
									'score' => [
										'sets' => 3,
										'player_first' => [
											1 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
											2 => [
												// 'point' => 2, 
											],
											3 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
										],
										'player_second' => [
											1 => [
												// 'point' => 6, 
												// 'tie_break' => 5,
											],
											2 => [
												// 'point' => 6, 
											],
											3 => [
												// 'point' => 6, 
												// 'tie_break' => 4,
											],
										],
									],
									'url' => '#',
								],
								[
									'datetime' => '2019-04-25 19:00:00',
									'player_first' => 'Robin Haase',
									'player_second' => 'Borna Coric',
									'player_image_first' => 'http://a.espncdn.com/i/flags/20x13/ned.gif',
									'player_image_second' => 'http://a.espncdn.com/i/flags/20x13/cro.gif',
									'status' => '',
									'score' => [
										'sets' => 3,
										'player_first' => [
											1 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
											2 => [
												// 'point' => 2, 
											],
											3 => [
												// 'point' => 7, 
												// 'tie_break' => 7,
											],
										],
										'player_second' => [
											1 => [
												// 'point' => 6, 
												// 'tie_break' => 5,
											],
											2 => [
												// 'point' => 6, 
											],
											3 => [
												// 'point' => 6, 
												// 'tie_break' => 4,
											],
										],
									],
									'url' => '#',
								],
							],
						],
						// [
						// 	'name' => 'Hungarian Open',
						// 	'step' => 'Masculino Doble / Ronda 63',
						// 	'type' => 'double',
						// 	'url' => '#',
						// 	'matches' => [
						// 		[
						// 			'datetime' => '2019-03-18 21:00:00',
						// 			'team_double_first' => [
						// 				'player_one' => 'J. Del Potro',
						// 				'player_second' => 'F. Delbonis',
						// 				'player_image_one' => 'http:////ssl.gstatic.com/onebox/media/sports/logos/1xBWyjjkA6vEWopPK3lIPA_48x48.png',
						// 				'player_image_second' => 'http:////ssl.gstatic.com/onebox/media/sports/logos/1xBWyjjkA6vEWopPK3lIPA_48x48.png',
						// 			],
						// 			'team_double_second' => [
						// 				'player_one' => 'F. Aliassime',
						// 				'player_second' => 'N. Djokovic',
						// 				'player_image_one' => 'http://ssl.gstatic.com/onebox/media/sports/logos/H23oIEP6qK-zNc3O8abnIA_48x48.png',
						// 				'player_image_second' => 'http://ssl.gstatic.com/onebox/media/sports/logos/H23oIEP6qK-zNc3O8abnIA_48x48.png',
						// 			],
						// 			'status' => 'live',
						// 			'score' => [
						// 				'sets' => 5,
						// 				'team_double_first' => [
						// 					1 => [
						// 						'point' => 7, 
						// 						'tie_break' => 7,
						// 					],
						// 					2 => [
						// 						'point' => 6, 
						// 					],
						// 					3 => [
						// 						'point' => 4, 
						// 					],
						// 					4 => [
						// 						'point' => 4, 
						// 					],
						// 					5 => [
						// 						'point' => 6, 
						// 					],
						// 				],
						// 				'team_double_second' => [
						// 					1 => [
						// 						'point' => 6, 
						// 						'tie_break' => 5,
						// 					],
						// 					2 => [
						// 						'point' => 4, 
						// 					],
						// 					3 => [
						// 						'point' => 6, 
						// 					],
						// 					4 => [
						// 						'point' => 6, 
						// 					],
						// 					5 => [
						// 						'point' => 4, 
						// 					],
						// 				],
						// 			],
						// 			'url' => '#',
						// 		],
						// 	],
						// ],
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
	 * VIDEOS LIST
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/videosList/VideosList.php';
	$videosListJson = [
		'data' => [
			'options' => [
				'items' => [
					'desktop' => 4,
					'mobile' => 4,
				],
				'slider' => [
					'desktop' => true,
					'mobile' => true,
				],
				'controls' => [
					'autoPlay' 			=> false,
					'displayControls' 	=> true,
					'muted' 			=> true,
					'loop'				=> false,
				],
			],
			'content' => [
				'type' => 'football',
			]
		]
	];
	$videoList = new VideosList($videosListJson);
	$widgetVideosList 	= $videoList->renderView();
	$assetVideoList = $videoList->assets();
	array_push($assets['css'], $assetVideoList['css']);
	array_push($assets['js'], $assetVideoList['js']);
	$displayVideosList = true;

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

	/****************************************
	 * SOCIAL GIFS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/socialGifs/SocialGifs.php';
	$socialGifsJson = [
		'data' => [
			'content' => [
				'search' => 'futbol',
			]
		]
	];
	$socialGifs = new SocialGifs($socialGifsJson);
	$widgetSocialGifs 	= $socialGifs->renderView();
	$assetSocialGifs = $socialGifs->assets();
	array_push($assets['css'], $assetSocialGifs['css']);
	array_push($assets['js'], $assetSocialGifs['js']);
	$displaySocialGifs = true;

	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');

	echo $template->render([
		'assetsStyle'				=> (new Assets())->generateAssets($assets['css']),
		'assetsJs'					=> (new Assets())->generateAssets($assets['js']),
		'widgetMetaTags'			=> [
											'content' 				=> $widgetMetaTags,
											'display'				=> $displayMetaTags,
		],
		'widgetNewsFeatured' 		=> [
											'content'			 	=> $widgetNewsFeatured,
											'display'				=> $displayNewsFeatured,
		],
		'widgetMatchesFeatured' 	=> [
											'content'			 	=> $widgetMatchesFeatured,
											'display'				=> $displayMatchesFeatured,
		],
		'widgetNewsList'			=> [
											'content'		 		=> $widgetNewsList,
											'display'				=> $displayNewsList,
		],
		'widgetMatchesNext'			=> [
											'content'		 		=> $widgetMatchesNext,
											'display'				=> $displayMatchesNext,
		],
		'widgetVideosList'			=> [
											'content'		 		=> $widgetVideosList,
											'display'				=> $displayVideosList,
		],
		'widgetSocialPosts'			=> [
											'content'		 		=> $widgetSocialPosts,
											'display'				=> $displaySocialPosts,
		],
		'widgetSocialGifs'			=> [
											'content'		 		=> $widgetSocialGifs,
											'display'				=> $displaySocialGifs,
		],
	]);
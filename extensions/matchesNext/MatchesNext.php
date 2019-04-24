<?php
	/**
	 * Matches Next
	 */
	class MatchesNext extends Widgets {
		public $titleNextMatces = 'Próximos partidos';
		public $date = '2019-04-25';
		public $linkCalendar = ['url' => '#', 'name' => 'Ver calendario'];
		public $sports = [
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
								'team_image_local' => 'images/football/spain/fc-barcelona.png',
								'team_image_visit' => 'images/football/spain/atletico-de-madrid.png',
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
								'team_image_local' => 'images/football/spain/fc-barcelona.png',
								'team_image_visit' => 'images/football/spain/atletico-de-madrid.png',
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
								'team_image_local' => 'images/football/spain/fc-barcelona.png',
								'team_image_visit' => 'images/football/spain/atletico-de-madrid.png',
								'status' => 'end',
								'match_time' => [
								],
								'score' => [
									'gol_local' => 0,
									'gol_visit' => 0,
								],
								'penalties' => [
								],
								'url' => '#',
							],
							[
								'datetime' => '2019-03-18 15:00:00',
								'team_local' => 'Real Sociedad',
								'team_visit' => 'Betis',
								'team_image_local' => 'images/football/spain/fc-barcelona.png',
								'team_image_visit' => 'images/football/spain/atletico-de-madrid.png',
								'status' => '',
								'match_time' => [
								],
								'score' => [
									'gol_local' => 0,
									'gol_visit' => 0,
								],
								'penalties' => [
								],
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
					[
						'name' => 'Conferencia Este',
						'step' => '',
						'url' => '#',
						'matches' => [
							[
								'datetime' => '2019-03-18 15:00:00',
								'team_local' => 'Golden State',
								'team_visit' => 'Miami Heat',
								'team_image_local' => 'images/basketball/nba/golden-state.png',
								'team_image_visit' => 'images/basketball/nba/miami-heat.png',
								'status' => 'live',
								'match_time' => [
									'quarter' => 2,
									'minutes' => 9,
									'seconds' => 45,
								],	
								'score' => [
									'gol_local' => 130,
									'gol_visit' => 129,
								],
								'url' => '#',
							],
							[
								'datetime' => '2019-03-18 15:00:00',
								'team_local' => 'Chicago Bulls',
								'team_visit' => 'Miami Heat',
								'team_image_local' => 'images/basketball/nba/chicaco-bulls.png',
								'team_image_visit' => 'images/basketball/nba/los-angeles-lakers.png',
								'status' => '',
								'match_time' => [
									'quarter' => 0,
									'minutes' => 0,
									'seconds' => 0,
								],	
								'score' => [
									'gol_local' => 0,
									'gol_visit' => 0,
								],
								'url' => '#',
							],
						],
					],
				],
			],
			'tenis' => [
				'name' => 'Tenis',
				'url' => 'tenis',
				'icon_name' => 'fas fa-baseball-ball tenis',
				'tournaments' => [
					[
						'name' => 'Masters de Miami',
						'step' => 'Individual Masculino / Ronda 63',
						'type' => 'single',
						'url' => '#',
						'matches' => [
							[
								'datetime' => '2019-03-18 21:00:00',
								'player_first' => 'Juan Martín del Potro',
								'player_second' => 'F. Auger Aliassime',
								'player_image_first' => 'http:////ssl.gstatic.com/onebox/media/sports/logos/1xBWyjjkA6vEWopPK3lIPA_48x48.png',
								'player_image_second' => 'http://ssl.gstatic.com/onebox/media/sports/logos/H23oIEP6qK-zNc3O8abnIA_48x48.png',
								'status' => 'live',
								'score' => [
									'sets' => 3,
									'player_first' => [
										1 => [
											'point' => 7, 
											'tie_break' => 7,
										],
										2 => [
											'point' => 2, 
										],
										3 => [
											'point' => 7, 
											'tie_break' => 7,
										],
									],
									'player_second' => [
										1 => [
											'point' => 6, 
											'tie_break' => 5,
										],
										2 => [
											'point' => 6, 
										],
										3 => [
											'point' => 6, 
											'tie_break' => 4,
										],
									],
								],
								'url' => '#',
							],
							[
								'datetime' => '2019-03-18 15:00:00',
								'player_first' => 'Jugador 1',
								'player_second' => 'Jugador 2',
								'player_image_first' => 'http:////ssl.gstatic.com/onebox/media/sports/logos/1xBWyjjkA6vEWopPK3lIPA_48x48.png',
								'player_image_second' => 'http://ssl.gstatic.com/onebox/media/sports/logos/H23oIEP6qK-zNc3O8abnIA_48x48.png',
								'status' => '',
								'score' => [
									'sets' => 3,
									'player_first' => [
										1 => [
											'point' => 7, 
											'tie_break' => 7,
										],
										2 => [
											'point' => 2, 
										],
										3 => [
											'point' => 7, 
											'tie_break' => 7,
										],
									],
									'player_second' => [
										1 => [
											'point' => 6, 
											'tie_break' => 5,
										],
										2 => [
											'point' => 6, 
										],
										3 => [
											'point' => 6, 
											'tie_break' => 4,
										],
									],
								],
								'url' => '#',
							],
						],
					],
					[
						'name' => 'Masters de Miami',
						'step' => 'Masculino Doble / Ronda 63',
						'type' => 'double',
						'url' => '#',
						'matches' => [
							[
								'datetime' => '2019-03-18 21:00:00',
								'team_double_first' => [
									'player_one' => 'J. Del Potro',
									'player_second' => 'F. Delbonis',
									'player_image_one' => 'http:////ssl.gstatic.com/onebox/media/sports/logos/1xBWyjjkA6vEWopPK3lIPA_48x48.png',
									'player_image_second' => 'http:////ssl.gstatic.com/onebox/media/sports/logos/1xBWyjjkA6vEWopPK3lIPA_48x48.png',
								],
								'team_double_second' => [
									'player_one' => 'F. Aliassime',
									'player_second' => 'N. Djokovic',
									'player_image_one' => 'http://ssl.gstatic.com/onebox/media/sports/logos/H23oIEP6qK-zNc3O8abnIA_48x48.png',
									'player_image_second' => 'http://ssl.gstatic.com/onebox/media/sports/logos/H23oIEP6qK-zNc3O8abnIA_48x48.png',
								],
								'status' => 'live',
								'score' => [
									'sets' => 5,
									'team_double_first' => [
										1 => [
											'point' => 7, 
											'tie_break' => 7,
										],
										2 => [
											'point' => 6, 
										],
										3 => [
											'point' => 4, 
										],
										4 => [
											'point' => 4, 
										],
										5 => [
											'point' => 6, 
										],
									],
									'team_double_second' => [
										1 => [
											'point' => 6, 
											'tie_break' => 5,
										],
										2 => [
											'point' => 4, 
										],
										3 => [
											'point' => 6, 
										],
										4 => [
											'point' => 6, 
										],
										5 => [
											'point' => 4, 
										],
									],
								],
								'url' => '#',
							],
						],
					],
				],
			],
		];

		// Assets files
		public $files = [
			'style'		=> [],
			'js'		=> [],
		];
		// Options
		public $options = [];

		public function renderView () {
			return Widgets::renderViewHtml([
					'titleNextMatces'	=> $this->titleNextMatces,
					'date'				=> $this->date,
					'sports'			=> $this->sports,
					'linkCalendar'		=> $this->linkCalendar,
				]
			);
		}
	}
?>
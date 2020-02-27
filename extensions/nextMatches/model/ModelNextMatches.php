<?php
	/**
	 * Model Next Matches
	 */
	class ModelNextMatches {
		//private $urlFootball 	= 'http://apiuf.gomovil.co/partido/partidos.json';
		private $urlFootball 	= 'http://gomovil.universofutbol.com/data.php?user=gomovil&pwd=g0m0v1lc0&metodo=partidos';
		private $urlBasket		= 'http://apiuf.gomovil.co/partido/partidos-basquet.json';
		private $urlTennis 		= 'http://apiuf.gomovil.co/partido/partidos-tenis.json';

		// Format content to display
		private $json = [
			'football' => [
				'display' 	=> true,
				'name' 		=> 'Fútbol',
				'url' 		=> 'futbol',
				'icon_name' => 'sports-icon football',
				'matches' 	=> null
			],
			'basket' => [
				'display' 	=> true,
				'name' 		=> 'Basket',
				'url' 		=> 'basket',
				'icon_name' => 'sports-icon basket',
				'matches' 	=> null
			],
			'tennis' => [
				'display' 	=> true,
				'name' 		=> 'Tenis',
				'url' 		=> 'tenis',
				'icon_name' => 'sports-icon tennis',
				'matches' 	=> null
			]
		];

		// Date info display
		private $dateDisplay = [
			'yesterday' => false,
			'today'		=> true,
			'tomorrow'	=> true,
		];

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'torneo',
				'key_api',
				'tipo',
				'local',
				'local_img',
				'local_pais',
				'local_resultado',
				'penal_local',
				'local_penal',
				'visitante',
				'visitante_img',
				'visitante_pais',
				'gol_visitante',
				'visitante_resultado',
				'penal_visitante',
				'visitante_penal',
				'estadio',
				'estado',
				'hora_inicio',
				'fechahora',
				'dia',
				'hora',
				'minuto',
				'ciudad',
				'pais',
				'jugador_1',
				'jugador_2',
				'nombre',
				'puntos_game',
				'sets_ganados',
				'nacionalidad',
				'bandera',
				'saque',
			],
			'verify'	=> [
				'tournament',
				'tournament',
				'type',
				'team_local',
				'team_image_local',
				'country_local',
				'gol_local',
				'penalty_local',
				'penalty_local',
				'team_visit',
				'team_image_visit',
				'country_visit',
				'gol_visit',
				'gol_visit',
				'penalty_visit',
				'penalty_visit',
				'stadium',
				'status',
				'date_begin',
				'date_begin',
				'date',
				'time',
				'minutes',
				'city',
				'country',
				'player_first',
				'player_second',
				'name',
				'point_game',
				'sets_won',
				'nationality',
				'flag',
				'serving',
			],
		];
		
		public function model ($params = []) {
			print_r($params);
			exit;
			self::setDate($params['date']);
			self::setContentConstructor($params['sports']);
			self::setSports($params['sports_display']);
			self::setDateDisplay($params['date_display']);
			return Widgets::multiRenameKey(self::getContent(), $this->mappingName['wrong'], $this->mappingName['verify']);
		}

		public function setDate ($date) {
			if (!empty($date)) {
				$this->date = $date;
			} else {
				$this->date = date('Y-m-d');
			}
		}

		private function setSports ($sports) {
			if ($sports['footall'] === false) {
				$this->json['football']['display'] = false;
			}
			if ($sports['basket'] === false) {
				$this->json['basket']['display'] = false;
			}
			if ($sports['tennis'] === false) {
				$this->json['tennis']['display'] = false;
			}
		}

		private function setDateDisplay ($dateDisplay) {
			if (isset($dateDisplay['yesterday']) && $dateDisplay['yesterday']) {
				$this->dateDisplay['yesterday'] = true;
			}
			if (isset($dateDisplay['today']) && !$dateDisplay['today']) {
				$this->dateDisplay['today'] = false;
			}
			if (isset($dateDisplay['tomorrow']) && !$dateDisplay['tomorrow']) {
				$this->dateDisplay['tomorrow'] = false;
			}
		}

		private function setContentConstructor ($sports) {
			if (count($sports) > 0) {
				foreach ($sports as $k => $s) {
					$this->json[$k] = $s;
				}
			}
		}

		private function getContent() {
			/**
			 * Creating the content for each sport
			 * require.
			 **/ 
			foreach ($this->json as $sport => $value) {
				if ($this->json[$sport]['display']) {
					$url = 'url' . ucfirst($sport);
					// Getting the info from the JSON
					$json = @file_get_contents($this->$url);
					if (strpos($http_response_header[0], "200")) {
						$matchesDates = (json_decode($json, true));
						/**
						 * Validate if the content is require for 
						 * yesterday, today and tomorrow
						 **/ 
						if ($this->dateDisplay['yesterday'] && $this->dateDisplay['today'] && $this->dateDisplay['tomorrow']) {
							$this->json[$sport]['matches'] = $matchesDates;
						} else {
							/**
							 * Validate which dates we must show
							 * yesterday, today and tomorrow
							 **/ 
							foreach ($matchesDates as $k => $dates) {
								if ((($k < $this->date) && $this->dateDisplay['yesterday']) || (($k == $this->date) && $this->dateDisplay['today']) || (($k > $this->date) && $this->dateDisplay['tomorrow'])) {
									$this->json[$sport]['matches'][$k] = $dates;
								}
							}
						}
					}
				}
			}
			return $this->json;
		}

	}
?>
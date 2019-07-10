<?php
	/**
	 * Model Next Matches
	 */
	class ModelNextMatches {
		
		private $urlFootball 	= 'http://apiuf.gomovil.co/partido/partidos.json';
		private $urlNba		 	= 'http://apiuf.gomovil.co/partido/partidos-basquet.json';
		private $urlTennis 		= 'http://apiuf.gomovil.co/partido/partidos-tenis.json';

		private $sports = [
			'football' 	=> true,
			'nba' 		=> true,
			'tennis' 	=> true,
		];

		private $json = [
			'football' => [
				'display' 	=> true,
				'name' 		=> 'Fútbol',
				'url' 		=> 'futbol',
				'icon_name' => 'sports-icon football',
				'matches' 	=> null
			],
			'nba' => [
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

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'torneo',
				'local',
				'local_img',
				'penal_local',
				'visitante',
				'visitante_img',
				'gol_visitante',
				'penal_visitante',
				'estadio',
				'estado',
				'hora_inicio',
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
				'team_local',
				'team_image_local',
				'penalty_local',
				'team_visit',
				'team_image_visit',
				'gol_visit',
				'penalty_visit',
				'stadium',
				'status',
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
			self::setDate($params['date']);
			self::setSports($params['sports']);
			
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
				$this->sports['football'] = false;
			}
			if ($sports['nba'] === false) {
				$this->sports['nba'] = false;
			}
			if ($sports['tennis'] === false) {
				$this->sports['tennis'] = false;
			}
		}

		private function getContent() {
			if ($this->sports['football']) {
				$jsonFootball = @file_get_contents($this->urlFootball);
				if (strpos($http_response_header[0], "200")) {
					$this->json['football']['matches'] =  (json_decode($jsonFootball, true));
				}
			}
			if ($this->sports['nba']) {
				$jsonNba = @file_get_contents($this->urlNba);
				if (strpos($http_response_header[0], "200")) { 
					$this->json['nba']['matches'] =  json_decode($jsonNba, true);
				}
			}
			if ($this->sports['tennis']) {
				$jsonTennis = @file_get_contents($this->urlTennis);
				if (strpos($http_response_header[0], "200")) {
					$this->json['tennis']['matches'] =  json_decode($jsonTennis, true);
				}
			}
			return $this->json;
		}
	}
?>
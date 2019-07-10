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
				
				// 'ligas',
				// 'copas',
				// 'selecciones',
				// 'nombre',
				// 'equipos',
				// 'equipo',
				// 'imagen',
				// 'fecha_actual',
				// 'posiciones',
				// 'local',
				// 'local_img',
				// 'goles_local',
				// 'penal_local',
				// 'visitante',
				// 'visitante_img',
				// 'goles_visitante',
				// 'penal_visitante',
				// 'dt_visitante',
				// 'estadio',
				// 'estado',
				// 'hora_inicio',
				// 'dia',
				// 'hora',
				// 'minuto',
				// 'evento',
				// 'evento_id',
				// 'tipo_evento',
				// 'equipo_condicion',
				// 'jugador'
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
				
				// 'leagues',
				// 'cups',
				// 'selections',
				// 'name',
				// 'teams',
				// 'team',
				// 'image',
				// 'actual_date',
				// 'positions',
				// 'team_local',
				// 'team_image_local',
				// 'gol_local',
				// 'penalty_local',
				// 'team_visit',
				// 'team_image_visit',
				// 'gol_visit',
				// 'penalty_visit',
				// 'dt_visit',
				// 'stadium',
				// 'status',
				// 'date_begin',
				// 'date',
				// 'time',
				// 'minutes',
				// 'interaction',
				// 'interaction_id',
				// 'interaction_type',
				// 'team_condition',
				// 'player'
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
				$jsonFootball = @file_get_contents($this->urlNba);
				if (strpos($http_response_header[0], "200")) { 
					$this->json['nba']['matches'] =  json_decode($jsonNba, true);
				}
			}
			if ($this->sports['tennis']) {
				$jsonFootball = @file_get_contents($this->urlTennis);
				if (strpos($http_response_header[0], "200")) {
					$this->json['tennis']['matches'] =  json_decode($jsonTennis, true);
				}
			}
			return $this->json;
		}
	}
?>
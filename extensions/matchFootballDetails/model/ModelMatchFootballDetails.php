<?php
	/**
	 * Model Match Football Details
	 */
	class ModelMatchFootballDetails {
		// Url JSON
		private $url = 'http://apiuf.gomovil.co/partido/';
		// Url tournaments content JSON
		private $urlTournaments = 'http://apiuf.gomovil.co/ligas/ligas.json';



		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/partido_detalle.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';

		//http://gomovil.universofutbol.com/partido_detalle.php?id=207642


		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'partido',
				'arbitro',
				'asistencia',
				'fechahora',
				'local',
				'dt_local',
				'local_tactica',
				'escudo_local',
				'goles_local',
				'penal_local',
				'visitante',
				'dt_visitante',
				'visitante_tactica',
				'escudo_visitante',
				'goles_visitante',
				'penal_visitante',
				'formaciones',
				'estadio',
				'jornada',
				'estado',
				'minuto',
				'tiros',
				'tiros_al_arco',
				'faltas',
				'corners',
				'offsides',
				'posesion',
				'amarillas',
				'rojas',
				'atajadas'
			],
			'verify'	=> [
				'match',
				'referee',
				'assistants',
				'datetime',
				'local_team',
				'local_dt',
				'local_tactic',
				'local_image',
				'local_gol',
				'local_penalty',
				'visit_team',
				'visit_dt',
				'visit_tactic',
				'visit_image',
				'visit_gol',
				'visit_penalty',
				'tournament_date',
				'formations',
				'stadium',
				'status',
				'minutes',
				'shots',
				'shots_on_target',
				'fouls',
				'corners',
				'offsides',
				'possession',
				'yellow_card',
				'red_card',
				'tied'
			],
		];

		
		public function model ($params = []) {
			if ($params['match']) {
				return Widgets::multiRenameKey(self::getMatchDetails($params['match']), $this->mappingName['wrong'], $this->mappingName['verify']);
			} else {
				return null;
			}
		}

		private function getMatchDetails ($match_id) {
			$json = @file_get_contents($this->json . 'id=' . $match_id . '&user=' . $this->user . '&pwd=' . $this->pass);
			if (strpos($http_response_header[0], "200")) {
				return json_decode($json, true);
			} else { 
				return null;
			}
		}

	}
?>
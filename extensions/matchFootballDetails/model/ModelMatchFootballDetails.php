<?php
	/**
	 * Model Match Football Details
	 */
	class ModelMatchFootballDetails {

		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/partido_detalle.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';

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
				'local_pais',
				'escudo_local',
				'goles_local',
				'penal_local',
				'visitante',
				'dt_visitante',
				'visitante_tactica',
				'visitante_pais',
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
				'atajadas',
				'evento',
				'equipo',
				'equipo_condicion',
				'jugador',
				'nombre',
				'apellido',
				'numero',
				'posicion'
			],
			'verify'	=> [
				'match',
				'referee',
				'assistants',
				'datetime',
				'local_team',
				'local_dt',
				'local_tactic',
				'local_country',
				'local_image',
				'local_gol',
				'local_penalty',
				'visit_team',
				'visit_dt',
				'visit_tactic',
				'visit_country',
				'visit_image',
				'visit_gol',
				'visit_penalty',
				'formations',
				'stadium',
				'tournament_date',
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
				'tied',
				'interaction',
				'team',
				'team_condition',
				'player',
				'player_name',
				'player_last_name',
				'number',
				'position'
			],
		];

		
		public function model ($params = []) {
			if ($params['match']) {
				$match = Widgets::multiRenameKey(self::getMatchDetails($params['match']), $this->mappingName['wrong'], $this->mappingName['verify']);
				return $match['match'];
			} else {
				return null;
			}
		}

		private function getMatchDetails ($match_id) {
			$json = @file_get_contents($this->json . 'id=' . $match_id . '&user=' . $this->user . '&pwd=' . $this->pass . '&eventId=0');
			if (strpos($http_response_header[0], "200")) {
				return json_decode($json, true);
			} else { 
				return null;
			}
		}

	}
?>
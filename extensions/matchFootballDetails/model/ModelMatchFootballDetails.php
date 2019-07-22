<?php
	/**
	 * Model Match Football Details
	 */
	class ModelMatchFootballDetails {
		// Url JSON
		private $url = 'http://apiuf.gomovil.co/partido/';
		// Url tournaments content JSON
		private $urlTournaments = 'http://apiuf.gomovil.co/ligas/ligas.json';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'torneo',
				'ligas',
				'copas',
				'selecciones',
				'nombre',
				'equipos',
				'equipo',
				'imagen',
				'fecha_actual',
				'posiciones',
				'local',
				'local_img',
				'goles_local',
				'penal_local',
				'visitante',
				'visitante_img',
				'goles_visitante',
				'penal_visitante',
				'dt_visitante',
				'estadio',
				'estado',
				'hora_inicio',
				'dia',
				'hora',
				'minuto',
				'evento',
				'evento_id',
				'tipo_evento',
				'equipo_condicion',
				'jugador'
			],
			'verify'	=> [
				'tournament',
				'leagues',
				'cups',
				'selections',
				'name',
				'teams',
				'team',
				'image',
				'actual_date',
				'positions',
				'team_local',
				'team_image_local',
				'gol_local',
				'penalty_local',
				'team_visit',
				'team_image_visit',
				'gol_visit',
				'penalty_visit',
				'dt_visit',
				'stadium',
				'status',
				'date_begin',
				'date',
				'time',
				'minutes',
				'interaction',
				'interaction_id',
				'interaction_type',
				'team_condition',
				'player'
			],
		];
		
		public function model ($params = []) {
			if ($params['match']) {
				return Widgets::multiRenameKey(self::getMatchDetails($params['match']), $this->mappingName['wrong'], $this->mappingName['verify']);
			} else {
				return null;
			}
		}

		private function getMatchDetails ($key) {
			$json = @file_get_contents($this->url . $key . '.json');
			if (strpos($http_response_header[0], "200")) {
				return json_decode($json);
			} else { 
				return null;
			}
		}

	}
?>
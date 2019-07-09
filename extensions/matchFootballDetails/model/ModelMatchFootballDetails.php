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
				'minuto'
			],
			'verify'	=> [
				'tournament',
				'leagues',
				'cups',
				'selections',
				'name',
				'teams',
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
				'minutes'
			],
		];
		
		public function model ($params = []) {
			if ($params['type'] && $params['tournament'] && $params['match']) {
				$typeTournament = $params['type'];
				$tournamentName = $params['tournaments'][$params['type']][$params['tournament']]['name']['default'];
				return Widgets::multiRenameKey(self::getMatchDetails($params['match']), $this->mappingName['wrong'], $this->mappingName['verify']);
			}
		}

		private function getMatchDetails ($key) {
			return json_decode(file_get_contents($this->url . $key . '.json'), true);
		}

		// private function getTournaments ($type, $name) {
		// 	$tournament = Widgets::multiRenameKey(json_decode(file_get_contents($this->urlTournaments), true), $this->mappingName['wrong'], $this->mappingName['verify']);
		// 	foreach ($tournament as $key => $t) {
		// 		if ($key == $type) {
		// 			foreach ($t as $value) {
		// 				if (Widgets::normalizeString($value['name']) == $name) {
		// 					return $value['key'];
		// 				}
		// 			}
		// 		}
		// 	}
		// }
	}
?>
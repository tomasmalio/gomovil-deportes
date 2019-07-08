<?php
	/**
	 * Model Position List
	 */
	class ModelNextMatchesFootball {
		// Url JSON
		private $url = 'http://apiuf.gomovil.co/ligas/';
		// Url tournaments content JSON
		private $urlTournaments = 'http://apiuf.gomovil.co/ligas/ligas.json';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
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
				
				'penal_local',
				'visitante',
				'visitante_img',
				'gol_visitante',
				'penal_visitante',
				'estado',
				'hora_inicio',
				'dia',
				'hora',
				'minuto'
			],
			'verify'	=> [
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
				
				'penalty_local',
				'team_visit',
				'team_image_visit',
				'gol_visit',
				'penalty_visit',
				'status',
				'date_begin',
				'date',
				'time',
				'minutes'
			],
		];
		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$typeTournament = $params['type'];
				$tournamentName = $params['tournaments'][$params['type']][$params['tournament']]['name']['default'];
				$tournament = self::getTournaments($typeTournament, Widgets::normalizeString($tournamentName));
				return Widgets::multiRenameKey(self::getFixture($tournament), $this->mappingName['wrong'], $this->mappingName['verify']);
			}
		}

		private function getFixture ($key) {
			return json_decode(file_get_contents($this->url . $key . '.json'), true);
		}

		private function getTournaments ($type, $name) {
			$tournament = Widgets::multiRenameKey(json_decode(file_get_contents($this->urlTournaments), true), $this->mappingName['wrong'], $this->mappingName['verify']);
			foreach ($tournament as $key => $t) {
				if ($key == $type) {
					foreach ($t as $value) {
						if (Widgets::normalizeString($value['name']) == $name) {
							return $value['key'];
						}
					}
				}
			}
		}
	}
?>
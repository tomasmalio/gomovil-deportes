<?php
	/**
	 * Model Scorers List Football
	 */
	class ModelScorersListFootball {
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
				'goleadores',
				'equipo',
				'escudo',
				'puesto',
				'nombre_completo',
				'goles'
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
				'scorers',
				'team',
				'team_shield',
				'position',
				'complete_name',
				'goals'
			],
		];
		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$typeTournament = $params['type'];
				$tournamentName = $params['tournaments'][$params['type']][$params['tournament']]['name']['default'];
				$tournament = self::getTournaments($typeTournament, Widgets::normalizeString($tournamentName));
				return (Widgets::multiRenameKey(self::getPositions($tournament), $this->mappingName['wrong'], $this->mappingName['verify']))['scorers'];
			}
		}

		private function getPositions ($key) {
			$json = json_decode(file_get_contents($this->url . $key . '.json'), true);
			return $json;
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
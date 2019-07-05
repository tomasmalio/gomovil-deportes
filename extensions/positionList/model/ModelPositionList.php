<?php
	/**
	 * Model Position List
	 */
	class ModelPositionList {
		// Url JSON
		private $url = 'http://apiuf.gomovil.co/ligas/';
		// Url tournaments content JSON
		private $urlTournaments = 'http://apiuf.gomovil.co/ligas/ligas.json';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'',
				'ligas',
				'copas',
				'selecciones',
				'nombre',
				'equipos',
				'imagen',
				'fecha_actual',
				'posiciones',
				'equipo',
				'escudo',
				'puesto',
				'jugados',
				'ganados',
				'empatados',
				'perdidos',
				'goles_favor',
				'goles_contra',
				'diferencia',
				'puntos'
			],
			'verify'	=> [
				'asfasfsaf',
				'leagues',
				'cups',
				'selections',
				'name',
				'teams',
				'image',
				'actual_date',
				'positions',
				'team',
				'team_shield',
				'position',
				'played',
				'won',
				'tied',
				'lost',
				'goals_in_favor',
				'goals against',
				'difference',
				'points'
			],
		];
		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$typeTournament = $params['type'];
				$tournamentName = $params['tournaments'][$params['type']][$params['tournament']]['name']['default'];
				$tournament = self::getTournaments($typeTournament, Widgets::normalizeString($tournamentName));
				return Widgets::multiRenameKey(self::getPositions($tournament), $this->mappingName['wrong'], $this->mappingName['verify']);
			}
		}

		private function getPositions ($key) {
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
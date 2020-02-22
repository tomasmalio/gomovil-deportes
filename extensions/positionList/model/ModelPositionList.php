<?php
	/**
	 * Model Position List
	 */
	class ModelPositionList {
		// Url JSON
		// private $url = 'http://apiuf.gomovil.co/ligas/';
		// // Url tournaments content JSON
		// private $urlTournaments = 'http://apiuf.gomovil.co/ligas/ligas.json';

		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/data.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';

		//http://gomovil.universofutbol.com/data.php?metodo=posiciones&user=gomovil&pwd=g0m0v1lc0&division=1&campeonato=1355

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'ligas',
				'copas',
				'selecciones',
				'nombre',
				'equipos',
				'escudo',
				'fecha_actual',
				'posiciones',
				'equipo',
				'escudo',
				'ubicacion',
				'partidos_jugados',
				'partidos_ganados',
				'partidos_empatados',
				'partidos_perdidos',
				'goles_a_favor',
				'goles_en_contra',
				'diferencia',
				'puntos'
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
				$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=torneos'), true), $this->mappingName['wrong'], $this->mappingName['verify']);
				print_r($array);
				foreach ($array as $res) {
					foreach ($res as $value) {
						if ($value['key'] == $params['tournament']) {
							return $this->getPositions($value['division'], $value['championship']);
						}
					}
				}
				// $typeTournament = $params['type'];
				// $tournamentName = $params['tournaments'][$params['type']][$params['tournament']]['name']['default'];
				// $tournament = self::getTournaments($typeTournament, Widgets::normalizeString($tournamentName));
				// return Widgets::multiRenameKey(self::getPositions($tournament), $this->mappingName['wrong'], $this->mappingName['verify']);
			}
		}

		private function getPositions ($division, $championship) {
			$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=posiciones&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']);
			print_r($array);
			exit;
			return $array['positions'];
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
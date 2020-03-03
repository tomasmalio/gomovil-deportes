<?php
	/**
	 * Model Position List
	 */
	class ModelPositionList {
		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/data.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'ligas',
				'copas',
				'selecciones',
				'torneo',
				'campeonato',
				'nombre',
				'equipos',
				'escudo',
				'fecha_actual',
				'posiciones',
				'equipo',
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
				'tournament',
				'championship',
				'team',
				'teams',
				'team_shield',
				'actual_date',
				'positions',
				'team',
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
				foreach ($array as $res) {
					foreach ($res as $value) {
						if ($value['key'] == $params['tournament']) {
							return $this->getPositions($value['division'], $value['championship']);
						}
					}
				}
			}
			return null;
		}

		private function getPositions ($division, $championship) {
			print_r(Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=posiciones&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']));
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
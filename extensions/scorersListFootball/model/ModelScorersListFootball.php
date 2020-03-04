<?php
	/**
	 * Model Scorers List Football
	 */
	class ModelScorersListFootball {
		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/data.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'nombre',
				'torneo',
				'campeonato',
				'fecha_actual',
				'goleadores',
				'equipo',
				'escudo',
				'goles',
				'pais'
			],
			'verify'	=> [
				'name',
				'tournament',
				'championship',
				'actual_date',
				'scorers',
				'team',
				'team_shield',
				'goals',
				'country'
			],
		];

		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=torneos'), true), $this->mappingName['wrong'], $this->mappingName['verify']);
				foreach ($array as $res) {
					foreach ($res as $value) {
						if ($value['key'] == $params['tournament']) {
							$return = $this->getPositions($value['division'], $value['championship']);
							return $return['scorers'];
						}
					}
				}
			}
			return null;
		}

		/**
		 * get Positions
		 * 
		 * @division int 
		 * @championship int
		 */
		private function getPositions ($division, $championship) {
			return Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=goleadores&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']);
		}

	}
?>
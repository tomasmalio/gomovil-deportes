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
				'equipo',
				'escudo',
				'goles'
			],
			'verify'	=> [
				'name',
				'tournament',
				'championship',
				'actual_date',
				'team',
				'team_shield',
				'goals'
			],
		];

		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=torneos'), true), $this->mappingName['wrong'], $this->mappingName['verify']);
				foreach ($array as $res) {
					foreach ($res as $value) {
						if ($value['key'] == $params['tournament']) {
							print_r($this->getPositions($value['actual_date'], $value['division'], $value['championship']));
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
			echo "aca";
			return Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=goleadores&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']);
		}

	}
?>
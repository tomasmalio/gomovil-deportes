<?php
	/**
	 * Model Teams List
	 */
	class ModelTeamsList {
		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/data.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';

		// Slider position
		private $sliderPosition = 0;

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'nombre',
				'campeonato',
				'equipos',
				'pais'
			],
			'verify'	=> [
				'name',
				'championship',
				'teams',
				'country'
			],
		];
		
		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=torneos'), true), $this->mappingName['wrong'], $this->mappingName['verify']);
				foreach ($array as $res) {
					foreach ($res as $value) {
						if ($value['key'] == $params['tournament']) {
							return $this->getTeams($value['division'], $value['championship']);
						}
					}
				}
			}
			return null;
		}

		/**
		 * Get Teams
		 * 
		 * @division int
		 * @championship int
		 */
		private function getTeams ($division, $championship) {
			$array = Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=equipos&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']);
			return $array['teams'];
		}
	}
?>
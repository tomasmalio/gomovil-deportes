<?php
	/**
	 * Model Match Football Details
	 */
	class ModelMatchFormation {

		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/partido_detalle.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'partido',
				'formaciones',
				'nombre',
				'apellido',
				'numero',
				'posicion'
			],
			'verify'	=> [
				'match',
				'formations',
				'player_name',
				'player_last_name',
				'number',
				'position'
			],
		];

		
		public function model ($params = []) {
			if ($params['match']) {
				$match = Widgets::multiRenameKey(self::getMatchDetails($params['match']), $this->mappingName['wrong'], $this->mappingName['verify']);
				return $match['match']['formations'];
			} else {
				return null;
			}
		}

		private function getMatchDetails ($match_id) {
			$json = @file_get_contents($this->json . 'id=' . $match_id . '&user=' . $this->user . '&pwd=' . $this->pass . '&eventId=0');
			if (strpos($http_response_header[0], "200")) {
				return json_decode($json, true);
			} else { 
				return null;
			}
		}

	}
?>
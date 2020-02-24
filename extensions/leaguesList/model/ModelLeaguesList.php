<?php
	/**
	 * Model Leagues List
	 */
	class ModelLeaguesList {
		// URL JSON
		private $json = 'http://gomovil.universofutbol.com/data.php?';
		// User
		private $user = 'gomovil';
		// Password
		private $pass = 'g0m0v1lc0&';
		
		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'torneo',
				'torneos',
				'campeonato'
			],
			'verify'	=> [
				'tournament',
				'tournaments',
				'championship'
			],
		];

		public function model ($params = []) {
			$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=torneos'), true), $this->mappingName['wrong'], $this->mappingName['verify']);
			return $array['championship'];
		}
	}
?>
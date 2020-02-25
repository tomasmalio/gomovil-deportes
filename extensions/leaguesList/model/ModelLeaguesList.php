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
				'campeonato',
				'tipo'
			],
			'verify'	=> [
				'name',
				'tournaments',
				'championship',
				'type'
			],
		];

		public function model ($params = []) {
			$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=torneos'), true), $this->mappingName['wrong'], $this->mappingName['verify']);
			return $this->groupByTournamentType($array['tournaments']);
		}

		private function groupByTournamentType ($tournaments) {
			$array['leagues'] 		= [];
			$array['cups'] 			= [];
			$array['selections'] 	= [];
			print_r($tournaments);
			foreach ($tournaments as $tournament) {
				switch (strtolower($tournament["type"])) {
					case 'liga':
					case 'league':
						array_push($array['leagues'], array('name' => $tournament['name'], 'key' => $tournament['key']));
						break;
					case 'copa':
					case 'cups':
						array_push($array['cups'], array('name' => $tournament['name'], 'key' => $tournament['key']));
						break;
					case 'seleccion':
					case 'selections':
						array_push($array['selections'], array('name' => $tournament['name'], 'key' => $tournament['key']));
						break;
				}
				print_r($array);
				exit;
				return $array;
			}
		}
	}
?>
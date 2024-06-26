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
			if (isset($params['search']['tournament']) && isset($params['search']['type'])) {
				return $this->findTournament($array, $params['search']['tournament']);
			} else {
				return $this->groupByTournamentType($array['tournaments']);
			}
			
		}

		/**
		 * Group by tournament type
		 * We go throw the JSON and order by leagues, cups and selections
		 * @tournaments json
		 */
		private function groupByTournamentType ($tournaments) {
			$array['leagues'] 		= [];
			$array['cups'] 			= [];
			$array['selections'] 	= [];
			
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
			}
			return $array;
		}


		private function findTournament ($tournaments, $search) {
			foreach ($tournaments['tournaments'] as $tournament) {
				if ($tournament['key'] == $search) {
					return $tournament;
					break;
				}
			}
		}
	}
?>
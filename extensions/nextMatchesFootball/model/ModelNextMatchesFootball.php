<?php
	/**
	 * Model Position List
	 */
	class ModelNextMatchesFootball {
		// Url JSON
		private $url = 'http://apiuf.gomovil.co/ligas/';
		// Url tournaments content JSON
		private $urlTournaments = 'http://apiuf.gomovil.co/ligas/ligas.json';

		private $json = 'http://gomovil.universofutbol.com/data.php?';

		private $user = 'gomovil';

		private $pass = 'g0m0v1lc0&';

		// Slider position
		private $sliderPosition = 0;

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'nombre',
				'torneo',
				'campeonato',
				'partido',
				'fecha',
				'local',
				'local_escudo',
				'local_resultado',
				'visitante',
				'visitante_escudo',
				'visitante_id',
				'visitante_resultado',
				'dia',
				'hora'
			],
			'verify'	=> [
				'name',
				'tournament',
				'championship',
				'match',
				'match_date',
				'team_local',
				'team_image_local',
				'team_result_local',
				'team_visit',
				'team_image_visit',
				'visitor_id',
				'team_result_visit',
				'day',
				'hour'
			],
		];
		
		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=torneos'), true), $this->mappingName['wrong'], $this->mappingName['verify']);
				foreach ($array as $res) {
					foreach ($res as $value) {
						if ($value['key'] == $params['tournament']) {
							return $this->getFixture($value['division'], $value['championship']);
						}
					}
				}
			}
			return null;
		}

		/**
		 * Get fixture
		 * 
		 * @division int
		 * @championship int
		 */
		private function getFixture ($division, $championship) {
			$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=fixture&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']);

			$fixture = []; 
			$q = 0;
			$actualDate = false;
			$newDate = true;
			foreach ($array['fixture'] as $res) {
				$key = $res['match']['match_date'];
				if (!array_key_exists($res['match']['match_date'], $fixture)) {
					$fixture[$key] = [];
					$q++;
				}
				if ($res['match']['day'] >= date('Y-m-d') && ($newDate < $res['match']['day'])) {
					self::setSliderPosition($q);
					$actualDate = true;
					$newDate = $res['match']['day'];
				}
				array_push($fixture[$key], $res['match']);
			}
			$return = [];
			$return['fixture'] = $fixture;
			return array_merge($return, ['slider_position' => $this->sliderPosition]);
		}

		/**
		 * Set the position for the slider
		 */
		private function setSliderPosition ($pos) {
			if (isset($pos) && is_numeric($pos)) {
				$this->sliderPosition = $pos;
			}
		}
	}
?>
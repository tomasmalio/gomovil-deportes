<?php
	/**
	 * Model Position List
	 */
	class ModelNextMatchesFootball {
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
				'torneo',
				'campeonato',
				'fecha_actual',
				'partido',
				'fecha',
				'local',
				'local_escudo',
				'local_resultado',
				'local_pais',
				'visitante',
				'visitante_escudo',
				'visitante_id',
				'visitante_resultado',
				'visitante_pais',
				'vistante_pais',
				'dia',
				'hora'
			],
			'verify'	=> [
				'name',
				'tournament',
				'championship',
				'actual_date',
				'match',
				'match_date',
				'team_local',
				'team_image_local',
				'team_result_local',
				'team_country_local',
				'team_visit',
				'team_image_visit',
				'visitor_id',
				'team_result_visit',
				'team_country_visit',
				'team_country_visit',
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
							return $this->getFixture($value['actual_date'], $value['division'], $value['championship']);
						}
					}
				}
			}
			return null;
		}

		/**
		 * Get fixture
		 * 
		 * @actual_date String
		 * @division int
		 * @championship int
		 */
		private function getFixture ($actual_date, $division, $championship) {
			$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=fixture&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']);

			$fixture = []; 
			$q = 0;
			$actualDate = false;
			
			foreach ($array['fixture'] as $res) {
				$key = $res['match']['match_date'];
				if (!array_key_exists($res['match']['match_date'], $fixture)) {
					$fixture[$key] = [];
					$q++;

					if ($key == $actual_date && !$actualDate) {
						self::setSliderPosition($q);
					}
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
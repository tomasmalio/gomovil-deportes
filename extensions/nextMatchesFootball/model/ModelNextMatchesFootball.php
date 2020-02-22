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

		private function getFixture ($division, $championship) {
			$array =  Widgets::multiRenameKey(json_decode(file_get_contents($this->json . '&user=' . $this->user . '&pwd=' . $this->pass . '&metodo=fixture&division='. $division .'&campeonato='. $championship), true), $this->mappingName['wrong'], $this->mappingName['verify']);

			$fixture = []; 
			$q = 0;
			$actualDate = false;
			foreach ($array['fixture'] as $res) {
				$key = $res['match']['match_date'];
				echo $key.'<br>';
				if (!array_key_exists($res['match']['match_date'], $fixture)) {
					$fixture[$key] = [];
					$q++;
					echo $q.'<br>';
				}
				if ($res['match']['day'] >= date('Y-m-d') && !$actualDate) {
					self::setSliderPosition($q);
					$actualDate = true;
				}
				array_push($fixture[$key], $res['match']);
			}
			$return = [];
			$return['fixture'] = $fixture;
			return array_merge($return, ['slider_position' => $this->sliderPosition]);
		}

		/**
		 * Get the fixture by the key
		 */
		// private function getFixture ($key) {
		// 	$array = json_decode(file_get_contents($this->url . $key . '.json'), true);
		// 	print_r($array);
		// 	if (isset($array['fecha_actual']) && !is_numeric($array['fecha_actual'])) {
		// 		$q = 1;
		// 		foreach ($array['fixture'] as $key => $a) {
		// 			if ($key == $array['fecha_actual']) {
		// 				self::setSliderPosition($q);
		// 				break;
		// 			}
		// 			$q++;
		// 		}
		// 	} elseif (isset($array['fecha_actual']) && is_numeric($array['fecha_actual'])) {
		// 		self::setSliderPosition($array['fecha_actual']);
		// 	}
		// 	return array_merge($array, ['slider_position' => $this->sliderPosition]);
		// }

		/**
		 * Get the tournament
		 */
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
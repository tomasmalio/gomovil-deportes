<?php
	/**
	 * Model Position List
	 */
	class ModelNextMatchesFootball {
		// Url JSON
		private $url = 'http://apiuf.gomovil.co/ligas/';
		// Url tournaments content JSON
		private $urlTournaments = 'http://apiuf.gomovil.co/ligas/ligas.json';


		private $tournaments = 'http://gomovil.universofutbol.com/data.php?metodo=torneos';

		private $user = 'gomovil';

		private $pass = 'g0m0v1lc0&';

		// Slider position
		private $sliderPosition = 0;

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'ligas',
				'copas',
				'selecciones',
				'nombre',
				'equipos',
				'imagen',
				'fecha_actual',
				'posiciones',
				'local',
				'local_img',
				'penal_local',
				'visitante',
				'visitante_img',
				'gol_visitante',
				'penal_visitante',
				'estado',
				'hora_inicio',
				'dia',
				'hora',
				'minuto'
			],
			'verify'	=> [
				'leagues',
				'cups',
				'selections',
				'name',
				'teams',
				'image',
				'actual_date',
				'positions',
				'team_local',
				'team_image_local',
				'penalty_local',
				'team_visit',
				'team_image_visit',
				'gol_visit',
				'penalty_visit',
				'status',
				'date_begin',
				'date',
				'time',
				'minutes'
			],
		];
		
		public function model ($params = []) {
			if ($params['type'] && $params['tournament']) {
				$array = json_decode(file_get_contents($this->tournaments . '&user=' . $this->user . '&pwd=' . $this->pass));

				print_r($array);
			}
			
			
			// if ($params['type'] && $params['tournament']) {
			// 	$typeTournament = $params['type'];
			// 	$tournamentName = $params['tournaments'][$params['type']][$params['tournament']]['name']['default'];
			// 	$tournament = self::getTournaments($typeTournament, Widgets::normalizeString($tournamentName));
			// 	return Widgets::multiRenameKey(self::getFixture($tournament), $this->mappingName['wrong'], $this->mappingName['verify']);
			// }
		}

		/**
		 * Get the fixture by the key
		 */
		private function getFixture ($key) {
			$array = json_decode(file_get_contents($this->url . $key . '.json'), true);
			print_r($array);
			if (isset($array['fecha_actual']) && !is_numeric($array['fecha_actual'])) {
				$q = 1;
				foreach ($array['fixture'] as $key => $a) {
					if ($key == $array['fecha_actual']) {
						self::setSliderPosition($q);
						break;
					}
					$q++;
				}
			} elseif (isset($array['fecha_actual']) && is_numeric($array['fecha_actual'])) {
				self::setSliderPosition($array['fecha_actual']);
			}
			// return array_merge($array, ['slider_position' => $this->sliderPosition]);
			print_r($array);
		}

		/**
		 * Get the tournament
		 */
		private function getTournaments ($type, $name) {
			$tournament = Widgets::multiRenameKey(json_decode(file_get_contents($this->urlTournaments), true), $this->mappingName['wrong'], $this->mappingName['verify']);
			foreach ($tournament as $key => $t) {
				if ($key == $type) {
					foreach ($t as $value) {
						if (Widgets::normalizeString($value['name']) == $name) {
							return $value['key'];
						}
					}
				}
			}
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
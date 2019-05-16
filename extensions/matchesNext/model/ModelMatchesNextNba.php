<?php
	/**
	 * Model Matches Next Nba
	 */
	class ModelMatchesNextNba {
		
		public $url = 'https://universofutbol.com/nba/a8d5be500ec66212f2192408d3c6dd77/matchesByDates/';

		public function model ($params = []) {
			/**
			 * Basket
			 */
			if ($params['basket']['display']) {
				if (isset($params['from']['date']) && $params['from']['date'])  {
					if (isset($params['from']['time']) && $params['from']['time']) {
						$this->url .= $params['from']['date'] . '%20' . $params['from']['time'] . '/';
					} else {
						$this->url .= $params['from']['date'] .'%2000:00:00/';
					}
				}
				if (isset($params['to']) && $params['to']) {
					if (isset($params['to']['time']) && $params['to']['time']) {
						$this->url .= $params['to']['date'] . '%20' . $params['to']['time'];
					} else {
						$this->url .= $params['to']['date'] .'%2023:59:59';
					}
				} else {
					$this->url .= $params['from']['date'] .'%2023:59:59';
				}
				$json = json_decode(file_get_contents($this->url), true);
				array_push($params['basket']['tournaments'], $json);
			}
			
			return $params;
		}
	}
?>
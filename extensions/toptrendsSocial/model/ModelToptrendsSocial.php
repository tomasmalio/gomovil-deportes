<?php
	/**
	 * Model Toptrends Social
	 */
	class ModelToptrendsSocial {
		
		private $url = 'http://app.toptrends.news/ws/wall.php?slug=';

		private $interval = '24';
		
		public function model ($params = []) {
			self::setInterval($params['interval']);
			if ($params['search']) {
				$json = self::getSocial($params['search']);
				if ($json) {
					return json_decode($json, true);
				} else {
					return null;
				}	
			}
		}

		public function setInterval ($interval) {
			if (!empty($interval)) {
				$this->interval = $interval;
			}
		}

		private function getSocial($search) {
			$json = @file_get_contents($this->url . $search .'&interval=' . $this->interval);
			if (strpos($http_response_header[0], "200")) { 
				return $json;
			} else { 
				return null;
			}
		}
	}
?>
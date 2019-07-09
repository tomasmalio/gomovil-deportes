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
				return json_decode(self::getSocial($params['search']), true);;
			}
		}

		public function setInterval ($interval) {
			if (!empty($interval)) {
				$this->interval = $interval;
			}
		}

		private function getSocial($search) {
			return file_get_contents($this->url . $search .'&interval=' . $this->interval);
		}
	}
?>
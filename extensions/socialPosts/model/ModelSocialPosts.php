<?php
	/**
	 * Model Social Posts
	 */
	class ModelSocialPosts {
		
		public $url = 'http://socialapi.gomovil.co/api/';

		public function model ($params = []) {
			switch ($params['type']) {
				case 'las-nenas':
					$json = file_get_contents($this->url . $params['type'] . '.json');
					break;
				default:
					$json = file_get_contents($this->url . 'virales.json');
					break;
			}
			return json_decode($json);
		}
	}
?>
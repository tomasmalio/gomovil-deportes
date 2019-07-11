<?php
	/**
	 * Model Social Posts
	 */
	class ModelSocialPosts {
		
		public $url = 'http://socialapi.gomovil.co/api/';

		public function model ($params = []) {
			switch ($params['type']) {
				case 'las-nenas':
				case 'tenis':
				case 'basquet':
				case 'basket':
					$json = file_get_contents($this->url . $params['type'] . '.json');
					break;
				case 'e-sports':
					$json = file_get_contents($this->url .'esports-peru.json');
					break;
				case 'voley':
					$json = file_get_contents($this->url . $params['type'] . '-peru.json');
					break;
				default:
					$json = file_get_contents($this->url . 'virales.json');
					break;
			}
			return json_decode($json);
		}
	}
?>
<?php
	/**
	 * Model Social Posts
	 */
	class ModelSocialPosts {
		
		private $url = 'http://socialapi.gomovil.co/api/';

		public function model ($params = []) {
			switch ($params['type']) {
				case 'las-nenas':
				case 'tenis':
					$json = file_get_contents($this->url . $params['type'] . '.json');
					break;
				case 'basket':
					$json = file_get_contents($this->url .'basquet.json');
					break;
				case 'e-sports':
					$json = file_get_contents($this->url .'esports-peru.json');
					break;
				case 'voley':
					$json = file_get_contents($this->url . $params['type'] . '-peru.json');
					break;
				case 'masdeportes':
				case '+deportes':
					$json = file_get_contents($this->url . 'polideportivo-peru.json');
					break;
				case 'virales':
					$json = file_get_contents($this->url . 'virales.json');
					break;
				default:
					$json = file_get_contents($this->url . 'deportes-peru.json');
					break;
			}
			return json_decode($json);
		}
	}
?>
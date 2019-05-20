<?php
	/**
	 * Model Scores List
	 */
	class ModelScoresList {
		
		public $url = 'http://apiuf.gomovil.co/cache/futbol/goleadores/argentina.json';

		public function model ($params = []) {
			$json = json_decode(file_get_contents($this->url), true);
			return $json['goleadores'];
		}
	}
?>
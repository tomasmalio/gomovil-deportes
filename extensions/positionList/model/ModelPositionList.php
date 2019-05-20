<?php
	/**
	 * Model Position List
	 */
	class ModelPositionList {
		
		public $url = 'http://apiuf.gomovil.co/cache/futbol/posiciones/argentina.json';

		public function model ($params = []) {
			$json = json_decode(file_get_contents($this->url), true);
			return $json['posiciones'];
		}
	}
?>
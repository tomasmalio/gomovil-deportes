<?php
	/**
	 * Model VideosList
	 */
	class ModelVideosList {
		
		public $url = 'http://biteldev.gomovil.co/api/videos-leyendas.json';

		public function model () {
			$json = file_get_contents($this->url);
			return json_decode($json);
		}
	}
?>
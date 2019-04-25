<?php
	/**
	 * Model News Lists
	 */
	class ModelNewsList {
		
		public $url = 'http://biteldev.gomovil.co/api/nota-del-dia.json';

		public function model () {
			$json = file_get_contents($this->url);
			return json_decode($json);
		}
	}
?>
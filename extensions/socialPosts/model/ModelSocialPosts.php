<?php
	/**
	 * Model Social Posts
	 */
	class ModelSocialPosts {
		
		public $url = 'http://socialapi.gomovil.co/api/virales.json';

		public function model () {
			$json = file_get_contents($this->url);
			return json_decode($json);
		}
	}
?>
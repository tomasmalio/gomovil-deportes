<?php
	/**
	 * Model VideosFootballGoMovil
	 */
	class ModelVideosFootballGoMovil {
		
		public $url = 'http://biteldev.gomovil.co/api/videos-leyendas.json';

		public function model () {
			$json = @file_get_contents($this->url);
			if (strpos($http_response_header[0], "200")) {
				return json_decode($json);
			} else {
				return null;
			}
			
		}
	}
?>
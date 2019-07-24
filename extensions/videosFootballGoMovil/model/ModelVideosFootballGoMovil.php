<?php
	/**
	 * Model VideosFootballGoMovil
	 */
	class ModelVideosFootballGoMovil {
		// Url
		private $url = 'http://biteldev.gomovil.co/api/videos-leyendas.json';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'nombre',
				'fecha_creacion'
			],
			'verify'	=> [
				'name',
				'datetime'
			],
		];

		public function model () {
			$json = @file_get_contents($this->url);
			if (strpos($http_response_header[0], "200")) {
				return Widgets::multiRenameKey(json_decode($json, true), $this->mappingName['wrong'], $this->mappingName['verify']);
			} else {
				return null;
			}
			
		}
	}
?>
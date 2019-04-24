<?php
	/**
	 * VideosList
	 */
	class VideosList extends Widgets {
		public $videos = [
			[
				'title' => "Pelota al pie: Godoy Cruz vs. Cristal",
				'm4v' => "http://cdn.gomovil.co/videos/pelota-al-pie/pelota-al-pie-godoy-cruz-sp-cristal.mp4",
				'poster' => "http://cdn.gomovil.co/videos/pelota-al-pie/pelota-al-pie-godoy-cruz-sp-cristal.png",
			],
			[
				'title' => "Fútbol +10: Semifinalistas listos | Cristal cambia | Sub-17 afuera",
				'm4v' => "http://cdn.gomovil.co/videos/futbol%2B10/futbol-mas-diez-18-abril.mp4",
				'poster' => "http://cdn.gomovil.co/videos/futbol%2B10/futbol-mas-10-18-abril.png"
			],
			[
				'title' => "Fútbol +10: Resumen semanal deportivo",
				'm4v' => "http://cdn.gomovil.co/videos/futbol%2B10/futbol-mas-10-11-de-abril.mp4",
				'poster' => "http://cdn.gomovil.co/videos/futbol%2B10/futbol-mas-diez-11-de-abril.png"
			],
			[
				'title' => "Pelota al pie: River vs. Alianza Lima",
				'm4v' => "http://cdn.gomovil.co/videos/pelota-al-pie/pelota-al-pie-river-alianza.mp4",
				'poster' => "http://cdn.gomovil.co/videos/pelota-al-pie/pelota-al-pie-river-alianza.png"
			]
		];

		// Assets files
		public $files = [
			'style'		=> ['skin.bitel.jplayer.less'],
			'js'		=> ['jquery.jplayer.js', 'jplayer.playlist.js'],
		];

		// Controls
		public $controls = [
			// Autoplay
			'autoPlay' 			=> true,
			// Display controls
			'displayControls' 	=> false,
			// Muted
			'muted' 			=> false,
			// Loop
			'loop'				=> false,
		];
		// Options
		public $options = [
			
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					'videoList'			=> $this,
				]
			);
		}
	}
?>
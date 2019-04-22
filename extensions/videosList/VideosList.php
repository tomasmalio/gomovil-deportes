<?php
	/**
	 * VideosList
	 */
	class VideosList extends Widgets {
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
			'muted' 			=> true,
			// Loop
			'loop'				=> true,
		];
		// Options
		public $options = [
			'minify' => false,
			'styles' => [
				'color_1' => 'white',
			],
			'script' => "",
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					'videoList'			=> $this,
				]
			);
		}
	}
?>
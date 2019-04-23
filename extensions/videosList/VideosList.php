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
			'displayControls' 	=> true,
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
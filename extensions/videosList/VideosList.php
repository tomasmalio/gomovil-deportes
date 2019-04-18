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
		// Autoplay
		public $autoPlay = true;
		// Display controls
		public $displayControls = true;
		// Muted
		public $muted = true;

		// Options
		public $options = [];

		public function assets (){
			return parent::getAssets($this->files['style'], $this->files['js']);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'videoList'			=> $this,
				]
			);
		}
	}
?>
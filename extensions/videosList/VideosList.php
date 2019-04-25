<?php
	/**
	 * VideosList
	 */
	class VideosList extends Widgets {
		public $videos;

		// Assets files
		public $files = [
			'style'		=> ['skin.bitel.jplayer.less'],
			'js'		=> ['jquery.jplayer.js', 'jplayer.playlist.js'],
		];

		// Options
		public $options = [
			'items' => [
				'desktop' => 4,
				'mobile' => 4,
			],
			'controls' => [
				// Autoplay
				'autoPlay' 			=> true,
				// Display controls
				'displayControls' 	=> true,
				// Muted
				'muted' 			=> true,
				// Loop
				'loop'				=> false,
			]
		];

		public function __construct() {
			if ($content = Widgets::model()) {
				$this->videos = $content;
			}
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'videos'			=> $this->videos,
					'options'			=> $this->options,
					'items'				=> parent::items(),
				]
			);
		}
	}
?>
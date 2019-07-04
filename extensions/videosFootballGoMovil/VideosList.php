<?php
	/**
	 * VideosList
	 */
	class VideosFootballGoMovil extends Widgets {
		// Video content
		public $content;

		public $view = 'videosFootballGoMovil';

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
			'slider' => [
				'desktop' 	=> [
					'display' 		=> true,
				],
				'mobile' 	=> [
					'display' 		=> true,
				],
			],
			'controls' => [
				// Autoplay
				'autoPlay' 			=> false,
				// Display controls
				'displayControls' 	=> true,
				// Muted
				'muted' 			=> true,
				// Loop
				'loop'				=> false,
			],
		];

		public function __construct($params = []) {
			parent::__construct($params);
			if (IS_MOBILE) {
				$this->viewName = $this->viewName . 'Mobile';
			}
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'content'			=> $this->content,
					'options'			=> $this->options,
					'slider'			=> parent::slider(),
					'items'				=> parent::items(),
				],
				$this->viewName
			);
		}
	}
?>
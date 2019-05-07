<?php
	/**
	 * VideosList
	 */
	class VideosList extends Widgets {
		public $videos;

		public $view = 'VideosList';

		// Assets files
		public $files = [
			'style'		=> ['skin.bitel.jplayer.less', 'swiper.css'],
			'js'		=> ['jquery.jplayer.js', 'jplayer.playlist.js', 'swiper.js'],
		];

		// Options
		public $options = [
			'items' => [
				'desktop' => 4,
				'mobile' => 4,
			],
			'slider' => [
				'desktop' => true,
				'mobile' => true,
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
			'script' => [
				'name'		=> 'swiper.videos-list',
				'content' 	=> "new Swiper('.swiper-container-video', {
					slidesPerView: 'auto',
					loop: true,
					spaceBetween: 15,
					mousewheel: true,
					pagination: {
						clickable: false,
					},
				});"
			]
		];

		public function __construct() {
			if ($content = Widgets::model()) {
				$this->videos = $content;
			}
			if ($GLOBALS['isMobile']) {
				$this->view = $this->view . 'Mobile';
			}
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'videos'			=> $this->videos,
					'options'			=> $this->options,
					'slider'			=> parent::slider(),
					'items'				=> parent::items(),
				],
				$this->view
			);
		}
	}
?>
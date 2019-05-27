<?php
	/**
	 * VideosList
	 */
	class VideosList extends Widgets {
		// Video content
		public $content;

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
			'script' => [
				'name'		=> 'swiper.videos-list',
				'content' 	=> "var swiperVideo = new Swiper('.swiper-container-video', {
					//slidesPerView: 'auto',
					loop: false,
					spaceBetween: 15,
					mousewheel: true,
				});"
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
			if (IS_MOBILE) {
				$this->view = $this->view . 'Mobile';
			}
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'content'			=> $this->content,
					'options'			=> $this->options,
					'slider'			=> parent::slider(),
					'items'				=> parent::items(),
				],
				$this->view
			);
		}
	}
?>
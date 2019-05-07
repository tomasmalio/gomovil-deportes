<?php
	/**
	 * NewsList
	 */
	class NewsList extends Widgets {
		public $news;

		// Assets files
		public $files = [
			'style'	=> ['news-list.less','swiper.css'],
			'js'	=> ['swiper.js'],
		];

		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> true,
				'mobile' 	=> true,
			],
			'items' => [
				'desktop' 	=> 5,
				'mobile' 	=> 5,
			],
			'minify' => false,
			'script' => [
				'name'		=> 'swiper.news-list',
				'content' 	=> "var swiper = new Swiper('.swiper-container', {
					slidesPerView: 'auto',
					loop: true,
					spaceBetween: 30,
					mousewheel: true,
					pagination: {
						clickable: false,
					},
				});"
			]
		];

		public function __construct() {
			if ($content = Widgets::model()) {
				$this->news = $content;
			}
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'newsList' 	=> $this->news,
					'slider'	=> parent::slider(),
					'items'		=> parent::items(),
				]
			);
		}
	}
?>
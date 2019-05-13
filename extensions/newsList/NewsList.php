<?php
	/**
	 * NewsList
	 */
	class NewsList extends Widgets {
		public $content;

		// Assets files
		public $files = [
			'style'	=> ['news-list.less','swiper.css'],
			'js'	=> ['swiper.js'],
		];

		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> [
					'display' 		=> true,
				],
				'mobile' 	=> [
					'display' 		=> true,
				],
			],
			'items' => [
				'desktop' 	=> 5,
				'mobile' 	=> 5,
			],
			'minify' => false,
			'script' => [
				'name'		=> 'swiper.news-list',
				'content' 	=> "var swiperNewsList = new Swiper('.news-list-content', {
					slidesPerView: 'auto',
					loop: true,
					spaceBetween: 30,
					mousewheel: true,
				});"
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'content' 	=> $this->content,
					'slider'	=> parent::slider(),
					'items'		=> parent::items(),
				]
			);
		}
	}
?>
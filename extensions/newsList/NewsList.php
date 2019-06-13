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
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'content' 		=> $this->content,
					'slider'		=> parent::slider(),
					'items'			=> parent::items(),
					'pagination'	=> parent::sliderPagination(),
					'navigation'	=> parent::sliderNavigation(),
				]
			);
		}
	}
?>
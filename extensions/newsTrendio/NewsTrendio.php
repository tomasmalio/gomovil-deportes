<?php
	/**
	 * NewsTrendio
	 */
	class NewsTrendio extends Widgets {
		public $content;

		// Assets files
		public $files = [
			'style'	=> ['swiper.css', 'news-trendio.less'],
			'js'	=> ['swiper.js'],
		];

		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> [
					'display' 		=> false,
				],
				'mobile' 	=> [
					'display' 		=> true,
				],
			],
			'items' => [
				'desktop' 	=> 4,
				'mobile' 	=> 4,
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
					'pagination'	=> parent::sliderPagination(),
					'navigation'	=> parent::sliderNavigation(),
				]
			);
		}
	}
?>
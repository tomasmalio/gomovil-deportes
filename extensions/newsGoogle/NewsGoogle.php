<?php
	/**
	 * Google-News feed parser and JSON provider Class
	 */
	class NewsGoogle extends Widgets {

		public $content;

		// Assets files
		public $files = [
			'style'	=> ['news-google.less','swiper.css'],
			'js'	=> ['swiper.js'],
		];

		// Options
		public $options = [
			'content' => [
				'display' => [
					'description' => false,
					'source' => true,
				]
			],
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
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return parent::renderViewHtml([
					'content' 		=> $this->content,
					'options'		=> $this->options['content'],
					'slider'		=> parent::slider(),
					'items'			=> parent::items(),
					'pagination'	=> parent::sliderPagination(),
					'navigation'	=> parent::sliderNavigation(),
				],
				$this->viewName
			);
		}
	}
?>
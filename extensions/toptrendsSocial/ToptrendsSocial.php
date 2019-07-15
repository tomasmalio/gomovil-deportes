<?php
	/**
	 * Toptrends Social
	 */
	class ToptrendsSocial extends Widgets {
		// Content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['toptrends-social.less'],
			'js'		=> [],
		];
		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> [
					'display' 		=> false,
				],
				'mobile' 	=> [
					'display' 		=> false,
				],
			],
			'items' => [
				'desktop' => 4,
				'mobile' => 1
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'content'			=> $this->content,
					'items'				=> parent::items(),
					'slider'			=> parent::slider(),
					'pagination'		=> parent::sliderPagination(),
					'navigation'		=> parent::sliderNavigation(),
				],
				$this->viewName
			);
		}
	}
?>
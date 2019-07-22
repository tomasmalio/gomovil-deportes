<?php
	/**
	 * NewsSportsGoMovil
	 */
	class NewsSportsGoMovil extends Widgets {
		public $content;

		// Assets files
		public $files = [
			'style'	=> ['news-sports-gomovil.less'],
			'js'	=> [],
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
			return parent::renderViewHtml([
					'content' 		=> $this->content,
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
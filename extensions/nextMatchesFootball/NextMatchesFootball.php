<?php
	/**
	 * Next Matches Football
	 */
	class NextMatchesFootball extends Widgets {
		// Content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['next-matches-football.less'],
			'js'		=> [],
		];
		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> [
					'display' 		=> true,
					'pagination'	=> false,
					'navigation'	=> true,
				],
				'mobile' 	=> [
					'display' 		=> true,
					'pagination'	=> false,
					'navigation'	=> true,
				],
				'options' => [
					'mousewheel' 	=> false
				],
				'dynamic' 	=> true,
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return parent::renderViewHtml([
					'content'			=> $this->content,
					'slider'			=> parent::slider(),
					'items'				=> parent::items(),
					'pagination'		=> parent::sliderPagination(),
					'navigation'		=> parent::sliderNavigation(),
				],
				$this->viewName
			);
		}
	}
?>
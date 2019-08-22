<?php
	/**
	 * Leagues List
	 */
	class LeaguesList extends Widgets {
		// Content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['leagues-list.less'],
			'js'		=> [],
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
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return parent::renderViewHtml([
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
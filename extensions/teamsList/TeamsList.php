<?php
	/**
	 * Teams List
	 */
	class TeamsList extends Widgets {
		// Content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['teams-list.less'],
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
<?php
	/**
	 * Match Football Stats
	 */
	class MatchStats extends Widgets {
		// Content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['match-football-stats.less'],
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
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return parent::renderViewHtml([
					'content'			=> $this->content,
					'slider'			=> parent::slider(),
					'pagination'		=> parent::sliderPagination(),
					'navigation'		=> parent::sliderNavigation(),
				],
				$this->viewName
			);
		}
	}
?>
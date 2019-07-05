<?php
	/**
	 * Position List
	 */
	class ScorersListFootball extends Widgets {
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['scorers-list-football.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

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
				],
				$this->viewName
			);
		}
	}
?>
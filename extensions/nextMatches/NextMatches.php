<?php
	/**
	 * Next Matches
	 */
	class NextMatches extends Widgets {
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['next-matches.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

		public function __construct($params = []) {
			// parent::__construct($params);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
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
<?php
	/**
	 * Full text
	 */
	class FullText extends Widgets {
		// Content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['full-text.less'],
			'js'		=> [],
		];
		// Options
		public $options = [
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
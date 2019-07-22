<?php
	/**
	 * Position List
	 */
	class PositionList extends Widgets {
		public $title = 'Posiciones';
		//
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['position-list.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

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
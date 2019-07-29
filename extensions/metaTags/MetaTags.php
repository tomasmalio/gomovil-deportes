<?php
	/**
	 * MetaTags
	 */
	class MetaTags extends Widgets {
		public $content;

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return parent::renderViewHtml([
					'content' 	=> $this->content,
				],
				$this->viewName
			);
		}
	}
?>
<?php
	/**
	 * Matches Next
	 */
	class MatchesNext extends Widgets {
		public $titleNextMatches = 'Próximos partidos';
		public $date;
		public $linkCalendar = ['url' => '#', 'name' => 'Ver calendario'];
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['next-matches.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

		public function __construct($params = []) {
			parent::__construct($params);			
			$this->date = date('Y-m-d');
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'titleNextMatches'	=> $this->titleNextMatches,
					'date'				=> $this->date,
					'content'			=> $this->content,
					'linkCalendar'		=> $this->linkCalendar,
				]
			);
		}
	}
?>
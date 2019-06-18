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
			$this->content = Widgets::multiRenameKey($this->content, 
				[
					'equipo',
					'escudo',
					'puesto',
					'jugados',
					'ganados',
					'empatados',
					'perdidos',
					'goles_favor',
					'goles_contra',
					'diferencia',
					'puntos',
				], 
				[
					'team',
					'team_shield',
					'position',
					'played',
					'won',
					'tied',
					'lost',
					'goals_in_favor',
					'goals against',
					'difference',
					'points',
				]
			);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'title'				=> $this->title,
					'content'			=> $this->content,
				],
				$this->viewName
			);
		}
	}
?>
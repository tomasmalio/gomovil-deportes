<?php
	/**
	 * NewsFeatured
	 */
	class NewsFeatured extends Widgets {
		//public $title;
		public $news = [
			'title' 		=> 'Alianza no tiene paz', 
			'description' 	=> 'Alianza Lima no tiene paz desde la derrota en la final del último Campeonato Descentralizado',
			'image'			=> 'https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/miguel-russo-alianza-lima-entrenador-millonarios-getty_1000x500.jpg',
			'date' 			=> '2019-04-24',
			'label'			=> 'Noticia del día',
			'category'		=> 'Fútbol',
		];

		// Assets files
		public $files = [
			'style'		=> ['news-featured.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

		public function renderView () {
			return Widgets::renderViewHtml([
					'news' => $this->news
				]
			);
		}
	}
?>
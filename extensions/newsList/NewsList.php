<?php
	/**
	 * NewsList
	 */
	class NewsList extends Widgets {
		public $news = [
			['title' => 'Título de la noticia 1', 'description' => 'Description 1', 'date' => '2019-04-09', 'url' => '#'],
			['title' => 'Título de la noticia 2', 'description' => 'Description 2', 'date' => '2019-06-09', 'url' => '#'],
			['title' => 'Título de la noticia 3', 'description' => 'Description 3', 'date' => '2019-05-19', 'url' => '#'],
		];

		// Assets files
		public $files = [
			'style'	=> ['swiper.css'],
			'js'	=> ['swiper.js'],
		];

		// Options
		public $options = [
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					'newsList' => $this->news
				]
			);
		}
	}
?>
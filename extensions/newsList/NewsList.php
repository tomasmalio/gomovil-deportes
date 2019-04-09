<?php
	/**
	 * NewsList
	 */
	class NewsList extends Widgets {
		public $news = array(
			array('title' => 'Título de la noticia 1', 'description' => 'Description 1', 'date' => '2019-04-09', 'url' => '#'),
			array('title' => 'Título de la noticia 2', 'description' => 'Description 2', 'date' => '2019-06-09', 'url' => '#'),
			array('title' => 'Título de la noticia 3', 'description' => 'Description 3', 'date' => '2019-05-19', 'url' => '#'),
		);

		public function renderView () {
			return Widgets::renderPhpFile(lcfirst(get_class($this)) .'/views/view' . get_class($this) . '.php', array(
					'newsList' => $this->news
				)
			);
		}
	}
?>
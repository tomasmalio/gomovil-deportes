<?php
	/**
	 * NewsFeatured
	 */
	class NewsFeatured extends Widgets {
		//public $title;
		public $news = [
			'title' 		=> 'Los giros en el destino de Viáfara', 
			'description' 	=> 'Description 1',
			'image'			=> 'https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/jhon-viafara-deportivo-cali-festejo-gol-afp_1000x500.jpg',
			'date' 			=> '2019-04-09',
			'label'			=> 'Noticia del día',
			'category'		=> 'Fútbol',
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					'news' => $this->news
				]
			);
		}
	}
?>
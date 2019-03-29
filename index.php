<?php
	require_once __DIR__.'/bootstrap.php';

	/* Featured News */
	$widgetFeaturedNews = file_get_contents('extensions/featuredNews/featuredNews.php');
	$widgetFeaturedNews = preg_replace('/{TITLE_WIDGET}/', 'Noticia del día', $widgetFeaturedNews);
	$widgetFeaturedNews = preg_replace('/{TITLE_NEWS}/', 'Los giros en el destino de Viáfara', $widgetFeaturedNews);
	$widgetFeaturedNews = preg_replace('/{IMAGE_NEWS}/', 'https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/jhon-viafara-deportivo-cali-festejo-gol-afp_1000x500.jpg', $widgetFeaturedNews);
	
	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');
	echo $twig->render('generateIndex.html', array(
													'widgetFeaturedNews' => $widgetFeaturedNews,
												)
											);
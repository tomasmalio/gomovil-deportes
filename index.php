<?php
	require_once __DIR__.'/bootstrap.php';

	/* Widget */
	require_once __DIR__.'/extensions/Widgets.php';
	$widget = new Widgets();
	
	/* Declare of extensions directory */
	$GLOBALS['extensions_url'] = '/extensions';

	/****************************************
	 * FEATURED NEWS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsFeatured/NewsFeatured.php';
	$widgetNewsFeatured = (new NewsFeatured())->renderView();

	/****************************************
	 * LIST NEWS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsList/NewsList.php';
	$widgetNewsList 	= (new NewsList())->renderView();

	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');

	echo $twig->render('generateIndex.html', array(
			'widgetNewsFeatured' 			=> $widgetNewsFeatured,
			'widgetNewsList'				=> $widgetNewsList,
		)
	);
<?php
	require_once __DIR__.'/bootstrap.php';

	/* Widget */
	require_once __DIR__.'/extensions/Widgets.php';
	$widget = new Widgets();
	
	/* Declare of extensions directory */
	$GLOBALS['extensions_url'] = '/extensions';

	/****************************************
	 * META TAGS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/metaTags/MetaTags.php';
	$widgetMetaTags = (new MetaTags())->renderView();
	$displayMetaTags = true;

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
			'widgetMetaTags'			=> array(
												'content' 				=> $widgetMetaTags,
												'display'				=> $displayMetaTags,
			),
			'widgetNewsFeatured' 		=> array(
												'content'			 	=> $widgetNewsFeatured,
												'display'				=> $displayNewsFeatured,
			),
			'widgetNewsList'			=> array(
												'content'		 		=> $widgetNewsList,
												'display'				=> $displayNewsList,
			),
		)
	);
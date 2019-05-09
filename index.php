<?php
	require_once __DIR__.'/bootstrap.php';

	/* Widget */
	$widget = new Widgets();
	
	/* Declare of extensions directory */
	$GLOBALS['extensions_url'] = '/extensions';

	use GoMovil\Assets;

	/* Mobile Detection */
	$detect = new Mobile_Detect();
	$GLOBALS['isMobile'] = $detect->isMobile();
	
	$assets = ['css' => [], 'js' => []];

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
	$assetNewsFeatured = (new NewsFeatured())->assets();
	array_push($assets['css'], $assetNewsFeatured['css']);
	array_push($assets['js'], $assetNewsFeatured['js']);
	$displayNewsFeatured = false;

	/****************************************
	 * MATCHES FEATURED 
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesFeatured/MatchesFeatured.php';
	$widgetMatchesFeatured = (new MatchesFeatured())->renderView();
	$assetMatchesFeatured = (new MatchesFeatured())->assets();
	array_push($assets['css'], $assetMatchesFeatured['css']);
	array_push($assets['js'], $assetMatchesFeatured['js']);
	$displayMatchesFeatured = true;

	/****************************************
	 * LIST NEWS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsList/NewsList.php';
	$widgetNewsList 	= (new NewsList())->renderView();
	$assetNewsList = (new NewsList())->assets();
	array_push($assets['css'], $assetNewsList['css']);
	array_push($assets['js'], $assetNewsList['js']);
	$displayNewsList = true;

	/****************************************
	 * NEXT MATCHES
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesNext/MatchesNext.php';
	$widgetMatchesNext 	= (new MatchesNext())->renderView();
	$assetMatchesNext = (new MatchesNext())->assets();
	array_push($assets['css'], $assetMatchesNext['css']);
	array_push($assets['js'], $assetMatchesNext['js']);
	$displayMatchesNext = true;

	/****************************************
	 * LIST VIDEOS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/videosList/VideosList.php';
	$widgetVideosList 	= (new VideosList())->renderView();
	$assetVideoList = (new VideosList())->assets();
	array_push($assets['css'], $assetVideoList['css']);
	array_push($assets['js'], $assetVideoList['js']);
	$displayVideosList = true;

	/****************************************
	 * SOCIAL POSTS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/socialPosts/SocialPosts.php';
	$widgetSocialPosts 	= (new SocialPosts())->renderView();
	$assetSocialPosts = (new SocialPosts())->assets();
	array_push($assets['css'], $assetSocialPosts['css']);
	array_push($assets['js'], $assetSocialPosts['js']);
	$displaySocialPosts = true;

	/****************************************
	 * SOCIAL GIFS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/socialGifs/SocialGifs.php';
	$widgetSocialGifs 	= (new SocialGifs())->renderView();
	$assetSocialGifs = (new SocialGifs())->assets();
	array_push($assets['css'], $assetSocialGifs['css']);
	array_push($assets['js'], $assetSocialGifs['js']);
	$displaySocialGifs = true;

	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');

	echo $template->render([
		'assetsStyle'				=> (new Assets())->generateAssets($assets['css']),
		'assetsJs'					=> (new Assets())->generateAssets($assets['js']),
		'widgetMetaTags'			=> [
											'content' 				=> $widgetMetaTags,
											'display'				=> $displayMetaTags,
		],
		'widgetNewsFeatured' 		=> [
											'content'			 	=> $widgetNewsFeatured,
											'display'				=> $displayNewsFeatured,
		],
		'widgetMatchesFeatured' 	=> [
											'content'			 	=> $widgetMatchesFeatured,
											'display'				=> $displayMatchesFeatured,
		],
		'widgetNewsList'			=> [
											'content'		 		=> $widgetNewsList,
											'display'				=> $displayNewsList,
		],
		'widgetMatchesNext'			=> [
											'content'		 		=> $widgetMatchesNext,
											'display'				=> $displayMatchesNext,
		],
		'widgetVideosList'			=> [
											'content'		 		=> $widgetVideosList,
											'display'				=> $displayVideosList,
		],
		'widgetSocialPosts'			=> [
											'content'		 		=> $widgetSocialPosts,
											'display'				=> $displaySocialPosts,
		],
		'widgetSocialGifs'			=> [
											'content'		 		=> $widgetSocialGifs,
											'display'				=> $displaySocialGifs,
],
	]);
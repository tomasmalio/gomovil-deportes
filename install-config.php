<?php 
	$typePlatform = $_GET['typePlatform'];
	print_r($_GET);

	if (isset($typePlatform) && $typePlatform != '') {
		$file = file_get_contents('index.php');
		$file = str_replace('{@TYPE_PRODUCTION}', $typePlatform, $file); 
		file_put_contents($file);
	} else {
		$file = file_get_contents('index.php');
		$file = str_replace('development', $typePlatform, $file); 
		file_put_contents($file);
	}
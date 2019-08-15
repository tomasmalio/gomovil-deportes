<?php 
	// echo $typePlatform;
	// $typePlatform = $_GET['typePlatform'];

	if (isset($typePlatform) && $typePlatform != '') {
		echo $typePlatform;
		$file = file_get_contents('index.php');
		$file = str_replace('{@TYPE_PRODUCTION}', $typePlatform, $file); 
		file_put_contents($file);
	} else {
		$file = file_get_contents('index.php');
		$file = str_replace('development', $typePlatform, $file); 
		file_put_contents($file);
	}
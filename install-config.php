<?php 
	$file = file_get_contents('index.php');
	if (isset($typePlatform) && $typePlatform != '') {
		echo $typePlatform;
		
		$file = str_replace('{@TYPE_PRODUCTION}', $typePlatform, $file); 
		$status = file_put_contents($file);
	} else {
		$file = file_get_contents('index.php');
		$file = str_replace('{@TYPE_PRODUCTION}', 'development', $file); 
		$status = file_put_contents($file);
	}
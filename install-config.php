<?php 
	$file = file_get_contents('index.php');
	if (isset($typePlatform) && $typePlatform != '') {
		echo $typePlatform;
		$newFile = str_replace('{@TYPE_PRODUCTION}', $typePlatform, $file);
		file_put_contents($newFile, $file);
	} else {
		$file = file_get_contents('index.php');
		$newFile = str_replace('{@TYPE_PRODUCTION}', 'development', $file);
		file_put_contents($newFile, $file);
	}
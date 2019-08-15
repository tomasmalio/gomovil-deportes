<?php 
	$file = file_get_contents('index.php');
	if (isset($typePlatform) && $typePlatform != '') {
		echo $typePlatform;
		
		file_put_contents(str_replace('{@TYPE_PRODUCTION}', $typePlatform, $file), $file);
	} else {
		$file = file_get_contents('index.php');
		file_put_contents(str_replace('{@TYPE_PRODUCTION}', 'development', $file), $file); 
	}
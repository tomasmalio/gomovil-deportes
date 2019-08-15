<?php 
	/**
	 * Creating the index for Production or Development
	 */
	$val = getopt("p:");
	print_r($val);
	$file = file_get_contents('include/db.php');
	if ($val['p'] === 'prod') {
		$file = str_replace('{@TYPE_PRODUCTION}', $val['p'], $file);
	} else {
		$file = str_replace('{@TYPE_PRODUCTION}', 'dev', $file);
	}
	file_put_contents('index.php', $file);
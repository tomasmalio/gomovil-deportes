<?php 
	/**
	 * Creating the index for Production or Development
	 */
	$val = getopt("p:");
	$file = file_get_contents('index.php');
	if (isset($val['p']) && $val['p'] == 'prod') {
		$file = str_replace('{@TYPE_PRODUCTION}', $val['p'], $file);
	} else {
		$file = str_replace('{@TYPE_PRODUCTION}', 'dev', $file);
	}
	file_put_contents('index.php', $file);
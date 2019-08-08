<?php
	use Phpfastcache\CacheManager;
	use Phpfastcache\Config\ConfigurationOption;

	// Setup File Path on your config files
	// Please note that as of the V6.1 the "path" config 
	// can also be used for Unix sockets (Redis, Memcache, etc)
	CacheManager::setDefaultConfig(new ConfigurationOption([
		'path' => '/files', // or in windows "C:/tmp/"
	]));

	// In your class, function, you can call the Cache
	$InstanceCache = CacheManager::getInstance('files');
	$InstanceCache->clear();
?>
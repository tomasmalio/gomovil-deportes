<?php

// Load our autoloader
require_once __DIR__.'/vendor/autoload.php';

// Specify our Twig templates location
$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');

 // Instantiate our Twig
$twig = new Twig_Environment($loader);

// Extensions directory
$twig->addGlobal('extensions', __DIR__.'/extensions');
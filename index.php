<?php

require './Slim/Slim.php';
\Slim\Slim::registerAutoloader();
require './twig/vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
require_once './app/views/TwigView.php';
require './app/models/factory.php';

$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => new \Slim\Extras\Views\Twig(),
    'templates.path' => './app/views/'
));

$app->get('/:user_id', function($user_id) use ($app) {
		$speciality = Factory::create("speciality");
		$allSpeciality = $speciality->getAllSpeciality();
		
		$receptions = Factory::create("receptions");
		$curReceptions = $receptions->getReceptionListByUserId($user_id); 

    	$app->render('template.html', array(
            'user_id' => $user_id,
    		'allSpeciality' => $allSpeciality,
    		'curReceptions' => $curReceptions,
    	));
    }
);

$app->run();

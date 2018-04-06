<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

session_start();

require __DIR__ .'/../vendor/autoload.php';

//make a config file with the database and slim app configs
$config = require_once('config.php');

$app = new \Slim\App($config);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule) {
	return $capsule;
};

$container['flash'] = function($container){
	return new \Slim\Flash\Messages;
};

$container['view'] = function($container){

	$view = new \Slim\Views\Twig(__DIR__ . '/../views/', [
		'cache' => false,
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
    ));

	$view->getEnvironment()->addGlobal('flash', $container->flash);

	return $view;
};

$container['notFoundHandler'] = function ($container){
	return function($request, $response) use ($container) {
		$container->view->render($response, 'pages/404.twig');
		return $response->withStatus(404);
	};
};

$container['MainController'] = function($container){
	return new \App\Controllers\MainController($container);
};

require __DIR__ .'/../app/routes.php';
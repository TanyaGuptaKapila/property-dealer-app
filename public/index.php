<?php

use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Set up PHP-DI container
$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

// Add routing & error middleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Inject PDO into container
$container->set('pdo', require __DIR__ . '/../config/db.php');
$app->addBodyParsingMiddleware();
// Add Twig view if needed (optional)
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$container->set('view', function () {
	return Twig::create(__DIR__ . '/../views', ['cache' => false]);
});
$app->add(TwigMiddleware::createFromContainer($app));

// Load routes
require __DIR__ . '/../src/routes.php';

// Run the app
$app->run();

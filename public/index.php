<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use DI\Container;

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

$container->set('view', function() {
    return Twig::create(__DIR__ . '/../views', ['cache' => false]);
});

$app->add(TwigMiddleware::createFromContainer($app));

require __DIR__ . '/../src/routes.php';

$app->run();

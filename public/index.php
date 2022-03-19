<?php

use Core\App;
use Core\Container;
use Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();
$router->get('/test/{name}', [\App\Controllers\Home::class, 'index']);
$router->get('/ahmed', [\App\Controllers\Test::class, 'index']);
$router->post('/test/{name}', function ($name) {
    echo $name;
});
$router->get('/contact/{ali}', [\App\Controllers\Contact::class, 'index']);
$router->post('/contact/create', [\App\Controllers\Contact::class, 'index']);

$container = new Container();
$container->set(\App\Services\ClintService::class, function () {
    return new \App\Services\ClintService('google.com');
});
$app = new App($router, $container);

$app->run();



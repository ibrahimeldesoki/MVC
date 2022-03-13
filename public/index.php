<?php

use Core\App;
use Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();
$router->get('/test/{name}', [\App\Controllers\Home::class, 'index']);
$router->post('/test/{name}', function ($name) {
    echo $name;
});
$router->get('/contact', [\App\Controllers\Contact::class, 'index']);
$router->post('/contact/create', [\App\Controllers\Contact::class, 'index']);

$app = new App($router);
$app->run();

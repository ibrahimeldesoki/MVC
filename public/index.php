<?php

use App\Controllers\Contact;
use App\Controllers\Home;
use App\Controllers\Test;
use App\Services\ClintService;
use Core\App;
use Core\Container;
use Core\DBConnection;
use Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/test/{name}', [Home::class, 'index']);
$router->get('/ahmed', [Test::class, 'index']);
$router->post('/test/{name}', function ($name) {
    echo $name;
});
$router->get('/contact/{ali}', [Contact::class, 'index']);
$router->post('/contact/create', [Contact::class, 'index']);

$container = new Container();
$container->set(ClintService::class, function () {
    return new ClintService('google.com');
});
$container->set(DBConnection::class, function () {
    return new DBConnection();
});

$app = new App($router, $container);

$app->run();



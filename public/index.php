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

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$router = new Router();

$router->get('/test/{name}', [Home::class, 'index']);
$router->get('/ahmed', [Test::class, 'index']);
$router->post('/test/{name}', function ($name) {
    echo $name;
});
$router->get('/contact/{ali}', [Contact::class, 'index']);
$router->post('/contact/create', [Contact::class, 'index']);

$app = new App($router, new Container());
$app->registerProvider(\App\Providers\DatabaseProvider::class);
$app->run();



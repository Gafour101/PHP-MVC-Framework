<?php
/** User: Gafour Tech ...**/

use gaf\controllers\AuthController;
use gaf\controllers\SiteController;
use gaf\phpmvc\Application;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'userClass' => \gaf\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$gaf = new Application(dirname(__DIR__), $config);

$gaf->router->get('/', [SiteController::class,'home']);
$gaf->router->get('/contact', [SiteController::class,'contact']);
$gaf->router->post('/contact',[SiteController::class,'contact']);

$gaf->router->get('/login', [AuthController::class,'login']);
$gaf->router->post('/login', [AuthController::class,'login']);

$gaf->router->get('/register', [AuthController::class,'register']);
$gaf->router->post('/register', [AuthController::class,'register']);
$gaf->router->get('/logout', [AuthController::class,'logout']);
$gaf->router->get('/profile', [AuthController::class,'profile']);
$gaf->run();
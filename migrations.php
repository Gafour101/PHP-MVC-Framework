<?php
/** User: Gafour Tech ...**/

use app\controllers\AuthController;
use app\controllers\SiteController;
use gaf\phpmvc\Application;

require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
    'userClass' => 'app\models\UserModel',
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();
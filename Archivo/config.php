<?php

const DirBase = __DIR__ . '/';

require_once 'vendor/autoload.php';  // Esto es para monolog
require_once DirBase . "model/conexion.php";
require_once DirBase . "controller/controller.php";
require_once DirBase . "controller/afiliados.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);

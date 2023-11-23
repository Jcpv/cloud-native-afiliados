<?php
require 'config.php';

use Slim\App;

use Controller\Estadistica\Gestor\ctrlAfiliados;

$app = new \Slim\App();

$app->group('/analisis', function (App $app) {

    $app->get('/afiliados2020[/{id}]', function ($req, $resp, $args) use ($app) {
        ctrlAfiliados::datosAfiliados($req, $resp, $args);
        return $resp->withJson(ctrlAfiliados::getResultado());
    });

    $app->delete('/afiliados2020[/{id}]', function ($req, $resp, $args) use ($app) {
        ctrlAfiliados::borrarAfiliados($req, $resp, $args);
        return $resp->withJson(ctrlAfiliados::getResultado());
    });

    $app->post('/afiliados2020', function ($req, $resp, $args) use ($app) {
        ctrlAfiliados::regNuevo($req, $resp, $args);
        return $resp->withJson(ctrlAfiliados::getResultado());
    });

    $app->put('/afiliados2020[/{id}]', function ($req, $resp, $args) use ($app) {
        ctrlAfiliados::guardarDato($req, $resp, $args);
    });

});

$app->run();

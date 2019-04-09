<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
    return $response->withJson(['message'=> 'Welcome to your phone book']);
});

$app->post('/phonebooks', \PhoneBookController::class . ':storePhoneBookItem');
$app->get('/phonebooks/{id}', \PhoneBookController::class . ':getOnePhoneBookItem');
$app->delete('/phonebooks/{id}', \PhoneBookController::class . ':deleteOnePhoneBookItem');
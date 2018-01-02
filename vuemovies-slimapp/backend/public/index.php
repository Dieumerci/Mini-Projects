<?php
//these two lines of code invokes the request and response objects
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//this line incles the php autoload to allow us to use the slim dependancies
require '../vendor/autoload.php';
//including the database
require '../src/config/db.php';
//creating the main slim objects
$app = new \Slim\App;
//creates the routes for the get object
//our route is /hello/{name} ***{name} is dynamic and can be anything
$app->get('/hello/{name}', function (Request $request, Response $response) {
    //creates the variable name and setting it to whatever is pasted
    $name = $request->getAttribute('name');
    //here we justing getting the response
    $response->getBody()->write("Hello, $name");

    return $response;
});

// Movie routes

require '../src/routes/movies.php';
$app->run();
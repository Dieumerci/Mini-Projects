<?php
//these two lines of code invokes the request and response objects
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//this line incles the php autoload to allow us to use the slim dependancies

//creating the main slim objects
$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Get all Movies
$app->get('/api/movies', function(Request $request, Response $response){
    $sql = "SELECT * FROM movies";

        try{
            //Get DB Object
            $db = new db();
            //Connection
            $db = $db->connect();

            $stmt = $db->query($sql);
            $movies = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            echo json_encode($movies);
        }catch(PDOException $e){

            echo '{"error": {"text": '.$e->getMessage().'}';

        }
});
// Get Single Movies
$app->get('/api/movies/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM movies WHERE id = $id";

        try{
            //Get DB Object
            $db = new db();
            //Connection
            $db = $db->connect();

            $stmt = $db->query($sql);
            $movie = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;

            echo json_encode($movie);
        }catch(PDOException $e){

            echo '{"error": {"text": '.$e->getMessage().'}';

        }
});

// Add Single Movie
$app->post('/api/movies/add', function(Request $request, Response $response){
    $movie_name = $request->getParam('movie_name');
    $category = $request->getParam('category');
    $description = $request->getParam('description');

    $sql = "INSERT INTO movies (movie_name,category,description) VALUES (:movie_name,:category,:description)";

        try{
            //Get DB Object
            $db = new db();
            //Connection
            $db = $db->connect();

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':movie_name',$movie_name);
            $stmt->bindParam(':category',$category);
            $stmt->bindParam(':description',$description);

            $stmt->execute();

            echo '{"notice": {"text": "Movie has been added"}';
        }catch(PDOException $e){

            echo '{"error": {"text": '.$e->getMessage().'}';

        }
});

// Update Single Movie
$app->put('/api/movies/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $movie_name = $request->getParam('movie_name');
    $category = $request->getParam('category');
    $description = $request->getParam('description');

    $sql = "UPDATE movies SET 
        movie_name = :movie_name,
        category = :category,
        description = :description
        WHERE id = $id";

        try{
            //Get DB Object
            $db = new db();
            //Connection
            $db = $db->connect();

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':movie_name',$movie_name);
            $stmt->bindParam(':category',$category);
            $stmt->bindParam(':description',$description);

            $stmt->execute();
            
            echo '{"notice": {"text": "Movie has been UPDATE"}';
        }catch(PDOException $e){

            echo '{"error": {"text": '.$e->getMessage().'}';

        }
});

// Delete Single Movie
$app->delete('/api/movies/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM movies WHERE id = $id";

        try{
            //Get DB Object
            $db = new db();
            //Connection
            $db = $db->connect();
            $stmt = $db->prepare($sql);
            
            $stmt->execute();
            $db = null;

            echo '{"notice": {"text": "Movie has been Deleted"}';
        }catch(PDOException $e){

            echo '{"error": {"text": '.$e->getMessage().'}';

        }
});
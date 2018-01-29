<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Get all users
$app->get('/api/users', function(Request $request, Response $response){
    //echo 'Users';
    $sql = "SELECT * FROM users";

    try{
        //Get db object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);
    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Get single user
$app->get('/api/user', function(Request $request, Response $response){
    //echo 'User';
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM users WHERE id = $id";

    try{
        //Get db object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Add user (POST)
$app->post('/api//add', function(Request $request, Response $response){
    $username = $request->getParam('username');
    $first_name = $request->getParam('ime');
    $last_name = $request->getParam('prezime');
    $biography = $request->getParam('biografija');
    
    $sql = "INSERT INTO users (username, ime, prezime, biografija) VALUES (:username,:ime,:prezime,:biografija)";

    try{
        //Get db object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':ime', $first_name);
        $stmt->bindParam(':prezime', $last_name);
        $stmt->bindParam(':biografija', $biografija);

        $stmt->execute();
        echo '{"notice": {"text": "User added"}';
    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
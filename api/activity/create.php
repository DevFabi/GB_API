<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate activity object
include_once '../objects/activity.php';
include_once '../objects/adress.php';
include_once '../objects/note.php';
include_once '../objects/photo.php';
 
$database = new Database();
$db = $database->getConnection();
 
$activity = new Activity($db);
$adress = new Adress($db);
$note = new Note($db);
$photo = new Photo($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->category_id) &&
    !empty($data->adress_ville)
    
){
    /* On récupère toutes les propriétés du formulaire */
    
     $adress->adress = $data->adress;
     $adress->codepostal =$data->adress_cp;
     $adress->ville = $data->adress_ville;
     $adress->created = date('Y-m-d H:i:s');

     $note->note_ambiance = $data->note_ambiance;
     $note->note_food =$data->note_food;
     $note->created = date('Y-m-d H:i:s');

     $photo->img =$data->photo_img;
     $photo->created = date('Y-m-d H:i:s');

    // Créer la note
        if($note->create()){
        $note_id = $db->lastInsertId();
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "note was created."));
    }
 
    // if unable to create the activity, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create note."));
    }


    // Créer la photo
        if($photo->create()){
        $photo_id = $db->lastInsertId();
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "photo was created."));
    }
 
    // if unable to create the activity, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create photo."));
    }


    // Créer l'adresse
    if($adress->create()){
    $adress_id = $db->lastInsertId();
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Adress was created."));
    }
 
    // if unable to create the activity, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create adress."));
    }

    // set activity property values
    $activity->name = $data->name;
    $activity->price = $data->price;
    $activity->category_id = $data->category_id; // Récupérer dans la liste select
    $activity->adress_id = $adress_id;    // Récupérer la dernière entrée id
    $activity->note_id = $note_id;        // Récupérer la dernière entrée id
    $activity->photo_id = $photo_id;      // Récupérer la dernière entrée id
    $activity->created = date('Y-m-d H:i:s');

    // create the activity
    if($activity->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Activity was created."));
    }
 
    // if unable to create the activity, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create activity."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create activity. Data is incomplete."));
}
?>
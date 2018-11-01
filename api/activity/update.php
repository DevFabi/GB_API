<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/activity.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare activity object
$activity = new Activity($db);
 
// get id of activity to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of activity to be edited
$activity->id = $data->id;
 

// A modifier pour update toutes les tables si nécessaire : Adress, note, photo
// set activity property values
$activity->name = $data->name;
$activity->price = $data->price;
$activity->category_id = $data->category_id;
$activity->adress_id = $data->adress_id;
$activity->note_id = $data->note_id;
$activity->photo_id = $data->photo_id;
$activity->adress = $data->adress;
$activity->adress_cp =$data->adress_cp;
$activity->adress_ville = $data->adress_ville;
$activity->note_ambiance = $data->note_ambiance;
$activity->note_food = $data->note_food;
$activity->photo_img = $data->photo_img;
 
// update the activity
if($activity->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "activities was updated."));
}
 
// if unable to update the activity, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update activity."));
}
?>
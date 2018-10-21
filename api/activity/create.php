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
 
$database = new Database();
$db = $database->getConnection();
 
$activity = new Activity($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->category_id) &&
    !empty($data->adress_id) &&
    !empty($data->note_id) &&
    !empty($data->photo_id) 
    
){
 
    // set activity property values
    $activity->name = $data->name;
    $activity->price = $data->price;
    $activity->category_id = $data->category_id;
    $activity->adress_id = $data->adress_id;
    $activity->note_id = $data->note_id;
    $activity->photo_id = $data->photo_id;
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
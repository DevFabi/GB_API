<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/activity.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare activity object
$activity = new Activity($db);
 
// set ID property of record to read
$activity->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of activity to be edited
$activity->readOne();
 
if($activity->name!=null){
    // create array
    $activity_arr = array(
            "id" => $activity->id,
            "name" => $activity->name,
            "price" => $activity->price,
            "category_id" => $activity->category_id,
            "category_name" => $activity->category_name,
            "adress_id" => $activity->adress_id,
            "adress" => $activity->adress,
            "adress_cp" => $activity->adress_cp,
            "adress_ville" => $activity->adress_ville,
            "note_id" => $activity->note_id,
            "note_ambiance" => $activity->note_ambiance,
            "note_food" => $activity->note_food,
            "photo_id" => $activity->photo_id,
            "photo_img"=> $activity->photo_img,
            "created" => $activity->created,
            "deleted" => $activity->deleted
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($activity_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user activity does not exist
    echo json_encode(array("message" => "Activity does not exist."));
}
?>
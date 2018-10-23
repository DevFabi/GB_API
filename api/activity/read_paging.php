<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/activity.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and activity object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$activity = new Activity($db);
 
// query activities
$stmt = $activity->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // activities array
    $activities_arr=array();
    $activities_arr["records"]=array();
    $activities_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
       $activity_item=array(
            "id" => $id,
            "name" => $name,
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name,
            "adress_id" => $adress_id,
            "adress" => $adress,
            "adress_cp" => $adress_cp,
            "adress_ville" => $adress_ville,
            "note_id" => $note_id,
            "note_ambiance" => $note_ambiance,
            "note_food" => $note_food,
            "photo_id" => $photo_id,
            "photo_img"=> $photo_img,
            "created" => $created,
            "deleted" => $deleted
        );
 
        array_push($activities_arr["records"], $activity_item);
    }
 
 
    // include paging
    $total_rows=$activity->count();
    $page_url="{$home_url}activity/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $activities_arr["paging"]=$paging;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($activities_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user activities does not exist
    echo json_encode(
        array("message" => "No activities found.")
    );
}
?>
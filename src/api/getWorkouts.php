<?php
include '../database.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$response = array();
$result = getAllWorkouts();
if($result->num_rows > 0) {

}
http_response_code(200);
echo json_encode($response);
?>

<?php
$debug = isset($_GET['debug']);
$id = $_GET['id'];
include '../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
if($id != Null) {
    removeTraining($id);
}
$response = array('Status' => 'Success');
http_response_code(200);
echo json_encode($response);
?>

<?php
$debug = isset($_GET['debug']);
$user = $_GET['user'];
include '../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$id = createEmptyTraining($user);
$response;
if($id != Null) {
    $response = array('Status' => 'Success', 'id' => $id);
} else {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

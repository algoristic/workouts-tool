<?php
$debug = isset($_GET['debug']);
$id = $_GET['id'];
$name = $_GET['name'];
$name = base64_decode($name);
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$response;
try {
    updateTraining($id, $name);
    $response = array('Status' => 'Success');
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

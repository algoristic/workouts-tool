<?php
$debug = isset($_GET['debug']);
$trainingId = $_GET['trainingId'];
$trainingPosition = $_GET['trainingPosition'];
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$response;
try {
    $response = array('Status' => 'Success');
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

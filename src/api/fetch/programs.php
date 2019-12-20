<?php
include '../../database.php';
include '../../util.php';
include '../../archive.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$response = array('Status' => 'OK');
http_response_code(200);
echo json_encode($response);
?>

<?php
$debug = isset($_GET['debug']);
$trainingId = Null;
if(isset($_GET['trainingId'])) {
    $trainingId = $_GET['trainingId'];
}
$step = Null;
if(isset($_GET['step'])) {
    $step = $_GET['step'];
}
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$response;
try {
    if(($trainingId != Null) && ($step != Null)) {
        setProgramStep($trainingId, $step);
    }
    $response = array('Status' => 'Success');
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

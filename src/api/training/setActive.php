<?php
$inactive = isset($_GET['inactive']);
$trainingId = Null;
if(isset($_GET['trainingId'])) {
    $trainingId = $_GET['trainingId'];
}
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$response;
try {
    if($trainingId != Null) {
        if($inactive) {
            deactivate($trainingId);
        } else {
            activate($trainingId);
        }
        $response = array('Status' => 'Success');
    } else {
        $response = array('Status' => 'Error');
    }
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

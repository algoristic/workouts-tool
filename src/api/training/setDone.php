<?php
$debug = isset($_GET['debug']);
$trainingId = Null;
if(isset($_GET['trainingId'])) {
    $trainingId = $_GET['trainingId'];
}
$skipTraining = isset($_GET['skipTraining']);
$routineId = Null;
if(isset($_GET['routineId'])) {
    $routineId = $_GET['routineId'];
}
$skipRoutine = isset($_GET['skipRoutine']);
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$response;
try {
    if($trainingId != Null) {
        if($skipTraining) {
            skipTraining($trainingId);
        } else {
            setTrainingDone($trainingId);
        }
    }
    if($routineId != Null) {
        if($skipRoutine) {
            skipRoutine($routineId);
        } else {
            setRoutineDone($routineId);
        }
    }
    $response = array('Status' => 'Success');
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

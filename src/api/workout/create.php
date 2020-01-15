<?php
$debug = isset($_GET['debug']);
$trainingId = $_GET['trainingId'];
$workoutName = $_GET['workoutName'];
$trainingPosition = $_GET['trainingPosition'];
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$response;
try {
    $newWorkoutId = createEmptySingleWorkout($workoutName);
    updateRoutine($trainingId, $newWorkoutId, $trainingPosition);
    $response = array('Status' => 'Success', 'id' => $newWorkoutId);
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

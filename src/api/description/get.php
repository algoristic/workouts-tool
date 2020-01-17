<?php
$debug = isset($_GET['debug']);
$subWorkoutId = $_GET['subWorkoutId'];
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$category = getTrainingCategory($subWorkoutId);
$description = '';
switch ($category) {
    case 'single_workouts':
        $description = getWorkoutDescription($subWorkoutId);
        break;
    case 'program_workouts':
        $description = getProgramDescription($subWorkoutId);
        break;
    default:
        break;
}

$response;
try {
    $response = array('Status' => 'Success', 'description' => addslashes($description));
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

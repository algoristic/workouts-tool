<?php
$debug = isset($_GET['debug']);
$trainingId = $_GET['trainingId'];
$programName = $_GET['programName'];
$trainingPosition = $_GET['trainingPosition'];
include '../../database.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$response;
try {
    $newProgramId = createEmptySingleProgram($programName);
    updateRoutine($trainingId, $newProgramId, $trainingPosition);
    $response = array('Status' => 'Success', 'id' => $newProgramId);
} catch (exception $e) {
    $response = array('Status' => 'Error');
}
http_response_code(200);
echo json_encode($response);
?>

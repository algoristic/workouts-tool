<?php
$debug = isset($_GET['debug']);
$count = 1;
if(!empty($_GET['count'])) {
    $count = intval($_GET['count']);
}
include '../../database.php';
include '../../util.php';
include '../../archive.php';
header("Access-Control-Allow-Origin: *");
if(!$debug) {
    header("Content-Type: application/json; charset=UTF-8");
}
$workouts = callDarebeeApi('https://darebee.com/media/com_jamegafilter/en_gb/1.json');
$before = getWorkoutsAmount();
$counter = 0;
//TODO: more logging when debugging :)
foreach($workouts as $key => $workout) {
    if(!$debug || ($debug && ($counter < $count))) {
        $name = trimSlug($workout->slug);
        if(!workoutIsInDatabase($name)) {
            $ui_name = getUiName($workout->name);
            $description = null;
            {
                $url = 'https://darebee.com/workouts/' . $name;
                $xPathQuery = '//div[contains(@class, "infotext")]';
                $description = extractTextFromPage($url, $xPathQuery);
            }
            $attrs = $workout->attr;
            $difficulty = $attrs->ct14;
            $difficulty_id = null;
            {   //get difficulty from database or create new entry
                $value = $difficulty->value[0];
                $ui_value = $difficulty->frontend_value[0];
                $difficulty = $value;
                $ui_value = addslashes($ui_value);
                if($value != '') {
                    $difficulty_id = fetchDifficulty($value, $ui_value);
                } else {
                    continue;
                }
            }
            $focus = $attrs->ct10;
            $focus_id = null;
            {   //get focus from database or create new entry
                $value = $focus->value[0];
                $ui_value = $focus->frontend_value[0];
                $focus = $value;
                $ui_value = addslashes($ui_value);
                if($value != '') {
                    $focus_id = fetchFocus($value, $ui_value);
                } else {
                    continue;
                }
            }
            $type = $attrs->ct16;
            $type_id = null;
            {   //get type from database or create new entry
                $value = $type->value[0];
                $ui_value = $type->frontend_value[0];
                $type = $value;
                $ui_value = addslashes($ui_value);
                if($value != '') {
                    $type_id = fetchType($value, $ui_value);
                } else {
                    continue;
                }
            }
            createWorkout($name, $ui_name, $description, $focus_id, $type_id, $difficulty_id);
            archiveWorkoutData($name, $focus, $type, $difficulty);
        }
    }
    $counter = ($counter + 1);
}
$after = getWorkoutsAmount();
$diff = ($after - $before);
http_response_code(200);
$response = array("total" => $after, "created" => $diff);
echo json_encode($response);
?>

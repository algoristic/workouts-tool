<?php
include '../../database.php';
include '../../util.php';
include '../../archive.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$workouts = callDarebeeApi('https://darebee.com/media/com_jamegafilter/en_gb/1.json');
$before = getWorkoutsAmount();
foreach($workouts as $key => $workout) {
    $name = explode(':', $workout->slug)[1];
    $ui_name = $workout->name;
    $ui_name = addslashes($ui_name);
    $description = null;
    {
        $url = 'https://darebee.com/workouts/' . $name;
        $html = getHTML($url, 10);
        preg_match('/<div class="infotext">(.*)<\/div>/', $html, $match);
        $description = $match[1];
        $description = trimWhitespace($description);
        $description = addslashes($description);
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
$after = getWorkoutsAmount();
$diff = ($after - $before);
http_response_code(200);
$response = array("total" => $after, "created" => $diff);
echo json_encode($response);
?>

<?php
include '../../database.php';
include '../../util.php';
$workouts = callDarebeeApi('https://darebee.com/media/com_jamegafilter/en_gb/1.json');
foreach($workouts as $key => $workout) {
    $name = explode(':', $workout->slug)[1];
    $ui_name = $workout->name;
    $ui_name = addslashes($ui_name);
    $attrs = $workout->attr;
    $difficulty = $attrs->ct14;
    $difficulty_id = null;
    {
        $value = $difficulty->value[0];
        $ui_value = $difficulty->frontend_value[0];
        $ui_value = addslashes($ui_value);
        if($value != '') {
            $difficulty_id = fetchDifficulty($value, $ui_value);
        } else {
            continue;
        }
    }
    $focus = $attrs->ct10;
    $focus_id = null;
    {
        $value = $focus->value[0];
        $ui_value = $focus->frontend_value[0];
        $ui_value = addslashes($ui_value);
        if($value != '') {
            $focus_id = fetchFocus($value, $ui_value);
        } else {
            continue;
        }
    }
    $type = $attrs->ct16;
    $type_id = null;
    {
        $value = $type->value[0];
        $ui_value = $type->frontend_value[0];
        $ui_value = addslashes($ui_value);
        if($value != '') {
            $type_id = fetchType($value, $ui_value);
        } else {
            continue;
        }
    }
    createWorkout($name, $ui_name, $focus_id, $type_id, $difficulty_id);
}
?>

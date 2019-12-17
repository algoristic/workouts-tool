<?php
function archiveWorkoutData($name, $focus, $type, $difficulty) {
    $media_dir = '../../media';
    {   //save actual workout images
        $workout_dir = $media_dir . '/workouts/' . $name;
        if(!file_exists($workout_dir)) {
            mkdir($workout_dir, 0705, true);
        }
        $instructions_file = $workout_dir . '/instructions.jpg';
        if(!file_exists($instructions_file)) {
            $original = 'https://darebee.com/images/workouts/' . $name . '.jpg';
            copyImage($original, $instructions_file);
        }
        $preview_file = $workout_dir . '/preview.jpg';
        if(!file_exists($preview_file)) {
            $original = 'https://darebee.com/images/workouts/' . $name . '-intro.jpg';
            copyImage($original, $preview_file);
        }
        $muscles_file = $workout_dir . '/muscles.jpg';
        if(!file_exists($muscles_file)) {
            $original = 'https://darebee.com/images/workouts/muscles/' . $name . '.jpg';
            copyImage($original, $muscles_file);
        }
    }
}
?>

<?php
function archiveProgramData($name, $url_name, $days) {
    echo ('- - - START - - -<br/>');
    $media_dir = '../../media';
    {
        $program_dir = $media_dir . '/programs/' . $name;
        if(!file_exists($program_dir)) {
            //mkdir($program_dir, 0705, true);
        }
        //TODO: program-overview = $name . '-promo.jpg'!
        $intro_file = $program_dir . '/intro.jpg';
        echo ('intro-file: ' . $intro_file . '<br/>');
        if(!file_exists($intro_file)) {
            $original = 'https://darebee.com/images/programs/' . $url_name . '/' . $name . '-intro.jpg';
            echo ('original intro-file: ' . $original . '<br/>');
            //copyImage($original, $intro_file);
        }
        $foundCombination = False;
        $imageName = '';
        $appendix = '';
        for($i = 1; $i <= $days; $i++) {
            $day_img = $program_dir . '/day-' . $i . '.jpg';
            echo ('day-image: ' . $day_img . '<br/>');
            if(!file_exists($day_img)) {
                $urlDayAppendix = $i;
                if($i < 10) {
                    $urlDayAppendix = '0' . $urlDayAppendix;
                }
                //days can be /day or /chapter !!! -> but '/day' is good enough in the fist place, since the rest can be added later!

                if(!$foundCombination) {
                    foreach (array('day', 'chapter') as $testImageName) {
                        if($foundCombination) {
                            break;
                        }
                        foreach (array('web', 'pages', '2019') as $testAppendix) {
                            //darebee use multiple different appendices here, which are not possible to be determined before...
                            $original = 'https://darebee.com/images/programs/' . $url_name . '/' . $testAppendix . '/' . $testImageName . $urlDayAppendix . '.jpg';
                            echo ('original day-image: ' . $original . '<br/>');
                            if(isImage($original)) {
                                echo 'found combination: appendix=' . $testAppendix . ' & image=' . $testImageName . '<br/>';
                                $foundCombination = True;
                                $appendix = $testAppendix;
                                $imageName = $testImageName;
                                //copyImage($original, $day_img);
                                break;
                            }
                        }
                    }
                }
                //TODO: work further with found appendix and imageName
            }
        }
        echo ('- - - -END- - - -<br/>');
    }
}
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

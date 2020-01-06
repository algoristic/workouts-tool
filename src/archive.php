<?php
function archiveProgramData($name, $url_name, $days) {
    $debug = isset($_GET['debug']);
    $space = '&nbsp;&nbsp;&nbsp;&nbsp;';
    $doubleSpace = $space . $space;
    $tripleSpace = $doubleSpace . $space;
    if($debug) {
        echo ('- - - START - - -<br/>');
        echo ($space . 'program: ' . $name . '<br/>');
    }
    $media_dir = '../../media';
    {
        $program_dir = $media_dir . '/programs/' . $name;
        if(!file_exists($program_dir)) {
            mkdir($program_dir, 0705, true);
        }
        //TODO: program-overview = $name . '-promo.jpg'!
        $intro_file = $program_dir . '/intro.jpg';
        if(!file_exists($intro_file)) {
            if($debug) {
                echo ($doubleSpace . 'intro-file: ' . $intro_file . '<br/>');
            }
            $original = 'https://darebee.com/images/programs/' . $url_name . '/' . $name . '-intro.jpg';
            if($debug) {
                echo ($doubleSpace . 'original intro-file: ' . $original . '<br/>');
            }
            copyImage($original, $intro_file);
        }
        $foundCombination = False;
        $imageName = '';
        $appendix = '';
        for($i = 1; $i <= $days; $i++) {
            $day_img = $program_dir . '/day-' . $i . '.jpg';
            if(!file_exists($day_img)) {
                $urlDayAppendix = $i;
                if($i < 10) {
                    $urlDayAppendix = '0' . $urlDayAppendix;
                }
                if(!$foundCombination) {
                    foreach (array('day', 'chapter', 'card') as $testImageName) {
                        if($foundCombination) {
                            break;
                        }
                        foreach (array('web', 'pages', '2018', '2019', '2020') as $testAppendix) {
                            //darebee use multiple different appendices here, which are impossible to be determined before...
                            $original = 'https://darebee.com/images/programs/' . $url_name . '/' . $testAppendix . '/' . $testImageName . $urlDayAppendix . '.jpg';
                            if($debug) {
                                echo ($tripleSpace . 'test original day-image: ' . $original . '<br/>');
                            }
                            if(isImage($original)) {
                                if($debug) {
                                    echo ($tripleSpace . '=> found combination: appendix=' . $testAppendix . ' & image=' . $testImageName . '<br/>');
                                }
                                $foundCombination = True;
                                $appendix = $testAppendix;
                                $imageName = $testImageName;
                                break;
                            }
                        }
                    }
                }
                if($foundCombination) {
                    $original = 'https://darebee.com/images/programs/' . $url_name . '/' . $appendix . '/' . $imageName . $urlDayAppendix . '.jpg';
                    if($debug) {
                        echo ($doubleSpace . 'copy files: original="' . $original . '", img="' . $day_img . '"<br/>');
                    }
                    copyImage($original, $day_img);
                }
            }
        }
        if($debug) {
            echo ('- - - -END- - - -<br/>');
        }
    }
}
function archiveWorkoutData($name, $focus, $type, $difficulty) {
    $debug = isset($_GET['debug']);
    $space = '&nbsp;&nbsp;&nbsp;&nbsp;';
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

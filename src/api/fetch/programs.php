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
$programs = callDarebeeApi('https://darebee.com/media/com_jamegafilter/en_gb/3.json');
$excludes = array('age-of-pandora', 'totals-program', 'carbon-and-dust');
$before = getProgramsAmount();
if($debug) {
    echo ('programs in database before fetching: ' . $before . '<br/>');
}
$counter = 0;
foreach ($programs as $key => $program) {
    if(!$debug || ($debug && ($counter < $count))) {
        //don't forget: only load and parse if program is unknown (see workouts as reference)
        $name = trimSlug($program->slug);
        $programIsInDatabase = programIsInDatabase($name);
        if(!$programIsInDatabase && !in_array($name, $excludes)) {
            $ui_name = getUiName($program->name);
            $url_name = getUrlName($program->thumbnail);
            $attrs = $program->attr;
            $difficulty = $attrs->ct21;
            var_dump($difficulty);
            $difficulty_id = null;
            {
                $value = $difficulty->value[0];
                $difficulty = $value;
                if($value != '') {
                    $difficulty_id = fetchDifficulty($value, $ui_value);
                } else {
                    continue;
                }
            }
            $url = 'https://darebee.com/programs/' . $name;
            $description = null;
            {   //extract description
                $xPathQuery = '//div[contains(@class, "infop-text")]//p';
                $description = extractTextFromPage($url, $xPathQuery);
            }
            $days = 0;
            {   //extract count of training days
                $xPathQuery = '//div[contains(@class, "ppp")]';
                $results = xPathQuery($url, $xPathQuery);
                $days = sizeof($results);
            }
            $beforeCall = null;
            $afterCall = null;
            if($debug) {
                $beforeCall = getProgramsAmount();
            }
            createProgram($name, $ui_name, $description, $days, $difficulty_id);
            archiveProgramData($name, $url_name, $days);
            if($debug) {
                $afterCall = getProgramsAmount();
                if(($afterCall - $beforeCall) != 1) {
                    echo ('failed creating program: ' . $name . '<br/>');
                }
            }
        }
    }
    $counter = ($counter + 1);
}
$after = getProgramsAmount();
if($debug) {
    echo ('programs in database after fetching: ' . $after . '<br/>');
}
$diff = ($after - $before);
if($debug) {
    $response = array('Status' => 'OK');
} else {
    $response = array("total" => $after, "created" => $diff);

}
http_response_code(200);
echo json_encode($response);
?>

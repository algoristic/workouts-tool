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
//header("Content-Type: application/json; charset=UTF-8");
$programs = callDarebeeApi('https://darebee.com/media/com_jamegafilter/en_gb/3.json');
$counter = 0;
foreach ($programs as $key => $program) {
    if(!$debug || ($debug && ($counter < $count))) {
        //don't forget: only load and parse if program is unknown (see workouts as reference)
        $name = trimSlug($program->slug);
        $ui_name = getUiName($program->name);
        $url_name = getUrlName($program->thumbnail);
        $description = null;
        {
            $url = 'https://darebee.com/programs/' . $name;
            $xPathQuery = '//div[contains(@class, "infop-text")]//p';
            $description = extractTextFromPage($url, $xPathQuery);
        }
        archiveProgramData($name, $url_name, 30);
    }
    $counter = ($counter + 1);
}
$response = array('Status' => 'OK');
http_response_code(200);
//echo json_encode($response);
?>

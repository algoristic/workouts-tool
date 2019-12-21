<?php
include '../../database.php';
include '../../util.php';
include '../../archive.php';
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
$programs = callDarebeeApi('https://darebee.com/media/com_jamegafilter/en_gb/3.json');
$count = 0;
foreach ($programs as $key => $program) {
    if($count < 1) {
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
        $count = $count + 1;
    }
}
$response = array('Status' => 'OK');
http_response_code(200);
//echo json_encode($response);
?>

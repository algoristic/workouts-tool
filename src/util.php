<?php
function callDarebeeApi($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $curl_response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($curl_response);
    if (isset($result->response->status) && $result->response->status == 'ERROR') {
        die('error occured: ' . $result->response->errormessage);
    } else {
        return $result;
    }
}

function copyImage($url, $path) {
    $curl = curl_init($url);
    $file_handle = fopen($path, 'wb');
    curl_setopt($curl, CURLOPT_FILE, $file_handle);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_exec($curl);
    curl_close($curl);
    fclose($file_handle);
}

function getHTML($url,$timeout)
{
       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
       curl_setopt($ch, CURLOPT_FAILONERROR, 1);
       return @curl_exec($ch);
}

function trimWhitespace($s) {
    return ltrim(rtrim($s));
}
?>

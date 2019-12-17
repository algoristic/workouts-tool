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
?>

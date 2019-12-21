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

function trimSlug($slug) {
    return explode(':', $slug)[1];
}

function getUiName($name) {
    return addslashes($name);
}

function getUrlName($url) {
    return explode('/', $url)[2];
}

function extractTextFromPage($url, $query) {
    $html = getHTML($url, 10);
    @$dom = DOMDocument::loadHTML($html);
    $xpath = new DOMXpath($dom);
    $results = $xpath->query($query);
    $result = '';
    foreach($results as $key => $paragraph) {
        $result .= $paragraph->nodeValue . '<br/><br/>';
    }
    return addslashes($result);
}

function isImage($url) {
    //return is_array(getimagesize($url));
    $params = array('http' => array('method' => 'HEAD'));
    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);
    if (!$fp) {
        return false;
    }
    $meta = stream_get_meta_data($fp);
    if ($meta === false) {
        fclose($fp);
        return false;
    }
    $wrapper_data = $meta["wrapper_data"];
    if(is_array($wrapper_data)) {
      foreach(array_keys($wrapper_data) as $hh) {
          if (substr($wrapper_data[$hh], 0, 19) == "Content-Type: image") {
            fclose($fp);
            return true;
          }
      }
    }
    fclose($fp);
    return false;
  }
?>

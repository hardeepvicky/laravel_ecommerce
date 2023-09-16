<?php
function d($array)
{
    $callBy = debug_backtrace()[0];
    echo "<pre>";
    echo "<b>" . $callBy['file'] . " At Line : " . $callBy['line'] . "</b>";
    echo "<br/>";
    print_r($array);    
    echo "</pre>";
}

function throw_exception($msg)
{
    throw new Exception($msg); 
}

function curl_get_request($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

function curl_post_request($url, $params, $headers = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}
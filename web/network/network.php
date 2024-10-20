<?php

function api_post($path, $data)
{
    $url = "http://127.0.0.1:8080" . $path;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    header('Access-Control-Allow-Origin: *');
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    return $response;
}
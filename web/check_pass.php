<?php
$content = trim(file_get_contents("php://input"));
echo $content;

if (isset($content)) {
    $content = json_decode($content, true);
    $name = $content["name"];
    $surname = $content["surname"];
    $email = $content["email"];
    $password = $content["password"];
    $response = api_post("/user", '{ "name":' . $name . ',surname":' . $surname . 'email":' . $email . '",password":' . $password . '}');

    return "adsf";
}


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
    $response = json_decode($response, false);
    $response = json_decode($response, false);
    return $response;
}

<?php
include("./network/network.php");
$content = trim(file_get_contents("php://input"));
echo $content;


if (isset($content)) {
    $content = json_decode($content, true);
    $data = new stdClass();
    $data->name = $content["name"];
    $data->surname = $content["surname"];
    $data->email = $content["email"];
    $data->password = $content["password"];
    $json = json_encode($data);
    $response = api_post("/register", $json);

    return $response;
}



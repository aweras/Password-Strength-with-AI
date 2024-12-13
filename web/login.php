<?php 
session_start();
if (isset($_SESSION['user_data'])) {
    
    exit(header("Location: index.php"));
}


?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<?php
include "./network/network.php";
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $data = new stdClass();
    $data->email = $_POST["email"];
    $data->password = $_POST["password"];
    $json_data = json_encode($data);
    $response = api_post("/login", $json_data);
    print_r ($response);
    if ($response->statusCode == 200) {
        $_SESSION['user_data'] = $response->user;
        @header("Location: ./index.php");
        @exit;
    }
}
?>

<body>
    <form action="" method="POST">
        <input type="mail" placeholder="E-mail" id="email" name="email">
        <input type="password" placeholder="Password" id="password" name="password">
        <input type="submit" value="login" >
        <a href="./register.php">Register</a>
    </form>
</body>

</html>
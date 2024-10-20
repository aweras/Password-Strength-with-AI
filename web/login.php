<?php session_start();
if (isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit();
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

    if ($response->message == "Login successful") {
        $_SESSION['user_data'] = $response->user;
        @header("Location: ./index.php");

        @exit();
    }
}
?>

<body>

    <form action="" method="POST">
        <input type="mail" placeholder="E-mail" id="email" name="email">
        <input type="password" placeholder="Şifre" id="password" name="password">
        <input type="submit" value="login">

    </form>

</body>

</html>
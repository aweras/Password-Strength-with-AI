<?php 
         
         session_start();
         if (isset($_SESSION['user_data'])) {
         header("Location: index.php");
         exit();
 }
 ?>
<html>

<head>
    <link rel="stylesheet" href="style.css">
   
</head>

<body>
    <script type="text/javascript" src="./utils.js"></script>
    <form action="" method="POST">
        <input type="text" placeholder="Name" id="name" name="name">
        <input type="text" placeholder="Surname" id="surname" name="surname">
        <input type="mail" placeholder="E-mail" id="email" name="email">
        <input type="password" placeholder="Password" id="password" name="password" onblur="checkPasswordStrength()">
        <div id="password_strength_bar">
            <div id="strength_bar"> </div>
        </div>
        <input type="password" placeholder="Confirm Password" id="password_check" name="password_check">
        <input type="submit" value="register">
    </form>
    <?php

    include("./network/network.php");
    if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password_check"])) {
        if ($_POST["password"]== $_POST["password_check"]) {
            $response = api_post("/register", '{"name":"' . $_POST['name'].'","surname":"'.$_POST['surname'] . '","password":"' . $_POST['password'].'","email":"' . $_POST['email'] . '"}');
            if($response->statusCode == 201){
            echo "başarılı";
            $data = new stdClass();
            $response = (array) $response; 
            $data->name = $response["name"];
            $data->surname = $response["surname"];
            $data->email = $response["email"];
            $_SESSION["user_data"] = $data;
            header("Location: ./index.php" );
            exit();
            }
        }else {
            echo "<script>alert('Please enter same password.')</script>";
        }
    }
    ?>

   
</body>

</html>
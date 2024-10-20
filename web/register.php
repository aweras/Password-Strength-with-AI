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

<body>
    <form action="" method="POST">
        <input type="text" placeholder="Ad" id="name" name="name">
        <input type="text" placeholder="Soyad" id="surname" name="surname">
        <input type="mail" placeholder="E-mail" id="email" name="email">
        <input type="password" placeholder="Şifre" id="password" name="password" oninput="checkPasswordStrength()">
        <div id="password_strength_bar">
            <div id="strength_bar"> </div>
        </div>
        <input type="password" placeholder="Şifre Tekrar" id="password_check" name="password_check">
        <input type="submit" value="register">

    </form>

    <?php

    include("./network/network.php");
    if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password_check"])) {

        $data = new stdClass();
        $data->name = $_POST["name"];
        $data->surname = $_POST["surname"];
        $data->email = $_POST["email"];
        $data->password = $_POST["password"];
        $password_confirmation = $_POST["password_check"];
        $json_data = json_encode($data);
        if ($data->password == $password_confirmation) {
            $response = api_post("/register", $json_data);
            echo $response;
        }
    }
    ?>
    <script>
        async function checkPasswordStrength() {
            const cname = document.getElementById("name").value;
            const csurname = document.getElementById("surname").value;
            const cemail = document.getElementById("email").value;
            const cpassword = document.getElementById("password").value;
            const strength_text = document.getElementById("password-strength-text");

            await fetch('check_pass.php', {
                method: 'POST',
                mode: "no-cors",
                headers: {
                    'Content-Type': 'application/json; charset=UTF-8'
                },
                body: JSON.stringify({ name: cname, surname: csurname, email: cemail, password: cpassword })
            })
                .then(r => r.text().then(console.log));
        }
    </script>
</body>

</html>
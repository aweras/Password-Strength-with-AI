<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="" method="POST">
        <input type="text" placeholder="Ad" id="name">
        <input type="text" placeholder="Soyad" id="surname">
        <input type="mail" placeholder="E-mail" id="email">
        <input type="password" placeholder="Şifre" id="password" oninput="checkPasswordStrength()">
        <div id="password_strength_bar">
            <div id="strength_bar"> </div>
        </div>
        <div id="password-strength-text"></div>
        <input type="password" placeholder="Şifre" id="password_check">
        <input type="submit" value="register">

    </form>
    <script>
        function checkPasswordStrength() {
            const password = document.getElementById("password").value;
            const strength_text = document.getElementById("password-strength-text");

            strength_text.textContent = password;
        }
    </script>
</body>

</html>
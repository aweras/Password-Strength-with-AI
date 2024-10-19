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
                body: JSON.stringify({ name: cname, surname: csurname, email: cemail, password: password })
            })
                .then(r => r.text().then(console.log));
        }
    </script>
</body>

</html>
<?php session_start();
if (!isset($_SESSION['user_data'])) {
    @header("Location: ./login.php");
    @exit();
} ?>
<html>



<head></head>

<body>
    <a href="./logout.php">Logout</a>
    <h1>Main Page</h1>
    <h2> Hello, <?= $_SESSION['user_data']->name ?> <?= $_SESSION['user_data']->surname ?></h2>
</body>

</html>
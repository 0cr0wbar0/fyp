<?php
require __DIR__ . '/init_database.php';
session_start();

global $database;
if (!isset($router)) {
  $database = init_database();
}

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);
$conf = htmlspecialchars($_POST["conf_password"]);

$username = mysqli_real_escape_string($database, $username);
$password = mysqli_real_escape_string($database, $password);
$conf = mysqli_real_escape_string($database, $conf);

?>

<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course</title>
    <script type="javascript" src="./static/styletoggle.js"></script>
    <script>
        function styleToggle(str) {
            document.cookie = "theme=" + str + "; SameSite=lax; path=/;";
            let sheets= document.getElementsByTagName('link');
            sheets[0].href = str;
        }

        function init_style() {
            const style = document.cookie.split("; ").find((row) => row.startsWith("theme="))?.split("=")[1] ?? "/static/stylesheet.css";
            switch (style) {
                case "/static/stylesheet.css":
                    styleToggle('/static/stylesheet.css');
                    break;
                case "/static/lush.css":
                    styleToggle('/static/lush.css');
                    break;
                case "/static/mono.css":
                    styleToggle('/static/mono.css');
                    break;
            }
        }

        window.onload = function () {
            init_style();
        };
    </script>
    <link rel="stylesheet" href="./static/stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut_icon" type="image/png" href="./static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="./static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="./static/shocked_hugh.ico">
</head>

<body id="background">

<div class="box">

    <div class="titles">
        <h1 class="header">
            Register
        </h1>
    </div>

<div class="info">

<?php

$error = false;

if (trim($username) == "" or trim($password) == "" or trim($conf) == "") {
    $error = true;
    echo "<p class='inline-err'>Fields cannot be left blank!<br></p>";
}

$qry = $database->query("select username from Users where username = '$username'");

if ($qry->num_rows > 0) {
    $error = true;
    echo "<p class='inline-err'>Username already in use!<br></p>";
}

if (strlen($password) < 9) {
    $error = true;
    echo "<p class='inline-err'>Password should be longer than 8 characters!<br></p>";
}
if (preg_match("#[0-9]+#", $password) === 0) {
    $error = true;
    echo "<p class='inline-err'>Password must include 1 or more numbers!<br></p>";
}
if (preg_match("#[A-Z]+#", $password) === 0) {
    $error = true;
    echo "<p class='inline-err'>Password must include 1 or more capital letters!<br></p>";
}

if ($password != $conf) {
    $error = true;
    echo "<p class='inline-err'>Password and confirmation do not match!<br></p>";
}

if (!$error) {
    $p_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $database->prepare("insert into Users (username, password) values (?, ?)");
    $stmt->bind_param("ss", $username, $p_hash);
    if ($stmt->execute()) {
        echo "<p class='inlinelink'>Successfully registered!</p><br><div class='nav'><a href='./login.php'>Go to login</a></div>";
    } else {
        echo "<p class='inline-err'>Error registering your account!<br></p>";
        echo "<div class='nav'><a href='/register.php'>Try again</a></div>";
    }
} else {
    echo "<div class='nav'><a href='/register.php'>Try again</a></div>";
}



?>

</div>

</div>

</body>

</html>
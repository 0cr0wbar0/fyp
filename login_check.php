<?php
session_start();

$servername = "127.0.0.1";
$root_user = "root";
$db_name = "rust_course";
$root_password = "pirhyw-9jyvxa-pavzUj";

$database = new mysqli($servername, $root_user, $root_password, $db_name);

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

$username = mysqli_real_escape_string($database, $username);
$password = mysqli_real_escape_string($database, $password);

?>

<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course</title>
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
            Login
        </h1>
    </div>

<div class="info">

<?php

$error = false;

if (trim($username) == "" or trim($password) == "") {
    $error = true;
    echo "<p class='inline-err'>Fields cannot be left blank!<br></p>";
}

$times = $database->query("select last_login, num_of_attempts from Users where username = '$username'");
while ($row = $times->fetch_assoc()) {
    if ((time() - $row["last_login"] < 300) and ($row["num_of_attempts"] >= 5)) {
        $error = true;
        echo "<p class='inline-err'>Too many login attempts! Try again later.<br></p>";
    } else {
        $current_time = time();
        $database->query("update Users set last_login = '$current_time', num_of_attempts = num_of_attempts + 1 where username = '$username'");
    }
}

if (!$error) {

    $query = $database->query("select * from Users");
    $user_found = false;

    while ($row = $query->fetch_assoc()) {
        if ($row["username"] == $username) {
            $user_found = true;
            if (password_verify($password, $row["password"])) {
                $database->query("update Users set num_of_attempts = 0 where username = '$username'");
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["username"] = $row["username"];
                echo "<p class='inlinelink'>" . $row["username"] . " successfully logged in, welcome!</p><br><div class='nav'><a href='https://fyp.cr0wbar.dev'>Continue to website</a></div>";
            } else {
                echo "<p class='inline-err'>Error logging in!<br></p>";
            }
        }
    }

    if (!$user_found) {
        echo "<p class='inline-err'>user not found<br></p>";
        echo "<a href='/login.html'>Try again</a>";
    }
} else {
    echo "<a href='/login.html'>Try again</a>";
}

$database->close();

?>

</div>

</div>

</body>

</html>

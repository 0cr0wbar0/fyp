<?php
require __DIR__ . '/init_database.php';
require __DIR__ . '/init_style.php';
session_start();

global $database;
if (!isset($router)) {
  $database = init_database();
}

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
    </script>
    <link rel="stylesheet" href="<?=init_style()?>">
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

$times = $database->prepare("select last_login, num_of_attempts from Users where username = ?");
$times->bind_param("i", $username);
$times->execute();
$result = $times->get_result();
while ($row = $result->fetch_assoc()) {
    if ((time() - $row["last_login"] < 300) and ($row["num_of_attempts"] >= 5)) {
        $error = true;
        echo "<p class='inline-err'>Too many login attempts! Try again later.<br></p>";
    } else {
        $current_time = time();
        $update = $database->prepare("update Users set last_login = ?, num_of_attempts = num_of_attempts + 1 where username = ?");
        $update->bind_param("is", $current_time, $username);
        $update->execute();
    }
}

if (!$error) {

    $query = $database->query("select * from Users");
    $user_found = false;

    while ($row = $query->fetch_assoc()) {
        if ($row["username"] == $username) {
            $user_found = true;
            if (password_verify($password, $row["password"])) {
                $success = $database->prepare("update Users set num_of_attempts = 0 where username = ?");
                $success->bind_param("s", $username);
                $success->execute();
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["username"] = $row["username"];
                echo "<p class='inlinelink'>" . $row["username"] . " successfully logged in, welcome!</p><br><div class='nav'><a href='./home.php'>Continue to website</a></div>";
            } else {
                echo "<p class='inline-err'>Error logging in!<br></p>";
            }
        }
    }

    if (!$user_found) {
        echo "<p class='inline-err'>User not found!<br></p>";
        echo "<div class='nav'><a href='/login.php'>Try again</a></div>";
    }
} else {
    echo "<div class='nav'><a href='/login.php'>Try again</a></div>";
}



?>

</div>

</div>

</body>

</html>

<?php
session_start();

$servername = "127.0.0.1";
$root_user = "root";
$db_name = "rust_course";
$root_password = "pirhyw-9jyvxa-pavzUj";

$database = new mysqli($servername, $root_user, $root_password, $db_name);
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
    <link rel="stylesheet" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut_icon" type="image/png" href="./static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="./static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="./static/shocked_hugh.ico">
</head>

<body id="background">

<div class="box">

<div class="info">
<?php

if (!isset($_SESSION["user_id"])) {?>

    <h1 class="inline-err">You're not logged in!</h1>
    <div class="nav">
        <a href="https://fyp,cr0wbar.dev">Back</a>
    </div>

<?php } else {

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

if (isset($_POST["usrnm_old"]) and isset($_POST["usrnm_new"])) {
    $old = htmlspecialchars($_POST["usrnm_old"]);
    $new = htmlspecialchars($_POST["usrnm_new"]);

    $old = mysqli_real_escape_string($database, $old);
    $new = mysqli_real_escape_string($database, $new);

    $error = false;

    $current_check = $database->query("select username from Users where user_id = '$user_id'");

    if ($current_check->fetch_assoc()["username"] != $old) {
        $error = true;
        echo "<p class='inline-err'>Inputted current username does not match!<br></p>";
    }

    $new_check = $database->query("select username from Users where username = '$new'");

    if ($new_check->num_rows > 0) {
        $error = true;
        echo "<p class='inline-err'>Requested username already in use!<br></p>";
    }

    if (!$error) {
        if ($database->query("update Users set username = '$new' where user_id = '$user_id'")) {
            $_SESSION["username"] = $new;
            echo "<p class='inlinelink'>Successfully changed username!</p><br><div class='nav'><a href='https://fyp.cr0wbar.dev/profile'>Back</a></div>";
        } else {
            echo "<p class='inline-err'>Error changing your username!<br></p><br><div class='nav'><a href='https://fyp.cr0wbar.dev/profile'>Back</a></div>";
        }
    } else {
        echo "<div class='nav'><a href='https://fyp.cr0wbar.dev/profile'>Try again</a></div>";
    }

} else if (isset($_POST["pass_old"]) and isset($_POST["pass_new"]) and isset($_POST["pass_conf"])) {

    $old = htmlspecialchars($_POST["pass_old"]);
    $new = htmlspecialchars($_POST["pass_new"]);
    $conf = htmlspecialchars($_POST["pass_conf"]);

    $old = mysqli_real_escape_string($database, $old);
    $new = mysqli_real_escape_string($database, $new);
    $conf = mysqli_real_escape_string($database, $conf);

    $error = false;

    $current_check = $database->query("select password from Users where user_id = '$user_id'");

    if (!password_verify($old, $current_check->fetch_assoc()["password"])) {
        $error = true;
        echo "<p class='inline-err'>Error with old password!<br></p>";
    }

    if (strlen($new) < 9) {
        $error = true;
        echo "<p class='inline-err'>Password should be longer than 8 characters!<br></p>";
    }
    if (preg_match("#[0-9]+#", $new) === 0) {
        $error = true;
        echo "<p class='inline-err'>Password must include 1 or more numbers!<br></p>";
    }
    if (preg_match("#[A-Z]+#", $new) === 0) {
        $error = true;
        echo "<p class='inline-err'>Password must include 1 or more capital letters!<br></p>";
    }

    if ($new != $conf) {
        $error = true;
        echo "<p class='inline-err'>Password and confirmation do not match!<br></p>";
    }

    if (!$error) {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        if ($database->query("update Users set password = '$hash' where user_id = '$user_id'")) {
            unset($_SESSION["user_id"]);
            unset($_SESSION["username"]);
            echo "<p class='inlinelink'>Successfully changed password!</p><br><div class='nav'><a href='https://fyp.cr0wbar.dev/login'>Log in</a></div>";
        } else {
            echo "<p class='inline-err'>Error changing your password!<br></p><br><div class='nav'><a href='https://fyp.cr0wbar.dev/profile'>Back</a></div>";
        }
    } else {
        echo "<div class='nav'><a href='https://fyp.cr0wbar.dev/profile'>Try again</a></div>";
    }

 } else if (isset($_POST["del_pass"]) and isset($_POST["del_conf"])) {

    $pass = htmlspecialchars($_POST["del_pass"]);
    $conf = htmlspecialchars($_POST["del_conf"]);

    $pass = mysqli_real_escape_string($database, $pass);
    $conf = mysqli_real_escape_string($database, $conf);

    $error = false;

    $current_check = $database->query("select password from Users where user_id = '$user_id'");

    if (!password_verify($pass, $current_check->fetch_assoc()["password"])) {
        $error = true;
        echo "<p class='inline-err'>Error with old password!<br></p>";
    }

    if ($pass != $conf) {
        $error = true;
        echo "<p class='inline-err'>Password and confirmation do not match!<br></p>";
    }

    if (!$error) {
        if ($database->query("delete from Users where user_id = '$user_id'")) {
            unset($_SESSION["user_id"]);
            unset($_SESSION["username"]);
            echo "<p class='inlinelink'>Successfully deleted account! See you later!</p><br><div class='nav'><a href='https://fyp.cr0wbar.dev'>Home page</a></div>";
        } else {
            echo "<p class='inline-err'>Error deleting your account!<br></p><br><div class='nav'><a href='https://fyp.cr0wbar.dev/profile'>Back</a></div>";
        }
    } else {
        echo "<div class='nav'><a href='https://fyp.cr0wbar.dev/profile'>Try again</a></div>";
    }

} else { ?>

    <h1 class="inline-err">Unknown error!</h1>
    <div class="nav">
        <a href="https://fyp.cr0wbar.dev/profile">Back</a>
    </div>

<?php }

}

$database->close();
?>

</div>

</div>

</body>

</html>


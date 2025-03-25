<?php
session_start();

require __DIR__ . '/init_database.php';
require __DIR__ . '/init_style.php';

global $database;
if (!isset($router)) {
  $database = init_database();
}
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
    <link rel="stylesheet" href=<?=init_style()?>>
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
        <a href="home.php">Back</a>
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

    $new_check = $database->prepare("select username from Users where username = ?");
    $new_check->bind_param("s", $new);
    $new_check->execute();

    if ($new_check->get_result()->num_rows > 0) {
        $error = true;
        echo "<p class='inline-err'>Requested username already in use!<br></p>";
    }

    if (!$error) {
        $update = $database->prepare("update Users set username = ? where user_id = ?");
        $update->bind_param("si", $new, $user_id);
        if ($update->execute()) {
            $_SESSION["username"] = $new;
            echo "<p class='inlinelink'>Successfully changed username!</p><br><div class='nav'><a href='profile.php'>Back</a></div>";
        } else {
            echo "<p class='inline-err'>Error changing your username!<br></p><br><div class='nav'><a href='profile.php'>Back</a></div>";
        }
    } else {
        echo "<div class='nav'><a href='profile.php'>Try again</a></div>";
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
        $update_pass = $database->prepare("update Users set password = ? where user_id = ?");
        $update_pass->bind_param("si", $hash, $user_id);
        if ($update_pass->execute()) {
            session_destroy();
            echo "<p class='inlinelink'>Successfully changed password!</p><br><div class='nav'><a href='login.php'>Log in</a></div>";
        } else {
            echo "<p class='inline-err'>Error changing your password!<br></p><br><div class='nav'><a href='profile.php'>Back</a></div>";
        }
    } else {
        echo "<div class='nav'><a href='profile.php'>Try again</a></div>";
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
            session_destroy();
            echo "<p class='inlinelink'>Successfully deleted account! See you later!</p><br><div class='nav'><a href='./home.php'>Home page</a></div>";
        } else {
            echo "<p class='inline-err'>Error deleting your account!<br></p><br><div class='nav'><a href='profile.php'>Back</a></div>";
        }
    } else {
        echo "<div class='nav'><a href='profile.php'>Try again</a></div>";
    }

} else { ?>

    <h1 class="inline-err">Unknown error!</h1>
    <div class="nav">
        <a href="./profile.php">Back</a>
    </div>

<?php }

}


?>

</div>

</div>

</body>

<audio autoplay id="mouseclick">
    <source src="./static/mouse-click.mp3" type="audio/mpeg">
    <source src="./static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>


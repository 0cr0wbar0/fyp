<?php
session_start();
require __DIR__."/init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course</title>
    <script src="./static/styletoggle.js"></script>
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
        if (!isset($_SESSION["user_id"]) and !isset($_SESSION["username"])) {
            echo "<p class='inline-err'>You're already logged out!<br></p>";
        } else {
            session_destroy();
            echo "<p class='inlinelink'>Successfully logged out, see you later!<br></p>";
        }
    ?>
    <div class='nav'><a href='home.php'>Go back to home</a></div>
</div>

</div>

</body>

<audio autoplay id="mouseclick">
    <source src="./static/mouse-click.mp3" type="audio/mpeg">
    <source src="./static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
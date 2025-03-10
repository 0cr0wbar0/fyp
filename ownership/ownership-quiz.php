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
    <title>cr0wbar's Rust course - Ownership: quiz</title>
    <script src="../static/styletoggle.js"></script>
    <link rel="stylesheet" href="">
    <script>
        window.onload = function () {
        init_style();
    };
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut_icon" type="image/png" href="../static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="../static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="../static/shocked_hugh.ico">
</head>

<body id="background">

<div class="navbar">
    <a href="https://fyp.cr0wbar.dev">Homepage</a>
<div class="dropdown">
        <button class="dropbtn">Change Theme &darr;</button>
        <div class="dropdown-content">
            <button onclick="styleToggle('/static/stylesheet.css')">Rusty</button>
            <button onclick="styleToggle('/static/lush.css')">Lush</button>
            <button onclick="styleToggle('/static/mono.css')">Monochrome</button>
        </div>
    </div>
    <a href="https://fyp.cr0wbar.dev/login">Login</a>
</div>

<div class="box">

    <div class="titles">
        <h1 class="header">
            Quiz
        </h1>

        <h3 class="subheader">
            Do you know your stack from your heap?
        </h3>
    </div>

    <form method="post">

        <?php

        $qry = $database->query("select question_1, question_2, question_3, question_4, question_5 from Quizzes where quiz_id = 2");

        $row = $qry->fetch_assoc();

        foreach ($row as $i) {
            echo htmlspecialchars_decode($i);
        }

        ?>

        <div class="quizsubmit"><button class="textsubmit" type="submit" name="submit">Submit answers</button></div>

    </form>

</div>

</body>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/ownership/4">&laquo; Slices</a>
</div>

</html>

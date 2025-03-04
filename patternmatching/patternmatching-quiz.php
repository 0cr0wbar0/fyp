<?php
session_start();

$servername = "127.0.0.1";
$root_user = "root";
$db_name = "rust_course";
$root_password = "pirhyw-9jyvxa-pavzUj";

$database = new mysqli($servername, $root_user, $root_password, $db_name);
?>

<!doctype html>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Pattern matching: quiz</title>
    <link rel="stylesheet" href="../static/stylesheet.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut_icon" type="image/png" href="../static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="../static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="../static/shocked_hugh.ico">
</head>

<body>

<div class="navbar">
    <a href="https://fyp.cr0wbar.dev">Homepage</a>
    <a href="https://fyp.cr0wbar.dev/login">Login</a>
</div>

<div class="box">

    <div class="titles">
        <h1 class="header">
            Quiz
        </h1>

        <h3 class="subheader">
            Have you met your match?
        </h3>
    </div>

    <form method="post">

        <?php

        $qry = $database->query("select question_1, question_2, question_3, question_4, question_5 from Quizzes where quiz_id = 3");

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
    <a href="https://fyp.cr0wbar.dev/patternmatching/2">&laquo; If-let statements</a>
</div>

</html>

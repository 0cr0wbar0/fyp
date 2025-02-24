<?php
session_start();

$servername = "127.0.0.1";
$root_user = "root";
$db_name = "rust_course";
$root_password = "";

$database = new mysqli($servername, $root_user, $root_password, $db_name);
?>

<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Ownership: quiz</title>
    <link rel="stylesheet" href="../static/stylesheet.css">
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
            Do you know your stack from your heap?
        </h3>
    </div>

    <form method="post">

        <?php

        $qry = $database->query("select * from Quizzes where quiz_id = 2");

        while ($row = $qry->fetch_assoc()) {
            echo htmlspecialchars_decode($row["question_1"]);
            echo htmlspecialchars_decode($row["question_2"]);
            echo htmlspecialchars_decode($row["question_3"]);
            echo htmlspecialchars_decode($row["question_4"]);
            echo htmlspecialchars_decode($row["question_5"]);
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

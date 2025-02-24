<?php
session_start();

$servername = "127.0.0.1";
$root_user = "root";
$db_name = "rust_course";
$root_password = "pirhyw-9jyvxa-pavzUj";

$database = new mysqli($servername, $root_user, $root_password, $db_name);
?>

<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Fundamentals: quiz</title>
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
        Time to test your fundamental knowledge!
    </h3>
</div>

<form method="post">

<?php

$qry = $database->query("select question_1, question_2, question_3, question_4, question_5 from Quizzes where quiz_id = 1");

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
    <a href="https://fyp.cr0wbar.dev/fundamentals/7">&laquo; Comments and Documentation</a>
</div>

</html>

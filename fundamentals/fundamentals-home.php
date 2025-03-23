<?php
session_start();
require __DIR__ . "/../init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Fundamentals</title>
    <script src="../static/styletoggle.js"></script>
    <link rel="stylesheet" href=<?=init_style()?>>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut_icon" type="image/png" href="../static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="../static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="../static/shocked_hugh.ico">
</head>

<body id="background">

<div class="navbar">
    <a href="../home.php">Homepage</a>
<div class="dropdown">
        <button class="dropbtn">Change Theme &darr;</button>
        <div class="dropdown-content">
            <button onclick="styleToggle('/static/stylesheet.css')">Rusty</button>
            <button onclick="styleToggle('/static/lush.css')">Lush</button>
            <button onclick="styleToggle('/static/mono.css')">Monochrome</button>
        </div>
    </div>
    <?php if (!isset($_SESSION["user_id"])) {?>
        <a href="../login.php">Login</a>
    <?php
    } else {
        $username = $_SESSION["username"];?>
        <div class="dropdown">
            <button class="dropbtn">Welcome, <?=$username?></button>
            <div class="dropdown-content">
                <a href="../profile.php">User profile</a>
                <a href="../logout.php">Log out</a>
            </div>
        </div>
    <?php }
    ?>
</div>

<div class="box">

<div class="titles">
    <h1 class="header">
        Fundamentals
    </h1>

    <h3 class="subheader">
        
    </h3>
</div>

<div class="info">
    <p> 
        This series of pages will cover the absolute basics of the Rust language, including:
        <ul class="list">
            <li>Variables</li>
            <li>Mutability</li>
            <li>Rust's data types</li>
            <li>Structs & Enums</li>
            <li>Functions & control flow</li>
            <li>Comments & documentation</li> 
        </ul>    
    </p>
</div>

</div>

<div class="nav">
    <a href="/home.php">&laquo; Back to Homepage</a>
    <a href="/fundamentals/fundamentals-1.php">Variables &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Beyond the basics</title>
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
        Beyond the Basics
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="paddedinfo">
    <p>
        This series of pages will cover features of Rust that are a bit more advanced, but
        are still helpful to understand, including:
        <ul class="list">
           <li>Generic types</li>
           <li>Traits</li>
           <li>Lifetimes</li>
        </ul>
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev">&laquo; Back to Homepage</a>
    <a href="https://fyp.cr0wbar.dev/beyond/1">Generic types &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
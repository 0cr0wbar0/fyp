<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Collections</title>
    <script src="../static/styletoggle.js"></script>
    <link rel="stylesheet" href="">
    <script>init_style();</script>
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
        Collections
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        These pages cover the main collection types in Rust, including:
        <ul class="list">
            <li>Vectors</li>
            <li>Hash maps</li>
        </ul>
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev">&laquo; Back to Homepage</a>
    <a href="https://fyp.cr0wbar.dev/collections/1">Vectors &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
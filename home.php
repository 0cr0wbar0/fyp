<?php
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course</title>
    <script src="./static/styletoggle.js"></script>
    <link rel="stylesheet" href="">
    <script>init_style();</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut_icon" type="image/png" href="./static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="./static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="./static/shocked_hugh.ico">
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
        Welcome to cr0wbar's interactive Rust course!
    </h1>

    <h3 class="subheader">
        This project aims to teach the fundamentals of the Rust programming language with minimal text and maximal interactivity and visualisation!
    </h3>
</div>

<div class="animbox">
    <img id="replayable" src="./static/hello_world_(black).gif">
</div>


<div class="buttonlist">
    <a href="https://fyp.cr0wbar.dev/fundamentals">1. Fundamentals</a>
    <a href="https://fyp.cr0wbar.dev/ownership">2. Ownership</a>
    <a href="https://fyp.cr0wbar.dev/patternmatching">3. Pattern Matching</a>
    <a href="https://fyp.cr0wbar.dev/collections">4. Collections</a>
    <a href="https://fyp.cr0wbar.dev/errorhandling">5. Error Handling</a>
    <a href="https://fyp.cr0wbar.dev/beyond">6. Beyond the Basics</a>
</div>

<label for="ImageBox">
    My socials:
</label>
<div id="ImageBox">
    <a href="https://github.com/0cr0wbar0"><img src="./static/github.png" width="20rem" height="20rem"></a>
</div>

</div>
    
</body>

<audio autoplay id="mouseclick">
    <source src="./static/mouse-click.mp3" type="audio/mpeg">
    <source src="./static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php
    require __DIR__ . '/init_style.php';
    session_start();
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

<div class="navbar">
    <a href="./home.php">Homepage</a>
    <div class="dropdown">
        <button class="dropbtn">Change Theme &darr;</button>
        <div class="dropdown-content">
            <button onclick="styleToggle('/static/stylesheet.css')">Rusty</button>
            <button onclick="styleToggle('/static/lush.css')">Lush</button>
            <button onclick="styleToggle('/static/mono.css')">Monochrome</button>
        </div>
    </div>
    <?php if (!isset($_SESSION["user_id"])) {?>
        <a href="login.php">Login</a>
    <?php
    } else {
        $username = $_SESSION["username"];?>
        <div class="dropdown">
            <button class="dropbtn">Welcome, <?=$username?></button>
            <div class="dropdown-content">
                <a href="./profile.php">User profile</a>
                <a href="./logout.php">Log out</a>
            </div>
        </div>
    <?php }
    ?>
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
    <a href="fundamentals/fundamentals-home.php">1. Fundamentals</a>
    <a href="ownership/ownership-home.php">2. Ownership</a>
    <a href="patternmatching/patternmatching-home.php">3. Pattern Matching</a>
    <a href="collections/collections-home.php">4. Collections</a>
    <a href="errorhandling/errorhandling-home.php">5. Error Handling</a>
    <a href="beyond/beyond-home.php">6. Beyond the Basics</a>
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
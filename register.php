<?php
session_start();
require __DIR__ . "/init_style.php";

if (!isset($_SESSION["user_id"])):
?>
<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
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
    <a href="./login.php">Login</a>
</div>

<div class="box">

    <div class="titles">
        <h1 class="header">
            Register
        </h1>
    </div>

    <p class="info">Already have an account? <a class="inlinelink" href="./login.php">Login</a></p>

</div>

<form method="POST" class="inputlist" action="register-check.php">
    <label for="text">Username</label>
    <input type="text" id="text" name="username">
    <label for="text">Password</label>
    <input type="password" id="text" name="password">
    <label for="text">Confirm Password</label>
    <input type="password" id="text" name="conf_password">
    <button class="textsubmit" type="submit" name="submit">Register</button>
</form>

</body>

<audio autoplay id="mouseclick">
    <source src="./static/mouse-click.mp3" type="audio/mpeg">
    <source src="./static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php else:
$username = $_SESSION["username"]; ?>
<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
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
    <div class="dropdown">
        <button class="dropbtn">Welcome, <?=$username?></button>
        <div class="dropdown-content">
            <a href="./profile.php">User profile</a>
            <a href="./logout.php">Log out</a>
        </div>
    </div>
</div>

<div class="box">

    <div class="titles">
        <h1 class="header">
            Register
        </h1>
    </div>

    <div class="info">
        <h2 class="inline-err">You're already logged in with an account!</h2>
        <div class="nav"><a href="./home.php">Back to Homepage</a><a href="logout.php">Log out</a></div>
    </div>

</div>

</body>

<audio autoplay id="mouseclick">
    <source src="./static/mouse-click.mp3" type="audio/mpeg">
    <source src="./static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php endif;
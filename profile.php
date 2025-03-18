<?php
session_start();

if (!isset($_SESSION["user_id"])):?>

<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course</title>
    <script src="./static/styletoggle.js"></script>
    <script>
        window.onload = function () {
            init_style();
        };
    </script>
    <link rel="stylesheet" href="">
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
        Profile details
    </h1>
</div>

<div class="info">
    <h1 class="inline-err">You're not logged in!</h1>
    <div class="nav">
        <a href="https://fyp,cr0wbar.dev">Back</a>
    </div>
</div>

</div>

</body>

</html>

<?php else:
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

$servername = "127.0.0.1";
$root_user = "root";
$db_name = "rust_course";
$root_password = "pirhyw-9jyvxa-pavzUj";

$database = new mysqli($servername, $root_user, $root_password, $db_name);

$attempt_list = $database->query("select Attempts.user_id,
   Quizzes.quiz_id,
   sum(Attempts.answer_1 + Attempts.answer_2 + Attempts.answer_3 + Attempts.answer_4 + Attempts.answer_5) score
    from Attempts join Users join Quizzes
    on Attempts.user_id = Users.user_id and Attempts.quiz_id = Quizzes.quiz_id
    where Attempts.user_id = '$user_id'
    group by Attempts.user_id, Attempts.attempt_id, Quizzes.quiz_id");

?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course</title>
    <script src="./static/styletoggle.js"></script>
    <script>
        window.onload = function () {
            init_style();
        };
    </script>
    <link rel="stylesheet" href="">
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
        <div class="dropdown">
            <button class="dropbtn">Welcome, <?=$username?></button>
            <div class="dropdown-content">
                <a href="https://fyp.cr0wbar.dev/profile">User profile</a>
                <a href="/logout.php">Log out</a>
            </div>
        </div>
</div>

<div class="box">

<div class="titles">
    <h1 class="header">
        Profile details
    </h1>

    <h2 class="subheader">
        View all your quiz scores, or make changes to your account.
    </h2>
</div>

<?php
    if ($attempt_list->num_rows == 0) {
?>
        <div class="info">
        <h2>Quiz Results</h2>
        <p class="inlinelink">It seems you haven't <br>submitted any quizzes yet!</p>
        </div>
<?php } else {
?>
<div class="info">
<h2>Quiz Results</h2>
<table>
<thead>
<tr>
<th scope='col'>Attempt No</th>
<th scope='col'>Topic</th>
<th scope='col'>Score</th>
</tr>
</thead>
<tbody>
<?php

$iter = 1;

while ($row = $attempt_list->fetch_assoc()) {
    $topic = match ($row["quiz_id"]) {
        '1' => "Fundamentals",
        '2' => "Ownership",
        '3' => "Pattern matching",
        '4' => "Collections",
        '5' => "Error handling",
        '6' => "Beyond the basics"
    }; ?>
    <tr>
        <th scope="row">
            <?=$iter?>
        </th>
        <th scope="row">
            <?=$topic?>
        </th>
        <th scope="row">
            <?=$row["score"]?>/5
        </th>
    </tr>
<?php $iter += 1;
    }
?>
</tbody>
</table>

</div>
<?php } ?>

<div class="info">
<h2>Change Username</h2>
<form method="POST" class="inputlist" action="acc_change_handler.php">
    <label for="text">Current username</label>
    <input type="text" id="text" name="usrnm_old">
    <label for="text">New username</label>
    <input type="text" id="text" name="usrnm_new">
    <button class="textsubmit" type="submit" name="submit">Change</button>
</form>
</div>

<div class="info">
<h2>Change Password</h2>
<form method="POST" class="inputlist" action="acc_change_handler.php">
    <label for="text">Current password</label>
    <input type="password" id="text" name="pass_old">
    <label for="text">New password</label>
    <input type="password" id="text" name="pass_new">
    <label for="text">Confirm new password</label>
    <input type="password" id="text" name="pass_conf">
    <button class="textsubmit" type="submit" name="submit">Change</button>
</form>
</div>

<div class="info">
<h2>Delete Account</h2>
<p class="inline-err"><b>This will permanently erase your <br>account and all of your quiz records.</b></p>
<form method="POST" class="inputlist" action="acc_change_handler.php">
    <label for="text">Enter password:</label>
    <input type="password" id="text" name="del_pass">
    <label for="text">Confirm password:</label>
    <input type="password" id="text" name="del_conf">
    <button class="textsubmit" type="submit" name="submit">Delete</button>
</form>
</div>

</div>

</body>

</html>
<?php
$database->close();
endif;
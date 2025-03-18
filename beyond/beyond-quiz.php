<?php
session_start();

$servername = "127.0.0.1";
$root_user = "root";
$db_name = "rust_course";
$root_password = "pirhyw-9jyvxa-pavzUj";

$database = new mysqli($servername, $root_user, $root_password, $db_name);

if (empty($_POST)):
?>

<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Beyond the basics: quiz</title>
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
    <?php if (!isset($_SESSION["user_id"])) {?>
        <a href="https://fyp.cr0wbar.dev/login">Login</a>
    <?php
    } else {
        $username = $_SESSION["username"];?>
        <div class="dropdown">
            <button class="dropbtn">Welcome, <?=$username?></button>
            <div class="dropdown-content">
                <a href="https://fyp.cr0wbar.dev/profile">User profile</a>
                <a href="/logout.php">Log out</a>
            </div>
        </div>
    <?php }
    ?>
</div>

<div class="box">

    <div class="titles">
        <h1 class="header">
            Quiz
        </h1>

        <h3 class="subheader">

        </h3>
    </div>

    <form method="post">

        <?php

        $qry = $database->query("select question_1, question_2, question_3, question_4, question_5 from Quizzes where quiz_id = 6");

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
    <a href="https://fyp.cr0wbar.dev/beyond/3">&laquo; Lifetimes</a>
</div>

</html>
<?php else:

$answer_1 = $_POST["question_1"];
$answer_2 = $_POST["question_2"];
$answer_3 = $_POST["question_3"];
$answer_4 = $_POST["question_4"];
$answer_5 = $_POST["question_5"];

$answers = array($answer_1, $answer_2, $answer_3, $answer_4, $answer_5);

foreach ($answers as $a) {
    if (trim($a) == "") {
        $a = "No input...";
    }
}

$explanations = array(
    "The <em>identity function</em> is a computational or mathematical function that takes an input and immediately returns it. While this version of it works, Rust has an even purer version available in the <b>std::convert</b> library!",
    "",
    "",
    "",
    ""
);

$results = array(0, 0, 0, 0, 0);
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>cr0wbar's Rust course - Ownership: quiz results</title>
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
        <?php if (!isset($_SESSION["user_id"])) {?>
            <a href="https://fyp.cr0wbar.dev/login">Login</a>
            <?php
        } else {
            $username = $_SESSION["username"];?>
            <div class="dropdown">
                <button class="dropbtn">Welcome, <?=$username?></button>
                <div class="dropdown-content">
                    <a href="https://fyp.cr0wbar.dev/profile">User profile</a>
                    <a href="/logout.php">Log out</a>
                </div>
            </div>
        <?php }
        ?>
    </div>

    <div class="box">

        <div class="titles">
            <h1 class="header">
                Results
            </h1>

            <h3 class="subheader">
                <?php if (!isset($_SESSION["user_id"])) { echo "You aren't logged in, so your results will not be saved."; } ?>
            </h3>
        </div>

        <?php

        $answer_qry = $database->query("select answer_1, answer_2, answer_3, answer_4, answer_5 from Quizzes where quiz_id = 6");

        $row = $answer_qry->fetch_assoc();

        $iter = 0;
        $total = 0;
        foreach ($row as $i) {?>
            <div class="info">
                <h3>Question <?=$iter+1?></h3>
                <p class="inlinelink">Correct answer(s): <?=$i?></p>
                <?php if (str_contains(strtolower($i), strtolower($answers[$iter]))): ?>
                    <p class="inlinelink">Your correct answer: <?=$answers[$iter]?></p>
                    <?php
                    $total += 1;
                    $results[$iter] = 1;
                    ?>
                <?php else:?>
                    <p class="inline-err">Your incorrect answer: <?=$answers[$iter]?></p>
                <?php endif;?>
                <p><?=$explanations[$iter]?></p>
            </div>
            <?php $iter += 1;
        }

        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            $quiz_id = 6;
            $save = $database->prepare("insert into Attempts (user_id, quiz_id, answer_1, answer_2, answer_3, answer_4, answer_5) values (?, ?, ?, ?, ?, ?, ?)");
            $save->bind_param("iiiiiii", $user_id, $quiz_id, ...$results);
            if (!$save->execute()) { ?>
                <h2 class="inline-err">There was a problem saving your results! Try the quiz again.</h2>
            <?php }
        }
        ?>

        <h1 class="inlinelink">Total: <?=$total?>/5</h1>

    </div>

    </body>

    </html>

<?php endif;
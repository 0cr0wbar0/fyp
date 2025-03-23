<?php
require __DIR__.'/../init_database.php';
require __DIR__.'/../init_style.php';
session_start();

global $database;
if (!isset($router)) {
  $database = init_database();
}

if (empty($_POST)):
?>

<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Error handling: quiz</title>
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
            Quiz
        </h1>

        <h3 class="subheader">
            Try not to panic!
        </h3>
    </div>

    <form method="post">

        <?php

        $qry = $database->query("select question_1, question_2, question_3, question_4, question_5 from Quizzes where quiz_id = 5");

        $row = $qry->fetch_assoc();

        foreach ($row as $i) {
            echo htmlspecialchars_decode($i);
        }

        ?>

        <div class="quizsubmit"><button class="textsubmit" type="submit" name="submit">Submit answers</button></div>

    </form>

</div>

<div class="nav">
    <a href="./errorhandling-3.php">&laquo; The Result enum</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php else:

$answer_1 = $_POST["question_1"] ?? "No input...";
$answer_2 = $_POST["question_2"] ?? "No input...";
$answer_3 = $_POST["question_3"] ?? "No input...";
$answer_4 = trim($_POST["question_4"]) !== "" ? $_POST["question_4"] : "No input...";
$answer_5 = trim($_POST["question_5"]) !== "" ? $_POST["question_5"] : "No input...";

$answers = array($answer_1, $answer_2, $answer_3, $answer_4, $answer_5);

foreach ($answers as $a) {
    if (trim($a) == "") {
        $a = "No input...";
    }
}

$explanations = array(
    "The <em>panic()</em> macro should only be used for unrecoverable errors, whereas <em>None</em> or <em>Err()</em> values can be mitigated.",
    "<b>This code panics,</b> so there's never any successful execution of this code!",
    "<em>unwrap()</em> always assumes that the Option or Result it is extracting from is <em>Some()</em> or <em>Ok(),</em> respectively.",
    "Any (stable) floating-point type would work here!",
    "The <em>try</em> operator caught the error value contained in variable <em>res</em> and returned it early!"
);

$multiple_correct_answers = array(false, false, false, true, false);

$results = array(0, 0, 0, 0, 0);
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>cr0wbar's Rust course - Ownership: quiz results</title>
        <script src="../static/styletoggle.js"></script>
        <link rel="stylesheet" href=<?=init_style()?>>
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
                Results
            </h1>

            <h3 class="subheader">
                <?php if (!isset($_SESSION["user_id"])) { echo "You aren't logged in, so your results will not be saved."; } ?>
            </h3>
        </div>

        <?php

        $answer_qry = $database->query("select answer_1, answer_2, answer_3, answer_4, answer_5 from Quizzes where quiz_id = 5");

        $row = $answer_qry->fetch_assoc();

        $iter = 0;
        $total = 0;
        foreach ($row as $i) {
            if (!$multiple_correct_answers[$iter]) { ?>
            <div class="info">
                <h3>Question <?=$iter+1?></h3>
                <p class="inlinelink">Correct answer(s): <?=$i?></p>
                <?php if (strtolower($i) === strtolower($answers[$iter])): ?>
                    <p class="inlinelink">Your correct answer: <?=$answers[$iter]?></p>
                    <?php
                    $total += 1;
                    $results[$iter] = 1;
                    ?>
                <?php else:?>
                    <p class="inline-err">Your incorrect answer: <?=$answers[$iter]?></p>
                <?php endif;
            } else {
                $multi = explode(" ", $i);?>
                <div class="info">
                    <h3>Question <?=$iter+1?></h3>
                    <p class="inlinelink">Correct answer(s): <?=implode(", or ", $multi)?></p>
                    <?php if (in_array(strtolower($answers[$iter]), array_map(fn($str): string => strtolower($str), $multi))): ?>
                    <p class="inlinelink">Your correct answer: <?=$answers[$iter]?></p>
                    <?php
                    $total += 1;
                    $results[$iter] = 1;
                    ?>
                    <?php else:?>
                    <p class="inline-err">Your incorrect answer: <?=$answers[$iter]?></p>
                    <?php endif;
                 } ?><p><?=$explanations[$iter]?></p>
            </div>
            <?php $iter += 1;
        }

        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            $quiz_id = 5;
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

    <audio autoplay id="mouseclick">
        <source src="../static/mouse-click.mp3" type="audio/mpeg">
        <source src="../static/mouse-click.ogg" type="audio/ogg">
    </audio>

    </html>

<?php endif;
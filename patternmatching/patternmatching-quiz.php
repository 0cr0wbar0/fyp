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
    <title>cr0wbar's Rust course - Pattern matching: quiz</title>
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
            Have you met your match?
        </h3>
    </div>

    <form method="post">

        <?php

        $qry = $database->query("select question_1, question_2, question_3, question_4, question_5 from Quizzes where quiz_id = 3");

        $row = $qry->fetch_assoc();

        foreach ($row as $i) {
            echo htmlspecialchars_decode($i);
        }

        ?>

        <div class="quizsubmit"><button class="textsubmit" type="submit" name="submit">Submit answers</button></div>

    </form>

</div>

<div class="nav">
    <a href="./patternmatching-2.php">&laquo; If-let statements</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php else:

    $answer_1 = $_POST["question_1"] ?? "Unanswered";
    $answer_2 = $_POST["question_2"] ?? "Unanswered";
    $answer_3 = trim($_POST["question_3"]) !== "" ? $_POST["question_3"] : "Unanswered";
    $answer_4 = trim($_POST["question_4"]) !== "" ? $_POST["question_4"] : "Unanswered";
    $answer_5 = $_POST["question_5"] ?? "Unanswered";

    $answers = array($answer_1, $answer_2, $answer_3, $answer_4, $answer_5);

    $explanations = array(
        "It's impossible to exhaustively match on every single possible string slice without a wildcard branch.",
        "Conversely to strings, enums will likely always have a limited number of variants, so a wildcard branch will not usually be necessary, unless some variants deliberately should not be matched on.",
        "The if-let statement binds the struct fields <em>fst</em> and <em>snd</em> to temporary bindings, before the code prints these bindings without a space between them.",
        "The constant <em>MIN,</em> implemented for all integers in Rust, represents the smallest possible number that can be represented in the bit size for each integer type.",
        "The match statement may look confusing, but tuples can be used in this way to match multiple variables against different values simultaneously."
    );

    $multiple_correct_answers = array(false, false, true, false, false);

    $results = array(0, 0, 0, 0, 0);
    ?>

<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Ownership: quiz results</title>
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
            Results
        </h1>

        <h3 class="subheader">
            <?php if (!isset($_SESSION["user_id"])) { echo "You aren't logged in, so your results will not be saved."; } ?>
        </h3>
    </div>

    <?php

    $answer_qry = $database->query("select answer_1, answer_2, answer_3, answer_4, answer_5 from Quizzes where quiz_id = 3");

    $row = $answer_qry->fetch_assoc();

    $iter = 0;
    $total = 0;
    foreach ($row as $i) {
    if (!$multiple_correct_answers[$iter]) { ?>
    <div class="info">
        <h3>Question <?=$iter+1?></h3>
        <p class="inlinelink">Correct answer: <?=$i?></p>
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
        $multi = explode("|", $i);?>
        <div class="info">
            <h3>Question <?=$iter+1?></h3>
            <p class="inlinelink">Correct answer: <?=implode(", or ", $multi)?></p>
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
        $quiz_id = 3;
        $save = $database->prepare("insert into Attempts (user_id, quiz_id, answer_1, answer_2, answer_3, answer_4, answer_5) values (?, ?, ?, ?, ?, ?, ?)");
        $save->bind_param("iiiiiii", $user_id, $quiz_id, ...$results);
        if (!$save->execute()) { ?>
            <h2 class="inline-err">There was a problem saving your results! Try the quiz again.</h2>
        <?php }
    }
    ?>

<h1 class="total">Total: <?=$total?>/5</h1>

<div class="nav"><a href="patternmatching-quiz.php">Try again?</a></div>

</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>

<?php endif;
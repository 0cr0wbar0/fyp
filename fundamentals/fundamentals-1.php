<?php
session_start();
require __DIR__."/../rustrunner.php";
require __DIR__."/../init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Fundamentals: variables</title>
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
        Variables
    </h1>

    <h3 class="subheader">
        
    </h3>
</div>

<div class="info">
    <p> 
        Like in almost all other programming languages, variables are single pieces of data that can be stored in memory when a program is running, and may have the potential to change in value during runtime.
    </p>
</div>

<div class="info">
    <p> 
        Variables need to be given a written alias before assignment:
    </p>
    <p class="inlinelink">let variable_name = ...;</p>
</div>

<div class="info">
    <p> 
        As seen above, Rust variables are typically defined using the keyword <em>let</em>, followed by an alphanumeric alias.
    </p>
</div>

<div class="info">
    <p> 
        Rust does not allow for unassigned variables that are not <em>explicitly typed</em>:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let variable_name;<br>
        }</p>
    <p class="inline-err">
        error[E0282]: type annotations needed<br>
         --> src/main.rs:2:9<br>
          |<br>
        2 |     let variable_name;<br>
          |<br>
          |<br>
        help: consider giving `variable_name` an explicit type<br>
          |<br>
        2 |     let variable_name: /* Type */;<br>
          |<br>                      
          <br>
        For more information about this error, try `rustc --explain E0282`.<br>
        error: could not compile `playground` (bin "playground") due to 1 previous error</p>
</div>

<div class="info">
    <p class="inlinelink">
            fn main() {<br>
            &nbsp;let variable_name: char;<br>
            }
    </p>
    <div>
        <?php
            example_exec("fn main() {\n
            \tlet _variable_name: char;\n
            }", "example1");
        ?>
    </div>
    <p>
        The "char" after the colon in the above example is <b>not the value of the variable, but the data type.</b>
    </p>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Try defining a variable of your own with the data type <em>char</em>:</p>
    <?php exercise_exec("fn main() {\r\n\t\n}", 'exercise1'); ?>
</div>

<div class="info">
    <p>
    In Rust, explicit types for variables are specified after the variable name, separated from it by a colon, after which the actual value is specified with an equals sign:
    </p>
    <p class="inlinelink">
            fn main() {<br>
            &nbsp;let variable_name: char = 'b';<br>
            }
    </p>
    <div>
        <?php
            example_exec("fn main() {\n
            \tlet _variable_name: char = 'b';\n
            }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Rust's data types will be explained in more detail later in this chapter.
    </p>
</div>

</div>

<div class="nav">
    <a href="./fundamentals-home.php">&laquo; Fundamentals intro</a>
    <a href="./fundamentals-2.php">Mutability &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
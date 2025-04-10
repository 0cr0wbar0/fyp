<?php
session_start();
require __DIR__."/../rustrunner.php";
require __DIR__."/../init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Fundamentals: mutability</title>
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
        Mutability
    </h1>

    <h3 class="subheader">
        
    </h3>
</div>

<div class="info">
    <p> 
        <b>All Rust variables are immutable by default.</b> The keyword <em>mut</em> must be used after <em>let</em> during assignment to create a mutable variable:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut number = 5;<br>
        &nbsp;println!("{}", number); // prints '5'<br>
        &nbsp;number = 10;<br>
        &nbsp;println!("{}", number); // prints '10'<br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let mut number = 5;
        println!(\"{}\", number);
        number = 10;
        println!(\"{}\", number);
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        The above example also contains some instances of <br> println!(), one of Rust's <b>macros</b>
         (covered in more detail later). println!() prints the value of a given variable, depending on its <b>data type</b>.
    </p>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Fix the problem with the code below (try running it first to see why it won't compile):</p>
    <?php exercise_exec("fn main() {\n\tlet new_num = 20;\n\tnew_num = new_num * 5;\n\tprintln!(\"{}\", new_num)\n}", 'exercise1'); ?>
</div>

<div class="info">
    <p> 
        Using the keyword <em>const</em>, Rust variables can also be defined as constants, forcing complete immutability throughout the entire lifetime of a variable:
    </p>
    <p class="inlinelink">
        const FORTY_TWO: u8 = 20+12+10;<br>
        <br>
        fn main() {<br>
            &nbsp;println!("{}", FORTY_TWO)<br>
        }
    </p>
    <div>
        <?php
        example_exec("const FORTY_TWO: u8 = 20+12+10;
        fn main() {
        println!(\"{}\", FORTY_TWO)
        }", "example2");
        ?>
    </div>
    <p>
        The piece of syntax involving the colon before the equals sign will be explained on the next page.
    </p>
</div>

<div class="info">
    <p>
        Constants can be defined at the very beginning of a Rust script, outside any functions (explained later), making them ideal for defining a value that has to be known and reused across a whole program.
    </p>
</div>

<div class="info">
    <p>
        To completely ensure that constants stay immutable, it is impossible for a constant to have a value that can't be calculated at compile-time.
    </p>
</div>

</div>

<div class="nav">
    <a href="./fundamentals-1.php">&laquo; Variables</a>
    <a href="./fundamentals-3.php">Primitive Data Types &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
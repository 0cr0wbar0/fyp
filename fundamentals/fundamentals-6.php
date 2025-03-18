<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Fundamentals: control flow</title>
    <meta charset="UTF-8">
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
        Control Flow
    </h1>

    <h3 class="subheader">
        conditionals, for-loops, while-loops and...just...loops?
    </h3>
</div>

<div class="info">
    <p> 
        If-statements in Rust do not need parentheses around their conditions, like with Java or C:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let i = 5;<br>
        &nbsp;if i == 0 {<br>
            &nbsp;&nbsp;println!("Zero!"); // Compiles, does not execute<br>
        &nbsp;} else {<br>
        &nbsp;&nbsp;println!("&#x1f614;");<br>
        &nbsp;}<br>
        }<br>
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let i = 5;
        if i == 0 {
            println!(\"Zero!\"); 
        } else {
        println!(\" \u{1f614} \");
        }
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        The result of an if-statement can immediately be assigned to a variable in Rust:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let i = 5;<br>
        &nbsp;let j = if i > 2 {10} else {0};<br>
        &nbsp;println!("{}", i + j);<br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let i = 5;
        let j = if i > 2 {10} else {0};
        println!(\"{}\", i + j);
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        For-loops in Rust are syntactically similar to if-statements, as they also do not need parentheses:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;for i in 0..10 { // For-loop with range<br>
        &nbsp;&nbsp;println!("{}", i*i);<br>
        &nbsp;}<br>
        <br>
        &nbsp;let arr = vec![5; 10]; // Creates vector with 10 elements, each element being the int 5<br>
        &nbsp;for j in arr { // For-loop with iterable structure, like a vector<br>
        &nbsp;&nbsp;println!("{}", j*j);<br>
        &nbsp;}<br>
    }
    </p>
    <p>
        As can be seen in the above example, <em>ranges</em> in Rust are defined with a double full stop between the lower and upper bounds. 
        Variable <em>i</em> acts as an iterator for all integers between 0 and 10 (including 0, but excluding 10 - Rust ranges exclude the last element by default), while variable <em>j</em> iterates for all elements of <em>arr</em>.
    </p>
    <div>
        <?php
            example_exec("fn main() {
        for i in 0..10 { 
        println!(\"{}\", i*i);
        }
        let arr = vec![5; 10]; 
        for j in arr {
        println!(\"{}\", j*j);
        }
    }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Whether a Rust range includes or excludes the ending element can be specified:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut v: Vec&lt;i32&gt; = Vec::new();<br>
        &nbsp;for i in 0..=100 { // Equals sign means that range is fully inclusive<br>
        &nbsp;&nbsp;v.push(i);<br>
        &nbsp;}<br>
        &nbsp;&nbsp;println!("{:?}", v);<br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let mut v: Vec&lt;i32&gt; = Vec::new();
        for i in 0..=100 { 
        v.push(i);
        }
        println!(\"{:?}\", v);
        }", "example4");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Rust also has a third kind of loop, simply defined with the keyword <em>loop</em>, that is designed to run infinitely. The only way for the loop to finish execution is manually, with the <em>break</em> keyword:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut x = 0;<br>
        &nbsp;loop {<br>
        &nbsp;&nbsp;x += 1;<br>
        &nbsp;&nbsp;if x == 20 {<br>
        &nbsp;&nbsp;&nbsp;break;<br>  
        &nbsp;&nbsp;}<br>
        &nbsp;}<br>
        &nbsp;println!("{}", x)<br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let mut x = 0;
        loop {
        x += 1;
        if x == 20 {
        break;  
        }
        }
        println!(\"{}\", x)
        }", "example5");
        ?>
    </div>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Using a for-loop, while-loop, or the infinite loop explained above (or all three!), make the function below print the fifteen times table up to 50:</p>
    <?php exercise_exec("fn main() {\n\tprintln!()\n}", 'exercise1'); ?>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals/5">&laquo; Functions</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/7">Comments & Docs &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
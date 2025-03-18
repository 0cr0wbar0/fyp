<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Fundamentals: comments & docs</title>
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
        Comments & Documentation
    </h1>

    <h3 class="subheader">
        
    </h3>
</div>

<div class="info">
    <p> 
          As can be seen throughout most code examples given in this chapter, Rust code can be annotated with comments that are ignored during compilation and execution.
    </p>
</div>

<div class="info">
    <p>
        Quick, single-line comments are denoted with a double forward slash (//):
    </p>
    <p class="inlinelink">
        fn main() {<br>
            &nbsp;let mut vector: Vec&lt;isize&gt; = Vec::new(); // initialising function for vector structs<br>
            &nbsp;vector.push(5); // function for appending an element to a vector<br>
            &nbsp;dbg!(vector); // macro that prints the vector in debug format<br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
            let mut vector: Vec&lt;isize&gt; = Vec::new();
            vector.push(5); 
            dbg!(vector); 
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        If a more detailed description is required for a piece of code, Rust allows for <em>doc comments</em>, indicated with a triple forward slash (///):
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;for i in 0..30 {<br>
        &nbsp;&nbsp;println!("{}", fibonacci(i));<br>
        &nbsp;}<br>
        }<br>
        <br>
        /// A function that takes a signed 32-bit integer as an argument<br>
        /// and also returns a signed 32-bit integer. <br>
        ///<br>
        /// Finds the zero-indexed nth term of the Fibonacci sequence.<br>
        ///<br>
        /// The function is recursive; if the integer is not zero or one,<br>
        /// it will repeatedly call itself with smaller numbers less than<br>
        /// n in order to find the sum of each term of the sequence before<br>
        /// the nth.<br>
        ///<br>
        fn fibonacci(n: i32) -> i32 {<br>
        &nbsp;if n == 0 {<br>
        &nbsp;&nbsp;return 0;<br>
        &nbsp;} else if n == 1 {<br>
        &nbsp;&nbsp;return 1;<br>
        &nbsp;} else {<br>
        &nbsp;&nbsp;fibonacci(n-1) + fibonacci(n-2)<br>
        &nbsp;}<br>
        }<br>
    </p>
    <div>
        <?php
            example_exec("fn main() {
        for i in 0..30 {
        println!(\"{}\", fibonacci(i));
        }
        }
        fn fibonacci(n: i32) -> i32 {
        if n == 0 {
        return 0;
        } else if n == 1 {
        return 1;
        } else {
        fibonacci(n-1) + fibonacci(n-2)
        }
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        <b>Doc comments also support Markdown,</b> allowing for division into titles, subtitles and code block examples if the documentation is being read in a text editor that supports Markdown:
    </p>
    <p class="inlinelink">
        fn main() {<br>
            &nbsp;for i in 0..30 {<br>
            &nbsp;&nbsp;println!("{}", fibonacci(i));<br>
            &nbsp;}<br>
            }<br>
            <br>
           /// # Fibonacci function<br>
           ///<br>
           /// A function that takes a signed 32-bit integer as an argument<br>
           /// and also returns a signed 32-bit integer.<br>
           ///<br>
           /// Finds the zero-indexed nth term of the Fibonacci sequence.<br>
           ///<br>
           /// ## Example<br>
           ///<br>
           /// ```fibonacci(10)``` will return 55, the tenth term of the<br>
           /// sequence (assuming that there is a 0th term).<br>
           ///<br>
           fn fibonacci(n: i32) -> i32 {<br>
            &nbsp;if n == 0 {<br>
            &nbsp;&nbsp;return 0;<br>
            &nbsp;} else if n == 1 {<br>
            &nbsp;&nbsp;return 1;<br>
            &nbsp;} else {<br>
            &nbsp;&nbsp;fibonacci(n-1) + fibonacci(n-2)<br>
            &nbsp;}<br>
            }<br>
    </p>
    <div>
        <?php
            example_exec("fn main() {
        for i in 0..30 {
        println!(\"{}\", fibonacci(i));
        }
        }
        fn fibonacci(n: i32) -> i32 {
        if n == 0 {
        return 0;
        } else if n == 1 {
        return 1;
        } else {
        fibonacci(n-1) + fibonacci(n-2)
        }
        }", "example3");
        ?>
    </div>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals/6">&laquo; Control Flow</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/quiz">Quiz &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
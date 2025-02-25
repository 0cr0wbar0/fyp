<?php
session_start();
require "../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Fundamentals: mutability</title>
    <link rel="stylesheet" href="../static/stylesheet.css">
    <link rel="shortcut_icon" type="image/png" href="../static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="../static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="../static/shocked_hugh.ico">
</head>

<body>

<div class="navbar">
    <a href="https://fyp.cr0wbar.dev">Homepage</a>
    <a href="https://fyp.cr0wbar.dev/login">Login</a>
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
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+mut+number+%3D+5%3B%0A++++println%21%28%22%7B%7D%22%2C+number%29%3B+%2F%2F+prints+%275%27%0A++++number+%3D+10%3B%0A++++println%21%28%22%7B%7D%22%2C+number%29%3B+%2F%2F+prints+%2710%27%0A%7D" target="_blank">
        fn main() {<br/>
        let mut number = 5;<br/>
        println!("{}", number); // prints '5'<br/>
        number = 10;<br/>
        println!("{}", number); // prints '10'<br/>
        }</a></p>
</div>

<div class="info">
    <p>
        The above example also contains some instances of <br/> println!(), one of Rust's <b>macros</b>
         (covered in more detail later). println!() prints the value of a given variable, depending on its <b>data type</b>.
    </p>
</div>

<div class="info">
    <p> 
        Using the keyword <em>const</em>, Rust variables can also be defined as constants, forcing complete immutability throughout the entire lifetime of a variable:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=const+FORTY_TWO%3A+u8+%3D+20%2B12%2B10%3B%0A%0Afn+main%28%29+%7B%0A++++println%21%28%22%7B%7D%22%2C+FORTY_TWO%29%0A%7D" target="_blank">
        const FORTY_TWO: u8 = 20+12+10;<br/>
        <br/>
        fn main() {<br/>
            &nbsp;println!("{}", FORTY_TWO)<br/>
        }</a></p>
    <p>
        The piece of syntax involving the colon before the equals sign will be explained in the next section.
    </p>
</div>

<div class="info">
    <p>
        Constants can be defined at the very beginning of a Rust script, outside of any functions (explained later), making them ideal for defining a value that has to be known and used across a whole program.
    </p>
</div>

<div class="info">
    <p>
        To completely ensure that constants stay immutable, it is impossible for a constant to have a value that can't be calculated at compile-time.
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals/1">&laquo; Variables</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/3">Primitive Data Types &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
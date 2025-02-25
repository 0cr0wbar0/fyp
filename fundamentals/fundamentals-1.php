<?php
session_start();
require "../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Fundamentals: variables</title>
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
    <p class="inlinelink"> <a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+variable_name%3B%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let variable_name;<br/>
        }</a></p>
    <p class="inline-err">
        error[E0282]: type annotations needed<br/>
         --> src/main.rs:2:9<br/>
          |<br/>
        2 |     let variable_name;<br/>
          |<br/>
          |<br/>
        help: consider giving `variable_name` an explicit type<br/>
          |<br/>
        2 |     let variable_name: /* Type */;<br/>
          |<br/>                      
          <br/>
        For more information about this error, try `rustc --explain E0282`.<br/>
        error: could not compile `playground` (bin "playground") due to 1 previous error</p>
</div>

<div class="info">
    <p class="inlinelink">
        <a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+variable_name%3A+char%3B%0A%7D" target="_blank">
            fn main() {<br/>
            &nbsp;let variable_name: char;<br/>
            }
        </a>
    </p>
    <p>
        The "char" after the colon in the above example is <b>not the value of the variable, but the data type.</b>
    </p>
</div>

<div class="info">
    <p>
    In Rust, explicit types for variables are specified after the variable name, separated from it by a colon, after which the actual value is specified with an equals sign:
    </p>
    <p class="inlinelink">
        <a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+variable_name%3A+char+%3D+%27b%27%3B%0A%7D" target="_blank">
            fn main() {<br/>
            &nbsp;let variable_name: char = 'b';<br/>
            }
        </a>
    </p>
</div>

<div class="info">
    <p>
        Rust's data types will be explained in more detail later in this chapter.
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals">&laquo; Fundamentals intro</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/2">Mutability &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
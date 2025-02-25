<?php
session_start();
require "../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Error handling: the panic!() macro</title>
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
        The panic!() Macro
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        The panic!() macro was given earlier as a common example of a macro in Rust, and this is indeed one of the most common across Rust's standard library.
    </p>
</div>

<div class="info">
    <p>
        This macro immediately and irrecoverably terminates the program in which it was called:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++panic%21%28%22Error%21%22%29%0A%7D" target="_blank">
        fn main() {<br>
        &nbsp;panic!("Error!")<br/>
        }
    </a></p>
    <p>
        It then prints the exact line and column numbers for where the panic occurred, and (optionally) prints a string, passed to it as a parameter, to error output explaining the reason, as well as a full backtrace of the runtime call stack (the record of processes executed during runtime):
    </p>
    <p class="inline-err">
        thread 'main' panicked at <b>src/main.rs:2:5:</b><br/>
        <b>Error!</b><br/>
        <b>stack backtrace</b>:<br/>
        &nbsp;0: rust_begin_unwind<br/>
        &nbsp;&nbsp;at /rustc/.../library/std/src/panicking.rs:665:5<br>
        &nbsp;1: core::panicking::panic_fmt<br/>
        &nbsp;&nbsp;at /rustc/.../library/core/src/panicking.rs:76:14<br>
        &nbsp;2: playground::main<br/>
        &nbsp;&nbsp;at ./src/main.rs:2:5<br/>
        &nbsp;3: core::ops::function::FnOnce::call_once<br/>
        &nbsp;&nbsp;at ./.rustup/toolchains/stable-x86_64-unknown-linux-gnu/lib/rustlib/src/rust/library/core/src/ops/function.rs:250:5<br/>
    </p>
</div>

<div class="info">
    <p>
        While the above example involves manually invoking the panic!() macro as an intended result of execution, many other built-in functions and macros in the standard library are written to invoke it if something goes irreparably wrong.
    </p>
</div>

<div class="info">
    <p>
        For example, the method <em>remove()</em>, implemented for vectors, will call the <br/>panic!() macro if an attempt is made to remove an element on an out-of-bounds index:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+mut+v+%3D+vec%21%5B1%2C2%2C3%2C4%2C5%5D%3B%0A++++v.remove%286%29%3B%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let mut v = vec![1,2,3,4,5];<br/>
        &nbsp;v.remove(6);<br/>
        }
    </a></p>
    <p class="inline-err">
        thread 'main' panicked at src/main.rs:3:7:<br/>
        removal index (is 6) should be < len (is 5)
    </p>
</div>

<div class="info">
    <p>
        In the implementation for the <em>remove()</em> method, the panic!() macro has been passed a string that provides contextual, useful information, saying exactly how the given index is out-of-bounds of the length of the given vector.
    </p>
</div>

<div class="info">
    <p>
        Since this macro allows for full string formatting, relevant variables and values can be passed into the error output string for maximum contextual clarity:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+big_num+%3D+i128%3A%3AMAX%3B%0A++++panic%21%28%22Number+%7Bnum%7D+is+too+big%21%22%2C+num+%3D+big_num%29%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let big_num = i128::MAX;<br/>
        &nbsp;panic!("Number {num} is too big!", num = big_num)<br/>
        }
    </a></p>
    <p class="inline-err">
        thread 'main' panicked at src/main.rs:3:5:<br/>
        Number 170141183460469231731687303715884105727 is too big!
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/errorhandling">&laquo; Error handling intro</a>
    <a href="https://fyp.cr0wbar.dev/errorhandling/2">The Result enum &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
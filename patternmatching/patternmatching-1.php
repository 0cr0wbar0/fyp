<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Pattern matching: match statements</title>
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
        Match Statements
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        There exists another form of control flow in Rust's syntax, based on <em>pattern matching</em>: executing different blocks of code depending on a match for:
        <ul class="list">
            <li>the value of a variable</li>
            <li>the discriminant (variant type) of an enum</li>
            <li>the value and status of an Option or Result type (explained later)</li>
        </ul>
    </p>
</div>

<div class="info">
    <p>
        The main method of pattern matching in Rust is through a match statement, which takes a given variable and has defined sections of code that run if that variable's value satisfies a match for that section:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+num%3A+i32+%3D+5%3B%0A++++match+num+%7B%0A++++++++1..%3D4+%3D%3E+%7B%0A++++++++++++println%21%28%22Too+small%21%22%29%3B%0A++++++++%7D%0A++++++++5+%3D%3E+%7B%0A++++++++++++println%21%28%22Match%21%22%29%3B%0A++++++++%7D%0A++++++++6..+%3D%3E+%7B%0A++++++++++++println%21%28%22Too+big%21%22%29%3B%0A++++++++%7D%0A++++++++_+%3D%3E+%7B%0A++++++++++++unreachable%21%28%29%0A++++++++%7D%0A++++%7D%0A%7D" target="_blank">
        fn main() {<br>
        &nbsp;let num: i32 = 5;<br>
        &nbsp;&nbsp;match num {<br>
        &nbsp;&nbsp;&nbsp;1..=4 => {<br>
        &nbsp;&nbsp;&nbsp;&nbsp;println!("Too small!");<br>
        &nbsp;&nbsp;&nbsp;}<br>
        &nbsp;&nbsp;&nbsp;5 => {<br>
        &nbsp;&nbsp;&nbsp;&nbsp;println!("Match!");<br>
        &nbsp;&nbsp;&nbsp;}<br>
        &nbsp;&nbsp;&nbsp;6.. => {<br>
        &nbsp;&nbsp;&nbsp;&nbsp;println!("Too big!");<br>
        &nbsp;&nbsp;&nbsp;}<br>
        &nbsp;&nbsp;&nbsp;_ => {<br>
        &nbsp;&nbsp;&nbsp;&nbsp;unreachable!()<br>
        &nbsp;&nbsp;&nbsp;}<br>
        &nbsp;&nbsp;}<br>
        &nbsp;}<br>
    </a></p>
    <p>
        Depending on the type of the variable in question, <em>ranges</em> can be specified for matching patterns. The above example prints "Too small!" if the value is 1, 2, 3 or 4, and prints "Too big!" if the value is 6 or greater.
    </p>
</div>

<div class="info">
    <p>
        Note the matching clause marked with an underscore in the above example. This underscore acts as a wildcard: if the value of the variable matches none of the other patterns, the wildcard block of code will be executed.
    </p>
</div>

<div class="info">
    <p>
        As a side note, the macro being called in the wildcard clause is used to explicitly define areas of code that are manually known to be unreachable, hence its name. 
        If the programmer is wrong, and the code explicitly defined as unreachable using this macro is indeed reached and executed during runtime, the macro will panic, with an error message that can be passed to it as a string.
    </p>
</div>

<div class="info">
    <p>
        It is forbidden to define a match statement with <em>non-exhaustive patterns</em>, that is, if not all possible values of a variable of a certain type are covered by the defined patterns:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+num%3A+i32+%3D+5%3B%0A++++match+num+%7B%0A++++++++1..%3D4+%3D%3E+%7B%0A++++++++++++println%21%28%22Too+small%21%22%29%3B%0A++++++++%7D%0A++++++++5+%3D%3E+%7B%0A++++++++++++println%21%28%22Match%21%22%29%3B%0A++++++++%7D%0A++++++++6..+%3D%3E+%7B%0A++++++++++++println%21%28%22Too+big%21%22%29%3B%0A++++++++%7D%0A++++++++%2F%2F+No+wildcard+pattern%0A++++%7D%0A%7D" target="_blank">
        fn main() {<br>
            &nbsp;let num: i32 = 5;<br>
            &nbsp;&nbsp;match num {<br>
            &nbsp;&nbsp;&nbsp;1..=4 => {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;println!("Too small!");<br>
            &nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;&nbsp;5 => {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;println!("Match!");<br>
            &nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;&nbsp;6.. => {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;println!("Too big!");<br>
            &nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;&nbsp;// No wildcard pattern<br>
            &nbsp;&nbsp;}<br>
            &nbsp;}<br>
    </a></p>
    <p class="inline-err">
    Compiling temp v0.1.0<br>
    error[E0004]: non-exhaustive patterns: `i32::MIN..=0_i32` not covered<br>
    --> src/main.rs:3:9<br>
     |<br>
   3 |   match num {<br>
     |         &nbsp;&nbsp;^^^ pattern `i32::MIN..=0_i32` not covered<br>
     |<br>
     = note: the matched value is of type `i32`<br>
   help: ensure that all possible cases are being handled by adding a match arm with a wildcard pattern or an explicit pattern as shown<br>
     |<br>
   12~    },<br>
   13+    i32::MIN..=0_i32 => todo!()<br>
     |<br>
     <br>
   For more information about this error, try `rustc --explain E0004`.<br>
   error: could not compile `temp` (bin "temp") due to 1 previous error<br>
    </p>
</div>

<div class="info">
    <p>
        For matching on a variable with an enum type, either all possible discriminants must be included, or the wildcard must be included if this is not the case: 
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=enum+Vehicles+%7B%0A++++Car%2C%0A++++Boat%2C%0A++++Train%2C%0A++++Plane%2C%0A%7D%0A%0Afn+main%28%29+%7B%0A++++let+v+%3D+Vehicles%3A%3ATrain%3B%0A++++match+v+%7B%0A++++++++Vehicles%3A%3ACar+%3D%3E+%7B%0A++++++++++++println%21%28%22Beep%21%22%29%3B%0A++++++++%7D%0A++++++++Vehicles%3A%3ABoat+%3D%3E+%7B%0A++++++++++++println%21%28%22Splash%21%22%29%3B%0A++++++++%7D%0A++++++++Vehicles%3A%3ATrain+%3D%3E+%7B%0A++++++++++++println%21%28%22Honk%21%22%29%3B%0A++++++++%7D%0A++++++++Vehicles%3A%3APlane+%3D%3E+%7B%0A++++++++++++println%21%28%22Zoom%21%22%29%3B%0A++++++++%7D+%2F%2F+Wildcard+not+needed+here%2C+as+all+discriminants+covered%0A++++%7D%0A%7D%0A" target="_blank">
        enum Vehicles {<br>
        &nbsp;Car,<br>
        &nbsp;Boat,<br>
        &nbsp;Train,<br>
        &nbsp;Plane<br>
        }<br>
        <br>
        <br>
        fn main() {<br>
            &nbsp;let v = Vehicles::Train;<br>
            &nbsp;match v {<br>
            &nbsp;&nbsp;Vehicles::Car => {<br>
            &nbsp;&nbsp;&nbsp;println!("Beep!");<br>
            &nbsp;&nbsp;}<br>
            &nbsp;&nbsp;Vehicles::Boat => {<br>
            &nbsp;&nbsp;&nbsp;println!("Splash!");<br>
            &nbsp;&nbsp;}<br>
            &nbsp;&nbsp;Vehicles::Train => {<br>
            &nbsp;&nbsp;&nbsp;println!("Honk!");<br>
            &nbsp;&nbsp;}<br>
            &nbsp;&nbsp;Vehicles::Plane => {<br>
            &nbsp;&nbsp;&nbsp;println!("Zoom!");<br>
            &nbsp;&nbsp;}<br>
            &nbsp;&nbsp;// Wildcard not needed here, as all discriminants covered<br>
            &nbsp;}<br>
        }<br>
    </a></p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/patternmatching">&laquo; Pattern Matching intro</a>
    <a href="https://fyp.cr0wbar.dev/patternmatching/2">If-let statements &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
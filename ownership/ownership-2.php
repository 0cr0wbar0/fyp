<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Ownership: references</title>
    <script src="../static/styletoggle.js"></script>
    <link rel="stylesheet" href="">
    <script>init_style();</script>
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
    <a href="https://fyp.cr0wbar.dev/login">Login</a>
</div>

<div class="box">

<div class="titles">
    <h1 class="header">
        References
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Languages like Java, C#, Python and PHP all use <em>garbage collection</em> to detect and free memory containing unused functions and variables, meaning an extra program must be running at all times during execution to perform this task.
        This can lead to slower execution times and less time-efficient and space-efficient programs.
    </p>
</div>

<div class="info">
    <p>
        Languages like C have no garbage collector, meaning they are faster in execution, but may require the programmer to handle memory manually, with
        minor mistakes in memory management leading to fatal errors that are difficult to predict or notice.
    </p>
</div>

<div class="info">
    <p>
        Fatal errors involving memory can also cause <em>undefined behaviour</em>, a set of unpredictable events that occur as a result of the runtime executing broken, residual instructions (which could cause anything from file corruption to fatal crashes of the entire operating system).
    </p>
</div>

<div class="info">
    <p>
        Rust strikes a middle ground between these two execution models:
        <ul class="list">
            <li>each value stored in memory is <b>owned</b> by some variable, struct or function</li>
            <li>in order to prevent undefined behaviour from deallocating the same memory area twice, each value has only <b>one owner at a time</b></li>
            <li>assigning a variable to another variable <b>transfers ownership of the first variable's value to the second variable</b></li>
            <li>passing a value into a function as an argument <b>transfers ownership of that value to that function</b></li>
            <li><b>any further attempt</b> to access a moved value outside its new owner will cause an error</li>
            <li>errors involving ownership are detected during compile-time, meaning the program will <b>refuse to execute</b> if these rules are not followed</li>
        </ul>
    </p>
</div>

<div class="animbox">
    <canvas id='ownership' width="480px" height="278px"></canvas>
    <div class="nav">
        <button class="textsubmit" id="ownership_anim_reset">Play</button>
        <button class="textsubmit" id="ownership_anim_pause">Pause</button>
    </div>
</div>

<div class="info">
    <p>
        In the above animation, some_func() is some function that takes a String struct as an argument, but doesn't return the same struct.
    </p>
</div>

<div class="info">
    <p>
        This strict system of <b>ownership</b> means that all values stored in memory can be tightly controlled and monitored, making Rust programs much more memory-safe than C programs, without the need for a resource-costly garbage collector.
    </p>
</div>

<div class="info">
    <p>
        However, there are inevitably going to be situations where a single variable needs to be accessed by many different parts of a Rust program multiple times.
        In order to allow this to happen, <b>references</b> to variables can be used in place of the variables themselves:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut s = String::from("borrowed");<br>
        &nbsp;println!("{} {:?} {}", <br>
        &nbsp;&nbsp;get_string_capacity(&s),<br>
        &nbsp;&nbsp;get_last_char(&mut s),<br>
        &nbsp;&nbsp;get_length(&s));<br>
        }<br>
        <br>
        /// Takes reference to a String struct,<br>
        /// returns capacity in bytes<br><br>
        fn get_string_capacity(string: &String) -> usize {<br>
        &nbsp;string.capacity()<br>
        }<br>
        <br>
        /// Takes *mutable* reference to a String,<br>
        /// returns last character of String,<br>
        /// provided the String's length is >= 1<br><br>
        fn get_last_char(string: &mut String) -> char {<br>
        &nbsp;string.pop().unwrap() // this method explained later!<br>
        }<br>
        <br>
        /// Takes reference to a String,<br>
        /// returns current length<br><br>
        fn get_length(string: &String) -> usize {<br>
        &nbsp;string.len()<br>
        }<br>
    </p>
    <p>
        References to variables, and the definition of the types of these variable references, are denoted with an ampersand (&). 
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let mut s = String::from(\"borrowed\");
        println!(\"{} {:?} {}\", 
        get_string_capacity(&s),
        get_last_char(&mut s),
        get_length(&s));
        }
        fn get_string_capacity(string: &String) -> usize {
        string.capacity()
        }
        
        fn get_last_char(string: &mut String) -> char {
        string.pop().unwrap()
        }
        
        fn get_length(string: &String) -> usize {
        string.len()
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        When a reference to a variable is passed to a function as an argument, that function <em>borrows</em> the variable for the duration of its execution, through the reference to it, meaning that ownership of the variable does not change.
    </p>
</div>

<div class="info">
    <p>
        Note, in the above example, how the String variable <em>s</em> was borrowed multiple times in the main function, but <em>only borrowed mutably once</em>.
        This is another immensely important ownership rule that helps to make memory safety guarantees.
    </p>
</div>

<div class="info">
    <p>
        If multiple mutable borrows could be made at once, <em>race conditions</em> (situations where the same variable is edited or overwritten by multiple processes, leading to unexpected behaviour) would occur.
    </p>
</div>

<div class="info">
    <p>
        However, most primitive types in Rust, such as integers, floating-point numbers, booleans, and characters, <em>aren't moved</em> when they are used in a function or assigned to another variable.
    </p>
</div>

<div class="info">
    <p>
        Since they take up very small, fixed amounts of memory space, they have a trait called <em>Copy</em>, which allows them to be simply copied, instead of moved, to the variable or function they might be used with. More technical details of why primitive types behave this way can be found on the next page.
    </p>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Fix the ownership-related compile error with the following code:</p>
    <?php exercise_exec("fn main() {\n\tlet s: String = String::from(\"String!\");\n\ttake_string(s);\n\tprintln!(\"{}\", s)\n}\n\nfn take_string(mut _string: String) -> String {\n\t_string = String::from(\"This is a different string!\");\n\t_string\n}", 'exercise1'); ?>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/ownership/1">&laquo; Scopes</a>
    <a href="https://fyp.cr0wbar.dev/ownership/3">Stack & Heap Memory &raquo;</a>
</div>

<script src="../static/sprites.min.js"></script>
<script>
    let ownership = new Sprite( {
        src: '../static/ownership.png',
        id: 'ownership',
        width: 480,
        height: 278,
        image_width: 21600,
        err: true
    });

    document.getElementById("ownership_anim_reset").onclick = function () {
        if (document.getElementById("ownership_anim_reset").innerHTML !== "Play") {
            document.getElementById("ownership_anim_reset").innerHTML = "Play";
        }
        ownership.play( {
            fps: 5,
            from: 1,
            to: 45,
            n: 0
        });
    }

    document.getElementById("ownership_anim_pause").onclick = function () {
        ownership.pause();
        document.getElementById("ownership_anim_reset").innerHTML = "Reset";
    }

</script>
<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>

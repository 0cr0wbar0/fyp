<?php
session_start();
require __DIR__."/../rustrunner.php";
require __DIR__."/../init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Ownership: scopes</title>
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
        Scopes
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Scopes, the areas of a program in which given variables are valid for access, are an absolutely vital component of Rust's guarantees of memory safety.
    </p>
</div>

<div class="info">
    <p>
        Separately from functions, scopes can be explicitly defined in Rust code with curly brackets:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let n: i32 = 10;<br>
        &nbsp;{<br>
        &nbsp;&nbsp;let n: i32 = 10 * 20;<br>
        &nbsp;&nbsp;println!("The scoped value of n is {}", n);<br>
        &nbsp;}<br>
        &nbsp;println!("The unscoped value of n is {}", n);<br>
        }
    </p>
    <div class="info">
        <?php example_exec("fn main() {\n
        \tlet n: i32 = 10;\n
        \t{\n
        \t\tlet n: i32 = 10 * 20;\n
        \t\tprintln!(&quot;The scoped value of n is {}&quot;, n);\n
        \t}\n
        \tprintln!(&quot;The unscoped value of n is {}&quot;, n);\n
        }", 'example1'); ?>
    </div>
</div>


<div class="info">
    <p>
        The above example is an instance of <em>shadowing</em>: the variable <em>n</em> is defined once in the main scope of the main function, then a new variable <em>n</em> is defined in the inner scope with a different value.
    </p>
</div>

<div class="info">
    <p>
        These two variables are entirely separate from one another, and they're only allowed to coexist in this piece of code because of the scope that separates them.
    </p>
</div>

<div class="info">
    <p>
        Once the inner scope finishes execution, the variable defined inside it is completely dropped, meaning that when the original variable <em>n</em> is printed, it has the value assigned to it independently of the inner scope.
    </p>
</div>

<div class="info">
    <p>
        Rust enforces the <b>Resource Acquisition Is Initialisation (RAII)</b> technique automatically during execution.
        This is an execution model commonly used in C++ programs that ties the window of access to a variable to the period of time between the <em>creation</em> of the variable, and the point at which the variable <em>goes out of scope</em>.
    </p>
</div>

<div class="animbox">
    <canvas id='scopes' width="480" height="276"></canvas>
    <div class="nav">
    <button class="textsubmit" id="scope_anim_reset">Play</button>
    <button class="textsubmit" id="scope_anim_pause">Pause</button>
    </div>
</div>

<div class="info">
    <p>
        Rust has a built-in <em>trait</em> (a set of rules that <em>modify the behaviour of a given data type</em>, explained in more detail later) called <em>Drop</em>.
        This trait implements a function, drop(), on all data types, and the Rust runtime uses this function to delete out-of-scope variables from memory, no matter their data type.
    </p>
</div>

<div class="info">
    <p>
        It is completely forbidden to manually call the drop() function on any value whatsoever:
    </p>
    <p class="inlinelink">
        struct ToDrop {<br>
        &nbsp;i: i32<br>
        }<br>
        <br>
        /// This impl tries to manually implement custom destruction<br>
        /// behaviour for ToDrop struct<br>
        impl Drop for ToDrop { <br>
        &nbsp;fn drop(&mut self) {<br>
        &nbsp;&nbsp;// some code to execute when struct is dropped<br>
        &nbsp;}<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let i = ToDrop { i: 20 };<br>
        &nbsp;i.drop();<br>
        }<br>
    </p>
    <p class="inline-err">
        error[E0040]: explicit use of destructor method<br>
        --> src/main.rs:15:7<br>
        |<br>
        15 |  i.drop();<br>
        |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^^^^ explicit destructor calls not allowed<br>
        |<br>
        help: consider using `drop` function<br>
        |<br>
        15 |     drop(i);<br>
        |&nbsp;&nbsp;&nbsp;&nbsp;+++++ ~<br>
        <br>
        For more information about this error, try `rustc --explain E0040`.<br>
        error: could not compile `temp` (bin "temp") due to 1 previous error
    </p>
</div>

<div class="info">
    <p>
        The second drop() function being suggested in the error output for the above code example is a different function entirely, and is part of <b>std::mem</b>, the built in memory management module for Rust.
        The functions in this module require considerably advanced knowledge of low-level Rust, and as such will not be explained further in this course.
    </p>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Try adding a scope of your own to the function below, before the println!(), with a variable that shadows the existing variable:</p>
    <?php exercise_exec("fn main() {\n\tlet outer: u32 = 15;\n\tprintln!(\"{}\", outer)\n}", 'exercise1'); ?>
</div>

</div>

<div class="nav">
    <a href="./ownership-home.php">&laquo; Ownership intro</a>
    <a href="./ownership-2.php">References &raquo;</a>
</div>

<script src="../static/sprites.min.js"></script>
<script>
    let scopes = new Sprite({
        src: '../static/scopes.png',
        id: 'scopes',
        width: 480,
        height: 276,
        image_width: 27360,
        err: true
    });

    document.getElementById("scope_anim_reset").onclick = function () {
        if (document.getElementById("scope_anim_reset").innerHTML !== "Play") {
            document.getElementById("scope_anim_reset").innerHTML = "Play";
        }
        scopes.play( {
            fps: 5,
            from: 1,
            to: 57,
            n: 0
        });
    }

    document.getElementById("scope_anim_pause").onclick = function () {
        scopes.pause();
        document.getElementById("scope_anim_reset").innerHTML = "Reset";
    }
</script>
<?php js(); ?>
</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<br>
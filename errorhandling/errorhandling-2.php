<?php
session_start();
require __DIR__."/../rustrunner.php";
require __DIR__."/../init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Error handling: the Option enum</title>
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
        The Option Enum
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        The Option enum is an enum-based type in Rust that can represent one of two possible states:
        <ul class="list">
            <li><b>Some(T)</b>: any value T of a certain type</li>
            <li><b>None</b>: no value at all</li>
        </ul>
    </p>
</div>

<div class="info">
    <p>
        This type is Rust's closest equivalent to the <em>null</em> and <em>None</em> types commonly seen in languages similar to Java and Python, respectively,
        and offers an easy method of handling errors involving absent values, ensuring that program crashes caused by "null" values are much harder to come across.
    </p>
</div>

<div class="info">
    <p>
        Think back to one of the very first examples of Rust code given in this course - if a variable is defined with an alias, but not given a value,
        many languages will give it a null value, whereas Rust will refuse to compile any code containing this if the variable in question is used anywhere beyond its definition.
    </p>
</div>

<div class="info">
    <p>
        Like any other type, Option can be specified as the return type of any given function, meaning that error handling can be easily put in place to mitigate the event of no value being found or returned.
    </p>
</div>

<div class="info">
    <p>
        In the case of an Option containing a value, the Some() syntax acts as a wrapper around the value, and can be removed with the built-in <b>unwrap()</b> method. 
        As its name implies, this strips away the Option, in order for the value to be used elsewhere:
    </p>
    <p class="inlinelink">
        fn option() -> Option&lt;i32&gt; {<br>
        &nbsp;Some(10)<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!("{}", option().unwrap())<br>
        }<br>
    </p>
    <p>
        unwrap() is also implemented for a similar type, <b>Result</b>, explained on the next page.
    </p>
    <div>
        <?php
            example_exec("fn option() -> Option&lt;i32&gt; {
        Some(10)
        }
        fn main() {
        println!(\"{}\", option().unwrap())
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        It is important to note, however, that unwrap() <b>assumes the value of the Option to be Some(V) with a valid value V,
        and calls the panic!() macro if the Option is None.</b> As such, this should only be used in cases where the expected behaviour of
        a function or method returning an Option is absolutely certain, or has been manually checked beforehand.
    </p>
</div>

<div class="info">
    <p>
        For slightly more advanced handling of this possibility, Option has another method called <em>expect()</em>.
        This also unwraps the enum, assuming it not to be None, with the added functionality of appending a string, defined by the programmer,
        to any error message caused by an instance of None:
    </p>
    <p class="inlinelink">
        fn option() -> Option&lt;i32&gt; {<br>
        &nbsp;None<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!("{}", option().expect("shouldn't be None"))<br>
        }
    </p>
    <div>
        <?php
        example_exec("fn option() -> Option&lt;i32&gt; {
        None
        }
        
        fn main() {
        println!(\"{}\", option().expect(\"shouldn't be None\"))
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        In terms of pattern matching, the Option enum can be efficiently used in situations where the existence of a value needs to be confirmed:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let num: Option&lt;i32&gt; = Some(5);<br>
        &nbsp;match num {<br>
        &nbsp;&nbsp;Some(number) => {<br>
        &nbsp;&nbsp;&nbsp;println!("Number matched: {}", number)<br>
        &nbsp;&nbsp;}<br>
        &nbsp;&nbsp;None => {<br>
        &nbsp;&nbsp;&nbsp;println!("No value found!")<br>
        &nbsp;&nbsp;}<br>
        &nbsp;}<br>
        }
    </p>
    <p>
        In the above example, the match statement uses a temporary variable <em>number</em> to match with the Option variable <em>num</em>, and prints the matching value.
        Furthermore, since <em>num</em> is explicitly defined to have an optional i32 value, all possible matches are covered (any i32, or no value), and there is no need for a wildcard match.
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let num: Option&lt;i32&gt; = Some(5);
        match num {
        Some(number) => {
        println!(\"Number matched: {}\", number)
        }
        None => {
        println!(\"No value found!\")
        }
        }
        }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Refactor the following code so that the Option is handled without<br>a call to panic!():</p>
    <?php exercise_exec("fn main() {\r\n\tlet maybe_int: Option&lt;i32&gt; = None;\n\tprintln!(\"{}\", maybe_int.expect(\"This shouldn't be None!\"))\n}", 'exercise1'); ?>
    <p><b>Hint:</b> A match statement is likely to be useful.</p>
</div>

</div>

<div class="nav">
    <a href="./errorhandling-1.php">&laquo; The panic!() macro</a>
    <a href="./errorhandling-3.php">The Result enum &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
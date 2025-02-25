<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Error handling: the Option enum</title>
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
        many languages will give it a null value, whereas Rust will refuse to compile any code containing this.
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
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+option%28%29+-%3E+Option%3Ci32%3E+%7B%0A++++Some%2810%29%0A%7D%0A%0Afn+main%28%29+%7B%0A++++println%21%28%22%7B%7D%22%2C+option%28%29.unwrap%28%29%29%0A%7D%0A" target="_blank">
        fn option() -> Option&lt;i32&gt; {<br/>
        &nbsp;Some(10)<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;println!("{}", option().unwrap())<br/>
        }<br/>
    </a></p>
    <p>
        unwrap() is also implemented for a similar type, <b>Result</b>, explained on the next page.
    </p>
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
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+option%28%29+-%3E+Option%3Ci32%3E+%7B%0A++++None%0A%7D%0A%0Afn+main%28%29+%7B%0A++++println%21%28%22%7B%7D%22%2C+option%28%29.expect%28%22shouldn%27t+be+None%22%29%29%0A%7D" target="_blank">
        fn option() -> Option&lt;i32&gt; {<br/>
        &nbsp;None<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;println!("{}", option().expect("shouldn't be None"))<br/>
        }
    </a></p>
</div>

<div class="info">
    <p>
        In terms of pattern matching, the Option enum can be efficiently used in situations where the existence of a value needs to be confirmed:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+num%3A+Option%3Ci32%3E+%3D+Some%285%29%3B%0A++++match+num+%7B%0A++++++++Some%28number%29+%3D%3E+%7B%0A++++++++++++println%21%28%22Number+matched%3A+%7B%7D%22%2C+number%29%0A++++++++%7D%0A++++++++None+%3D%3E+%7B%0A++++++++++++println%21%28%22No+value+found%21%22%29%0A++++++++%7D%0A++++%7D%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let num: Option&lt;i32&gt; = Some(5);<br/>
        &nbsp;match num {<br/>
        &nbsp;&nbsp;Some(number) => {<br/>
        &nbsp;&nbsp;&nbsp;println!("Number matched: {}", number)<br/>
        &nbsp;&nbsp;}<br/>
        &nbsp;&nbsp;None => {<br/>
        &nbsp;&nbsp;&nbsp;println!("No value found!")<br/>
        &nbsp;&nbsp;}<br/>
        &nbsp;}<br/>
        }
    </a></p>
    <p>
        In the above example, the match statement uses a temporary variable <em>number</em> to match with the Option variable <em>num</em>, and prints the matching value.
        Furthermore, since <em>num</em> is explicitly defined to have an optional i32 value, all possible matches are covered (any i32, or no value), and there is no need for a wildcard match.
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/errorhandling/1">&laquo; The panic!() macro</a>
    <a href="https://fyp.cr0wbar.dev/errorhandling/3">The Result enum &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
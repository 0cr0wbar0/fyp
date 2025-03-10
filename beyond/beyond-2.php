<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Beyond the basics: traits</title>
    <script src="../static/styletoggle.js"></script>
    <script>
        window.onload = function () {
            init_style();
        };
    </script>
    <link rel="stylesheet" href="">
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
        Traits
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Traits, very similar to Java's interface feature, are common sets of methods that can be implemented into different types.
        Most (if not all) of the structs and enums in the standard Rust library implement traits that are used to alter their behaviour,
        or implement similar methods across multiple different types.
    </p>
</div>

<div class="info">
    <p>
        For instance, the <em>Copy</em> trait seen earlier implements methods on types that are small enough to be
        safely copied, rather than borrowed.<br>The <em>Clone</em> trait, conversely, implements a method on types that can't be safely
        copied, called <em>clone()</em>, which copies the entire value from one space to another in heap memory, which may negate
        the need to borrow the value in some cases, but can slow down execution.
    </p>
</div>

<div class="info">
    <p>
        There's also a <em>Sized</em> trait, which marks types whose sizes in memory can be ascertained at compile-time, before the program begins execution.
        A variant of this trait, <em>?Sized,</em> can be used to give the option not to enforce the behaviour of the trait, if appropriate.
    </p>
</div>

<div class="info">
    <p>
        When defining a struct or enum, pre-existing traits defined in the standard Rust library can be explicitly implemented with the <em>derive attribute</em>.
        This is written on the line before the definition of the data type in question, and multiple traits can be implemented at once:
    </p>
    <p class="inlinelink">
        #[derive(Clone, Debug)]<br>
        struct Cloneable {<br>
        &nbsp;string: String,<br>
        &nbsp;integer: i32,<br>
        &nbsp;float: f64,<br>
        &nbsp;character: char,<br>
        &nbsp;boolean: bool<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let cln = Cloneable {<br>
        &nbsp;&nbsp;string: String::from("hello"),<br>
        &nbsp;&nbsp;integer: 28,<br>
        &nbsp;&nbsp;float: 169.3487,<br>
        &nbsp;&nbsp;character: 'A',<br>
        &nbsp;&nbsp;boolean: true<br>
        &nbsp;};<br>
        &nbsp;println!("{:?}", dbg!(&cln)); // displayable with debugging macro<br>
        &nbsp;println!("{:?}", cln.clone()) // cloneable<br>
        }<br>
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]
            #[derive(Clone, Debug)]
        struct Cloneable {
        string: String,
        integer: i32,
        float: f64,
        character: char,
        boolean: bool
        }
        
        fn main() {
        let cln = Cloneable {
        string: String::from(\"hello\"),
        integer: 28,
        float: 169.3487,
        character: 'A',
        boolean: true
        };
        println!(\"{:?}\", dbg!(&cln));
        println!(\"{:?}\", cln.clone())
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Of course, the programmer can write and implement their own structs, using the <em>trait and impl keywords</em>:
    </p>
    <p class="inlinelink">
        struct Cloneable {<br>
        &nbsp;string: &'static str,<br>
        &nbsp;integer: i32,<br>
        &nbsp;float: f64,<br>
        &nbsp;character: char,<br>
        &nbsp;boolean: bool<br>
        }<br>
        <br>
        trait ChangeString {<br>
        &nbsp;fn change_string(&mut self, val: &'static str) -> &'static str ;<br>
        }<br>
        <br>
        <br>
        impl ChangeString for Cloneable {<br>
        &nbsp;&nbsp;fn change_string(&mut self, val: &'static str) -> &'static str {<br>
        &nbsp;&nbsp;&nbsp;self.string = val;<br>
        &nbsp;&nbsp;&nbsp;self.string<br>
        &nbsp;}<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let mut cln = Cloneable {<br>
        &nbsp;&nbsp;string: "hello",<br>
        &nbsp;&nbsp;integer: 28,<br>
        &nbsp;&nbsp;float: 169.3487,<br>
        &nbsp;&nbsp;character: 'A',<br>
        &nbsp;&nbsp;boolean: true<br>
        &nbsp;};<br>
        &nbsp;println!("{}", cln.change_string("hi!"))<br>
        }<br>
    </p>
    <p>
        Methods in traits are usually defined without bodies, only type definitions, and they have code written for them per implementation.
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]
            struct Cloneable {
        string: &'static str,
        integer: i32,
        float: f64,
        character: char,
        boolean: bool
        }
        
        trait ChangeString {
        fn change_string(&mut self, val: &'static str) -> &'static str ;
        }
        
        
        impl ChangeString for Cloneable {
        fn change_string(&mut self, val: &'static str) -> &'static str {
        self.string = val;
        self.string
        }
        }
        
        fn main() {
        let mut cln = Cloneable {
        string: \"hello\",
        integer: 28,
        float: 169.3487,
        character: 'A',
        boolean: true
        };
        println!(\"{}\", cln.change_string(\"hi!\"))
        }", "example2");
        ?>
    </div>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/beyond/1">&laquo; Generic types</a>
    <a href="https://fyp.cr0wbar.dev/beyond/3">Lifetimes &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php
session_start();
require "../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Beyond the basics: traits</title>
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
        safely copied, rather than borrowed.<br/>The <em>Clone</em> trait, conversely, implements a method on types that can't be safely
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
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=%23%5Bderive%28Clone%2C+Debug%29%5D%0Astruct+Cloneable+%7B%0A++++string%3A+String%2C%0A++++integer%3A+i32%2C%0A++++float%3A+f64%2C%0A++++character%3A+char%2C%0A++++boolean%3A+bool%0A%7D%0A%0Afn+main%28%29+%7B%0A++++let+cln+%3D+Cloneable+%7B%0A++++++++string%3A+String%3A%3Afrom%28%22hello%22%29%2C%0A++++++++integer%3A+28%2C%0A++++++++float%3A+169.3487%2C%0A++++++++character%3A+%27A%27%2C%0A++++++++boolean%3A+true%0A++++%7D%3B%0A++++println%21%28%22%7B%3A%3F%7D%22%2C+dbg%21%28%26cln%29%29%3B+%2F%2F+displayable+with+debugging+macro%0A++++println%21%28%22%7B%3A%3F%7D%22%2C+cln.clone%28%29%29+%2F%2F+cloneable%0A%7D%0A" target="_blank">
        #[derive(Clone, Debug)]<br/>
        struct Cloneable {<br/>
        &nbsp;string: String,<br/>
        &nbsp;integer: i32,<br/>
        &nbsp;float: f64,<br/>
        &nbsp;character: char,<br/>
        &nbsp;boolean: bool<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let cln = Cloneable {<br/>
        &nbsp;&nbsp;string: String::from("hello"),<br/>
        &nbsp;&nbsp;integer: 28,<br/>
        &nbsp;&nbsp;float: 169.3487,<br/>
        &nbsp;&nbsp;character: 'A',<br/>
        &nbsp;&nbsp;boolean: true<br/>
        &nbsp;};<br/>
        &nbsp;println!("{:?}", dbg!(&cln)); // displayable with debugging macro<br/>
        &nbsp;println!("{:?}", cln.clone()) // cloneable<br/>
        }<br/>
    </a></p>
</div>

<div class="info">
    <p>
        Of course, the programmer can write and implement their own structs, using the <em>trait and impl keywords</em>:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=struct+Cloneable+%7B%0A++++string%3A+%26%27static+str%2C%0A++++integer%3A+i32%2C%0A++++float%3A+f64%2C%0A++++character%3A+char%2C%0A++++boolean%3A+bool%0A%7D%0A%0Atrait+ChangeString+%7B%0A++++fn+change_string%28%26mut+self%2C+val%3A+%26%27static+str%29+-%3E+%26%27static+str+%3B%0A%7D%0A%0A%0Aimpl+ChangeString+for+Cloneable+%7B%0A++++fn+change_string%28%26mut+self%2C+val%3A+%26%27static+str%29+-%3E+%26%27static+str+%7B%0A++++++++self.string+%3D+val%3B%0A++++++++self.string%0A++++%7D%0A%7D%0A%0Afn+main%28%29+%7B%0A++++let+mut+cln+%3D+Cloneable+%7B%0A++++++++string%3A+%22hello%22%2C%0A++++++++integer%3A+28%2C%0A++++++++float%3A+169.3487%2C%0A++++++++character%3A+%27A%27%2C%0A++++++++boolean%3A+true%0A++++%7D%3B%0A++++println%21%28%22%7B%7D%22%2C+cln.change_string%28%22hi%21%22%29%29%0A%7D%0A" target="_blank">
        struct Cloneable {<br/>
        &nbsp;string: &'static str,<br/>
        &nbsp;integer: i32,<br/>
        &nbsp;float: f64,<br/>
        &nbsp;character: char,<br/>
        &nbsp;boolean: bool<br/>
        }<br/>
        <br/>
        trait ChangeString {<br/>
        &nbsp;fn change_string(&mut self, val: &'static str) -> &'static str ;<br/>
        }<br/>
        <br/>
        <br/>
        impl ChangeString for Cloneable {<br/>
        &nbsp;&nbsp;fn change_string(&mut self, val: &'static str) -> &'static str {<br/>
        &nbsp;&nbsp;&nbsp;self.string = val;<br/>
        &nbsp;&nbsp;&nbsp;self.string<br/>
        &nbsp;}<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let mut cln = Cloneable {<br/>
        &nbsp;&nbsp;string: "hello",<br/>
        &nbsp;&nbsp;integer: 28,<br/>
        &nbsp;&nbsp;float: 169.3487,<br/>
        &nbsp;&nbsp;character: 'A',<br/>
        &nbsp;&nbsp;boolean: true<br/>
        &nbsp;};<br/>
        &nbsp;println!("{}", cln.change_string("hi!"))<br/>
        }<br/>
    </a></p>
    <p>
        Methods in traits are usually defined without bodies, only type definitions, and they have code written for them per implementation.
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/beyond/1">&laquo; Generic types</a>
    <a href="https://fyp.cr0wbar.dev/beyond/3">Lifetimes &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
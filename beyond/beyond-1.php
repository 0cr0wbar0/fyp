<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Beyond the basics: generic types</title>
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
        Generic Types
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Both the collection types and the Option and Result enums explained earlier in this course would be nowhere near
        useful or practical if they couldn't work with as many types as possible. Vectors and hash maps can act as collections
        for many different data types, from primitive integers to complicated structs, and Options and Results can be defined
        in a similar way.
    </p>
</div>

<div class="info">
    <p>
        This is made possible through <b>generic types</b> - ambiguous representations of multiple possible types,
        that allow functions, methods, enums and structs to handle parameters or fields, respectively, regardless of their actual data type:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+first_of_vec%3CT%3A+Copy%3E%28v%3A+Vec%3CT%3E%29+-%3E+T+%7B%0A++++v%5B0%5D+%2F%2F+of+type+T%2C+where+T+is+copyable%0A%7D%0A%0Afn+main%28%29+%7B%0A++++println%21%28%0A++++++++%22%7B%7D+%7B%7D+%7B%7D%22%2C%0A++++++++first_of_vec%28vec%21%5B1%2C+2%2C+3%5D%29%2C%0A++++++++first_of_vec%28vec%21%5B%22a%22%2C+%22b%22%2C+%22c%22%5D%29%2C%0A++++++++first_of_vec%28vec%21%5Btrue%2C+false%2C+false%5D%29%0A++++%29%0A%7D%0A" target="_blank">
        fn first_of_vec&lt;T: Copy&gt;(v: Vec&lt;T&gt;) -> T {<br/>
        &nbsp;v[0] // of type T, where T is copyable<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;println!(<br/>
        &nbsp;&nbsp;"{} {} {}",<br/>
        &nbsp;&nbsp;first_of_vec(vec![1, 2, 3]),<br/>
        &nbsp;&nbsp;first_of_vec(vec!["a", "b", "c"]),<br/>
        &nbsp;&nbsp;first_of_vec(vec![true, false, false])<br/>
        &nbsp;)<br/>
        }
    </a></p>
    <p>
        Note how the <em>first_of_vec()</em> function in the above example uses the angle bracket (< >) syntax previously seen for definitions of
        vectors, hash maps, and other built-in structs and enums in the standard Rust library.
    </p>
</div>

<div class="info">
    <p>
        This is exactly how these other built-in features can behave in this manner: rather than exclusively take and return values of specific types,
        they are defined to take any type, as long as that type implements the required traits:
    </p>
    <p class="inlinelink">
        // The actual library definition of the Result enum:<br/>
        pub enum Result&lt;T, E&gt; {<br/>
        &nbsp;Ok(T),<br/>
        &nbsp;Err(E),<br/>
        }
    </p>
    <p>
        Result takes two completely generic, non-constrained types T and E. All that the compiler can infer about what these
        two types are is that they can potentially be <em>different types</em> from each other.
    </p>
</div>

<div class="info">
    <p>
        The specific definition of first_of_vec() with <em>T: Copy</em> in the first example essentially means that first_of_vec() can take a vector containing elements of any one type,
        as long as that type <em>implements the Copy trait</em> (meaning it can be copied in memory instead of needing to be borrowed and referenced).
    </p>
</div>

<div class="info">
    <p>
        If the first_of_vec() example was implemented without the specification that values of type T are copyable (that is, if
        the function was defined as first_of_vec&lt;<b>T</b>&gt;() rather than first_of_vec&lt;<b>T: Copy</b>&gt;()), the code would fail to compile
        because the compiler can't infer enough about the parameter's typing or traits to know if its elements can be cloned or copied:
    </p>
    <p class="inline-err">
        error[E0507]: cannot move out of index of `Vec&lt;T&gt;`<br/>
        --> src/main.rs:2:5<br/>
        |<br/>
        2 |     v[0]<br/>
        |     &nbsp;&nbsp;^^^^ move occurs because value has type `T`, which does not implement the `Copy` trait<br/>
        |<br/>
        help: if `T` implemented `Clone`, you could clone the value<br/>
        --> src/main.rs:1:17<br/>
        |<br/>
        1 | fn first_of_vec&lt;T&gt;(v: Vec&lt;T&gt;) -> T {<br/>
        |                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^ consider constraining this type parameter with `Clone`<br/>
        2 |     v[0] // of type T, where T is copyable<br/>
        |     &nbsp;&nbsp;---- you could clone this value
    </p>
</div>

<div class="info">
    <p>
        One valid alternative to the syntax in the first example, however, is to introduce the trait binding at the end of the function typing (after the parameters and return type)
        with the <b>where</b> keyword:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+first_of_vec%3CT%3E%28v%3A+Vec%3CT%3E%29+-%3E+T+where+T%3A+Copy+%7B%0A++++v%5B0%5D%0A%7D%0A%0Afn+main%28%29+%7B%0A++++println%21%28%0A++++++++%22%7B%7D+%7B%7D+%7B%7D%22%2C%0A++++++++first_of_vec%28vec%21%5B1%2C+2%2C+3%5D%29%2C%0A++++++++first_of_vec%28vec%21%5B%22a%22%2C+%22b%22%2C+%22c%22%5D%29%2C%0A++++++++first_of_vec%28vec%21%5Btrue%2C+false%2C+false%5D%29%0A++++%29%0A%7D%0A" target="_blank">
        fn first_of_vec&lt;T&gt;(v: Vec&lt;T&gt;) -> T <b>where T: Copy</b> {<br/>
        &nbsp;v[0]<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;println!(<br/>
        &nbsp;&nbsp;"{} {} {}",<br/>
        &nbsp;&nbsp;first_of_vec(vec![1, 2, 3]),<br/>
        &nbsp;&nbsp;first_of_vec(vec!["a", "b", "c"]),<br/>
        &nbsp;&nbsp;first_of_vec(vec![true, false, false])<br/>
        &nbsp;)<br/>
        }

    </a></p>
</div>

<div class="info">
    <p>
        Traits are very important to work with when implementing generics, and how they define behaviour will be explained in more detail on the next page.
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/beyond">&laquo; Beyond the basics intro</a>
    <a href="https://fyp.cr0wbar.dev/beyond/2">Traits &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
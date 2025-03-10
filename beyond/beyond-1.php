<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Beyond the basics: generic types</title>
    <script src="../static/styletoggle.js"></script>
    <link rel="stylesheet" href="">
    <script>
        window.onload = function () {
        init_style();
    };
</script>
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
    <p class="inlinelink">
        fn first_of_vec&lt;T: Copy&gt;(v: Vec&lt;T&gt;) -> T {<br>
        &nbsp;v[0] // of type T, where T is copyable<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!(<br>
        &nbsp;&nbsp;"{} {} {}",<br>
        &nbsp;&nbsp;first_of_vec(vec![1, 2, 3]),<br>
        &nbsp;&nbsp;first_of_vec(vec!["a", "b", "c"]),<br>
        &nbsp;&nbsp;first_of_vec(vec![true, false, false])<br>
        &nbsp;)<br>
        }
    </p>
    <p>
        Note how the <em>first_of_vec()</em> function in the above example uses the angle bracket (< >) syntax previously seen for definitions of
        vectors, hash maps, and other built-in structs and enums in the standard Rust library.
    </p>
    <div>
        <?php
            example_exec("fn first_of_vec&lt;T: Copy&gt;(v: Vec&lt;T&gt;) -> T {
       v[0]
        }
        
        fn main() {
        println!(
        \"{} {} {}\",
        first_of_vec(vec![1, 2, 3]),
        first_of_vec(vec![\"a\", \"b\", \"c\"]),
        first_of_vec(vec![true, false, false])
        )
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        This is exactly how these other built-in features can behave in this manner: rather than exclusively take and return values of specific types,
        they are defined to take any type, as long as that type implements the required traits:
    </p>
    <p class="inlinelink">
        // The actual library definition of the Result enum:<br>
        pub enum Result&lt;T, E&gt; {<br>
        &nbsp;Ok(T),<br>
        &nbsp;Err(E),<br>
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
        error[E0507]: cannot move out of index of `Vec&lt;T&gt;`<br>
        --> src/main.rs:2:5<br>
        |<br>
        2 |     v[0]<br>
        |     &nbsp;&nbsp;^^^^ move occurs because value has type `T`, which does not implement the `Copy` trait<br>
        |<br>
        help: if `T` implemented `Clone`, you could clone the value<br>
        --> src/main.rs:1:17<br>
        |<br>
        1 | fn first_of_vec&lt;T&gt;(v: Vec&lt;T&gt;) -> T {<br>
        |                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^ consider constraining this type parameter with `Clone`<br>
        2 |     v[0] // of type T, where T is copyable<br>
        |     &nbsp;&nbsp;---- you could clone this value
    </p>
</div>

<div class="info">
    <p>
        One valid alternative to the syntax in the first example, however, is to introduce the trait binding at the end of the function typing (after the parameters and return type)
        with the <b>where</b> keyword:
    </p>
    <p class="inlinelink">
        fn first_of_vec&lt;T&gt;(v: Vec&lt;T&gt;) -> T <b>where T: Copy</b> {<br>
        &nbsp;v[0]<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!(<br>
        &nbsp;&nbsp;"{} {} {}",<br>
        &nbsp;&nbsp;first_of_vec(vec![1, 2, 3]),<br>
        &nbsp;&nbsp;first_of_vec(vec!["a", "b", "c"]),<br>
        &nbsp;&nbsp;first_of_vec(vec![true, false, false])<br>
        &nbsp;)<br>
        }
    </p>
    <div>
        <?php
        example_exec("fn first_of_vec&lt;T&gt;(v: Vec&lt;T&gt;) -> T where T: Copy {
        v[0]
        }
        
        fn main() {
        println!(
        \"{} {} {}\",
        first_of_vec(vec![1, 2, 3]),
        first_of_vec(vec![\"a\", \"b\", \"c\"]),
        first_of_vec(vec![true, false, false])
        )
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Fix the following code by adding the missing trait binding(s):</p>
    <?php exercise_exec("fn main() {\r\n\tlet string = \"String!\";\n\tdebug(string);\n}\n\nfn debug&lt;T&gt;(val: T) {\n\tprintln!(\"{}\", dbg!(val))\n}", 'exercise1'); ?>
    <p><b>Hint:</b> Pay attention to the error message. Multiple trait bindings for one generic are separated with the addition symbol (+).</p>
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

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
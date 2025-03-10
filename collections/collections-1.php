<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Collections: vectors</title>
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
        Vectors
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Vectors are the primary linear collection type in Rust. They are mutable, growable lists of values, represented as a struct in memory.
    </p>
</div>

<div class="info">
    <p>
        Vectors can be initialised in two main ways:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut fstvec: Vec&lt;i32&gt; = Vec::new(); // Constructor method<br>
        &nbsp;fstvec.push(10);<br>
        &nbsp;fstvec.push(5);<br>
            <br>
        &nbsp;let sndvec: Vec&lt;f64&gt; = vec![2.643, 4.219, 9.263]; // vec! macro<br>
            <br>
        &nbsp;println!("{:?} {:?}", fstvec, sndvec)<br>
        }  
    </p>
    <div>
        <?php
        example_exec("fn main() {
        let mut fstvec: Vec&lt;i32&gt; = Vec::new();
        fstvec.push(10);
        fstvec.push(5);
            
        let sndvec: Vec&lt;f64&gt; = vec![2.643, 4.219, 9.263]; 
            
        println!(\"{:?} {:?}\", fstvec, sndvec)
        }  ", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        As can be seen in the above example, there is a shorthand macro, <em>vec!</em>, for quickly initialising a vector and immediately filling it with values (although empty vectors can still be made by leaving the macro's square brackets empty).
        The shorthand syntax that can be used with arrays can also be used with this macro:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let vec: Vec&lt;f64&gt; = vec![23.45673; 10]; // creates vector with ten elements equal to this float<br>
        &nbsp;println!("{:?}", vec)<br>
        }
    </p>
    <div>
        <?php
        example_exec("fn main() {
        let vec: Vec&lt;f64&gt; = vec![23.45673; 10];
        println!(\"{:?}\", vec)
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        As with arrays, individual elements of vectors can be accessed with indexing...:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let vec: Vec&lt;i32&gt; = vec![56, 23, 78, 92, 108];<br>
        &nbsp;println!("{}", vec[2]) // prints 78 (zero-indexed)<br>
        }
    </p>
    <div>
        <?php
        example_exec("fn main() {
        let vec: Vec&lt;i32&gt; = vec![56, 23, 78, 92, 108];
        println!(\"{}\", vec[2])
        }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p>
        ...and iterated over with loops:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let vec: Vec&lt;i32&gt; = vec![12, 43, 5, 78, 32];<br>
        <br>
        &nbsp;for v in vec {<br>
        &nbsp;&nbsp;println!("{}", v);<br>
        &nbsp;}<br>
        }
    </p>
    <div>
        <?php
        example_exec("fn main() {
        let vec: Vec&lt;i32&gt; = vec![12, 43, 5, 78, 32];
        
        for v in vec {
        println!(\"{}\", v);
        }
        }", "example4");
        ?>
    </div>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Try initialising a vector of <em>chars</em>, before iterating over it with <b>.iter()</b> (remember the page on arrays and slices?):</p>
    <?php exercise_exec("fn main() {\r\n\t\n}", 'exercise1'); ?>
</div>

<div class="info">
    <p>
        Vectors also have a multitude of useful built-in methods (such as <b>push()</b>, demonstrated above) that allow for easily accessible operations on them and their elements. For example:
        <ul class="list">
            <li><b>insert(N, T):</b> adds variable T to vector at index N</li>
            <li><b>remove(N)</b>: returns the element at index N, deleting it from the vector</li>
            <li><b>push()</b> and <b>pop()</b> treat the given vector like a stack (data structure that only allows access and edits on one end):
            <ul>
                <li><b>push(T)</b>: adds variable T to the end of the vector if it matches the vector's type</li>
                <li><b>pop()</b>: removes last element from the vector</li>
            </ul>
            </li>
            <li>
                <b>append(&mut V)</b>: borrows another vector V and transfers all of its elements to the end of the given vector
            </li>
            <li>
                <b>truncate(N)</b>: shortens the vector down to the first N elements, deleting every element with an index that exceeds N
            </li>
        </ul>
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/collections">&laquo; Collections intro</a>
    <a href="https://fyp.cr0wbar.dev/collections/2">Hash maps &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
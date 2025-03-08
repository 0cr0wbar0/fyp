<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Ownership: slices</title>
    <link rel="stylesheet" href="../static/stylesheet.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
        Slices
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Where String structs consist of an allocated place in heap memory pointing to a sequence of characters on the stack, string slices (denoted as a type with &str) are only the latter part: an <em>ungrowable, fixed sequence</em> of Unicode characters pushed to the stack in order.
    </p>
</div>

<div class="animbox">
    <canvas id='slice' width="480px" height="324px"></canvas>
    <div class="nav">
        <button class="textsubmit" id='slice_anim_reset'>Play</button>
        <button class="textsubmit" id='slice_anim_pause'>Pause</button>
    </div>
</div>

<div class="info">
    <p>
        String slices aren't the only kind of slice. Generally, slices in Rust are <em>references to sequences of memory cells on the stack</em>. 
    </p>
</div>

<div class="info">
    <p>
        Vectors (explained later) are structs stored on the heap, and are mutable, but <em>arrays</em> in Rust are immutable sequences of stack memory:
    </p>
</div>

<div class="animbox">
    <canvas id='array' width="480px" height="334px"></canvas>
    <div class="nav">
        <button class="textsubmit" id='array_anim_reset'>Play</button>
        <button class="textsubmit" id='array_anim_pause'>Pause</button>
    </div>
</div>

<div class="info">
    <p>
        The syntax used to define the variable <em>arr</em> in the above example is shorthand for defining vectors and arrays in Rust: <em>[1;5]</em> means an array with five elements which all equal 1.
    </p>
</div>

<div class="info">
    <p>
        This is one of two primary ways that arrays can be defined in Rust, with the other method involving an explicit definition of <em>each element</em> to be in the array (for example, the array defined above could also be defined as <em>[1, 1, 1, 1, 1]</em>.)
    </p>
</div>

<div class="info">
    <p>
        Rust arrays (denoted with [T; N], where T is a primitive type and N is an unchanging size) and slices (denoted with [T] or &[T]) are so similar in data structure that all methods implemented for slices can be used on arrays.
    </p>
</div>

<div class="info">
    <p>
        Arrays can be iterated over with for loops, but they also implement a trait that allows for an <em>iterator</em> to be used on them:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let arr: [usize; 5] = [1, 2, 3, 4, 5];<br>
        &nbsp;for n in arr {<br>
        &nbsp;&nbsp;println!("{}", n); // conventional for loop<br>
        &nbsp;}<br>
        &nbsp;println!();
        <br>
        &nbsp;for i in arr.iter() { // iter() method creates an iterator for arr<br>
        &nbsp;&nbsp;println!("{}", i)<br>
        &nbsp;}<br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let arr: [usize; 5] = [1, 2, 3, 4, 5];
        for n in arr {
        println!(\"{}\", n);
        }
        println!();
        for i in arr.iter() {
        println!(\"{}\", i)
        }
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Iterators are implemented for most, if not all, of Rust's built-in collection types, like arrays, vectors and hash maps (the latter two are further explained in the Collections chapter).
    </p>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Add appropriate type annotations to the incorrectly typed code below:</p>
    <?php exercise_exec("fn main() {\n\tlet arr: [char; 10] = [6,7,8,9,10];\n\tlet chars: String = \"String struct!\";\n}", 'exercise1'); ?>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/ownership/3">&laquo; Stack & Heap Memory</a>
    <a href="https://fyp.cr0wbar.dev/ownership/quiz">Quiz &raquo;</a>
</div>

<script src="../static/sprites.min.js"></script>
<script>
    let slice = new Sprite( {
        src: '../static/string_slice.png',
        id: 'slice',
        width: 480,
        height: 324,
        image_width: 17280,
        err: true
    });

    let array = new Sprite( {
        src: '../static/array.png',
        id: 'array',
        width: 480,
        height: 334,
        image_width: 14880,
        err: true
    });

    document.getElementById("slice_anim_reset").onclick = function () {
        if (document.getElementById("slice_anim_reset").innerHTML !== "Play") {
            document.getElementById("slice_anim_reset").innerHTML = "Play";
        }
        slice.play( {
            fps: 5,
            from: 1,
            n: 0
        });
    }

    document.getElementById("slice_anim_pause").onclick = function () {
        slice.pause();
        document.getElementById("slice_anim_reset").innerHTML = "Reset";
    }

    document.getElementById("array_anim_reset").onclick = function () {
        if (document.getElementById("array_anim_reset").innerHTML !== "Play") {
            document.getElementById("array_anim_reset").innerHTML = "Play";
        }
        array.play( {
            fps: 5,
            from: 1,
            n: 0
        });
    }

    document.getElementById("array_anim_pause").onclick = function () {
        array.pause();
        document.getElementById("array_anim_reset").innerHTML = "Reset";
    }
</script>
<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>

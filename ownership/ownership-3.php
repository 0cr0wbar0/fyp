<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Ownership: stack & heap memory</title>
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
        Stack Memory & Heap Memory
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Like for most programming languages, the Rust runtime manages its stored variables, functions, macros and other such pieces of data in two distinct areas of memory: <b>stack</b> memory and <b>heap</b> memory.
    </p>
</div>

<div class="info">
    <p>
        Whether a variable is stored in the stack or in the heap depends on its data type, particularly, <em>whether the size of a variable of that data type can be known at compile-time</em>.
    </p>
</div>

<div class="info">
    <p>
        Learning this distinction may seem daunting, but understanding it will also further understanding of Rust's ownership system, since memory management is handled with ownership in such a way 
        that most Rust programmers won't need to concern themselves with it, even without a garbage collector.
    </p>
</div>

<div class="info">
    <p>
        Stack memory:
        <ul class="list">
            <li>is a <b>last-in-first-out (LIFO)</b> memory space; for some value to be removed, every value that entered after it must be removed first</li>
            <li>stores values with sizes that are <b>already known</b> and <b>are unchangeable</b></li>
            <li><em>pushes</em> (inserts) values when assigned and <em>pops</em> (removes) them from the stack when they're destructed</li>
            <li>push & pop operations are very fast, as the position from which to add or remove never changes</li>
        </ul>
    </p>
</div>

<div class="animbox">
    <canvas id='stack' width="480px" height="231px"></canvas>
    <div class="nav">
        <button class="textsubmit" id='stack_anim_reset'>Play</button>
        <button class="textsubmit" id='stack_anim_pause'>Pause</button>
    </div>
</div>

<div class="info">
    <p>
        Heap memory:
        <ul class="list">
            <li>is a less structured, more open memory space</li>
            <li>stores values with <b>unknown initial sizes</b> that <b>may change during execution</b></li>
            <li>space is <b>allocated and deallocated</b> instead of pushed and popped</li>
            <li>allocation is slower and more expensive than stack operations, as the runtime constantly needs to distinguish between used memory and free memory</li>
        </ul>
    </p>
</div>

<div class="animbox">
    <canvas id='heap' width="480px" height="380px"></canvas>
    <div class="nav">
        <button class="textsubmit" id='heap_anim_reset'>Play</button>
        <button class="textsubmit" id='heap_anim_pause'>Pause</button>
    </div>
</div>

<div class="info">
    <p>
        As mentioned on the previous page, C and C++ allow programmers to handle memory manually. More specifically, C allows programmers to manually <em>allocate, reallocate and deallocate spaces on the heap</em>. 
    </p>
</div>

<div class="info">
    <p>
        Rust, on the other hand, will automatically perform these operations on the heap, depending on the ownership status of a value.
    </p>
</div>

<div class="info">
    <p>
        Recall the two string data types mentioned in the last chapter: since String structs are <em>mutable</em>, they are allocated in heap memory, whereas string slices (explained in more detail on the next page) are <em>immutable</em>, and pushed to the stack during execution.
    </p>
</div>

<div class="info">
    <p>
        Specifically, String structs are allocated on the heap during their lifetimes, but the actual body of the string is <em>stored on the stack</em>, and the struct has a memory pointer to the first character of the string.
    </p>
    <p class="inlinelink">
        fn main() {<br>
            <br>
        &nbsp;/// The below string struct is built using from(),<br>
        &nbsp;/// a built-in method that attempts to convert <br>
        &nbsp;/// a variable of one type into another type.<br>
        &nbsp;/// <br>
        &nbsp;/// Here, a string literal (a.k.a. a value of type &str)<br>
        &nbsp;/// is pushed onto the stack character by character, <br>
        &nbsp;/// and the struct is then allocated in <br>
        &nbsp;/// heap memory and has its pointer set to the string literal.<br>
        <br>
        &nbsp;let str_struct = String::from("This is a struct!");<br>
        <br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let _str_struct = String::from(\"This is a struct!\");
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        When the struct is assigned a new set of characters, these characters are simply pushed onto the stack, and the String struct's pointer is moved to those new characters. The old sequence of characters subsequently goes out of scope, and is eventually popped from the stack.
    </p>
    <p class="inlinelink">
        fn main() {<br>
            <br>
        &nbsp;/// When the below struct is given<br>
        &nbsp;/// a new value on the second line, <br>
        &nbsp;/// its pointer is moved to the new <br>
        &nbsp;/// string literal, and the previous<br>
        &nbsp;/// string literal goes out of scope.<br>
            <br>
        &nbsp;let mut str_struct = String::from("This is a struct!");<br>
            <br>
        &nbsp;str_struct = String::from("This is a new string!");<br>
        <br>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let mut _str_struct = String::from(\"This is a struct!\");
        _str_struct = String::from(\"This is a new string!\");
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        However, in the case of one String struct being assigned to another, the one taking the value will have its pointer moved to the <em>same memory as the struct being assigned</em>. This is to save memory, and prevent bloat on the stack.
    </p>
    <p class="inlinelink">
        fn main() {<br>
            <br>
        &nbsp;/// Assigning the first variable<br>
        &nbsp;/// to the second will move ownership<br>
        &nbsp;/// of the first, making it inaccessible,<br>
        &nbsp;/// but will also cause both structs to<br>
        &nbsp;/// point to the same sequence of memory<br>
        &nbsp;/// cells on the stack.<br>
            <br>
        &nbsp;let str_struct = String::from("This is a struct!");<br>
            <br>
        &nbsp;let second_struct = str_struct;<br>
            <br>
        }
    </p>
    <div>
        <?php
        example_exec("fn main() {
        let _str_struct = String::from(\"This is a struct!\");
        let _second_struct = _str_struct;
        }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Values stored exclusively on the stack are known by the compiler to never change in storage size during execution, such as integers, booleans and single characters. However, if these need to be stored in a dynamic context for whatever reason, Rust offers a <em>generic</em> (explained later) called <b>Box.</b>
    </p>
</div>

<div class="info">
    <p>
        The Box generic allocates heap memory for a given variable, before pushing a pointer to this memory space onto the stack. A variable is said to be <b>boxed</b> if it is being explicitly stored on the heap using this generic, when it would normally be stored on the stack.
    </p>
</div>

<div class="animbox">
    <canvas id='boxed' width="480px" height="309px"></canvas>
    <div class="nav">
        <button class="textsubmit" id='boxed_anim_reset'>Play</button>
        <button class="textsubmit" id='boxed_anim_pause'>Pause</button>
    </div>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/ownership/2">&laquo; References</a>
    <a href="https://fyp.cr0wbar.dev/ownership/4">Slices &raquo;</a>
</div>

<script src="../static/sprites.min.js"></script>
<script>
    let stack = new Sprite( {
        src: '../static/stack.png',
        id: 'stack',
        width: 480,
        height: 231,
        image_width: 38880,
        err: true
    });

    let heap = new Sprite( {
        src: '../static/heap.png',
        id: 'heap',
        width: 480,
        height: 380,
        image_width: 17280,
        err: true
    });

    let boxed = new Sprite( {
        src: '../static/boxed.png',
        id: 'boxed',
        width: 480,
        height: 309,
        image_width: 11520,
        err: true
    });

    document.getElementById("stack_anim_reset").onclick = function () {
        if (document.getElementById("stack_anim_reset").innerHTML !== "Play") {
            document.getElementById("stack_anim_reset").innerHTML = "Play";
        }
        stack.play( {
            fps: 5,
            from: 1,
            to: 81,
            n: 0
        });
    }

    document.getElementById("stack_anim_pause").onclick = function () {
        stack.pause();
        document.getElementById("stack_anim_reset").innerHTML = "Reset";
    }

    document.getElementById("heap_anim_reset").onclick = function () {
        if (document.getElementById("heap_anim_reset").innerHTML !== "Play") {
            document.getElementById("heap_anim_reset").innerHTML = "Play";
        }
        heap.play( {
            fps: 5,
            from: 1,
            to: 36,
            n: 0
        });
    }

    document.getElementById("heap_anim_pause").onclick = function () {
        heap.pause();
        document.getElementById("heap_anim_reset").innerHTML = "Reset";
    }

    document.getElementById("boxed_anim_reset").onclick = function () {
        if (document.getElementById("boxed_anim_reset").innerHTML !== "Play") {
            document.getElementById("boxed_anim_reset").innerHTML = "Play";
        }
        boxed.play( {
            fps: 5,
            from: 1,
            to: 24,
            n: 0
        });
    }

    document.getElementById("boxed_anim_pause").onclick = function () {
        boxed.pause();
        document.getElementById("boxed_anim_reset").innerHTML = "Reset";
    }

</script>
<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>

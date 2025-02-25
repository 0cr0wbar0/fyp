<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Collections: vectors</title>
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
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+mut+fstvec%3A+Vec%3Ci32%3E+%3D+Vec%3A%3Anew%28%29%3B+%2F%2F+Initialised+with+struct+constructor%0A++++fstvec.push%2810%29%3B%0A++++fstvec.push%285%29%3B%0A++++%0A++++let+sndvec%3A+Vec%3Cf64%3E+%3D+vec%21%5B2.643%2C+4.219%2C+9.263%5D%3B+%2F%2F+Initialised+with+vec%21+macro%0A%0A++++println%21%28%22%7B%3A%3F%7D+%7B%3A%3F%7D%22%2C+fstvec%2C+sndvec%29%0A%7D%0A" target="_blank">
        fn main() {<br/>
        &nbsp;let mut fstvec: Vec&lt;i32&gt; = Vec::new(); // Constructor method<br/>
        &nbsp;fstvec.push(10);<br/>
        &nbsp;fstvec.push(5);<br/>
            <br/>
        &nbsp;let sndvec: Vec&lt;f64&gt; = vec![2.643, 4.219, 9.263]; // vec! macro<br/>
            <br/>
        &nbsp;println!("{:?} {:?}", fstvec, sndvec)<br/>
        }  
    </a></p>
</div>

<div class="info">
    <p>
        As can be seen in the above example, there is a shorthand macro, <em>vec!</em>, for quickly initialising a vector before immediately filling it with values (although empty vectors can still be made by leaving the macro's square brackets empty).
        The shorthand syntax that can be used with arrays can also be used with this macro:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+vec%3A+Vec%3Cf64%3E+%3D+vec%21%5B23.45673%3B+10%5D%3B+%2F%2F+creates+vector+with+ten+elements+equal+to+this+float%0A++++println%21%28%22%7B%3A%3F%7D%22%2C+vec%29%0A%7D%0A" target="_blank">
        fn main() {<br/>
        &nbsp;let vec: Vec&lt;f64&gt; = vec![23.45673; 10]; // creates vector with ten elements equal to this float<br/>
        &nbsp;println!("{:?}", vec)<br/>
        }
    </a></p>
</div>

<div class="info">
    <p>
        As with arrays, individual elements of vectors can be accessed with indexing...:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+vec%3A+Vec%3Ci32%3E+%3D+vec%21%5B56%2C+23%2C+78%2C+92%2C+108%5D%3B+%0A++++println%21%28%22%7B%7D%22%2C+vec%5B2%5D%29+%2F%2F+prints+78+%28zero-indexed%29%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let vec: Vec&lt;i32&gt; = vec![56, 23, 78, 92, 108];<br/>
        &nbsp;println!("{}", vec[2]) // prints 78 (zero-indexed)<br/>
        }
    </a></p>
</div>

<div class="info">
    <p>
        ...and iterated over with loops:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+vec%3A+Vec%3Ci32%3E+%3D+vec%21%5B12%2C+43%2C+5%2C+78%2C+32%5D%3B+%0A++++%0A++++for+v+in+vec+%7B%0A++++++++println%21%28%22%7B%7D%22%2C+v%29%3B%0A++++%7D%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let vec: Vec&lt;i32&gt; = vec![12, 43, 5, 78, 32];<br/>
        <br/>
        &nbsp;for v in vec {<br/>
        &nbsp;&nbsp;println!("{}", v);<br/>
        &nbsp;}<br/>
        }
    </a></p>
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

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
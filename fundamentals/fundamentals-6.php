<?php
session_start();
require "../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Fundamentals: control flow</title>
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
        Control Flow
    </h1>

    <h3 class="subheader">
        conditionals, for-loops, while-loops and...just...loops?
    </h3>
</div>

<div class="info">
    <p> 
        If-statements in Rust do not need parentheses around their conditions, like with Java or C:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+i+%3D+5%3B%0A++++if+i+%3D%3D+0+%7B%0A++++++++println%21%28%22Zero%21%22%29%3B+%2F%2F+Compiles%2C+does+not+execute%0A++++%7D+else+%7B%0A++++++++println%21%28%22%F0%9F%98%94%22%29%3B%0A++++%7D%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let i = 5;<br/>
        &nbsp;if i == 0 {<br/>
            &nbsp;&nbsp;println!("Zero!"); // Compiles, does not execute<br/>
        &nbsp;} else {<br/>
        &nbsp;&nbsp;println!("😔");<br/>
        &nbsp;}<br/>
        }<br/>
    </a></p>
</div>

<div class="info">
    <p>
        The result of an if-statement can immediately be assigned to a variable in Rust:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+i+%3D+5%3B%0A++++let+j+%3D+if+i+%3E+2+%7B10%7D+else+%7B0%7D%3B%0A++++println%21%28%22%7B%7D%22%2C+i+%2B+j%29%3B%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let i = 5;<br/>
        &nbsp;let j = if i > 2 {10} else {0};<br/>
        &nbsp;println!("{}", i + j);<br/>
        }
    </a></p>
</div>

<div class="info">
    <p>
        For-loops in Rust are syntactically similar to if-statements, as they also do not need parentheses:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++++++for+i+in+0..10+%7B+%2F%2F+For-loop+with+range%0A++++++++++++println%21%28%22%7B%7D%22%2C+i*i%29%3B%0A++++++++%7D%0A++++++++println%21%28%22%5Cn%22%29%3B%0A++++++++let+arr+%3D+vec%21%5B5%3B+10%5D%3B+%2F%2F+Creates+vector+with+10+elements%2C+each+element+being+the+int+5%0A++++++++for+j+in+arr+%7B+%2F%2F+For-loop+with+iterable+structure%2C+like+a+vector%0A++++++++++++println%21%28%22%7B%7D%22%2C+j*j%29%3B%0A++++++++%7D%0A++++%7D" target="_blank">
        fn main() {<br/>
        &nbsp;for i in 0..10 { // For-loop with range<br/>
        &nbsp;&nbsp;println!("{}", i*i);<br/>
        &nbsp;}<br/>
        <br/>
        &nbsp;println!("\n");
        &nbsp;let arr = vec![5; 10]; // Creates vector with 10 elements, each element being the int 5<br/>
        &nbsp;for j in arr { // For-loop with iterable structure, like a vector<br/>
        &nbsp;&nbsp;println!("{}", j*j);<br/>
        &nbsp;}<br/>
    }
    </a></p>
    <p>
        As can be seen in the above example, <em>ranges</em> in Rust are defined with a double full stop between the lower and upper bounds. 
        Variable <em>i</em> acts as an iterator for all integers between 0 and 10 (including 0, but excluding 10 - Rust ranges exclude the last element by default), while variable <em>j</em> iterates for all elements of <em>arr</em>.
    </p>
</div>

<div class="info">
    <p>
        Whether a Rust range includes or excludes the ending element can be specified:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+mut+v%3A+Vec%3Ci32%3E+%3D+Vec%3A%3Anew%28%29%3B%0A++++for+i+in+0..%3D100+%7B+%2F%2F+Equals+sign+means+that+range+is+fully+inclusive%0A++++++++v.push%28i%29%3B%0A++++%7D%0A++++println%21%28%22%7B%3A%3F%7D%22%2C+v%29%3B%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let mut v: Vec&lt;i32&gt; = Vec::new();<br/>
        &nbsp;for i in 0..=100 { // Equals sign means that range is fully inclusive<br/>
        &nbsp;&nbsp;v.push(i);<br/>
        &nbsp;}<br/>
        &nbsp;&nbsp;println!("{:?}", v);
        }
    </a></p>
</div>

<div class="info">
    <p>
        Rust also has a third kind of loop, simply defined with the keyword <em>loop</em>, that is designed to run infinitely. The only way for the loop to finish execution is manually, with the <em>break</em> keyword:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+mut+x+%3D+0%3B%0A++++loop+%7B%0A++++++++x++%3D+1%3B%0A++++++++if+x+%3D%3D+20+%7B%0A++++++++++++break%3B%0A++++++++%7D%0A++++%7D%0A++++println%21%28%22%7B%7D%22%2C+x%29%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let mut x = 0;<br/>
        &nbsp;loop {<br/>
        &nbsp;&nbsp;x += 1;<br/>
        &nbsp;&nbsp;if x == 20 {<br/>
        &nbsp;&nbsp;&nbsp;break;<br/>  
        &nbsp;&nbsp;}<br/>
        &nbsp;}<br/>
        &nbsp;println!("{}", x)<br/>
        }
    </a></p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals/5">&laquo; Functions</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/7">Comments & Docs &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
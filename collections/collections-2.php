<?php
session_start();
require "../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Collections: hash maps</title>
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
        Hash Maps
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Like in many programming languages, hash maps in Rust are data structures that associate <b>keys</b> to <b>values</b> in a linear list of pairs.
        Accessing a value in a hash map via its corresponding key is an extremely efficient and computationally inexpensive process.
    </p>
</div>

<div class="info">
    <p>
        In a similar manner to vectors, hash maps can be initialised with their constructor method <b>new()</b>:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=use+std%3A%3Acollections%3A%3AHashMap%3B%0A%0Afn+main%28%29+%7B%0A++++let+mut+map%3A+HashMap%3Cisize%2C+%26str%3E+%3D+HashMap%3A%3Anew%28%29%3B%0A++++%0A++++map.insert%281%2C+%22h%22%29%3B+%2F%2F+1+is+the+key%2C+%22h%22+is+the+value%0A++++map.insert%282%2C+%22i%22%29%3B%0A++++map.insert%283%2C+%22%21%22%29%3B%0A++++%0A++++println%21%28%22%7B%7D%7B%7D%7B%7D%22%2C+map%5B%261%5D%2C+map%5B%262%5D%2C+map%5B%263%5D%29%0A%7D" target="_blank">
        use std::collections::HashMap;<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let mut map: HashMap&lt;isize, &str&gt; = HashMap::new();<br/>
        <br/>
        &nbsp;map.insert(1, "h"); // 1 is the key, "h" is the value<br/>
        &nbsp;map.insert(2, "i");<br/>
        &nbsp;map.insert(3, "!");<br/>
        <br/>
        &nbsp;println!("{}{}{}", map[&1], map[&2], map[&3])<br/>
        }
    </a></p>
    <p>
        Unlike vectors, however, as can be seen on the first line of the above example, hash maps may not immediately be available, and may need to be imported from the <em>collections</em> module in the standard crate.
    </p>
</div>

<div class="info">
    <p>
        For the sake of clarity when working with hash maps, the type of the data structure can be specified (the above example creates a hash map with integer keys and string slice values), but this is ultimately not required for the compiler to infer the type of the hash map.
    </p>
</div>

<div class="info">
    <p>
        The hash map struct has many methods implemented for it to simplify the process of working with this data structure, such as <em>get(K)</em>,
        which takes a key K and returns a reference for its value, if it exists:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=use+std%3A%3Acollections%3A%3AHashMap%3B%0A%0Afn+main%28%29+%7B%0A+let+mut+map+%3D+HashMap%3A%3Anew%28%29%3B%0A%0A+map.insert%281%2C+%22h%22%29%3B%0A+map.insert%282%2C+%22i%22%29%3B%0A+map.insert%283%2C+%22%21%22%29%3B%0A%0A+println%21%28%22%7B%7D%22%2C+map.get%28%263%29.unwrap%28%29%29%0A%7D" target="_blank">
        use std::collections::HashMap;<br>
        <br>
        fn main() {<br>
        &nbsp;let mut map = HashMap::new();<br>
        <br>
        &nbsp;map.insert(1, "h");<br>
        &nbsp;map.insert(2, "i");<br>
        &nbsp;map.insert(3, "!");<br>
        <br>
        &nbsp;println!("{}", map.get(&3).unwrap())<br>
        }
    </a></p>
    <p>
        In order to handle the possibility of accessing a key that doesn't exist, this method returns an <em>Option</em> that needs to be unwrapped (explained in the chapter on error handling).
        Additionally, as can be seen in both this example and the previous example, many methods that make accesses to hash maps <em>expect a reference</em> to a numerical index rather than an actual numerical value.
    </p>
</div>

<div class="info">
    <p>
        Rust hash map structs have three particularly useful built-in methods that allow for iterations over specific parts of the hash map: <em>keys(), values()</em> and <em>iter().</em>
    </p>
</div>

<div class="info">
    <p>
        <em>keys()</em> allows for exclusive iteration over the hash map's keys, and <em>values()</em> offers the same for the hash map's values:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=use+std%3A%3Acollections%3A%3AHashMap%3B%0A%0Afn+main%28%29+%7B%0A++++let+mut+map+%3D+HashMap%3A%3Anew%28%29%3B%0A++++%0A++++map.insert%281%2C+%22h%22%29%3B%0A++++map.insert%282%2C+%22e%22%29%3B%0A++++map.insert%283%2C+%22l%22%29%3B%0A++++map.insert%284%2C+%22l%22%29%3B%0A++++map.insert%285%2C+%22o%22%29%3B%0A++++map.insert%286%2C+%22%21%22%29%3B%0A++++%0A++++for+i+in+map.keys%28%29+%7B%0A++++++++println%21%28%22%7B%7D%22%2C+i%29%0A++++%7D%0A++++println%21%28%29%3B%0A++++for+c+in+map.values%28%29+%7B%0A++++++++println%21%28%22%7B%7D%22%2C+c%29%0A++++%7D%0A%7D" target="_blank">
        use std::collections::HashMap;<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let mut map = HashMap::new();<br/>
        <br/>
        &nbsp;map.insert(1, "h");<br/>
        &nbsp;map.insert(2, "e");<br/>
        &nbsp;map.insert(3, "l");<br/>
        &nbsp;map.insert(4, "l");<br/>
        &nbsp;map.insert(5, "o");<br/>
        &nbsp;map.insert(6, "!");<br/>
        <br/>
        &nbsp;for i in map.keys() {<br/>
        &nbsp;&nbsp;println!("{}", i)<br/>
        &nbsp;}<br/>
        &nbsp;println!();<br/>
        &nbsp;for c in map.values() {<br/>
        &nbsp;&nbsp;println!("{}", c)<br/>
        &nbsp;}<br/>
        }
    </a></p>
    <p>Note that <em>keys()</em> and <em>values()</em> return their results in a random order every time they are used.</p>
</div>

<div class="info">
    <p>
        <em>iter()</em> returns all key-value pairs in the hash map, while <em>iter_mut() returns a mutable reference to the value of each pair</em>, which can be very helpful if any edits need to be made to the values in respect to the keys:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=use+std%3A%3Acollections%3A%3AHashMap%3B%0A%0Afn+main%28%29+%7B%0A++++let+mut+map+%3D+HashMap%3A%3Anew%28%29%3B%0A++++%0A++++map.insert%281%2C+%22h%22%29%3B%0A++++map.insert%282%2C+%22e%22%29%3B%0A++++map.insert%283%2C+%22l%22%29%3B%0A++++map.insert%284%2C+%22l%22%29%3B%0A++++map.insert%285%2C+%22o%22%29%3B%0A++++map.insert%286%2C+%22%21%22%29%3B%0A++++%0A++++for+%28k%2C+v%29+in+map.iter_mut%28%29+%7B%0A++++++++if+k+%25+2+%21%3D+0+%7B%0A++++++++++++*v+%3D+%22_%22%3B%0A++++++++%7D%0A++++%7D%0A++++%0A++++println%21%28%22%7B%3A%3F%7D%22%2C+map%29%0A++++%0A%7D" target="_blank">
        use std::collections::HashMap;<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let mut map = HashMap::new();<br/>
        <br/>
        &nbsp;map.insert(1, "h");<br/>
        &nbsp;map.insert(2, "e");<br/>
        &nbsp;map.insert(3, "l");<br/>
        &nbsp;map.insert(4, "l");<br/>
        &nbsp;map.insert(5, "o");<br/>
        &nbsp;map.insert(6, "!");<br/>
        <br/>
        &nbsp;for (k, v) in map.iter_mut() {<br/>
        &nbsp;&nbsp;if k % 2 != 0 {<br/>
        &nbsp;&nbsp;&nbsp;*v = "_";<br/>
        &nbsp;&nbsp;}<br/>
        &nbsp;}<br/>
        <br/>
        &nbsp;println!("{:?}", map)<br/>
        <br>
        }
    </a></p>
    <p>
        <em>iter()</em> and <em>iter_mut()</em> also return their elements in a random order.
    </p>
</div>

<div class="info">
    <p>
        As a side note, notice that in this example, each value being edited needs to be <em>dereferenced</em> with an asterisk (*).
        Where <em>referencing</em> a variable is done with an ampersand (&), and allows for that variable to be used elsewhere in memory by passing its address,
        dereferencing is the opposite of this process, using the memory address contained in a reference to access the original variable.
    </p>
</div>

<div class="info">
    <p>
        This syntax will likely be familiar to those with previous C or C++ experience. Rust occasionally makes use of dereferencing syntax in more advanced contexts,
        but since those mostly go beyond the limits of this introductory course's scope, this should be enough information on C-like dereferencing.
    </p>
</div>


</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/collections/1">&laquo; Vectors</a>
    <a href="https://fyp.cr0wbar.dev/collections/quiz">Quiz &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
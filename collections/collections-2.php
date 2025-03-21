<?php
session_start();
require __DIR__."/../rustrunner.php";
require __DIR__."/../init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Collections: hash maps</title>
    <script src="../static/styletoggle.js"></script>
    <link rel="stylesheet" href=<?=init_style()?>>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut_icon" type="image/png" href="../static/shocked_hugh.ico">
    <link rel="apple-touch-icon" href="../static/shocked_hugh.png">
    <link rel="icon" type="image/x-icon" href="../static/shocked_hugh.ico">
</head>

<body id="background">

<div class="navbar">
    <a href="../home.php">Homepage</a>
<div class="dropdown">
        <button class="dropbtn">Change Theme &darr;</button>
        <div class="dropdown-content">
            <button onclick="styleToggle('/static/stylesheet.css')">Rusty</button>
            <button onclick="styleToggle('/static/lush.css')">Lush</button>
            <button onclick="styleToggle('/static/mono.css')">Monochrome</button>
        </div>
    </div>
    <?php if (!isset($_SESSION["user_id"])) {?>
        <a href="../login.php">Login</a>
    <?php
    } else {
        $username = $_SESSION["username"];?>
        <div class="dropdown">
            <button class="dropbtn">Welcome, <?=$username?></button>
            <div class="dropdown-content">
                <a href="../profile.php">User profile</a>
                <a href="../logout.php">Log out</a>
            </div>
        </div>
    <?php }
    ?>
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
    <p class="inlinelink">
        use std::collections::HashMap;<br>
        <br>
        fn main() {<br>
        &nbsp;let mut map: HashMap&lt;isize, &str&gt; = HashMap::new();<br>
        <br>
        &nbsp;map.insert(1, "h"); // 1 is the key, "h" is the value<br>
        &nbsp;map.insert(2, "i");<br>
        &nbsp;map.insert(3, "!");<br>
        <br>
        &nbsp;println!("{}{}{}", map[&1], map[&2], map[&3])<br>
        }
    </p>
    <p>
        Unlike vectors, however, as can be seen on the first line of the above example, hash maps may not immediately be available, and may need to be imported from the <em>collections</em> module in the standard crate.
    </p>
    <div>
        <?php
            example_exec("use std::collections::HashMap;
            fn main() {
        let mut map: HashMap&lt;isize, &str&gt; = HashMap::new();
        
        map.insert(1, \"h\");
        map.insert(2, \"i\");
        map.insert(3, \"!\");
        
        println!(\"{}{}{}\", map[&1], map[&2], map[&3])
        }", "example1");
        ?>
    </div>
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
    <p class="inlinelink">
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
    </p>
    <p>
        In order to handle the possibility of accessing a key that doesn't exist, this method returns an <em>Option</em> that needs to be unwrapped (explained in the chapter on error handling).
        Additionally, as can be seen in both this example and the previous example, many methods that make accesses to hash maps <em>expect a reference</em> to a numerical index rather than an actual numerical value.
    </p>
    <div>
        <?php
            example_exec("use std::collections::HashMap;
        fn main() {
        let mut map = HashMap::new();
        
        map.insert(1, \"h\");
        map.insert(2, \"i\");
        map.insert(3, \"!\");
        
        println!(\"{}\", map.get(&3).unwrap())
        }", "example2");
        ?>
    </div>
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
    <p class="inlinelink">
        use std::collections::HashMap;
        <br>
        fn main() {<br>
        &nbsp;let mut map = HashMap::new();<br>
        <br>
        &nbsp;map.insert(1, "h");<br>
        &nbsp;map.insert(2, "e");<br>
        &nbsp;map.insert(3, "l");<br>
        &nbsp;map.insert(4, "l");<br>
        &nbsp;map.insert(5, "o");<br>
        &nbsp;map.insert(6, "!");<br>
        <br>
        &nbsp;for i in map.keys() {<br>
        &nbsp;&nbsp;println!("{}", i)<br>
        &nbsp;}<br>
        &nbsp;println!();<br>
        &nbsp;for c in map.values() {<br>
        &nbsp;&nbsp;println!("{}", c)<br>
        &nbsp;}<br>
        }
    </p>
    <p>Note that <em>keys()</em> and <em>values()</em> return their results in a random order every time they are used.</p>
    <div>
        <?php
            example_exec("use std::collections::HashMap;
        
        fn main() {
        let mut map = HashMap::new();
        
        map.insert(1, \"h\");
        map.insert(2, \"e\");
        map.insert(3, \"l\");
        map.insert(4, \"l\");
        map.insert(5, \"o\");
        map.insert(6, \"!\");
        
        for i in map.keys() {
        println!(\"{}\", i)
        }
        println!();
        for c in map.values() {
        println!(\"{}\", c)
        }
        }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p>
        <em>iter()</em> returns all key-value pairs in the hash map, while <em>iter_mut() returns a mutable reference to the value of each pair</em>, which can be very helpful if any edits need to be made to the values in respect to the keys:
    </p>
    <p class="inlinelink">
        use std::collections::HashMap;<br>
        <br>
        fn main() {<br>
        &nbsp;let mut map = HashMap::new();<br>
        <br>
        &nbsp;map.insert(1, "h");<br>
        &nbsp;map.insert(2, "e");<br>
        &nbsp;map.insert(3, "l");<br>
        &nbsp;map.insert(4, "l");<br>
        &nbsp;map.insert(5, "o");<br>
        &nbsp;map.insert(6, "!");<br>
        <br>
        &nbsp;for (k, v) in map.iter_mut() {<br>
        &nbsp;&nbsp;if k % 2 != 0 {<br>
        &nbsp;&nbsp;&nbsp;*v = "_";<br>
        &nbsp;&nbsp;}<br>
        &nbsp;}<br>
        <br>
        &nbsp;println!("{:?}", map)<br>
        <br>
        }
    </p>
    <p>
        <em>iter()</em> and <em>iter_mut()</em> also return their elements in a random order.
    </p>
    <div>
        <?php
            example_exec("use std::collections::HashMap;
        
        fn main() {
        let mut map = HashMap::new();
        
        map.insert(1, \"h\");
        map.insert(2, \"e\");
        map.insert(3, \"l\");
        map.insert(4, \"l\");
        map.insert(5, \"o\");
        map.insert(6, \"!\");
        
        for (k, v) in map.iter_mut() {
        if k % 2 != 0 {
        *v = \"_\";
        }
        }
        
        println!(\"{:?}\", map)
        }", "example4");
        ?>
    </div>
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

<div class="info">
    <p><b>Exercise:<br></b>Define a function <em>get_reverse()</em> for the hash map below that, given a hash map and a &str value, returns its i32 key, or zero if the key can't be found:</p>
    <?php exercise_exec("use std::collections::HashMap;\n\nfn main() {\r\n\tlet map: &lt;i32, &str&gt; = HashMap::new();\n\tmap.insert(1, \"s\");\t
        map.insert(2, \"t\");\t
        map.insert(3, \"r\");\t
        map.insert(4, \"i\");\t
        map.insert(5, \"n\");\t
        map.insert(6, \"g\");\n\n\tprintln!(\"{}\", get_reverse(map, \"i\"))\n}", 'exercise1'); ?>
    <p><br><b>Hint:</b> if you use iter_mut(), you may have to dereference the keys and values being iterated over! Pay close attention to any error messages, many of them will offer direct inline fixes.</p>
</div>

</div>

<div class="nav">
    <a href="./collections-1.php">&laquo; Vectors</a>
    <a href="./collections-quiz.php">Quiz &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
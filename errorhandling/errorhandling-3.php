<?php
session_start();
require __DIR__."/../rustrunner.php";
require __DIR__."/../init_style.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Error handling: the Result enum</title>
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
        The Result Enum
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Where the panic!() macro is primarily for terminating a program by force due to a completely unworkable error,
        the Result enum, very similar to the Option enum explained recently, is for handling errors that are <em>anticipated</em> in the execution of a method or function.
    </p>
</div>

<div class="info">
    <p>
        A return value of the Result type can be precisely one of two variants:
        <ul class="list">
        <li><b>Ok(V)</b>: A successful execution, with a return value V</li>
        <li><b>Err(E)</b>: An encountered error, with an error message E</li>
        </ul>
    </p>
</div>

<div class="info">
    <p>
        The primary difference between using the panic!() macro and using the Result enum when error handling in Rust
        is that while the best that can be done with a panic!() is to simply print a statement explaining the error, unsuccessful
        Result values can be matched on, caught and mitigated without forcibly terminating the program.
    </p>
</div>

<div class="info">
    <p>
        Similarly to the Option enum, the value of a Result variable can be extracted from its enum wrapper with the <em>unwrap()</em> method:
    </p>
    <p class="inlinelink">
        fn result() -> Result&lt;i32, String&gt; {<br>
        &nbsp;Ok(5)<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!("{}", result().unwrap())<br>
        }
    </p>
    <p>
        An additional similarity is that this implementation of unwrap() expects an Ok(V) with a valid return value V and a successful execution,
        and will panic if the Result is an Err() of any kind. As with unwrapping an Option, this should only be used with complete confidence in the behaviour of a function or method.
        <br>
        <br> Result also has the <em>expect()</em> method implemented for it, allowing for the same quick error checking for high-confidence functions and methods that return a Result.
    </p>
    <div>
        <?php
            example_exec("fn result() -> Result&lt;i32, String&gt; {
        Ok(5)
        }
        
        fn main() {
        println!(\"{}\", result().unwrap())
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        When a Result is defined as the type of a variable or function, however, it needs two types in its definition: the successful return type and the error output type.
        The Result in the above example returns an integer on success, and a string on failure.
    </p>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Refactor the following code so that the Result is handled without<br>a call to panic!():</p>
    <?php exercise_exec("fn main() {\r\n\tlet output: Result&lt;i32, String&gt; = result();\n\tprintln!(\"{}\", output.expect(\"This should be successful!\"))\n}\n\nfn result() -> Result<i32, String> {\n\tErr(\"unsuccessful!\".to_string())\n}", 'exercise1'); ?>
    <p><b>Hint:</b> A match statement is likely to be useful.</p>
</div>

<div class="info">
    <p>
        Option and Result are so similar, in fact, that they both have methods that allow one to be converted into the other:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        <br>
        &nbsp;let maybe_ten: Option&lt;f32&gt; = Some(10.56);<br>
        &nbsp;let success: Result&lt;i32, String&gt; = Ok(4);<br>
        <br>
        &nbsp;let new_result = maybe_ten.ok_or("fail");<br>
        &nbsp;let new_option = success.ok();<br>
        <br>
        &nbsp;println!("{:?} {:?}", new_result, new_option)<br>
        <br>
        }
    </p>
    <p>
        In the above example, the variable <em>maybe_ten</em> is converted into a successful Result, and the variable <em>success</em>
        is converted into a successful Option.
    </p>
    <div>
        <?php
        example_exec("fn main() {
        
        let maybe_ten: Option&lt;f32&gt; = Some(10.56);
        let success: Result&lt;i32, String&gt; = Ok(4);
        
        let new_result = maybe_ten.ok_or(\"fail\");
        let new_option = success.ok();
        
        println!(\"{:?} {:?}\", new_result, new_option)
        
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        The method <em>ok_or()</em> takes ownership of the given Option and returns either an Ok() with the Option's contained value, or an Err() with the value passed into the method, respectively depending on the Option being Some() or None.
        <br><br>The <em>ok()</em> method implemented for Result, meanwhile, takes the given Result and returns an Option on the type of the Result's success type.
    </p>
</div>

<div class="info">
    <p>
        Another shared piece of functionality between Result and Option is the shorthand <b>Try</b> operator, denoted with a question mark at the end of any function or method call that returns a Result or Option.
        When this is added to such a statement, it will match on the output, unwrap the value if it is a Some() or Ok() value respectively, and return early with a None or Err() otherwise:
    </p>
    <p class="inlinelink">
        use std::collections::HashMap;<br>
        <br>
        fn option_on_hashmap() -> Option<&'static str> {<br>
        &nbsp;let map: HashMap&lt;i32, &'static str&gt; = HashMap::new();<br>
        &nbsp;Some(map.get(&5)?)<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!("{:?}", option_on_hashmap())<br>
        }
    </p>
    <p>
        Any call of the methods <em>get()</em> or <em>get_key_value()</em> on a hash map returns an Option on the type of the key.
        In this instance, there's nothing in the hash map, so the attempt to access a value in the hash map fails and the Try operator returns early with a None value, ignoring the Some() wrapper.
    </p>
    <div>
        <?php
            example_exec("use std::collections::HashMap;
            
        fn option_on_hashmap() -> Option<&'static str> {
        let map: HashMap&lt;i32, &'static str&gt; = HashMap::new();
        Some(map.get(&5)?)
        }
        
        fn main() {
        println!(\"{:?}\", option_on_hashmap())
        }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Note the syntax around the definition of string slices in the above example. This is the main way to specify string slices as the explicit type of any variable or function, and will be explained
        in much more detail in the last chapter.
    </p>
</div>

</div>

<div class="nav">
    <a href="./errorhandling-2.php">&laquo; The Option enum</a>
    <a href="./errorhandling-quiz.php">Quiz &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
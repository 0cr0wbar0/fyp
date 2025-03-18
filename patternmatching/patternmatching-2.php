<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>cr0wbar's Rust course - Pattern matching: if-let statements</title>
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
    <?php if (!isset($_SESSION["user_id"])) {?>
        <a href="https://fyp.cr0wbar.dev/login">Login</a>
    <?php
    } else {
        $username = $_SESSION["username"];?>
        <div class="dropdown">
            <button class="dropbtn">Welcome, <?=$username?></button>
            <div class="dropdown-content">
                <a href="https://fyp.cr0wbar.dev/profile">User profile</a>
                <a href="/logout.php">Log out</a>
            </div>
        </div>
    <?php }
    ?>
</div>

<div class="box">

<div class="titles">
    <h1 class="header">
        If-Let Statements
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        The need for all match statements in Rust to be completely exhaustive for all possible matches can, in some cases, lead to boilerplate code that may be annoying to write.
    </p>
</div>

<div class="info">
    <p>
        For situations where pattern matching is being used on a value, and <em>not all matches need to be considered</em> when checking that value, if-let statements will likely be better suited for the task.
    </p>
</div>

<div class="info">
    <p>
        An if-let statement is a control flow statement that defines a <em>single</em> matching pattern and then checks whether or not a given variable matches it:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let num: i32 = 5;<br>
        &nbsp;if let 5 = num {<br>
        &nbsp;&nbsp;println!("Correct value!")<br>
        &nbsp;} else {<br>
        &nbsp;&nbsp;println!("Incorrect value!")<br>
        &nbsp;}<br>
        }
    </p>
    <p>The above example is similar to the first example given for match statements on the previous page, with the exception that this is exclusively checking if the variable <em>num</em> exactly matches the value 5, and for no other matching pattern.</p>
    <div>
        <?php
        example_exec("fn main() {
        let num: i32 = 5;
        if let 5 = num {
        println!(\"Correct value!\")
        } else {
        println!(\"Incorrect value!\")
        }
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p>
        If-let statements can, of course, work with discriminants in enums as well. The below example is a modified example regarding enums from the previous page:
    </p>
    <p class="inlinelink">
        enum Vehicles {<br>
        &nbsp;Car,<br>
        &nbsp;Boat,<br>
        &nbsp;Train,<br>
        &nbsp;Plane<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let v = Vehicles::Train;<br>
        &nbsp;if let Vehicles::Car = v {<br>
        &nbsp;&nbsp;println!("This is a car!")<br>
        &nbsp;} else {<br>
        &nbsp;&nbsp;println!("This isn't a car!")<br>
        &nbsp;}<br>
        }
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]
            enum Vehicles {
        Car,
        Boat,
        Train,
        Plane
        }
        
        fn main() {
        let v = Vehicles::Train;
        if let Vehicles::Car = v {
        println!(\"This is a car!\")
        } else {
        println!(\"This isn't a car!\")
        }
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p><b>Exercise:<br></b>Try defining an enum of your own with variants of one type (tuples, structs or units), then write an if-let statement to match on one of these variants:</p>
    <?php exercise_exec("enum Variants {\n\n}\n\nfn main() {\n\t\n}", 'exercise1'); ?>
</div>

<div class="info">
    <p>
        Regarding enum structs (discriminants of an enum defined as structs), the primary way to <em>access or edit their fields</em> is through pattern matching:
    </p>
    <p class="inlinelink">
        enum Structs {<br>
        &nbsp;Point { x: i32, y: i32 },<br>
        &nbsp;Precise3DPoint { x: f64, y: f64, z: f64 },<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let strct = Structs::Precise3DPoint {<br>
        &nbsp;&nbsp;x: 23.5567,<br>
        &nbsp;&nbsp;y: 43.2343,<br>
        &nbsp;&nbsp;z: 98.7987<br>
        &nbsp;};<br>
        &nbsp;if let Structs::Precise3DPoint {<br>
        &nbsp;&nbsp;x: match_x,<br>
        &nbsp;&nbsp;y: match_y,<br>
        &nbsp;&nbsp;z: match_z<br>
        &nbsp;} = strct {<br>
        &nbsp;&nbsp;println!("{} {} {}", match_x, match_y, match_z)<br>
        &nbsp;}<br>
        }
        
    </p>
    <p>
       Temporary bindings are made to successful matches, which can then be accessed and edited. In the above example, the aliases <em>match_x</em> through to <em>match_z</em> represent these bindings.
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]
            enum Structs {
        Point { x: i32, y: i32 },
        Precise3DPoint { x: f64, y: f64, z: f64 },
        }
        
        fn main() {
        let strct = Structs::Precise3DPoint {
        x: 23.5567,
        y: 43.2343,
        z: 98.7987
        };
        if let Structs::Precise3DPoint {
        x: match_x,
        y: match_y,
        z: match_z
        } = strct {
        println!(\"{} {} {}\", match_x, match_y, match_z)
        }
        }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Additionally, when matching on enum structs, some of the fields being matched on can be <em>optionally omitted with range syntax</em> (double full stop) if they are irrelevant to the desired match:
    </p>
    <p class="inlinelink">
        enum Structs {<br>
        &nbsp;Point { x: i32, y: i32 },<br>
        &nbsp;Precise3DPoint { x: f64, y: f64, z: f64 },<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let strct = Structs::Point {<br>
        &nbsp;&nbsp;x: 23,<br>
        &nbsp;&nbsp;y: 43<br>
        &nbsp;};<br>
        &nbsp;if let Structs::Point {<br>
        &nbsp;&nbsp;x: match_x,<br>
        &nbsp;&nbsp;..<br>
        &nbsp;} = strct {<br>
        &nbsp;&nbsp;println!("{}", match_x)<br>
        &nbsp;}<br>
        }
    </p>
    <div>
    <?php
        example_exec("#[allow(dead_code)]
        enum Structs {
        Point { x: i32, y: i32 },
        Precise3DPoint { x: f64, y: f64, z: f64 },
        }
        
        fn main() {
        let strct = Structs::Point {
        x: 23,
        y: 43
        };
        if let Structs::Point {
        x: match_x,
        ..
        } = strct {
        println!(\"{}\", match_x)
        }
        }", "example4");
    ?>
    </div>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/patternmatching/1">&laquo; Match Statements</a>
    <a href="https://fyp.cr0wbar.dev/patternmatching/quiz">Quiz &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Fundamentals: structs & enums</title>
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
        Structs & Enums
    </h1>

    <h3 class="subheader">
        
    </h3>
</div>

<div class="info">
    <p> 
        A struct is a simple Rust data structure that can be defined and customised by the programmer.
    </p>
</div>

<div class="info">
    <p> 
        Structs are made up of <em>fields</em>, internal pieces of data that also need their own data types:
    </p>
    <p class="inlinelink">
        struct Train {<br/>
            &nbsp;colour: String, // Field definitions are separated by commas<br/>
            &nbsp;num_of_coaches: i32,<br/>
            &nbsp;max_speed_kmh: f64<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let t = Train {<br/>
        &nbsp;&nbsp;colour: String::from("Green"),<br/>
        &nbsp;&nbsp;num_of_coaches: 12,<br/>
        &nbsp;&nbsp;max_speed_kmh: 109.125<br/>
        &nbsp;};<br/>
        }
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]
            struct Train {
            colour: String, 
            num_of_coaches: i32,
            max_speed_kmh: f64
        }
        
        fn main() {
        let _t = Train {
        colour: String::from(\"Green\"),
        num_of_coaches: 12,
        max_speed_kmh: 109.125
        };
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p> 
        Like with variables, each struct, and each field, also needs its own alias.
    </p>
</div>

<div class="info">
    <p> 
        Struct fields can also be other structs:
    </p>
    <p class="inlinelink">
        struct Driver {<br/>
            &nbsp;name: String,<br/>
            &nbsp;years_of_exp: i32,<br/>
            &nbsp;can_drive_diesel_trains: bool<br/>
        }<br/>
        <br/>
        struct Train {<br/>
            &nbsp;driver: Driver, // A driver assigned to a train<br/>
            &nbsp;colour: String,<br/>
            &nbsp;num_of_coaches: i32,<br/>
            &nbsp;max_speed_kmh: f64<br/>
        }<br/>
        <br/>
        fn main() {<br/>
            &nbsp;let d = Driver {<br/>
            &nbsp;&nbsp;name: String::from("Dave"),<br/>
            &nbsp;&nbsp;years_of_exp: 5,<br/>
            &nbsp;&nbsp;can_drive_diesel_trains: false<br/>
            &nbsp;};<br/>
        <br/>
            &nbsp;let new_t = Train {<br/>
            &nbsp;&nbsp;driver: d,<br/>
            &nbsp;&nbsp;colour: String::from("Red"),<br/>
            &nbsp;&nbsp;num_of_coaches: 5,<br/>
            &nbsp;&nbsp;max_speed_kmh: 149.55<br/>
            &nbsp;};<br/>
        }
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]\n
            struct Driver {
            name: String,
            years_of_exp: i32,
            can_drive_diesel_trains: bool
        }
        
        #[allow(dead_code)]
        struct Train {
            driver: Driver,
            colour: String,
            num_of_coaches: i32,
            max_speed_kmh: f64
        }
        
        fn main() {
            let d = Driver {
            name: String::from(\"Dave\"),
            years_of_exp: 5,
            can_drive_diesel_trains: false
            };
        
            let _new_t = Train {
            driver: d,
            colour: String::from(\"Red\"),
            num_of_coaches: 5,
            max_speed_kmh: 149.55
            };
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p> 
        <em>Enums</em>, short for enumerations, are tiny pieces of data that, similar to structs, are defined entirely by the programmer as a custom data structure, and can only be one of multiple <em>variants</em> (sometimes called <em>discriminants</em>):
    </p>
    <p class="inlinelink">
        enum Reviews {<br/>
            &nbsp;Excellent,<br/>
            &nbsp;Great,<br/>
            &nbsp;Good,<br/>
            &nbsp;Okay,<br/>
            &nbsp;Bad,<br/>
            &nbsp;Terrible<br/>
        }<br/><br/>
        
        fn main() {<br/>
        &nbsp;let bad_review = Reviews::Bad;<br/>
        }
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]
            enum Reviews {
            Excellent,
            Great,
            Good,
            Okay,
            Bad,
            Terrible
        }
        
        fn main() {
        let _bad_review = Reviews::Bad;
        }", "example3");
        ?></div>
</div>

<div class="info">
    <p>Enums can have their own variants <em>defined inline as custom data types</em> (like with the above example). Variants with an alias but with no value are said to be of the <em>unit</em> type.</p>
</div>

<div class="info">
    <p>
        In a similar way to structs, enums can have multiple fields of different types and data structures:
    </p>
    <p class="inlinelink">
        enum OpcodeInts { <br/>
            &nbsp;RRQ = 1, // Variants can represent hardcoded values... <br/>
            &nbsp;WRQ = 2, <br/>
            &nbsp;DATA = 3, <br/>
            &nbsp;ACK = 4, <br/>
            &nbsp;ERR = 5 <br/>
        }<br/>
        <br/>
        enum Lengths { <br/>
            &nbsp;One(i32), // ...tuples of different lengths... <br/>
            &nbsp;Two(i32, i32), <br/>
            &nbsp;Three(i32, i32, i32), <br/>
            &nbsp;Four(i32, i32, i32, i32), <br/>
            &nbsp;Five(i32, i32, i32, i32, i32) <br/>
        }<br/>
        <br/>
        enum Structs {<br/>
            &nbsp;Point {x: i32, y: i32}, // ...and structs!<br/>
            &nbsp;Precise3DPoint {x: f32, y: f32, z: f32},<br/>
        }<br/>
        <br/>
        enum Mix {<br/>
            &nbsp;Tuple(f64, f64), // Enums can mix these types together as well<br/>
            &nbsp;Vehicle {colour: String, num_of_wheels: i32}<br/>
        }<br/>
        <br/>
        fn main() {<br/>
            &nbsp;let opcode = OpcodeInts::DATA;<br/>
            &nbsp;let three_d_point = Structs::Precise3DPoint {<br/>
                &nbsp;&nbsp;x: 28.17,<br/>
                &nbsp;&nbsp;y: 34.78,<br/>
                &nbsp;&nbsp;z: 97.12<br/>
                &nbsp;};<br/>
            &nbsp;let tuple_example = Mix::Tuple(54.982, 34.195);<br/>
        }
    </p>
    <div>
        <?php
            example_exec("#[allow(dead_code)]
            enum OpcodeInts { 
            RRQ = 1, 
            WRQ = 2, 
            DATA = 3, 
            ACK = 4, 
            ERR = 5 
        }
        
        #[allow(dead_code)]
        enum Lengths { 
            One(i32),
            Two(i32, i32), 
            Three(i32, i32, i32), 
            Four(i32, i32, i32, i32), 
            Five(i32, i32, i32, i32, i32) 
        }
        
        #[allow(dead_code)]
        enum Structs {
            Point {x: i32, y: i32}, 
            Precise3DPoint {x: f32, y: f32, z: f32},
        }
        
        #[allow(dead_code)]
        enum Mix {
            Tuple(f64, f64),
            Vehicle {colour: String, num_of_wheels: i32}
        }
        
        fn main() {
            let _opcode = OpcodeInts::DATA;
            let _three_d_point = Structs::Precise3DPoint {
                x: 28.17,
                y: 34.78,
                z: 97.12
                };
            let _tuple_example = Mix::Tuple(54.982, 34.195);
        }", "example4");
        ?>
    </div>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals/3">&laquo; Primitive Data Types</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/5">Functions &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
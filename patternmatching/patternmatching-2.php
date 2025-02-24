<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Pattern matching: if-let statements</title>
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
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+num%3A+i32+%3D+5%3B%0A++++if+let+5+%3D+num+%7B%0A++++++++println%21%28%22Correct+value%21%22%29%0A++++%7D+else+%7B%0A++++++++println%21%28%22Incorrect+value%21%22%29%0A++++%7D%0A%7D" target="_blank">
        fn main() {<br/>
        &nbsp;let num: i32 = 5;<br/>
        &nbsp;if let 5 = num {<br/>
        &nbsp;&nbsp;println!("Correct value!")<br/>
        &nbsp;} else {<br/>
        &nbsp;&nbsp;println!("Incorrect value!")<br/>
        &nbsp;}<br/>
        }
    </a></p>
    <p>The above example is similar to the first example given for match statements on the previous page, with the exception that this is exclusively checking if the variable <em>num</em> exactly matches the value 5, and for no other matching pattern.</p>
</div>

<div class="info">
    <p>
        If-let statements can, of course, work with discriminants in enums as well. The below example is a modified example regarding enums from the previous page:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=enum+Vehicles+%7B%0A++++Car%2C%0A++++Boat%2C%0A++++Train%2C%0A++++Plane%0A%7D%0A%0Afn+main%28%29+%7B%0A++++let+v+%3D+Vehicles%3A%3ATrain%3B%0A++++if+let+Vehicles%3A%3ACar+%3D+v+%7B%0A++++++++println%21%28%22This+is+a+car%21%22%29%0A++++%7D+else+%7B%0A++++++++println%21%28%22This+isn%27t+a+car%21%22%29%0A++++%7D%0A%7D" target="_blank">
        enum Vehicles {<br/>
        &nbsp;Car,<br/>
        &nbsp;Boat,<br/>
        &nbsp;Train,<br/>
        &nbsp;Plane<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let v = Vehicles::Train;<br/>
        &nbsp;if let Vehicles::Car = v {<br/>
        &nbsp;&nbsp;println!("This is a car!")<br/>
        &nbsp;} else {<br/>
        &nbsp;&nbsp;println!("This isn't a car!")<br/>
        &nbsp;}<br/>
        }
    </a></p>
</div>

<div class="info">
    <p>
        Regarding enum structs (discriminants of an enum defined as structs), the primary way to <em>access or edit their fields</em> is through pattern matching:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=enum+Structs+%7B%0A++++Point+%7B+x%3A+i32%2C+y%3A+i32+%7D%2C%0A++++Precise3DPoint+%7B+x%3A+f64%2C+y%3A+f64%2C+z%3A+f64+%7D%2C%0A%7D%0A%0Afn+main%28%29+%7B%0A++++let+strct+%3D+Structs%3A%3APrecise3DPoint+%7B%0A++++++++x%3A+23.5567%2C%0A++++++++y%3A+43.2343%2C%0A++++++++z%3A+98.7987%0A++++%7D%3B%0A++++if+let+Structs%3A%3APrecise3DPoint+%7B%0A++++++++x%3A+match_x%2C%0A++++++++y%3A+match_y%2C%0A++++++++z%3A+match_z%0A++++%7D+%3D+strct+%7B%0A++++++++println%21%28%22%7B%7D+%7B%7D+%7B%7D%22%2C+match_x%2C+match_y%2C+match_z%29%0A++++%7D%0A%7D%0A" target="_blank">
        enum Structs {<br/>
        &nbsp;Point { x: i32, y: i32 },<br/>
        &nbsp;Precise3DPoint { x: f64, y: f64, z: f64 },<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let strct = Structs::Precise3DPoint {<br/>
        &nbsp;&nbsp;x: 23.5567,<br/>
        &nbsp;&nbsp;y: 43.2343,<br/>
        &nbsp;&nbsp;z: 98.7987<br/>
        &nbsp;};<br/>
        &nbsp;if let Structs::Precise3DPoint {<br/>
        &nbsp;&nbsp;x: match_x,<br/>
        &nbsp;&nbsp;y: match_y,<br/>
        &nbsp;&nbsp;z: match_z<br/>
        &nbsp;} = strct {<br/>
        &nbsp;&nbsp;println!("{} {} {}", match_x, match_y, match_z)<br/>
        &nbsp;}<br/>
        }
        
    </a></p>
    <p>
       Temporary bindings are made to successful matches, which can then be accessed and edited. In the above example, the aliases <em>match_x</em> through to <em>match_z</em> represent these bindings.
    </p>
</div>

<div class="info">
    <p>
        Additionally, when matching on enum structs, some of the fields being matched on can be <em>optionally omitted with range syntax</em> (double full stop) if they are irrelevant to the desired match:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=enum+Structs+%7B%0A++++Point+%7B+x%3A+i32%2C+y%3A+i32+%7D%2C%0A++++Precise3DPoint+%7B+x%3A+f64%2C+y%3A+f64%2C+z%3A+f64+%7D%2C%0A%7D%0A%0Afn+main%28%29+%7B%0A++++let+strct+%3D+Structs%3A%3APoint+%7B+%0A++++++++x%3A+23%2C+%0A++++++++y%3A+43+%0A++++%7D%3B%0A++++if+let+Structs%3A%3APoint+%7B+%0A++++++++x%3A+match_x%2C+%0A++++++++..+%0A++++%7D+%3D+strct+%7B%0A++++++++println%21%28%22%7B%7D%22%2C+match_x%29%0A++++%7D%0A%7D%0A" target="_blank">
        enum Structs {<br/>
        &nbsp;Point { x: i32, y: i32 },<br/>
        &nbsp;Precise3DPoint { x: f64, y: f64, z: f64 },<br/>
        }<br/>
        <br/>
        fn main() {<br/>
        &nbsp;let strct = Structs::Point {<br/>
        &nbsp;&nbsp;x: 23,<br/>
        &nbsp;&nbsp;y: 43<br/>
        &nbsp;};<br/>
        &nbsp;if let Structs::Point {<br/>
        &nbsp;&nbsp;x: match_x,<br/>
        &nbsp;&nbsp;..<br/>
        &nbsp;} = strct {<br/>
        &nbsp;&nbsp;println!("{}", match_x)<br/>
        &nbsp;}<br/>
        }
    </a></p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/patternmatching/1">&laquo; Match Statements</a>
    <a href="https://fyp.cr0wbar.dev/patternmatching/quiz">Quiz &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
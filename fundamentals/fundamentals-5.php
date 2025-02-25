<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Fundamentals: functions & control flow</title>
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
        Functions
    </h1>

    <h3 class="subheader">
        (And a little bit on function-like macros)
    </h3>
</div>

<div class="info">
    <p> 
        <b>Rust functions are private by default,</b> and are defined with the keyword <em>fn</em>:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++println%21%28%22Hello%2C+world%21%22%29%0A%7D" target="_blank">
        fn main() {<br/>
            &nbsp;println!("Hello, world!")<br/>
        }<br/>
    </a></p>
    <p>The keyword <em>pub</em> must be used before <em>fn</em> in order to make a function public, and therefore accessible in other Rust programs.</p>
</div>

<div class="info">
    <p>
        Every Rust program needs a main function, which contains the only part of the program that will be executed. All other separately defined functions need to be included, or <em>called</em>, inside this function:  
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B+%0A++++println%21%28%22This+is+a+string%22%29%0A%7D%0A++++++++%0Afn+hidden_string%28%29+%7B%0A++++println%21%28%22Ooh%2C+secret+string%21%22%29+%2F%2F+Compiles%2C+does+not+execute%0A%7D" target="_blank">
        fn main() { <br/>
            &nbsp;println!("This is a string")<br/>
        }<br/>
        <br/>
        fn hidden_string() {<br/>
            &nbsp;println!("Ooh, secret string!") // Compiles, does not execute<br/>
        }
    </a></p>
</div>

<div class="info">
    <p>
        Rust functions can implicitly return the last found value in the function body as an expression, as long as the return value is explicitly typed:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++println%21%28%22%7B%7D%22%2C+character%28%29%29%0A%7D%0A%0Afn+character%28%29+%7B%0A++++%27f%27+%2F%2F+Return+value+of+function+without+semicolon%2C+recognised+as+expression%0A%7D" target="_blank">
        fn main() {<br/>
            &nbsp;println!("{}", character())<br/>
        }<br/>
        <br/>
        fn character() {<br/>
            &nbsp;'f' // Return value of function without semicolon, recognised as expression<br/>
        }<br/>
    </a></p>
    <p class="inline-err">
        error[E0277]: `()` doesn't implement `std::fmt::Display`<br/>
        --> src/main.rs:2:20<br/>
        |<br/>
        2 |     println!("{}", character())<br/>
        |                    `()` cannot be formatted with the default formatter<br/>
        |<br/>
        = help: the trait `std::fmt::Display` is not implemented for `()`<br/>
        <br/>
        error[E0308]: mismatched types<br/>
        --> src/main.rs:6:5<br/>
        |<br/>
        5 | fn character() {<br/>
        |               - help: try adding a return type: `-> char`<br/>
        6 |     'f' // Return value of function without semicolon<br/>
        |     ^^^ expected `()`, found `char`<br/>
        <br/>
        Some errors have detailed explanations: E0277, E0308.<br/>
        For more information about an error, try `rustc --explain E0277`.
    </p>
</div>

<div class="info">
    <p>
        Because the return value wasn't explicitly given for the character() function, and because it's trying to return an expression, the function returned the empty <em>unit type</em>, defined as ().
    </p>
</div>

<div class="info">
    <p>
        In Rust, the results of functions can immediately be assigned to variables:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+x%3A+i32+%3D+%7B%0A++++++++let+mut+y%3A+i32+%3D+0%3B%0A++++++++while+y+%3C+5+%7B%0A++++++++++++y+%2B%3D+1%3B%0A++++++++%7D%0A++++++++y%0A++++%7D%3B%0A++++println%21%28%22%7B%7D%22%2C+x%29%0A%7D%0A" target="_blank">
        fn main() {<br/>
            &nbsp;let x: i32 = {<br/>
                &nbsp;&nbsp;let mut y: i32 = 0;<br/>
                &nbsp;&nbsp;&nbsp;while y < 5 {<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;y += 1;<br/>
                    &nbsp;&nbsp;&nbsp;}<br/>
                    &nbsp;&nbsp;y<br/>
                &nbsp;};<br/>
            &nbsp;println!("{}", x)<br/>
        }<br/>
    </a></p>
</div>

<div class="info">
    <p>
        Functions can be written to take parameters, variables defined in the brackets next to the function name that can then be used in the body of a function:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++println%21%28%22%7B%3A%3F%7D%22%2C+reverse_nums%289%2C+10%29%29%0A%7D%0A%0Afn+reverse_nums%28i%3A+i32%2C+j%3A+i32%29+-%3E+%28i32%2C+i32%29+%7B%0A++++%28j%2C+i%29%0A%7D" target="_blank">
        fn main() {<br/>
            &nbsp;println!("{:?}", reverse_nums(9, 10))<br/>
        }<br/>
        <br/>
        fn reverse_nums(i: i32, j: i32) -> (i32, i32) {<br/>
            &nbsp;(j, i)<br/>
        }
    </a></p>
    <p>
        Function parameters <em>always need explicit type definitions.</em>
    </p>
</div>

<div class="info">
    <p>
        Note the syntax between the curly brackets in the string formatting of the println!() call in the above example. This prints the result of the supplied function call in a <em>debug</em> view, allowing for the printing of data structures like structs, enums and tuples (explained later).
    </p>
</div>

<div class="info">
    <p>
        Functions can also be <em>implemented on structs and enums,</em> as methods, with the <em>impl</em> keyword:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=struct+Train+%7B%0A++++colour%3A+String%2C%0A++++num_of_coaches%3A+i32%2C%0A++++max_speed_kmh%3A+f64%0A%7D%0A%0Aimpl+Train+%7B%0A++++pub+fn+how_many_coaches%28%26self%29+%7B%0A++++++++println%21%28%22%7B%7D%22%2C+%26self.num_of_coaches%29%3B%0A++++%7D%0A%7D%0A%0Afn+main%28%29+%7B%0A++++let+t+%3D+Train+%7B%0A++++++++colour%3A+String%3A%3Afrom%28%22Green%22%29%2C%0A++++++++num_of_coaches%3A+5%2C%0A++++++++max_speed_kmh%3A+120.05%0A++++%7D%3B%0A++++%0A++++t.how_many_coaches%28%29%3B%0A%7D" target="_blank">
        struct Train {<br/>
            &nbsp;colour: String,<br/>
            &nbsp;num_of_coaches: i32,<br/>
            &nbsp;max_speed_kmh: f64<br/>
        }<br/>
        <br/>
        impl Train {<br/>
            &nbsp;pub fn how_many_coaches(&self) {<br/>
                &nbsp;&nbsp;println!("{}", &self.num_of_coaches);<br/>
            &nbsp;}<br/>
        }<br/>
        <br/>
        fn main() {<br/>
            &nbsp;let t = Train {<br/>
                &nbsp;&nbsp;colour: String::from("Green"),<br/>
                &nbsp;&nbsp;num_of_coaches: 5,<br/>
                &nbsp;&nbsp;max_speed_kmh: 120.05<br/>
            &nbsp;};<br/>
            <br/>
            &nbsp;t.how_many_coaches();<br/>
        }
    </a></p>
</div>

<div class="info">
    <p>
        The syntax involving the ampersand symbol (&) in the above example will be fully explained in the next chapter. For now, note that in order for the Train struct <em>t</em> to access its own fields, it has to get them using the <em>self</em> keyword. This allows structs and enums to refer to themselves in their methods, and perform actions like calling other functions and methods on themselves.
    </p>
</div>

<div class="info">
    <p>
        As mentioned before, println!() is not a function, but a <b>macro</b>.
    </p>
</div>

<div class="info">
    <p>
        <b>Function-like macros</b>, explained very briefly, are part of a larger, much more complicated collection of functionality in the Rust language.
    </p>
</div>

<div class="info">
    <p>
        They appear to be normal functions, except for the exclamation point used in their names:
    </p>
    <ul class="list">
        <li>println!(): prints formatted string, followed by a new line</li>
        <li>eprintln!(): prints formatted string to error output, followed by a new line</li>
        <li>dbg!(): prints a passed value in debug view</li>
        <li>assert!(): checks that a boolean value is true, <em>panics</em> if value is false (explained later)</li>
        <li>panic!(): immediately and forcefully terminates program and prints a passed string as an error value (elaborated on later)</li>
    </ul>
    <p>The above examples of Rust macros are all built into the standard library.</p>
</div>

<div class="info">
    <p>
        The main feature that sets function-like macros apart from functions is that macros can take <b>variable numbers of arguments as input:</b>
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++println%21%28%22Hello%2C+world%21%22%29%3B%0A++++%2F%2F+One+argument+given+to+println%21%28%29%0A%0A++++let+x+%3D+5%3B%0A++++println%21%28%22The+value+of+x+is%3A+%7B%7D%22%2C+x%29%3B%0A++++%2F%2F+Two+arguments+given%3A%0A++++%2F%2F+Formatted+string+and+one+variable+to+print+with+string%0A++++%0A++++let+y+%3D+vec%21%5B10%2C+100%2C+1000%5D%3B%0A++++%2F%2F+Creating+a+vector+%28mutable+Rust+array%29+with+vec%21%0A%0A++++println%21%28%22The+values+of+vector+y+are+%7B%7D%2C+%7B%7D+and+%7B%7D%22%2C+y%5B0%5D%2C+y%5B1%5D%2C+y%5B2%5D%29%3B%0A++++%2F%2F+Four+arguments+given%3A%0A++++%2F%2F+Formatted+string+with+three+inputs%2C+and+three+vector+elements%0A%7D" target="_blank">
        fn main() {<br/>
            &nbsp;println!("Hello, world!"); <br/>&nbsp;// One argument given to println!()<br/>
            <br/>
            &nbsp;let x = 5;<br/>
            &nbsp;println!("The value of x is: {}", x); <br/>&nbsp;// Two arguments given:<br/>
            &nbsp;// Formatted string and one variable to print with string<br/>
            <br/>
            &nbsp;let y = vec![10, 100, 1000];<br/>&nbsp;// Creating a vector (mutable Rust array) with vec!<br/>
            <br/>
            &nbsp;println!("The values of vector y are {}, {} and {}", y[0], y[1], y[2]); <br/>&nbsp;// Four arguments given:<br/>
            &nbsp;// Formatted string with three inputs, and three vector elements<br/>
        }
        
    </a></p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals/4">&laquo; Structs & Enums</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/6">Control Flow &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
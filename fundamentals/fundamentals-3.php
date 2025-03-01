<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Fundamentals: data types</title>
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
        Primitive Data Types
    </h1>

    <h3 class="subheader">
        
    </h3>
</div>

<div class="info">
    <p> 
        Rust's primitive data types work slightly differently to other imperative languages like Python and C.
    </p>
</div>

<div class="info">
    <p> 
        Rust is statically typed, but the type can be inferred at compile-time, negating the need to specify the type in some cases:
    </p>
    <p class="inlinelink">
        fn main() {<br/>
        &nbsp;let i = 10; // i inferred as type i32 (explained below)<br/>
        &nbsp;println!("{}", i);<br/>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let i = 10;
        println!(\"{}\", i);
        }", "example1");
        ?>
    </div>
</div>

<div class="info">
    <p> 
        Integers require a specification of their <em>bit count</em>, 
        as well as <em>whether they are signed or unsigned</em>:
        <ul class="list">
            <li>u8: unsigned 8-bit integer</li>
            <li>u16: unsigned 16-bit integer</li>
            <li>u32: unsigned 32-bit integer</li>
            <li>...and so on, up to u128.</li>
        </ul>
        <ul class="list">
            <li>i8: signed 8-bit integer</li>
            <li>i16: signed 16-bit integer</li>
            <li>...and so on, up to i128.</li>
        </ul>
    </p>
</div>

<div class="info">
    <p> 
        A defined integer variable that isn't specified with a size or signature (like the first example on this page) will default to <b>i32</b>.
    </p>
</div>

<div class="info">
    <p> 
        There also exists integer data types that are based on the <em>CPU architecture of the machine executing the code: <b>isize</b> and <b>usize</b>.</em>
        For example, on a 32-bit architecture, an <b>isize</b> variable would have the same bit count as an <b>i32</b> variable. 
    </p>
</div>

<div class="info">
    <p>
        Data types can't always be inferred, such as when the built-in <b>into()</b> method is used to convert a variable of one type to another:
    </p>
    <p class="inlinelink">
        fn main() {<br/>
        &nbsp;let x = "10";<br/>
        &nbsp;let y = x.into();<br/>
        println!("{}", y);<br/>
        }
    </p>
    <p class="inline-err">error[E0283]: type annotations needed<br/>
        |<br>
        3 |     let y = x.into();<br/>
          |          type must be known at this point<br/>
          |<br/>
          = note: cannot satisfy `_: From<&str>`<br/>
          = note: required for `&str` to implement `Into<_>`<br/>
        help: consider giving `y` an explicit type<br/>
          |<br/>
        3 |     let y: /* Type */ = x.into();<br/>
    </p>
    <p>Since there's no information on what type variable <em>y</em> is, the compiler doesn't know how to convert to it from a string variable <em>x</em>.</p>
</div>

<div class="info">
    <p>
        For trivial problems, such as type mismatches or unclear typing, the Rust compiler and runtime can print direct, contextual suggestions for how to fix the error!
    </p>
</div>

<div class="info">
    <p> 
        Floating-point numbers can only be two possible sizes in the stable release of Rust:
        <ul class="list">
            <li>f32: 32-bit float</li>
            <li>f64: 64-bit float</li>
        </ul>
    </p>
    <p>
        There are also f16 and f128 types, but these are currently only available in <em>nightly</em> (experimental) versions of the language.
    </p>
</div>

<div class="info">
    <p> 
        There is no "fsize" data type in Rust, but if no type is specified for a float, the compiler will default to <b>f64</b>:
    </p>
    <p class="inlinelink">
        fn main() {<br/>
        &nbsp;let f_big = 3.33; // f64<br/>
        &nbsp;let f_small: f32 = 3.3; // f32<br/>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let _f_big = 3.33;
        let _f_small: f32 = 3.3;
        }", "example2");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Alternatively, for type annotation, the type of a numerical variable can be <em>specified in its value</em>:
        <ul class="list">
            <li>2 as an unsigned 16-bit integer: 2u16 or 2_u16</li>
            <li>35 as a signed 128-bit integer: 35i128 or 35_i128</li>
        </ul>
        An underscore can be optionally added, for clarity purposes.
    </p>
</div>

<div class="info">
    <p>
        Similar annotations exist for other types of numeral, like different number bases:
        <ul class="list">
            <li>10000 == 1_0000</li>
            <li>20 in binary: <b>0b00010100</b> or <b>0b0001_0100</b></li>
            <li>32 in hexadecimal: <b>0x</b>20</li>
            <li>70 as a byte: b'F'</li>
            <li>17 in octal: <b>0o</b>21</li>
        </ul>
    </p>
</div>

<div class="info">
    <p>
        Booleans in Rust are lower-case, and require very little type annotation:
    </p>
    <p class="inlinelink">
        fn main () {<br/>
        &nbsp;let t = true; // inferred as bool<br/>
        }
    </p>
    <div>
        <?php
            example_exec("fn main () {
        let _t = true;
        }", "example3");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Expressions involving comparison of numerical values are also evaluated, and assigned as, bools:
    </p>
    <p class="inlinelink">
        fn main() {<br/>
        &nbsp;let num = 5;<br/>
        &nbsp;let is_zero = (num == 0); // inferred as bool<br/>
        &nbsp;println!("{}", is_zero);<br/>
        }
    </p>
    <p>
        Variable <em>num</em> isn't zero, so variable <em>is_zero</em> equates to false, with no annotation explicitly needed.
    </p>
    <div>
        <?php
        example_exec("fn main() {
        let num = 5;
        let is_zero = num == 0;
        println!(\"{}\", is_zero);
        }", "example4");
        ?>
    </div>
</div>

<div class="info">
    <p>
        Characters in Rust are representations of Unicode, and accept all kinds of different characters and emoticons:
    </p>
    <p class="inlinelink">
        fn main() {<br/>
        &nbsp;let letter = 'b';<br/>
        &nbsp;let j: char = 'あ'; // Japanese character<br/>
        &nbsp;let c: char = '好'; // Chinese character<br/>
        }
    </p>
    <div>
        <?php
            example_exec("fn main() {
        let _letter = 'b';
        let _j: char = 'あ';
        let _c: char = '好';
        }", "example5");
        ?>
    </div>
</div>

<div class="info">
    <p>
        <b>There are two string types in Rust:</b>
    </p>
    <ul class="list">
        <li>&str: string <em>slices</em> or <em>literals</em></li>
        <ul>
            <li>immutable</li>
        </ul>
        <li>String: string <em>structs</em></li>
        <ul>
            <li>mutable</li>
        </ul>
    </ul>
</div>

<div class="info">
    <p>
        Aside from having different mutability, these two types behave very differently from each other, and this difference will be fully explained in later chapters.
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/fundamentals/2">&laquo; Mutability</a>
    <a href="https://fyp.cr0wbar.dev/fundamentals/4">Structs & Enums &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
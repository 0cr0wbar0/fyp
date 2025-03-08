<?php
session_start();
include __DIR__."/../rustrunner.php";
?>
<!doctype html>
<html lang="en" class="background">

<head>
  <title>cr0wbar's Rust course - Beyond the basics: lifetimes</title>
  <link rel="stylesheet" href="../static/stylesheet.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
    Lifetimes
  </h1>

  <h3 class="subheader">

  </h3>
</div>

<div class="info">
  <p>
    While the Rust compiler does have the ability to infer the scopes of variables (and any references they may have) to an extent, there are situations where the compiler may need to be manually told how long certain values will exist in memory,
    so the program can be safely executed with no undefined behaviour.
  </p>
</div>

<div class="info">
  <p>
    When working with references as parameters and return types in functions and methods, it's not always obvious to the compiler whether it's memory safe to use them all.
    If the original values the references were pointing to were to go out of scope and get dropped from memory, the references would be <em>dangling,</em> that is, pointing to uninitialised memory. <br>Until it is confirmed that the compiling program isn't threatening
    to allow this, the compiler will refuse.
  </p>
</div>

<div class="info">
  <p>
    In the following example, the function takes a string slice and explicitly returns a string slice:
  </p>
  <p class="inlinelink">
    fn f(fst: &str) -> &str {<br>
    &nbsp;fst<br>
    }<br>
    <br>
    fn main() {<br>
    &nbsp;println!("{}", f("h"))<br>
    }
  </p>
  <p>
    Here, the compiler infers that the string input and the string output last as long as each other.
  </p>
    <?php
    example_exec("fn f(fst: &str) -> &str {
    fst
    }
    fn main() {
    println!(\"{}\", f(\"h\"))
    }", "example1");
    ?>
</div>

<div class="info">
  <p>
    The following example, however, is not so simple:
  </p>
  <p class="inlinelink">
    fn f(fst: &str, snd: &str) -> &str {<br>
    &nbsp;fst.to_owned() + snd // string concat requires left-hand string to be owned<br>
    }<br>
    <br>
    fn main() {<br>
    &nbsp;println!("{}", f("h", "i"))<br>
    }
  </p>
  <p class="inline-err">
    error[E0106]: <b>missing lifetime specifier</b><br>
    --> src/main.rs:1:31<br>
    |<br>
    1 | fn f(fst: &str, snd: &str) -> &str {<br>
    |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^ expected named lifetime parameter<br>
    |<br>
    = help: this function's return type contains a borrowed value, but the signature does not say whether it is borrowed from `fst` or `snd`<br>
    help: consider introducing a named lifetime parameter<br>
    |<br>
    1 | fn f<'a>(fst: &'a str, snd: &'a str) -> &'a str {<br>
    |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;++++&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;++&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;++&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;++<br>
    <br>
    For more information about this error, try `rustc --explain E0106`.
  </p>
  <p>
    A <b>lifetime,</b> separate from a scope (and explicitly denoted with an apostrophe and a short alias), is the memory-safe lifespan of a function, variable or reference. The lifetime of a reference is dependent on the lifetime of the variable it is referencing.
  </p>
</div>

<div class="info">
  <p>
    In the above example, the compiler can't work out which parameter relates to the returned reference,
    so it suggests adding explicit <em>lifetime parameters</em> to specify that:
    <ul class="list">
    <li>the function and both of its parameters all last as long as each other</li>
    <li>neither of the parameters could potentially reference a dropped value</li>
    <li>execution of the function won't lead to accesses of uninitialised memory</li>
    </ul>
  </p>
</div>

<div class="info">
  <p>
    A similar error also arises if a function is specified as returning a reference, but takes no parameters:
  </p>
  <p class="inlinelink">
    fn f() -> &str {<br>
    &nbsp;"hi"<br>
    }<br>
    <br>
    fn main() {<br>
    &nbsp;println!("{}", f())<br>
    }
  </p>
  <p class="inline-err">
    error[E0106]: missing lifetime specifier<br>
    --> src/main.rs:1:11<br>
    |<br>
    1 | fn f() -> &str {<br>
    |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^ expected named lifetime parameter<br>
    |<br>
    = help: this function's return type contains a borrowed value, but there is no value for it to be borrowed from<br>
    help: consider using the `'static` lifetime, but this is uncommon unless you're returning a borrowed value from a `const` or a `static`<br>
    |<br>
    1 | fn f() -> &'static str {<br>
    |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+++++++<br>
    help: instead, you are more likely to want to return an owned value<br>
    |<br>
    1 | fn f() -> String {<br>
    |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~~~~~<br>
    <br>
    For more information about this error, try `rustc --explain E0106`.
  </p>
  <p>
    Absolutely no inference can be made here, because there aren't any references in the parameters to compare to the return value.
  </p>
</div>

<div class="info">
  <p>
    Note the message in the above erroneous example suggesting use of the <em>static lifetime.</em> This is a reserved alias for lifetimes that last <b>for the duration of the entire program.</b>
  </p>
</div>

<div class="info">
  <p>
    Explicit lifetime parameters share the <em>same angle bracket syntax</em> as generics. If a function uses generics and lifetime parameters at the same time,
    these need to be defined in the same brackets:
  </p>
  <p class="inlinelink">
    fn f<'a, T>(arr: &'a [T]) -> &'a T where T: Copy {<br>
    &nbsp;&arr[0]<br>
    }<br>
    <br>
    fn main() {<br>
    &nbsp;println!("{}", f(&[1; 5]))<br>
    }
  </p>
  <p>
    The lifetime specifier <b>'a</b> used here means that the function, its parameter and its return value all share the same lifetime.
  </p>
    <div>
        <?php
            example_exec("fn f<'a, T>(arr: &'a [T]) -> &'a T where T: Copy {
    &arr[0]
    }
    
    fn main() {
    println!(\"{}\", f(&[1; 5]))
    }", "example2");
        ?>
    </div>
</div>

<div class="info">
  <p>
    Lifetime specifiers need aliases for the same reason that generics need them - multiple generics of different aliases are inferred to mean that those generics are different types,
    whereas multiple lifetimes with different aliases are inferred to mean that those lifetimes are all of <em>different lengths.</em>
  </p>
</div>

<div class="info">
  <p>
    This example takes two generic parameters of explicitly different lifetimes, meaning that the parameter <em>val</em> can potentially last for a differing period of time than the parameter <em>arr</em> during execution:
  </p>
  <p class="inlinelink">
    fn f<'a, 'b:'a, T, U>(arr: &'a [T], val: &'b U) -> (&'a T, &'b U) <br> where T: Copy, U: ?Sized {<br>
    &nbsp;(&arr[0], val)<br>
    }<br>
    <br>
    fn main() {<br>
    &nbsp;println!("{:?}", f(&[1; 5], "hello"))<br>
    }
  </p>
  <p>
    Note the colon in the generic definition: lifetime <em>'b</em> is being explicitly defined inline as <b>lasting longer</b> than <em>'a,</em> and the Rust compiler will attempt to enforce these bounds whenever this function is called.
  </p>
    <div>
        <?php
        example_exec("fn f<'a, 'b:'a, T, U>(arr: &'a [T], val: &'b U) -> (&'a T, &'b U)  where T: Copy, U: ?Sized {
    (&arr[0], val)
    }
    
    fn main() {
    println!(\"{:?}\", f(&[1; 5], \"hello\"))
    }", "example3");
        ?>
    </div>
</div>


<div class="info">
    <p><b>Exercise:<br></b>The following function <em>concat()</em> takes three string slices and returns a string struct. Refactor this function so that:</p>
    <ul class="list">
        <li><em>one</em>, <em>two</em> and <em>three</em> are all of different lifetime lengths</li>
        <li><em>three</em> explicitly lasts longer than <em>two</em></li>
    </ul>
    <?php exercise_exec("fn main() {\r\n\tprintln!(\"{}\", concat(\"st\", \"ri\", \"ng\"))\n}\n\nfn concat(one: &str, two: &str, three: &str) -> String {\n\tone.to_owned() + &two.to_owned() + three\n}", 'exercise1'); ?>
</div>

</div>

<div class="nav">
  <a href="https://fyp.cr0wbar.dev/beyond/2">&laquo; Traits</a>
  <a href="https://fyp.cr0wbar.dev/beyond/quiz">Quiz &raquo;</a>
</div>

<?php js(); ?>

</body>

<audio autoplay id="mouseclick">
  <source src="../static/mouse-click.mp3" type="audio/mpeg">
  <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>
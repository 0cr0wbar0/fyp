<html lang="en" class="background">

<head>
    <title>cr0wbar's Rust course - Ownership: references</title>
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
        References
    </h1>

    <h3 class="subheader">

    </h3>
</div>

<div class="info">
    <p>
        Languages like Java, C#, Python and PHP all use <em>garbage collection</em> to detect and free memory containing unused functions and variables, meaning an extra program must be running at all times during execution to perform this task.
        This can lead to slower execution times and less time-efficient and space-efficient programs.
    </p>
</div>

<div class="info">
    <p>
        Languages like C have no garbage collector, meaning they are faster in execution, but may require the programmer to handle memory manually, with
        minor mistakes in memory management leading to fatal errors that are difficult to predict or notice.
    </p>
</div>

<div class="info">
    <p>
        Fatal errors involving memory can also cause <em>undefined behaviour</em>, a set of unpredictable events that occur as a result of the runtime executing broken, residual instructions (which could cause anything from file corruption to fatal crashes of the entire operating system).
    </p>
</div>

<div class="info">
    <p>
        Rust strikes a middle ground between these two execution models:
        <ul class="list">
            <li>each value stored in memory is <b>owned</b> by some variable, struct or function</li>
            <li>in order to prevent undefined behaviour from deallocating the same memory area twice, each value has only <b>one owner at a time</b></li>
            <li>assigning a variable to another variable <b>transfers ownership of the first variable's value to the second variable</b></li>
            <li>passing a value into a function as an argument <b>transfers ownership of that value to that function</b></li>
            <li><b>any further attempt</b> to access a moved value outside its new owner will cause an error</li>
            <li>errors involving ownership are detected during compile-time, meaning the program will <b>refuse to execute</b> if these rules are not followed</li>
        </ul>
    </p>
</div>

<div class="animbox">
    <p><img src="../static/ownership.gif"></p>
    <p>
        Note: in the above animation, some_func() is some function that takes a String struct as an argument, but doesn't return the same struct.
    </p>
</div>

<div class="info">
    <p>
        This strict system of <b>ownership</b> means that all values stored in memory can be tightly controlled and monitored, making Rust programs much more memory-safe than C programs, without the need for a resource-costly garbage collector.
    </p>
</div>

<div class="info">
    <p>
        However, there are inevitably going to be situations where a single variable needs to be accessed by many different parts of a Rust program multiple times.
        In order to allow this to happen, <b>references</b> to variables can be used in place of the variables themselves:
    </p>
    <p class="inlinelink"><a href="https://play.rust-lang.org/?version=stable&mode=debug&edition=2021&code=fn+main%28%29+%7B%0A++++let+mut+s+%3D+String%3A%3Afrom%28%22borrowed%22%29%3B%0A++++println%21%28%22%7B%7D+%7B%7D+%7B%7D%22%2C+%0A++++++++++++get_string_capacity%28%26s%29%2C%0A++++++++++++get_last_char%28%26mut+s%29.unwrap%28%29%2C%0A++++++++++++get_length%28%26s%29%29%3B%0A%7D%0A%0A%0A%2F%2F%2F+Takes+reference+to+a+String+struct%2C%0A%2F%2F%2F+returns+capacity+in+bytes%0Afn+get_string_capacity%28string%3A+%26String%29+-%3E+usize+%7B%0A++++string.capacity%28%29%0A%7D%0A%0A%2F%2F%2F+Takes+*mutable*+reference+to+a+String%2C%0A%2F%2F%2F+returns+last+character+of+String%2C%0A%2F%2F%2F+provided+the+String%27s+length+is+%3E%3D+1%0Afn+get_last_char%28string%3A+%26mut+String%29+-%3E+Option%3Cchar%3E+%7B%0A++++string.pop%28%29%0A%7D%0A%0A%0A%2F%2F%2F+Takes+reference+to+a+String%2C%0A%2F%2F%2F+returns+current+length%0Afn+get_length%28string%3A+%26String%29+-%3E+usize+%7B%0A++++string.len%28%29%0A%7D" target="_blank">
        fn main() {<br>
        &nbsp;let mut s = String::from("borrowed");<br>
        &nbsp;println!("{} {:?} {}", <br>
        &nbsp;&nbsp;get_string_capacity(&s),<br>
        &nbsp;&nbsp;get_last_char(&mut s).unwrap(),<br>
        &nbsp;&nbsp;get_length(&s));<br>
        }<br>
        <br>
        /// Takes reference to a String struct,<br>
        /// returns capacity in bytes<br>
        fn get_string_capacity(string: &String) -> usize {<br>
        &nbsp;string.capacity()<br>
        }<br>
        <br>
        /// Takes *mutable* reference to a String,<br>
        /// returns last character of String,<br>
        /// provided the String's length is >= 1<br>
        fn get_last_char(string: &mut String) -> Option&lt;char&gt; {<br>
        &nbsp;string.pop()<br>
        }<br>
        <br>
        /// Takes reference to a String,<br/>
        /// returns current length<br/>
        fn get_length(string: &String) -> usize {<br>
        &nbsp;string.len()<br>
        }<br>
    </a></p>
    <p>
        References to variables, and the definition of the types of these variable references, are denoted with an ampersand (&). 
    </p>
</div>

<div class="info">
    <p>
        When a reference to a variable is passed to a function as an argument, that function <em>borrows</em> the variable for the duration of its execution, through the reference to it, meaning that ownership of the variable does not change.
    </p>
</div>

<div class="info">
    <p>
        Note, in the above example, how the String variable <em>s</em> was borrowed multiple times in the main function, but <em>only borrowed mutably once</em>.
        This is another immensely important ownership rule that helps to make memory safety guarantees.
    </p>
</div>

<div class="info">
    <p>
        If multiple mutable borrows could be made at once, <em>race conditions</em> (situations where the same variable is edited or overwritten by multiple processes, leading to unexpected behaviour) would occur.
    </p>
</div>

<div class="info">
    <p>
        However, most primitive types in Rust, such as integers, floating-point numbers, booleans, and characters, <em>aren't moved</em> when they are used in a function or assigned to another variable.
    </p>
</div>

<div class="info">
    <p>
        Since they take up very small, fixed amounts of memory space, they have a trait called <em>Copy</em>, which allows them to be simply copied, instead of moved, to the variable or function they might be used with. More technical details of why primitive types behave this way can be found on the next page.
    </p>
</div>

</div>

<div class="nav">
    <a href="https://fyp.cr0wbar.dev/ownership/1">&laquo; Scopes</a>
    <a href="https://fyp.cr0wbar.dev/ownership/3">Stack & Heap Memory &raquo;</a>
</div>

</body>

<audio autoplay id="mouseclick">
    <source src="../static/mouse-click.mp3" type="audio/mpeg">
    <source src="../static/mouse-click.ogg" type="audio/ogg">
</audio>

</html>

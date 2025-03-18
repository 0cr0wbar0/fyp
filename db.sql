drop table if exists Attempts;
drop table if exists Users;
drop table if exists Quizzes;

create table Users (
                       user_id integer auto_increment primary key,
                       username varchar(30) unique,
                       password varchar(2048),
                       last_login bigint default 0,
                       num_of_attempts integer default 0
);

create table Quizzes (
                         quiz_id integer primary key,
                         quiz_topic varchar(30),
                         question_1 varchar(2000),
                         answer_1 varchar(300),
                         question_2 varchar(2000),
                         answer_2 varchar(300),
                         question_3 varchar(2000),
                         answer_3 varchar(300),
                         question_4 varchar(2000),
                         answer_4 varchar(300),
                         question_5 varchar(2000),
                         answer_5 varchar(300)
);

create table Attempts (
                          attempt_id integer auto_increment primary key,
                          user_id integer,
                          quiz_id integer,
                          answer_1 boolean,
                          answer_2 boolean,
                          answer_3 boolean,
                          answer_4 boolean,
                          answer_5 boolean,
                          foreign key (user_id) references Users(user_id) on update cascade on delete cascade,
                          foreign key (quiz_id) references Quizzes(quiz_id) on update cascade on delete cascade
);

insert into Quizzes (quiz_id, quiz_topic, question_1, answer_1, question_2, answer_2, question_3, answer_3, question_4, answer_4, question_5, answer_5) values (
    1, 'Fundamentals',

    '<div class="info">
                <h3>Question 1</h3>
                <p>
                Will the following code compile?
                </p>
                <p class="inlinelink">
                fn main() {<br>
                &nbsp;let v;<br>
                }
                </p>
                <input id="question1_yes" name="question1_select" type="radio" value="Yes"><label for="question1_yes">Yes</label>
                <input id="question1_no" name="question1_select" type="radio" value="No"><label for="question1_no">No</label>
            </div>',

     'No',

    '<div class="info">
                <h3>Question 2</h3>
                <p>
                    Label each of the following numerical values with their <b>number bases</b> (decimal, octal, binary or hexadecimal) by filling in the blanks:<br>
                    <br>57 is <input name="question_2_1" id="answertext" type="text">
                    <br>0o10 is <input name="question_2_2" id="answertext" type="text">
                    <br>0x40 is <input name="question_2_3" id="answertext" type="text">
                    <br>0b1010 is <input name="question_2_4" id="answertext" type="text">
                </p>
                </div>',

    'decimal octal hexadecimal binary',

    '<div class="info">
                <h3>Question 3</h3>
                <p>
                    What is the printed output of the following code?
                </p>
                <p class="inlinelink">
                    struct Precise3DPoint {x: f32, y: f32, z: f32}<br>
                    <br>
                    fn main() {<br>
                    &nbsp;let p = Precise3DPoint {x: 32.456, y: 12.321, z: 98.546};<br>
                    &nbsp;println!("{}", p.z)<br>
                    }
                </p>
                <label for="answertext">Output: </label><input type="text" id="answertext" name="question3">
            </div>', '98.546',
    '<div class="info">
    <h3>Question 4</h3>
    <p>
        Will the following code compile?
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;println!("{}", reverse(100, 10))<br>
        }<br>
        <br>
        fn reverse(i, j) -> (i32, i32) {<br>
        &nbsp;(j, i)<br>
        }
    </p>
    <input id="question4_yes" name="question4_select" type="radio" value="Yes"><label for="question4_yes">Yes</label>
    <input id="question4_no" name="question4_select" type="radio" value="No"><label for="question4_no">No</label>
</div>', 'No',
    '<div class="info">
    <h3>Question 5</h3>
    <p>
        Fill in the missing upper bound of the for loop so that the main function prints the five times table <b>up to 60.</b>
    </p>
    <p class="inlinelink">
        fn main() {<br>
        <label for="answertext">&nbsp;for i in 1..</label><input name="question_5" id="answertext" type="text" size="2">&nbsp;{<br>
        &nbsp;&nbsp;println!("{}", 5*i);<br><br>
        &nbsp;}<br>
        }
    </p>
                </div>', '=12 13'
);

insert into Quizzes (quiz_id, quiz_topic, question_1, answer_1, question_2, answer_2, question_3, answer_3, question_4, answer_4, question_5, answer_5) values (
                                                                                                                                                    2,
                                                                                                                                                                'Ownership',
'<div class="info">
    <h3>Question 1</h3>
    <p>
        What is the printed output of the following code?
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let num: i32 = 5;<br>
        &nbsp;{<br>
        &nbsp;&nbsp;let num: i32 = num * 20;<br>
        &nbsp;}<br>
        &nbsp;println!("{}", num);<br>
        }
    </p>
    <label for="answertext">Output: </label><input id="answertext" name="question_1" type="text" size="10">
            </div>',
'5',
'<div class="info">
    <h3>Question 2</h3>
    <p>
        <b>True or false:</b>
    </p>
    <p>
        String slices are stored on the heap.
    </p>
    <input id="question_2_true" name="question_2" type="radio" value="True"><label for="question_2_true">True</label>
    <input id="question_2_false" name="question_2" type="radio" value="False"><label for="question_2_false">False</label>
        </div>',
'False',
'<div class="info">
    <h3>Question 3</h3>
    <p>
        Will the following code compile?
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let s = String::from("hello");<br>
        &nbsp;print_string(s);<br>
        &nbsp;dbg!(s);<br>
        }<br>
        <br>
        fn print_string(s: String) {<br>
        &nbsp;for i in s.chars() {<br>
        &nbsp;&nbsp;println!("{}", i)<br>
        &nbsp;}<br>
        }
    </p>
    <input id="question_3_true" name="question_3" type="radio" value="Yes"><label for="question_3_true">Yes</label>
    <input id="question_3_false" name="question_3" type="radio" value="No"><label for="question_3_false">No</label>
</div>',
'No',
'<div class="info">
    <h3>Question 4</h3>
    <p>
        Consider the following code:
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let arr = &[''1'', ''2'', ''3''];<br>
        &nbsp;println!("{} {} {}", arr[0], arr[1], arr[2])<br>
        }
    </p>
    <p>What is the <b>type</b> of <em>arr?</em></p>
    <input id="answertext" name="question_4" type="text">
</div>',
'&[char]',
'<div class="info">
    <h3>Question 5</h3>
    <p>
        <b>Why</b> does the following code refuse to compile?
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut string = String::from("String!");<br>
        &nbsp;let (x, y, z) = (&mut string, &mut string, &mut string);<br>
        &nbsp;println!("{x}, {y}, {z}");<br>
        }
    </p>

    <label>
        <input  name="question_5" type="radio" value="There is a type mismatch"> There is a type mismatch
    </label><br>
    <label>
        <input  name="question_5" type="radio" value="It is impossible for <em>x</em>, <em>y</em> and <em>z</em> to be declared like this"> It is impossible for <em>x</em>, <em>y</em> and <em>z</em> to be declared like this
    </label><br>
    <label>
        <input  name="question_5" type="radio" value="The println!() macro call is incorrectly formatted"> The println!() macro call is incorrectly formatted
    </label><br>
    <label>
        <input  name="question_5" type="radio" value="The assignment to <em>x</em>, <em>y</em> and <em>z</em> would make race conditions possible"> The assignment to <em>x</em>, <em>y</em> and <em>z</em> would make race conditions possible
    </label>
</div>',
'The assignment to <em>x</em>, <em>y</em> and <em>z</em> would make race conditions possible');

insert into Quizzes (quiz_id, quiz_topic, question_1, answer_1, question_2, answer_2, question_3, answer_3, question_4, answer_4, question_5, answer_5) values (
                                                                                                                                                       3,
                                                                                                                                                    'Pattern matching',
'<div class="info">
    <h3>Question 1</h3>
    <p>
        <b>Why</b> does the following code not compile?
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let string = ":)";<br>
        &nbsp;match string {<br>
        &nbsp;&nbsp;":)" => {<br>
        &nbsp;&nbsp;&nbsp;println!("Happy!")<br>
        &nbsp;&nbsp;}<br>
        &nbsp;&nbsp;":(" => {<br>
        &nbsp;&nbsp;&nbsp;println!("Sad!")<br>
        &nbsp;&nbsp;}<br>
        &nbsp;&nbsp;":|" => {<br>
        &nbsp;&nbsp;&nbsp;println!("Meh...")<br>
        &nbsp;&nbsp;}<br>
        &nbsp;}<br>
        }
    </p>

    <label>
        <input  name="question_1" type="radio" value="The match statement is missing a wildcard branch"> The match statement is missing a wildcard branch
    </label><br>
    <label>
        <input  name="question_1" type="radio" value="The branches of the match statement are missing ranges"> The branches of the match statement are missing ranges
    </label><br>
    <label>
        <input  name="question_1" type="radio" value="The println!() statements are missing semicolons"> The println!() statements are missing semicolons
    </label>
</div>',
'The match statement is missing a wildcard branch',
'<div class="info">
    <h3>Question 2</h3>
    <p>
        <b>True or false:</b>
    </p>
    <p>
        It is impossible to exhaustively match on enum variants/discriminants without a wildcard branch.
    </p>
    <label>
        <input name="question_2" type="radio" value="True"> True
    </label>
    <label>
        <input name="question_2" type="radio" value="False"> False
    </label>
</div>',
'False',
'<div class="info">
    <h3>Question 3</h3>
    <p>
        What is the printed output of the following?
    </p>
    <p class="inlinelink">
        enum Structs {<br>
        &nbsp;SplitString { fst: String, snd: String },<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let strs = Structs::SplitString {<br>
        &nbsp;&nbsp;fst: String::from("hel"),<br>
        &nbsp;&nbsp;snd: String::from("lo!")<br>
        &nbsp;};<br>
        &nbsp;if let Structs::SplitString {<br>
        &nbsp;&nbsp;fst: first,<br>
        &nbsp;&nbsp;snd: second<br>
        &nbsp;} = strs {<br>
        &nbsp;&nbsp;println!("{}{}", first, second)<br>
        &nbsp;}<br>
        }<br>

    </p>
    <label for="answertext">Output: </label><input id="answertext" name="question_3" type="text">
</div>',
'"hello!" hello!',
'<div class="info">
    <h3>Question 4</h3>
    <p>
        Fill in the blanks for the match statement below such that <b>all 32-bit negative numbers</b> are included, and <b>the string "Small!" is printed if a negative number is matched on.</b> <br>(Think back to the error examples given for match statements!)
    </p>
    <p class="inlinelink">
        fn mtch(a: i32) {<br>
        &nbsp;match a {<br>
        &nbsp;&nbsp;<input type="text" id="answertext" name="question_4_1" size="11"> => { <input type="text" id="answertext" name="question_4_2" size="18"> }<br>
        &nbsp;&nbsp;0 => { println!("Just right!") }<br><br>
        &nbsp;&nbsp;1.. => { println!("Big!") }<br><br>
        &nbsp;}<br>
        }
    </p>
</div>',
'i32::MIN..0 println!("Small!")',
'<div class="info">
    <h3>Question 5</h3>
    <p>
        Will the following code compile?
    </p>
    <p class="inlinelink">
        enum Structs {<br>
        &nbsp;ThreeDimensions {<br>
        &nbsp;&nbsp;x: i32,<br>
        &nbsp;&nbsp;y: i32,<br>
        &nbsp;&nbsp;z: i32<br>
        &nbsp;},<br>
        &nbsp;Precise3D {<br>
        &nbsp;&nbsp;x: f32,<br>
        &nbsp;&nbsp;y: f32,<br>
        &nbsp;&nbsp;z: f32<br>
        &nbsp;}<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let int_point = Structs::ThreeDimensions {<br>
        &nbsp;&nbsp;x: 27,<br>
        &nbsp;&nbsp;y: 68,<br>
        &nbsp;&nbsp;z: 91<br>
        &nbsp;};<br>
        &nbsp;let float_point = Structs::Precise3D {<br>
        &nbsp;&nbsp;x: 23.456,<br>
        &nbsp;&nbsp;y: 75.364,<br>
        &nbsp;&nbsp;z: 21.052<br>
        &nbsp;};<br>
        &nbsp;if let (Structs::ThreeDimensions { x: 27, .. },<br>
        &nbsp;&nbsp;Structs::Precise3D { z: 21.035, .. }) =<br>
        &nbsp;&nbsp;(int_point, float_point) {<br>
        &nbsp;&nbsp;&nbsp;println!("Match!")<br>
        &nbsp;&nbsp;} else {<br>
        &nbsp;&nbsp;&nbsp;println!("Mismatch!")<br>
        &nbsp;&nbsp;}<br>
        }
    </p>
    <label>
        <input type="radio" name="question_5" value="Yes"> Yes
    </label>
    <label>
        <input type="radio" name="question_5" value="No"> No
    </label>
</div>',
'Yes');

insert into Quizzes (quiz_id, quiz_topic, question_1, answer_1, question_2, answer_2, question_3, answer_3, question_4, answer_4, question_5, answer_5) values (
                                                                                                                                                       4,
                                                                                                                                                    'Collections',
'<div class="info">
    <h3>Question 1</h3>
    <p>
       <b>True or false:</b>
    </p>
    <p>
        <em>iter()</em> is a method implemented for hash maps that returns all key-value pairs in the order they were added.
    </p>
    <label>
        <input name="question_1" type="radio" value="True"> True
    </label>
    <label>
        <input name="question_1" type="radio" value="False"> False
    </label>
</div>',
'False',

'<div class="info">
    <h3>Question 2</h3>
    <p>
        Fill in the blank, using a method you learned in this chapter, to shorten the vector below by <b>five</b> elements.
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut v = vec![5.12; 20];<br>
        &nbsp;<label for="answertext">v.</label><input type="text" name="question_2" id="answertext" size="12">;<br>
        &nbsp;println!("{}", v.len())<br>
        }
    </p>
</div>',
'truncate(5)',
'<div class="info">
    <h3>Question 3</h3>
    <p>
      What is the printed output of the following?
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;let mut a = vec![49, 57, 12];<br>
        &nbsp;let mut b = Vec::from([43, 21, 56, 105]); // converting array into vec<br>
        &nbsp;a.append(&mut b);<br>
        &nbsp;a.reverse();<br>
        &nbsp;println!("{}", a.remove(0))<br>
        }
    </p>
    <label for="answertext">Output: </label><input id="answertext" name="question_3" type="text">
</div>',
'105',
'<div class="info">
    <h3>Question 4</h3>
    <p>
        Fill in both blanks below so that the hash map has 32-bit <b>unsigned</b> integer keys and single character values.
    </p>
    <p class="inlinelink">
        use std::collections::HashMap;<br>
        <br>
        fn main() {<br>
        <label for="answertext">&nbsp;let map: HashMap&lt; </label><input name="question_4_1" type="text" id="answertext" size="3"> <label for="answertext">,</label> <input name="question_4_2" type="text" id="answertext" size="3"> &gt; = HashMap::new();<br>
        &nbsp;println!("{:?}", map)<br>
        }
    </p>
</div>',
'u32 char',
'<div class="info">
       <h3>Question 5</h3>
       <p>
          In light of your knowledge of how <em>iter()</em> behaves on hash maps, how does it behave for vectors?
       </p>
       <label>
           <input name="question_5" type="radio" value="Returns all indices of elements"> Returns all indices of elements<br>
       </label>
       <label>
           <input name="question_5" type="radio" value="Returns references to all elements"> Returns references to all elements<br>
       </label>
       <label>
           <input name="question_5" type="radio" value="Returns values of all elements"> Returns values of all elements<br>
       </label>
   </div>',
'Returns values of all elements');

insert into Quizzes (quiz_id, quiz_topic, question_1, answer_1, question_2, answer_2, question_3, answer_3, question_4, answer_4, question_5, answer_5) values (
                                                                                                                                                       5,
                                                                                                                                                    'Error handling',
'<div class="info">
    <h3>Question 1</h3>
    <p>
      What is the primary difference between panic!() and Result?
    </p>
    <label>
        <input name="question_1" type="radio" value="Only panic!() allows for error handling with strings"> Only panic!() allows for error handling with strings<br>
    </label>
    <label>
        <input name="question_1" type="radio" value="An unsuccessful Result can be caught and managed"> An unsuccessful Result can be caught and managed<br>
    </label>
    <label>
        <input name="question_1" type="radio" value="There is no difference at all"> There is no difference at all<br>
    </label>
</div>',
'An unsuccessful Result can be caught and managed',
'<div class="info">
    <h3>Question 2</h3>
    <p>
        Does the following <em>successfully execute?</em>
    </p>
    <p class="inlinelink">
        fn main() {<br>
        &nbsp;panic!("{string}", string = ":(")<br>
        }
    </p>
    <label>
        <input name="question_2" type="radio" value="Yes"> Yes
    </label>
    <label>
        <input name="question_2" type="radio" value="No"> No
    </label>
</div>',
'No',
'   <div class="info">
    <h3>Question 3</h3>
    <p>
        <b>Why</b> does the following code fail to execute?
    </p>
    <p class="inlinelink">
        fn none() -> Option&lt; char &gt; {<br>
        &nbsp;None<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!("{:?}", none().unwrap())<br>
        }
    </p>
    <label>
        <input name="question_3" type="radio" value="em>unwrap()</em> panics"> <em>unwrap()</em> panics<br>
    </label>
    <label>
        <input name="question_3" type="radio" value="None is not a valid return value"> None is not a valid return value<br>
    </label>
    <label>
        <input name="question_3" type="radio" value="There is a type mismatch between None and the explicit return type of none()"> There is a type mismatch between None and the explicit return type of none()
    </label>
</div>',
'<em>unwrap()</em> panics',
'<div class="info">
    <h3>Question 4</h3>
    <p>
        Fill in the blank in the following function with an appropriate type:
    </p>
    <p class="inlinelink">
        <label for="answertext">fn fail_result() -&gt; Result &lt; i32, </label><input name="question_4" id="answertext" type="text" size="3"> &gt; {<br>
        &nbsp;Err(12.346)<br>
        <br>
        }
    </p>
</div>',
'f32 f64',
'<div class="info">
    <h3>Question 5</h3>
    <p>
        What is the printed output of the code below?
    </p>
    <p class="inlinelink">
        fn result_to_option(opt: Result &lt; i32, char &gt;) -> Option&lt; i32 &gt; {<br>
        &nbsp;let new_option = Some(opt.ok()?);<br>
        &nbsp;new_option<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let res = Err(''a'');<br>
        &nbsp;println!("{:?}", result_to_option(res))<br>
        }
    </p>
    <label for="answertext">Output: </label><input id="answertext" name="question_5" type="text" size="10">
</div>',
'None');

insert into Quizzes (quiz_id, quiz_topic, question_1, answer_1, question_2, answer_2, question_3, answer_3, question_4, answer_4, question_5, answer_5) values (
                                                                                                                                                       6,
                                                                                                                                                    'Beyond the basics',
'<div class="info">
    <h3>Question 1</h3>
    <p>
        Will the following code compile?
    </p>
    <p class="inlinelink">
        fn identity&lt;T&gt;(t: T) -> T {<br>
        &nbsp;t<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;println!("{} {:?} {}", identity(5), identity([1,2,3]), identity("hello"))<br>
        }
    </p>
    <label>
        <input type="radio" name="question_1" value="Yes"> Yes
    </label>
    <label>
        <input type="radio" name="question_1" value="No"> No
    </label>
</div>',
'Yes',
'<div class="info">
    <h3>Question 2</h3>
    <p>
        <b>Why</b> does the following function <b>successfully compile?</b>
    </p>
    <p class="inlinelink">
        fn f() -> &''static str {<br>
        &nbsp;"hello"<br>
        }<br>
    </p>
    <label>
        <input type="radio" name="question_2" value="The function <em>f()</em> is never used"> The function <em>f()</em> is never used<br>
    </label>
    <label>
        <input type="radio" name="question_2" value="The lifetime of the returned string in <em>f()</em> is guaranteed to be valid"> The lifetime of the returned string in <em>f()</em> is guaranteed to be valid<br>
    </label>
    <label>
        <input type="radio" name="question_2" value="It doesn''t"> It doesn''t
    </label>
</div>',
'The lifetime of the returned string in <em>f()</em> is guaranteed to be valid',
'<div class="info">
    <h3>Question 3</h3>
    <p>
        Fill in the blank so that the struct defined below is explicitly <b>cloneable.</b>
    </p>
    <p class="inlinelink">
        <label for="answertext">#[derive(</label><input type="text" name="question_3" id="answertext" size="5">)]<br>
        struct S {<br>
        &nbsp;string: String,<br>
        &nbsp;opt: Option&lt;String&gt;,<br>
        &nbsp;res: Result&lt;i32, String&gt;<br>
        }
    </p>
</div>',
'Clone',
'<div class="info">
    <h3>Question 4</h3>
    <p>
        <b>True or false:</b>
    </p>
    <p>
        The lifetime of a reference is independent of its original variable''s lifetime.
    </p>
    <label>
        <input name="question_4" type="radio" value="True"> True
    </label>
    <label>
        <input name="question_4" type="radio" value="False"> False
    </label>
</div>',
'False',
'<div class="info">
    <h3>Question 5</h3>
    <p>
        Will the following compile?
    </p>
    <p class="inlinelink">
        fn f<''a, T>(arr: &''a Vec&lt;T&gt;) -> &''a T where T: Copy {<br>
        &nbsp;&arr[0]<br>
        }<br>
        <br>
        fn main() {<br>
        &nbsp;let mut v = vec![];<br>
        &nbsp;v.push(String::from("This is a string!"));<br>
        &nbsp;println!("{}", f(&v))<br>
        }

    </p>
    <label>
        <input name="question_5" type="radio" value="Yes"> Yes
    </label>
    <label>
        <input name="question_5" type="radio" value="No"> No
    </label>
</div>',
'No');

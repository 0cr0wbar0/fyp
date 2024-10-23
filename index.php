
<?php
    require __DIR__ . '/vendor/autoload.php';

    $router = new AltoRouter();

    $router->map('GET', '/', function() {
        require __DIR__ . '/home.html';
    });

    $router->map('GET', '/login', function() {
        require __DIR__ . '/login.html';
    });

    $router->map('GET', '/register', function() {
        require __DIR__ . '/register.html';
    });

    // [a:page] is a regex match on alphanumerics that creates a variable $page

    $router->map('GET', '/[a:page]', function($page) {
        require __DIR__ . '/' . $page . '/' . $page . '-home.html';
    });

    // [i:id] is same as above comment, except for integers and creates $id

    $router->map('GET', '/[a:page]/[i:id]', function($page, $id) {
        require __DIR__ . '/' . $page . '/' . $page . '-' . $id . '.html';
    });

    $router->map('GET', '/[a:page]/quiz', function($page) {
        require __DIR__ . '/' . $page . '/' . $page . '-quiz.html';
    });

    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] );
    } else {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }

?>

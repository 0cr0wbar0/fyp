
<?php
    require __DIR__ . '/vendor/autoload.php';
    require __DIR__ . '/init_database.php';

    $router = new AltoRouter();

    if (getenv('DATABASE_URL') === null) {
        $database = init_database();
    }

    $router->map('GET', '/', function() {
        require __DIR__ . '/home.php';
    });

    $router->map('GET', '/login', function() {
        require __DIR__ . '/login.php';
    });

    $router->map('GET', '/register', function() {
        require __DIR__ . '/register.php';
    });

    // [a:page] is a regex match on alphanumerics that creates a variable $page

    $router->map('GET', '/[a:page]', function($page) {
        require __DIR__ . '/' . $page . '/' . $page . '-home.php';
    });

    // [i:id] is same as above comment, except for integers and creates $id

    $router->map('GET', '/[a:page]/[i:id]', function($page, $id) {
        require __DIR__ . '/' . $page . '/' . $page . '-' . $id . '.php';
    });

    $router->map('GET', '/[a:page]/quiz', function($page) {
        require __DIR__ . '/' . $page . '/' . $page . '-quiz.php';
    });

    $router->map('GET', '/profile', function() {
        require __DIR__ . '/profile.php';
    });

    $router->map('GET', '/static/*', function() {
        require __DIR__ . '/home.php';
    });

    $router->map('GET', '/vendor/*', function() {
        require __DIR__ . '/home.php';
    });

    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] );
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }

?>

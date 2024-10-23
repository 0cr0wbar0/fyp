
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

    $router->map('GET', '/fundamentals', function() {
        require __DIR__ . '/fundamentals/fundamentals-home.html';
    });
    
    $router->map('GET', '/ownership', function () {
        require __DIR__ . '/ownership/ownership-home.html';
    });

    $router->map('GET', '/patternmatching', function () {
        require __DIR__ . '/patternmatching/patternmatching-home.html';
    });

    $router->map('GET', '/collections', function () {
        require __DIR__ . '/collections/collections-home.html';
    });

    $router->map('GET', '/errorhandling', function() {
        require __DIR__ . '/errorhandling/errorhandling-home.html';
    });

    $router->map('GET', '/generics', function() {
        require __DIR__ . '/generics/generics-home.html';
    });

    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] );
    } else {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }

?>

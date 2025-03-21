<?php

function init_database(): mysqli {
    $env = file_get_contents(__DIR__."/.env");
    $lines = explode("\n",$env);

    foreach($lines as $line){
        preg_match("/([^#]+)=(.*)/",$line,$matches);
        if(isset($matches[2])){ putenv(trim($line)); }
    }

    $servername = getenv('DATABASE_URL');
    $root_user = getenv('DATABASE_USER');
    $db_name = getenv('DATABASE_NAME');
    $root_password = getenv('DATABASE_PASSWORD');

    global $database;

    $database = new mysqli($servername, $root_user, $root_password, $db_name);

    return $database;
}
<?php
ini_set('display_errors',0);

$input = str_replace( array('“', '”', '‘', '’',), array('"', '"', "'", "'"), $_POST["code_block"]);
$input = mb_convert_encoding($input, "UTF-8");
$arr = [];
exec("docker run --rm --ulimit rttime=10 --memory=50m rust-test bash temp.sh ".escapeshellarg($input)." 2>&1", $arr, $result);


$output = implode("\n", $arr);

if (trim($output) == null) {
    $output = "No output...";
}

$response = array(
        "exit_code" => $result,
        "output" => $output
);
echo json_encode($response);
<?php
ini_set('display_errors',0);

$input = $_POST["code_block"];
$arr = [];
exec("docker run --rm --ulimit cpu=5 rust-test bash temp.sh ".escapeshellarg($input)." 2>&1", $arr, $result);

// reminder
// <?php <p class=<?php if ($result == 0) { "inlinelink" } else { "inline-err" }>


$response = array(
        "exit_code" => $result,
        "output" => implode("\n", $arr)
);
echo json_encode($response);
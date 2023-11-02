<?php

session_start();

if ($_SESSION['status'] == 'admin' && $_SESSION['email']) {
    $file_paths = "/Users/Lenovo/Desktop/php practice/module-5/login-form/data.json";
    $json_data = file_get_contents($file_paths);
    $data = json_decode($json_data, true);

    if ($data === null) {
        die("Error parsing JSON data.");
    }

    if (isset($_GET['data'])) {
        $decoded_value = urldecode($_GET['data']);
    }

    unset($data[$decoded_value]);

    file_put_contents($file_paths, json_encode($data, JSON_PRETTY_PRINT));
    header("location:dashboard.php");

} else {
    header('location:dashboard.php');
}

<?php
require 'varDump.php';

$new_todo = $_POST['item'] ?? "";
$new_todo = trim($new_todo);

if ($new_todo) {
    if (file_exists('list.json')) {

        $json = file_get_contents('list.json');
        $jsonArray = json_decode($json, true);
    } else {
        $jsonArray = [];
    }
    $jsonArray[$new_todo] = ["completed" => false];
    $json = json_encode($jsonArray, JSON_PRETTY_PRINT);
    file_put_contents('list.json', $json);
}

header('location: index.php');
<?php
$todo = $_POST['todo_name'];

$todos = file_get_contents('list.json');
$todos = json_decode($todos, true);


$todos[$todo]['completed'] = !$todos[$todo]['completed'];

file_put_contents('list.json', json_encode($todos, JSON_PRETTY_PRINT));

header('location: index.php');
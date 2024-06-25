<?php

$todo = $_POST['todo_name'];

$todos = file_get_contents('list.json');
$todos = json_decode($todos, true);

unset($todos[$todo]);

$todos = json_encode($todos, JSON_PRETTY_PRINT);
file_put_contents('list.json', $todos);

header('location: index.php');

<?php


$path = $argv[1];
$currentStatus = [];
readpath($path, $currentStatus);
while (true) {
    clearcache($path);
    checkpath($path);
    sleep(1);
}

function clearcache($path)
{
    clearstatcache(false, $path);
}

function readpath($path, &$filesMap)
{
    $filesMap[$path] = filemtime($path);
    if (is_dir($path)) {
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                continue;
            }
            $filename = $path . '/' . $file;
            $filesMap[$filename] = filemtime($filename);
            if (is_dir($filename)) {
                readpath($filename, $filesMap);
            }
        }

    }
}

function checkpath($path)
{
    global $currentStatus;
    $newStatus = [];
    readpath($path, $newStatus);
    foreach ($currentStatus as $file => $time) {
        if (!isset($newStatus[$file])) {
            echo "file \"$file\" was deleted..." . PHP_EOL;
        } elseif ($newStatus[$file] != $time) {
            echo "file \"$file\" was modified..." . PHP_EOL;

        }

    }
    foreach ($currentStatus as $file => $time) {
        if (!isset($currentStatus[$file])) {
            echo "file \"$file\" was added..." . PHP_EOL;
        }
    }
    $currentStatus = $newStatus;

}
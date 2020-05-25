<?php
$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

$data = $_GET;

$tasks[] = array(
    array(
        'task' => $data['task'], // string
        'due' => $data['due'], // Y/m/d H:i:s
        'created' => date('Y/m/d H:i:s'), // Y/m/d H:i:s
        'labels' => $data['labels'], // array of strings
        'project' => $data['project'], // string
        'priority' => $data['priority'] // none, low, medium, high
    )
);

$tasks = json_encode($tasks);
file_put_contents('storage/tasks.json', $tasks);
?>
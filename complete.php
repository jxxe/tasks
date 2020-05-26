<?php
// Accepts an AJAX request and completes a task
$timezone = file_get_contents('storage/settings.json');
$timezone = json_decode($prefs, true);
$timezone = $timezone['timezone'];
date_default_timezone_set($timezone);

$id = $_POST['id'];

$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

$stats = file_get_contents('storage/statistics.json');
$stats = json_decode($stats, true);

$completed = file_get_contents('storage/completed.json');
$completed = json_decode($completed, true);

foreach($tasks as $key => $task) {
    if($task['id'] == $id) {
        $stats[] = array(
            'priority' => $task['priority'],
            'created' => $task['created'],
            'completed' => date('Y/m/d H:i:s'),
            'project' => $task['project']
        );
        $completed[] = $task;
        unset($tasks[$key]);
        break;
    }
}

$i = 0;
foreach($tasks as &$task) {
    $task['order'] = $i;
    $i++;
}

$tasks = json_encode($tasks);
file_put_contents('storage/tasks.json', $tasks);

$stats = json_encode($stats);
file_put_contents('storage/statistics.json', $stats);

$completed = json_encode($completed);
file_put_contents('storage/completed.json', $completed);
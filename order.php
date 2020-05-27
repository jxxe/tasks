<?php
// Accepts an AJAX request and reorders tasks
$order = $_POST;
print_r($order);
$order = $order['order'];


$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

foreach($order as $key => $position) {
    $tasks[$key]['order'] = $position;
}

usort($tasks, function($a, $b) {
    return $a['order'] <=> $b['order'];
});

// Reindex orders
foreach($tasks as $key => &$task) {
    $task['order'] = $key;
}

$tasks = json_encode($tasks);
file_put_contents('storage/tasks.json' ,$tasks);
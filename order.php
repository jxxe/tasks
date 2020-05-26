<?php
// Accepts an AJAX request and reorders tasks
$order = $_POST;
$order = $order['order'];

$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

$i = 0;
foreach($order as $position) {
    echo $tasks[$i]['order'] . ':';
    $tasks[$i]['order'] = $position;
    echo $tasks[$i]['order'] . ' / ';
    $i++;
}

usort($tasks, function($a, $b) {
    return $a['order'] <=> $b['order'];
});

$tasks = json_encode($tasks);
file_put_contents('storage/tasks.json' ,$tasks);
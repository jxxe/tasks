<?php
// Accepts an AJAX request and reorders tasks
$order = $_POST;
$order = $order['order'];

echo '<pre>';
print_r($order);
echo '</pre>';

$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

echo '<pre>';
foreach($tasks as $task) {
    echo $task['order'];
    echo '<br>';
}
echo '</pre>';
echo '<hr>';

// Update orders
foreach($order as $key => $position) {
    if($key == count($tasks)) {
        break;
    } else {
        $tasks[$key]['order'] = $position;
    }
}

echo '<pre>';
foreach($tasks as $task) {
    echo $task['order'];
    echo '<br>';
}
echo '</pre>';
echo '<hr>';

// Sort by order
usort($tasks, function($a, $b) {
    return $a['order'] <=> $b['order'];
});

echo '<pre>';
foreach($tasks as $task) {
    echo $task['order'];
    echo '<br>';
}
echo '</pre>';
echo '<hr>';

// Reindex orders
foreach($tasks as $key => &$task) {
    $task['order'] = $key;
}

echo '<pre>';
foreach($tasks as $task) {
    echo $task['order'];
    echo '<br>';
}
echo '</pre>';
echo '<hr>';

$tasks = json_encode($tasks);
file_put_contents('storage/tasks.json' ,$tasks);
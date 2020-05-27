<?php

$tasks = [
    [
        'task' => 'First task, stay first',
        'order' => 0,
    ],
    [
        'task' => 'Second task, become fourth',
        'order' => 1,
    ],
    [
        'task' => 'Third task, become second',
        'order' => 2,
    ],
    [
        'task' => 'Fourth task, become third',
        'order' => 3,
    ]
];

foreach($tasks as $task) {
    echo $task['task'] . ' / ' . $task['order'];
    echo '<br>';
}

$order = [0,2,3,1]; // first, third, fourth, second

echo '<br>';

foreach($order as $key => $position) {
    print_r($tasks[$key]);
    echo '<br>';
    $tasks[$key]['order'] = $position;
    print_r($tasks[$key]);
    echo '<br><br>';
}

usort($tasks, function($a, $b) {
    return $a['order'] <=> $b['order'];
});

foreach($order as $key => $position) {
    print_r($tasks[$key]);
    echo '<br><br>';
}

echo '<hr>';

$list = [
    [
        'order' => 1.
    ],
    [
        'order' => 3.
    ],
    [
        'order' => 8.
    ],
    [
        'order' => 10.
    ],
];

echo '<pre>';
print_r($list);
echo '</pre>';

foreach($list as $number => &$item) {
    $item['order'] = $number;
}

echo '<pre>';
print_r($list);
echo '</pre>';
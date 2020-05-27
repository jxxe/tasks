<?php
$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

$data = $_POST;

if(empty($data['priority'])) {
    $priority = 'no';
} else {
    $priority = $data['priority'];
}

if(empty($data['due'])) {
    $due = null;
} else {
    $due = date("Y/m/d", strtotime($data['due']));
}

foreach($tasks as &$task) {
    $task['order'] = $task['order'] + 1;
}

$id = uniqid();

$tasks[] = array(
    'task' => strip_tags($data['task']), // string
    'due' => @strip_tags($due), // Y/m/d
    'alert' => @strip_tags($data['alert']),
    'created' => date('Y/m/d H:i:s'), // Y/m/d H:i:s
    'labels' => @strip_tags($data['labels']), // array of strings
    'project' => @strip_tags($data['project']), // string
    'priority' => @strip_tags($priority), // no, low, medium, high
    'id' => $id, // unique id
    'order' => 0, // integer, starts at zero
    'link' => $data['link'],
);

echo $id;

usort($tasks, function($a, $b) {
    return $a['order'] <=> $b['order'];
});

$tasks = json_encode($tasks);
file_put_contents('storage/tasks.json', $tasks);
?>
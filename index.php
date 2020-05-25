<?php
$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

foreach($tasks as $task) {
    
}
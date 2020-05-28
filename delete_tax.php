<?php
$post = $_POST;
if($post['type'] == 'label') {
    $labels = file_get_contents('storage/labels.json');
    $labels = json_decode($labels, true);
    
    foreach($labels as $key => $label) {
        if($label['id'] == $post['id']) {
            unset($labels[$key]);
            break;
        }
    }

    $labels = json_encode($labels);
    $labels = file_put_contents('storage/labels.json', $labels);
} else if($post['type'] == 'project') {
    $projects = file_get_contents('storage/projects.json');
    $projects = json_decode($projects, true);
    
    foreach($projects as $key => $project) {
        if($project['id'] == $post['id']) {
            unset($projects[$key]);
            break;
        }
    }
    
    $projects = json_encode($projects);
    $projects = file_put_contents('storage/projects.json', $projects);
}
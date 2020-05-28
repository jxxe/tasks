<?php
$projects = file_get_contents('storage/projects.json');
$projects = json_decode($projects, true);

$data = $_POST;

$id = 'project-' . uniqid();

function strtoslug($string){
    return trim(preg_replace('/[^A-Za-z0-9]+/', '_', $string), '_');
}

$projects[] = array(
    'name' => strtoslug(strip_tags($data['name'])),
    'color' => strip_tags($data['color']),
    'id' => $id,
);

echo $id;

$projects = json_encode($projects);
file_put_contents('storage/projects.json', $projects);
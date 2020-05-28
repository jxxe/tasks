<?php
$labels = file_get_contents('storage/labels.json');
$labels = json_decode($labels, true);

$data = $_POST;

$id = 'label-' . uniqid();

function strtoslug($string){
    return trim(preg_replace('/[^A-Za-z0-9]+/', '_', $string), '_');
}

$labels[] = array(
    'name' => strtoslug(strip_tags($data['name'])),
    'color' => strip_tags($data['color']),
    'id' => $id,
);

echo $id;

$labels = json_encode($labels);
file_put_contents('storage/labels.json', $labels);
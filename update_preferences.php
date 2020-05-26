<?php
/**
 * array(
 *     'timezone' => 'America/Los_Angeles',
 *     'color_theme' => 'light'
 * )
 */
$prefs = file_get_contents('storage/settings.json');
$prefs = json_decode($prefs, true);

$prefs = $_POST;

$prefs = json_encode($prefs);
file_put_contents('storage/settings.json', $prefs);
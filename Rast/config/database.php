<?php

$connection = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'rast'
];


$mysqli = new mysqli(
    $connection['host'],
    $connection['user'],
    $connection['password'],
    $connection['database']
);

if($mysqli->connect_error){
    die("Error conecting to database".$mysqli->connect_error);
}
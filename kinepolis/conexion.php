<?php

$host = '127.0.0.1';
$bd = 'kinepolis';
$usuario = 'user';
$password = 'P9k@D6r!V2x#Bn7L';

$conexion = new PDO(
    "mysql:host=$host;dbname=$bd;charset=utf8mb4",
    $usuario,
    $password
);

$conexion->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
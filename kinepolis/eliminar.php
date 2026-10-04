<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = '
        DELETE FROM peliculas
        WHERE id = :id
    ';

    $consulta = $conexion->prepare($sql);

    $consulta->execute([
        'id' => $_POST['id']
    ]);
}

header('Location: index.php');
exit;
?>
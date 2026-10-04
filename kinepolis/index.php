<?php
require 'conexion.php';

$consulta = $conexion->prepare(
    'SELECT * FROM peliculas'
);

$consulta->execute();

$peliculas = $consulta->fetchAll(
    PDO::FETCH_ASSOC
);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cartelera Kinépolis</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <section class="cartelera">

    <?php foreach ($peliculas as $pelicula): ?>

    <article class="pelicula">
        <h2><?= $pelicula['titulo'] ?></h2>
        <p><?= $pelicula['genero'] ?></p>
        <p><?= $pelicula['duracion'] ?> minutos</p>
        
        <?php if ($pelicula['3d'] == 1): ?>
                <span class="badge">3D</span>
            <?php endif; ?>
    </article>

    <?php endforeach; ?>

</section>
</body>
</html>
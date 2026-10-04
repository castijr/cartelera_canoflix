<?php
require 'conexion.php';
$buscar = $_GET['buscar'] ?? '';
$consulta = $conexion->prepare('SELECT * FROM peliculas WHERE titulo LIKE :buscar');
$consulta->execute(['buscar' => '%' . $buscar . '%']);
$peliculas = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cartelera Kinépolis</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
 
    <header class="controles-superiores">
        <a class="boton boton-nuevo" href="nueva.php">
            + Añadir Nueva Película
        </a>
        
        <form method="get" class="buscador">
            <label for="buscar" style="margin-right: 10px;">Buscar película:</label>
            <input id="buscar" type="text" name="buscar" placeholder="Título..." style="padding: 5px;">
            <button type="submit" class="boton">Buscar</button>
        </form>
    </header>

    <?php if ($buscar != ''): ?>
        <p style="text-align: center; margin-bottom: 20px;">Resultados para: <strong><?= $buscar ?></strong></p>
    <?php endif; ?>
    
    <section class="cartelera">
        <?php foreach ($peliculas as $pelicula): ?>

        <article class="pelicula <?php if ($pelicula['3d'] == 1): ?> fondo-verde <?php endif; ?>">
            <h2><?= $pelicula['titulo'] ?></h2>
            <p><strong>Género:</strong> <?= $pelicula['genero'] ?></p>
            <p><strong>Duración:</strong> <?= $pelicula['duracion'] ?> min</p>
            <p><strong>Estreno:</strong> <?= $pelicula['anyo'] ?></p>
            <p><strong>Director:</strong> <?= $pelicula['director'] ?></p>
        
            <label>
                <input type="checkbox" <?php if ($pelicula['3d'] == 1): ?> checked <?php endif; ?> disabled> 
                Versión 3D
            </label>
            
            <div class="acciones">
                <a class="boton" href="editar.php?id=<?= $pelicula['id'] ?>">Editar</a>
                
                <form action="eliminar.php" method="post" style="margin: 0;">
                    <input type="hidden" name="id" value="<?= $pelicula['id'] ?>">
                    <button class="boton peligro">Eliminar</button>
                </form>
            </div>
        </article>

        <?php endforeach; ?>
    </section>
</body>
</html>
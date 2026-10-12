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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera Kinépolis</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
 
    <header class="controles-superiores">
        <a href="https://acastillo.iesalonsocano.org/cartelera_canoflix/kinepolis/index.php">
            <img src="img/logo_canoflix_sinFondo.png" width="150" alt="Logo Canoflix">
        </a>
        
        <form method="get" class="buscador">
            <label for="buscar">Buscar película:</label>
            <input id="buscar" type="text" name="buscar" placeholder="Título...">
            <button type="submit" class="boton">Buscar</button>
        </form>

        <a class="boton boton-nuevo" href="nueva.php">
            + Añadir Nueva Película
        </a>
    </header>

    <?php if ($buscar != ''): ?>
        <p class="resultado-busqueda">Resultados para: <strong><?= htmlspecialchars($buscar) ?></strong></p>
    <?php endif; ?>
    
    <section class="cartelera">
        <?php foreach ($peliculas as $pelicula): ?>

        <article class="pelicula">
            <header class="pelicula-cabecera">
                <h2 class="pelicula-titulo"><?= htmlspecialchars($pelicula['titulo']) ?></h2>
                <span class="pelicula-puntuacion">★ <?= htmlspecialchars($pelicula['puntuacion']) ?></span>
            </header>

            <div class="pelicula-info">
                <p class="pelicula-director"><strong>Director:</strong> <?= htmlspecialchars($pelicula['director']) ?></p>
                <p class="pelicula-metadata">
                    <?= htmlspecialchars($pelicula['genero']) ?> · <?= htmlspecialchars($pelicula['duracion']) ?> min · <?= htmlspecialchars($pelicula['anyo']) ?> · <?= htmlspecialchars($pelicula['idioma']) ?>
                </p>
            </div>

            <?php if ($pelicula['3d'] == 1): ?>
                <span class="badge-3d">✨ 3D Disponible</span>
            <?php else: ?>
                <span class="badge-2d">2D Estándar</span>
            <?php endif; ?>
            
            <p class="descripcion"><?= htmlspecialchars($pelicula['descripcion']) ?></p>
            
            <div class="acciones">
                <a class="boton boton-editar" href="editar.php?id=<?= $pelicula['id'] ?>">Editar</a>
                
                <form action="eliminar.php" method="post">
                    <input type="hidden" name="id" value="<?= $pelicula['id'] ?>">
                    <button class="boton peligro">Eliminar</button>
                </form>
            </div>
        </article>

        <?php endforeach; ?>
    </section>
</body>
</html>
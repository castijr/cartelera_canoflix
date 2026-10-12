<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id =$_GET['id'] ?? null;

    if (!$id) {
        header('Location: index.php');
        exit;
    }

    $consulta =$conexion->prepare('SELECT * FROM peliculas WHERE id = :id');
    $consulta->execute(['id' =>$id]);
    $pelicula =$consulta->fetch(PDO::FETCH_ASSOC);

    if (!$pelicula) {
        header('Location: index.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {$sql = '
        UPDATE peliculas
        SET titulo = :titulo,
            puntuacion = :puntuacion,
            genero = :genero,
            duracion = :duracion,
            director = :director,
            anyo = :anyo,
            idioma = :idioma,
            `3d` = :tres_d,
            descripcion = :descripcion
        WHERE id = :id
    ';

    $consulta = $conexion->prepare($sql);

    $consulta->execute([
        'titulo'      => $_POST['titulo'],
        'puntuacion'  => $_POST['puntuacion'],
        'genero'      => $_POST['genero'],
        'duracion'    => $_POST['duracion'],
        'director'    => $_POST['director'],
        'anyo'        => $_POST['anyo'],
        'idioma'      => $_POST['idioma'],
        'tres_d'      => isset($_POST['3d']) ? 1 : 0,         'descripcion' =>$_POST['descripcion'],
        'id'          => $_POST['id']
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Película</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header style="text-align: center; margin-bottom: 20px;">
        <h1>Editar Película</h1>
    </header>

    <section style="max-width: 600px; margin: 0 auto; background: var(--color-superficie); padding: 30px; border-radius: var(--radio-tarjeta); border: 2px solid var(--color-principal);">
        
        <form method="post" style="display: flex; flex-direction: column; gap: 15px;">

            <input type="hidden" name="id" value="<?= $pelicula['id'] ?>">

            <div>
                <label>Título:</label><br>
                <input type="text" name="titulo" value="<?= htmlspecialchars($pelicula['titulo']) ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Puntuación (0 - 10):</label><br>
                    <input type="number" step="0.1" min="0" max="10" name="puntuacion" value="<?= $pelicula['puntuacion'] ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label>Género:</label><br>
                    <input type="text" name="genero" value="<?= htmlspecialchars($pelicula['genero']) ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Duración (min):</label><br>
                    <input type="number" name="duracion" value="<?= $pelicula['duracion'] ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label>Director:</label><br>
                    <input type="text" name="director" value="<?= htmlspecialchars($pelicula['director']) ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Año:</label><br>
                    <input type="number" name="anyo" value="<?= $pelicula['anyo'] ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label>Idioma:</label><br>
                    <input type="text" name="idioma" value="<?= htmlspecialchars($pelicula['idioma'] ?? '') ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
            </div>

            <div>
                <label style="font-weight: bold; cursor: pointer;">
                    <input type="checkbox" name="3d" value="1" <?php if ($pelicula['3d'] == 1) echo 'checked'; ?>> 
                    Es versión 3D
                </label>
            </div>

            <div>
                <label>Descripción:</label><br>
                <textarea name="descripcion" rows="4" required style="width: 100%; padding: 8px; box-sizing: border-box; resize: vertical;"><?= htmlspecialchars($pelicula['descripcion'] ?? '') ?></textarea>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="boton" style="flex: 1;">Actualizar Película</button>
                <a href="index.php" class="boton" style="background-color: var(--color-texto-secundario); text-align: center; flex: 1;">Cancelar</a>
            </div>
        </form>

    </section>
</body>
</html>
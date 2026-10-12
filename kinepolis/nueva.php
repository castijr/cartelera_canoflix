<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {$sql = '
        INSERT INTO peliculas
        (titulo, puntuacion, genero, duracion, director, anyo, idioma, `3d`, descripcion)
        VALUES
        (:titulo, :puntuacion, :genero, :duracion, :director, :anyo, :idioma, :tres_d, :descripcion)
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
        'tres_d'      => isset($_POST['3d']) ? 1 : 0,         'descripcion' =>$_POST['descripcion']
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
    <title>Añadir Nueva Película</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header style="text-align: center; margin-bottom: 20px;">
        <h1>+ Añadir Nueva Película</h1>
    </header>

    <section style="max-width: 600px; margin: 0 auto; background: var(--color-superficie); padding: 30px; border-radius: var(--radio-tarjeta); border: 2px solid var(--color-principal);">
        
        <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label>Título:</label><br>
                <input type="text" name="titulo" required style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Puntuación (0 - 10):</label><br>
                    <input type="number" step="0.1" min="0" max="10" name="puntuacion" placeholder="Ej: 8.5" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label>Género:</label><br>
                    <input type="text" name="genero" placeholder="Ej: Ciencia ficción" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Duración (min):</label><br>
                    <input type="number" name="duracion" placeholder="Ej: 148" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label>Director:</label><br>
                    <input type="text" name="director" placeholder="Ej: Christopher Nolan" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Año:</label><br>
                    <input type="number" name="anyo" placeholder="Ej: 2024" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label>Idioma:</label><br>
                    <input type="text" name="idioma" placeholder="Ej: Inglés" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                </div>
            </div>

            <div>
                <label style="font-weight: bold; cursor: pointer;">
                    <input type="checkbox" name="3d" value="1"> 
                    Es versión 3D
                </label>
            </div>

            <div>
                <label>Descripción:</label><br>
                <textarea name="descripcion" rows="4" placeholder="Sinopsis de la película..." required style="width: 100%; padding: 8px; box-sizing: border-box; resize: vertical;"></textarea>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="boton" style="flex: 1;">Guardar Película</button>
                <a href="index.php" class="boton" style="background-color: var(--color-texto-secundario); text-align: center; flex: 1;">Cancelar</a>
            </div>
        </form>

    </section>
</body>
</html>
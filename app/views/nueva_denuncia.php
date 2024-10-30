<?php
include_once '../controllers/DenunciaController.php'; // Ruta corregida

$denunciaController = new DenunciaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturando los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $estado = $_POST['estado'];
    $ciudadano = $_POST['ciudadano'];
    $telefono = $_POST['telefono'];

    // Crear nueva denuncia
    if ($denunciaController->crearDenuncia($titulo, $descripcion, $ubicacion, $estado, $ciudadano, $telefono)) {
        // Redirigir a la página de ver denuncias después de guardar
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al crear la denuncia. Intente nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Denuncia</title>
    <link rel="stylesheet" href="../utils/styles.css"> <!-- Ruta corregida para el CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Enlace a Font Awesome -->
</head>
<body>
    <div class="sidebar">
        <h2>Menú</h2>
        <ul>
            <li><a href="nueva_denuncia.php">Nueva Denuncia</a></li>
            <li><a href="index.php">Ver Denuncias</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="form-container">
            <h2>Crear Nueva Denuncia</h2>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" action="nueva_denuncia.php">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" required>

                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Resuelto">Resuelto</option>
                </select>

                <label for="ciudadano">Nombre del Ciudadano:</label>
                <input type="text" id="ciudadano" name="ciudadano" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>

                <button type="submit">Crear Denuncia</button>
            </form>
        </div>
    </div>
</body>
</html>

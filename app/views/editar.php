<?php
include_once '../controllers/DenunciaController.php'; // Asegúrate de que la ruta sea correcta

$denunciaController = new DenunciaController();

// Verifica si se ha pasado un ID a través de la URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Obtiene la denuncia según el ID proporcionado
    $denuncia = $denunciaController->obtenerDenunciaPorId($id);
    // Verifica si se encontró la denuncia
    if (!$denuncia) {
        echo "Denuncia no encontrada.";
        exit; // Termina la ejecución si no se encuentra la denuncia
    }
} else {
    // Si no se pasa un ID, redirige a la lista de denuncias
    header('Location: index.php');
    exit;
}

// Manejo de la actualización de la denuncia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $estado = $_POST['estado'];
    $ciudadano = $_POST['ciudadano'];
    $telefono = $_POST['telefono'];
    // Actualiza la denuncia en la base de datos
    $denunciaController->actualizarDenuncia($id, $titulo, $descripcion, $ubicacion, $estado, $ciudadano, $telefono);
    // Redirige a la lista de denuncias después de actualizar
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Denuncia</title>
    <link rel="stylesheet" href="../utils/styles.css"> <!-- Estilos generales -->
    <link rel="stylesheet" href="../utils/editar-styles.css"> <!-- Estilos específicos para editar.php -->
</head>
<body>
    <div class="container"> <!-- Añadido un contenedor para mantener la estructura -->
        <h2>Editar Denuncia</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($denuncia['id']); ?>">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($denuncia['titulo']); ?>" required>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required><?php echo htmlspecialchars($denuncia['descripcion']); ?></textarea>
            <label for="ubicacion">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion" value="<?php echo htmlspecialchars($denuncia['ubicacion']); ?>" required>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="">Seleccione un estado</option>
                <option value="Pendiente" <?php if ($denuncia['estado'] === 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                <option value="En Proceso" <?php if ($denuncia['estado'] === 'En Proceso') echo 'selected'; ?>>En Proceso</option>
                <option value="Resuelta" <?php if ($denuncia['estado'] === 'Resuelta') echo 'selected'; ?>>Resuelta</option>
                <option value="Cerrada" <?php if ($denuncia['estado'] === 'Cerrada') echo 'selected'; ?>>Cerrada</option>
            </select>
            <label for="ciudadano">Ciudadano:</label>
            <input type="text" name="ciudadano" id="ciudadano" value="<?php echo htmlspecialchars($denuncia['ciudadano']); ?>" required>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($denuncia['telefono_ciudadano']); ?>" required>
            <button type="submit">Actualizar</button>
            <button type="button" onclick="window.location.href='index.php'">Cancelar</button>
        </form>
    </div>
</body>
</html>

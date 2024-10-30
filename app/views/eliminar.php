<?php
include_once '../controllers/DenunciaController.php'; // Asegúrate de que la ruta sea correcta

$denunciaController = new DenunciaController();

// Verifica si se ha pasado un ID a través de la URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Elimina la denuncia utilizando el controlador
    if ($denunciaController->eliminarDenuncia($id)) {
        // Redirige a la lista de denuncias después de eliminar
        header('Location: index.php?message=Denuncia eliminada exitosamente');
        exit;
    } else {
        echo "Error al eliminar la denuncia.";
        exit; // Termina la ejecución si hay un error
    }
} else {
    // Si no se pasa un ID, redirige a la lista de denuncias
    header('Location: index.php');
    exit;
}
?>

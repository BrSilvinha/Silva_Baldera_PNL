<?php
include_once '../controllers/DenunciaController.php'; // Ruta corregida

$denunciaController = new DenunciaController();

// Paginación
$limit = 5; // Número de denuncias por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
$offset = ($page - 1) * $limit; // Cálculo del offset

// Búsqueda por ID
$searchId = isset($_GET['search_id']) ? (int)$_GET['search_id'] : null;
if ($searchId) {
    $denuncias = [$denunciaController->obtenerDenunciaPorId($searchId)];
} else {
    $denuncias = $denunciaController->obtenerDenuncias($offset, $limit);
}
$totalDenuncias = $denunciaController->contarDenuncias(); // Contar todas las denuncias
$totalPages = ceil($totalDenuncias / $limit); // Calcular total de páginas

// Manejo de eliminación
if (isset($_GET['eliminar'])) {
    $idEliminar = (int)$_GET['eliminar'];
    $denunciaController->eliminarDenuncia($idEliminar);
    // Redirige a la lista de denuncias después de eliminar, sin mensaje
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Denuncias</title>
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
        <div class="header">
            <h2>Lista de Denuncias</h2>
            <button class="btn-nueva-denuncia" onclick="window.location.href='nueva_denuncia.php'">Nueva Denuncia</button>
        </div>

        <div class="search">
            <input type="text" class="search-bar" placeholder="Buscar por ID..." id="search-input">
            <button class="search-button" onclick="searchById()">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                    <th>Ciudadano</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($denuncias) && !empty($denuncias[0])): ?>
                    <?php foreach ($denuncias as $denuncia): ?>
                        <tr>
                            <td><?php echo $denuncia['id']; ?></td>
                            <td><?php echo htmlspecialchars($denuncia['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['ubicacion']); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['estado']); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['ciudadano']); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['telefono_ciudadano']); ?></td>
                            <td class="actions">
                                <button class="btn-editar" title="Editar" onclick="window.location.href='editar.php?id=<?php echo $denuncia['id']; ?>'">
                                    <i class="fas fa-pencil-alt" style="color: white;"></i>
                                </button>
                                <button class="btn-eliminar" title="Eliminar" onclick="if(confirm('¿Estás seguro de que quieres eliminar esta denuncia?')) window.location.href='?eliminar=<?php echo $denuncia['id']; ?>'">
                                    <i class="fas fa-trash" style="color: white;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No hay denuncias registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">«</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>">»</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function searchById() {
            const searchInput = document.getElementById('search-input').value;
            if (searchInput) {
                window.location.href = `?search_id=${searchInput}`; // Redirigir a la misma página con el parámetro de búsqueda
            }
        }
    </script>
</body>
</html>

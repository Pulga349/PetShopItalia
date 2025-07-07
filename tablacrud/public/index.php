<?php
require_once(__DIR__ . '/../src/controllers/ProductoController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Stock</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="header-bar">
            <h2>Inventario 📋</h2>
            <a href="productos/crear.php" class="btn btn-add">Agregar Nuevo Producto ✔️</a>
        </div>
        <div class="card">
            <form method="GET" class="search-form">
                <input type="text" name="buscar" placeholder="Buscar producto..." value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
            </form>
        </div>
        
        <?php
        $controller = new ProductoController();
        $controller->listar();
        ?>
    </div>
</body>
</html>

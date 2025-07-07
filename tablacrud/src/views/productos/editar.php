<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="post" class="form-card-grid">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <div class="form-header">
                <a href="../index.php" class="btn">🔙 Volver</a>
                <h2>Editar Producto</h2>
                <p class="subtitle">Modifica la información del producto</p>
            </div>
            <?php if (!empty($errores['general'])): ?>
                <div class="err-msj"><?= $errores['general'] ?></div>
            <?php endif; ?>
            <div class="form-card-container">
                <div class="form-card form-main">
                    <h3>Información del Producto</h3>
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre) ?>" class="input">
                        <?php if (!empty($errores['nombre'])): ?><span class="err-msj"><?= $errores['nombre'] ?></span><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="input"><?= htmlspecialchars($descripcion) ?></textarea>
                        <?php if (!empty($errores['descripcion'])): ?><span class="err-msj"><?= $errores['descripcion'] ?></span><?php endif; ?>
                    </div>
                </div>
                <div class="form-card form-side">
                    <h3>Precio e Inventario</h3>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" id="precio" name="precio" value="<?= htmlspecialchars($precio) ?>" class="input">
                        <?php if (!empty($errores['precio'])): ?><span class="err-msj"><?= $errores['precio'] ?></span><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock Inicial</label>
                        <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($stock) ?>" class="input">
                        <?php if (!empty($errores['stock'])): ?><span class="err-msj"><?= $errores['stock'] ?></span><?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-card form-actions" style="flex-direction: row; justify-content: flex-end; display: flex; gap: 1em;">
                <a href="../index.php" class="btn btn-delete">Cancelar❌</a>
                <input type="submit" class="btn btn-add" value="Guardar💾" style="font-size: 1.1em;">
            </div>
        </form>
    </div>
</body>
</html>
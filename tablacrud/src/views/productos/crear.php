<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="post" class="form-card-grid">
            <div class="form-header">
                <a href="../index.php" class="btn">🔙 Volver</a>
                <h2>Agregar Producto</h2>
            </div>
            <?php if (!empty($errores['general'])): ?>
                <div class="err-msj"><?= $errores['general'] ?></div>
            <?php endif; ?>
            <div class="form-card-container">
                <div class="form-card form-main">
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" id="nombre" name="nombre" value="<?= ($nombre) ?>" class="input">
                        <?php if (!empty($errores['nombre'])): ?><span class="err-msj"><?= $errores['nombre'] ?></span><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="input"><?= ($descripcion) ?></textarea>
                        <?php if (!empty($errores['descripcion'])): ?><span class="err-msj"><?= $errores['descripcion'] ?></span><?php endif; ?>
                    </div>
                </div>
                <div class="form-card form-side">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" id="precio" name="precio" value="<?= ($precio) ?>" class="input">
                        <?php if (!empty($errores['precio'])): ?><span class="err-msj"><?= $errores['precio'] ?></span><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock Inicial</label>
                        <input type="number" id="stock" name="stock" value="<?= ($stock) ?>" class="input">
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

<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Última Actualización</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $productos_totales = 0;
    $stock_total = 0;
    $stock_bajo = 0;
while ($row = $result->fetch_assoc()): 
    $productos_totales++;
    $stock_total += $row['stock'];
    if ($row['stock'] <= 50) $stock_bajo++;
?>
        <tr>
            <td>#<?= htmlspecialchars($row['id']) ?></td>
            <td>
                <span style="font-weight: bold;"><?= htmlspecialchars($row['nombre']) ?></span><br>
                <span><?= htmlspecialchars($row['descripcion']) ?></span>
            </td>
            <td><span class="badge badge-price">$<?= number_format($row['precio'], 2, ',', '.') ?></span></td>
            <td>
                <?php if ($row['stock'] > 50): ?>
                    <span class="badge badge-stock badge-green"><?= $row['stock'] ?> unidades</span>
                <?php else: ?>
                    <span class="badge badge-stock badge-red"><?= $row['stock'] ?> unidades</span>
                <?php endif; ?>
            </td>
            <td><?php
            $fecha = strtotime($row['ultact']);
            echo date("d/m/Y, H:i", $fecha);?>
            </td>
            <td>
                <a href='productos/editar.php?id=<?= $row['id'] ?>' class='btn btn-edit'>Editar ✏️</a>
                <a href='productos/eliminar.php?id=<?= $row['id'] ?>' class='btn btn-delete' onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar ❌</a>
            </td>
        </tr>
<?php endwhile; ?>
    </tbody>
</table>

<div class="stats-row">
    <div class="card">
        <div class="card-header"><p>Productos Totales</p></div>
        <div class="card-body"><span><?= $productos_totales ?> 📦</span></div>
    </div>
    <div class="card">
        <div class="card-header"><p>Stock Total</p></div>
        <div class="card-body"><span><?= $stock_total ?> 📦​</span></div>
    </div>
    <div class="card">
        <div class="card-header"><p>Stock Bajo</p></div>
        <div class="card-body"><span><?= $stock_bajo ?> 📦​</span></div>
    </div>
</div>
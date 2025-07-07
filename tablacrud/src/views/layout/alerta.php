<div class="alerta-eliminar">
    <div class="alerta-contenido">
        <h3><?= $titulo ?? "¿Estás seguro?" ?></h3>
        <p><?= $mensaje ?? "¿Deseas eliminar este elemento?" ?></p>
        <form method="post" style="display:inline;">
            <input type="hidden" name="confirmar" value="1">
            <button type="submit" class="btn btn-delete">Sí, eliminar</button>
        </form>
        <a href="<?= $cancelar_url ?? '../index.php' ?>" class="btn">Cancelar</a>
    </div>
</div>
<style>
.alerta-eliminar {
    position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; z-index: 1000;
}
.alerta-contenido {
    background: #fff; padding: 2em 2.5em; border-radius: 12px; box-shadow: 0 2px 12px #0002; text-align: center;
}
</style>
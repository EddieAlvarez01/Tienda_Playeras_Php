<?php if ($_SESSION['user']['rol'] == 'administrador'): ?>
    <h1>Gestión de pedidos</h1>
    <?php if (isset($_SESSION['update-order'])): ?>
        <?php if ($_SESSION['update-order']): ?>
            <strong class="alert-green">Estado del pedido actualizado correctamente</strong>
        <?php else: ?>
            <strong class="alert-red">Error al actualizar estado del pedido</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('update-order'); ?>
    <?php endif; ?>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>
<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Numero de pedido</th>
            <th>Coste</th>
            <th>fecha</th>
            <th>Direccion</th>
            <th>Estado</th>
        </tr>
        <?php while ($order = $result->fetch_object()): ?>
            <tr>
                <td>
                    <a href="<?= base_url ?>Pedido/orderDetail&id=<?= $order->id ?>"><?= $order->id ?></a>
                </td>
                <td>Q<?= $order->coste ?></td>
                <td><?= $order->fecha ?></td>
                <td><?= $order->direccion ?></td>
                <td><?= $order->estado ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No hay pedidos para mostrar</p>
<?php endif; ?>

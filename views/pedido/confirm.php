<?php if($_SESSION['save-order']): ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>Tu pedido ha sido guardado con éxito, una vez que relices la transferencia bancaria a la cuenta 5558848 con el coste del pedido, sera procesado</p>
    <br>
    <h3>Datos del pedido:</h3>
        Numero de pedido: <?=$_GET['id']?> <br>
        Total a pagar: <?=Utils::calculateTotal()?> <br>
        Productos:
        <?php foreach($_SESSION['cart'] as $item): ?>
            <ul>
                <li>
                    <?=$item['product']->nombre . ' - Q' . $item['price'] . ' - x' . $item['unit']?>
                </li>
            </ul>
        <?php endforeach; ?>
<?php else: ?>
    <h1>Error al confirmar el pedido, intentalo de nuevo</h1>
<?php endif; ?>
<?php Utils::deleteSession('save-order'); ?>
<?php Utils::deleteSession('cart'); ?>

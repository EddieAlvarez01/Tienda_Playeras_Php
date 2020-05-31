<h1>Detalle del pedido</h1>
<?php if($_SESSION['user']['rol'] == 'administrador'): ?>
    <h3>Cambiar estado</h3>
    <form action="<?=base_url?>Pedido/changeState&id=<?=$_GET['id']?>" method="post">
        <select name="state">
            <option value="confirm" <?= ($rOrder->estado == 'confirm') ? 'selected' : '' ?>>Pendiente</option>
            <option value="preparation" <?= ($rOrder->estado == 'preparation') ? 'selected' : '' ?>>En preparación</option>
            <option value="ready" <?= ($rOrder->estado == 'ready') ? 'selected' : '' ?>>Preparado para enviar</option>
            <option value="sent" <?= ($rOrder->estado == 'sent') ? 'selected' : '' ?>>Enviado</option>
        </select>
        <input type="submit" value="Cambiar estado">
    </form>
    <br>
<?php endif; ?>
<h3>Datos del envío</h3>
Provincia: <?=$rOrder->provincia?><br>
Localidad: <?=$rOrder->localidad?><br>
Dirección: <?=$rOrder->direccion?>
<br>
<h3>Datos del pedido:</h3>
Numero de pedido: <?=$_GET['id']?> <br>
Total a pagar: Q<?=$rOrder->coste?> <br>
Productos:
<?php while($product = $result->fetch_object()): ?>
    <ul>
        <li>
            <?=$product->nombre . ' - Q' . $product->precio . ' - x' . $product->cantidad?>
        </li>
    </ul>
<?php endWhile; ?>
<h1>Carrito de compra</h1>
<?php if(isset($_SESSION['cart'])): ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Acción</th>
        </tr>
        <?php foreach($_SESSION['cart'] as $index => $item): ?>
            <tr>
                <td><img class="img-cart" src="<?= ($item['product']->imagen != '') ? base_url . 'uploads/images/' . $item['product']->imagen : base_url . 'assets/img/camiseta.png'?>"></td>
                <td><a href="<?=base_url?>Producto/productDetail&id=<?=$item['id']?>"><?=$item['product']->nombre?></a></td>
                <td><?=$item['price']?></td>
                <td>
                    <a href="<?=base_url?>Pedido/increaseUnits&index=<?=$index?>" class="button">+</a>
                    <?=$item['unit']?>
                    <a href="<?=base_url?>Pedido/decreaseUnits&index=<?=$index?>" class="button">-</a>
                </td>
                <td><a href="<?=base_url?>Pedido/removeFromCart&id=<?=$item['id']?>" class="button button-order button-order button-red">Eliminar del carrito</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <div class="total-cart">
        <h3>Precio total: Q<?= Utils::calculateTotal(); ?></h3>
        <a href="<?=base_url?>Pedido/order" class="button button-order">Hacer pedido</a>
    </div>
<?php else: ?>
    <p>No hay productos en el carrito</p>
<?php endif; ?>
<h1>Gestionar Productos</h1>
<?php if(!isset($_SESSION['error-product-db'])): ?>
    <?php if(isset($_SESSION['delete-product'])): ?>
        <?php if($_SESSION['delete-product']): ?>
            <strong class="alert-green">Producto eliminado exitosamente</strong>
        <?php else: ?>
            <strong class="alert-red">Error al eliminar producto</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('delete-product'); ?>
    <?php endif; ?>
    <a class="button button-small" href="<?= base_url ?>Producto/createProduct">Crear Producto</a>
    <table>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>OFERTA</th>
            <th>FECHA</th>
            <th>CATEGORÍA</th>
            <th>ACCIONES</th>
        </tr>
        <?php while($product = $products->fetch_object()): ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->nombre ?></td>
                <td>Q<?= $product->precio ?></td>
                <td><?= $product->stock ?></td>
                <td><?= $product->oferta ?></td>
                <td><?= $product->fecha ?></td>
                <td><?= $product->categoria ?></td>
                <td>
                    <a href="<?=base_url?>Producto/editProduct&id=<?=$product->id?>" class="button button-manage">Editar</a>
                    <a href="<?=base_url?>Producto/deleteProduct&id=<?=$product->id?>" class="button button-manage button-red">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <?= $_SESSION['error-product-db'] ?>
    <?php Utils::deleteSession('error-product-db'); ?>
<?php endif; ?>

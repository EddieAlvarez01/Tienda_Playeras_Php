<?php if(isset($_SESSION['error-logged'])): ?>
    <strong class="alert-red">Inicie Sesión porfavor</strong>
    <?php Utils::deleteSession('error-logged'); ?>
<?php endif; ?>
<?php if(isset($_GET['id'])): ?>
    <?php if(isset($_GET['cat'])): ?>
        <h1><?=$_GET['cat']?></h1>
    <?php else: ?>
        <h1>Categoria</h1>
    <?php endif; ?>
<?php else: ?>
    <h1>Algunos de nuestros productos</h1>
<?php endif; ?>
<div class="product">
    <?php if($result->num_rows > 0): ?>
        <?php while($product = $result->fetch_object()): ?>
            <a href="<?=base_url?>Producto/productDetail&id=<?=$product->id?>">
                <img src="<?= ($product->imagen != '') ? base_url . 'uploads/images/' . $product->imagen : base_url . 'assets/img/camiseta.png'?>">
                <h2><?=$product->nombre?></h2>
            </a>
            <p>Q<?=$product->precio?></p>
            <a href="<?=base_url?>Pedido/addCart&id=<?=$product->id?>" class="button">Comprar</a>
        <?php endwhile; ?>
    <?php else: ?>
        <?= 'No hay productos para mostrar' ?>
    <?php endif; ?>
</div>
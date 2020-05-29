<?php if(!isset($_SESSION['error-detail-db'])): ?>
    <h1><?=$result->nombre?></h1>
    <div id="detail-product">
        <div class="image">
            <img src="<?= ($result->imagen != '') ? base_url . 'uploads/images/' . $result->imagen : base_url . 'assets/img/camiseta.png'?>">
        </div>
        <div class="data">
            <p class="description"><?=$result->descripcion?></p>
            <p class="price">Q<?=$result->precio?></p>
            <a href="<?=base_url?>Pedido/addCart&id=<?=$product->getId()?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>Error al mostrar detalle</h1>
    <?php Utils::deleteSession('error-detail-db'); ?>
<?php endif; ?>

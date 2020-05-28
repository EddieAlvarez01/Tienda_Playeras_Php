<h1>Algunos de nuestros productos</h1>
<div class="product">
    <?php while($product = $result->fetch_object()): ?>
        <img src="<?= ($product->imagen != '') ? base_url . 'uploads/images/' . $product->imagen : base_url . 'assets/img/camiseta.png'?>">
        <h2><?=$product->nombre?></h2>
        <p>Q<?=$product->precio?></p>
        <a href="#" class="button">Comprar</a>
    <?php endwhile; ?>
</div>
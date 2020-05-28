<h1>Crear producto</h1>
<?php if(isset($_SESSION['save-product'])): ?>
    <?php if($_SESSION['save-product']): ?>
        <strong class="alert-green">Producto creado exitosamente</strong>
    <?php else: ?>
        <strong class="alert-red">Error al crear el producto</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('save-product'); ?>
<?php elseif(isset($_SESSION['error-product'])): ?>
    <?php foreach($_SESSION['error-product'] as $item): ?>
        <strong class="alert-red"><?=$item?></strong>
    <?php endforeach; ?>
    <?php Utils::deleteSession('error-product'); ?>
<?php endif; ?>
<div class="form_container">
    <form action="<?=base_url?>Producto/saveProduct" method="post" enctype="multipart/form-data">
        <label for="category">Categoría</label>
        <select name="category">
            <?php while($category = $categories->fetch_object()): ?>
                <option value="<?=$category->id?>"><?=$category->nombre?></option>
            <?php endwhile; ?>
        </select>
        <label for="name">Nombre</label>
        <input type="text" name="name" required>
        <label for="description">Descripcion</label>
        <textarea name="description"></textarea>
        <label for="price">Precio</label>
        <input type="text" name="price" required>
        <label for="stock">Stock</label>
        <input type="number" name="stock" required>
        <label for="offer">Oferta</label>
        <input type="text" name="offer">
        <label for="image">Imagen</label>
        <input type="file" name="image">
        <input type="submit" value="Crear">
    </form>
</div>

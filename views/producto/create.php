<?php if(isset($_GET['id'])): ?>
    <h1>Editar producto</h1>
    <?php $action = base_url . 'Producto/saveProduct&id=' . $_GET['id'] . "&img=" . $pro->imagen; ?>
<?php else: ?>
    <h1>Crear producto</h1>
    <?php $action = base_url . 'Producto/saveProduct'; ?>
<?php endif; ?>
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
<?php if(!isset($_SESSION['error-edit'])): ?>
    <div class="form_container">
        <form action="<?=$action?>" method="post" enctype="multipart/form-data">
            <label for="category">Categoría</label>
            <select name="category">
                <?php while($category = $categories->fetch_object()): ?>
                    <?php if(isset($_GET['id'])): ?>
                        <option value="<?=$category->id?>" <?php echo ($category->id == $pro->categoria_id) ? "selected" : ""; ?>><?=$category->nombre?></option>
                    <?php else: ?>
                        <option value="<?=$category->id?>"><?=$category->nombre?></option>
                    <?php endif; ?>
                <?php endwhile; ?>
            </select>
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?php echo (isset($_GET['id'])) ? $pro->nombre : ""?>" required>
            <label for="description">Descripcion</label>
            <textarea name="description"><?php echo (isset($_GET['id'])) ? $pro->descripcion : ""?></textarea>
            <label for="price">Precio</label>
            <input type="text" name="price" value="<?php echo (isset($_GET['id'])) ? $pro->precio : ""?>" required>
            <label for="stock">Stock</label>
            <input type="number" name="stock" value="<?php echo (isset($_GET['id'])) ? $pro->stock : ""?>" required>
            <label for="offer">Oferta</label>
            <input type="text" name="offer" value="<?php echo (isset($_GET['id'])) ? $pro->oferta : ""?>">
            <label for="image">Imagen</label>
            <?php if(isset($_GET['id'])): ?>
                <img src="<?= base_url . 'uploads/images/' . $pro->imagen?>" class="thumb">
            <?php endif; ?>
            <input type="file" name="image">
            <input type="submit" value="<?php echo (isset($_GET['id'])) ? "Editar" : "Crear"?>">
        </form>
    </div>
<?php else: ?>
    <strong class="alert-red"><?= $_SESSION['error-edit'] ?></strong>
    <?php Utils::deleteSession('error-edit'); ?>
<?php endif; ?>

<h1>Editar Producto</h1>
<form action="" method="post">
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
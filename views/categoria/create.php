<h1>Crear Categoría</h1>
<?php if(isset($_SESSION['save-category'])): ?>
    <?php if($_SESSION['save-category']): ?>
        <strong class="alert-green">Categoría creada exitosamente</strong>
    <?php else: ?>
        <strong class="alert-red">Error al crear categoría</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('save-category'); ?>
<?php elseif(isset($_SESSION['error-category'])): ?>
    <strong class="alert-red"><?= $_SESSION['error-category'][0] ?></strong>
    <?php Utils::deleteSession('error-category'); ?>
<?php endif; ?>
<form action="<?= base_url ?>Categoria/saveCategory" method="post">
    <label for="name">Nombre: </label>
    <input type="text" name="name" required>
    <input type="submit" value="Crear">
</form>

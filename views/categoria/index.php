<h1>Gestionar Categorias</h1>
<?php if(!isset($_SESSION['error-category-db'])): ?>
    <a class="button button-small" href="<?= base_url ?>Categoria/create">Crear categoria</a>
    <table>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
        </tr>
        <?php while($category = $categories->fetch_object()): ?>
            <tr>
                <td><?= $category->id ?></td>
                <td><?= $category->nombre ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <?= $_SESSION['error-category-db'] ?>
    <?php Utils::deleteSession('error-category-db'); ?>
<?php endif; ?>

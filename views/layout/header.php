<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda de Camisetas</title>
        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    </head>
    <body>
        <!-- CABECERA -->
        <div id="container">
            <header id="header">
                <div id="logo">
                    <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta logo">
                    <a href="<?=base_url?>Producto/index">
                        Tienda de camisetas
                    </a>
                </div>
            </header>

            <?php $categories = Utils::showCategories(); ?>
            <!-- MENU -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>Producto/index">Inicio</a>
                    </li>
                    <?php while($category = $categories->fetch_object()): ?>
                        <li>
                            <a href="<?=base_url?>Producto/listByCategory&id=<?=$category->id?>&cat=<?= $category->nombre ?>"><?= $category->nombre ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </nav>
            <div id="content">
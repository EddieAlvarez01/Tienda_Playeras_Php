<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda de Camisetas</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="assets/img/camiseta.png" alt="Camiseta logo">
                <a href="index.php">
                    Tienda de camisetas
                </a>
            </div>
        </header>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Categoría 1</a>
                </li>
            </ul>
        </nav>
        <div id="content">

            <!-- BARRA LATERAL -->
            <aside id="lateral">
                <div id="login" class="block-aside">
                    <form action="#" method="post">
                        <label for="email">Correo</label>
                        <input type="email" name="email">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password">
                        <input type="submit" value="Enviar">
                    </form>
                    <a href="#">Mis pedidos</a>
                    <a href="#">Gestionar pedidos</a>
                    <a href="#">Gestionar categorías</a>
                </div>
            </aside>

            <!-- CONTENIDO CENTRAL -->
            <div id="central">
                <div class="product">
                    <img src="assets/img/camiseta.png">
                    <h2>Camiseta azul ancha</h2>
                    <p>Q30</p>
                    <a href="#">Comprar</a>
                </div>
            </div>
        </div>

        <!-- PIE DE PAGINA -->
        <footer id="foot">
            <p>Desarrollado por Eddie Alvarez &copy; <?= date('Y') ?></p>
        </footer>
    </body>
</html>
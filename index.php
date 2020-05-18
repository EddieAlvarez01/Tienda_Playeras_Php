<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda de Camisetas</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- CABECERA -->
        <div id="container">
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
                        <h3>Entrar a la web</h3>
                        <form action="#" method="post">
                            <label for="email">Correo</label>
                            <input type="email" name="email">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password">
                            <input type="submit" value="Enviar">
                        </form>
                        <ul>
                            <li><a href="#">Mis pedidos</a></li>
                            <li><a href="#">Gestionar pedidos</a></li>
                            <li><a href="#">Gestionar categorías</a></li>
                        </ul>
                    </div>
                </aside>

                <!-- CONTENIDO CENTRAL -->
                <div id="central">
                    <h1>Productos destacados</h1>
                    <div class="product">
                        <img src="assets/img/camiseta.png">
                        <h2>Camiseta azul ancha</h2>
                        <p>Q30</p>
                        <a href="#" class="button">Comprar</a>
                    </div>
                </div>
            </div>

            <!-- PIE DE PAGINA -->
            <footer id="foot">
                <p>Desarrollado por Eddie Alvarez &copy; <?= date('Y') ?></p>
            </footer>
        </div>
    </body>
</html>
<!-- BARRA LATERAL -->
<aside id="lateral">
    <div id="login" class="block-aside">
        <?php if(isset($_SESSION['error-login'])): ?>
            <?php foreach($_SESSION['error-login'] as $item): ?>
                <strong class="alert-red"><?= $item ?></strong>
            <?php endforeach; ?>
            <?php Utils::deleteSession('error-login'); ?>
        <?php elseif(isset($_SESSION['login'])): ?>
            <strong class="alert-red">Credenciales incorrectos</strong>
            <?php Utils::deleteSession('login'); ?>
        <?php endif; ?>
        <?php if(!isset($_SESSION['user'])): ?>
            <h3>Entrar a la web</h3>
            <form action="<?= base_url ?>Usuario/login" method="post">
                <label for="email">Correo</label>
                <input type="email" name="email" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
                <input type="submit" value="Enviar">
            </form>
        <?php else: ?>
            <h3><?= $_SESSION['user']['nombre'] . ' ' . $_SESSION['user']['apellidos'] ?></h3>
            <ul>
                <?php if($_SESSION['user']['rol'] == 'administrador'): ?>
                    <li><a href="<?= base_url ?>Categoria/index">Gestionar categorías</a></li>
                    <li><a href="#">Gestionar productos</a></li>
                    <li><a href="#">Gestionar pedidos</a></li>
                <?php else: ?>
                    <li><a href="#">Mis pedidos</a></li>
                <?php endif; ?>
                <li><a href="<?= base_url ?>Usuario/logout">Cerrar sesión</a></li>
            </ul>
        <?php endif; ?>
    </div>
</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">

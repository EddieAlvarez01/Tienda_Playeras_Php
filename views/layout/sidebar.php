<!-- BARRA LATERAL -->
<aside id="lateral">
    <?php if(isset($_SESSION['user'])): ?>
        <div id="cart" class="block-aside">
            <h3>Mi carrito</h3>
            <ul>
                <li><a href="<?=base_url?>Pedido/viewCart">Productos (<?= (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0 ?>)</a></li>
                <li><a href="<?=base_url?>Pedido/viewCart">Total: Q<?=Utils::calculateTotal();?></a></li>
                <li><a href="<?=base_url?>Pedido/viewCart">Ver carrito</a></li>
            </ul>
        </div>
    <?php endif; ?>
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
            <ul>
                <li><a href="<?=base_url?>Usuario/register">Registrarse</a></li>
            </ul>
        <?php else: ?>
            <h3><?= $_SESSION['user']['nombre'] . ' ' . $_SESSION['user']['apellidos'] ?></h3>
            <ul>
                <?php if($_SESSION['user']['rol'] == 'administrador'): ?>
                    <li><a href="<?= base_url ?>Categoria/index">Gestionar categorías</a></li>
                    <li><a href="<?=base_url?>Producto/manageProducts">Gestionar productos</a></li>
                    <li><a href="<?=base_url?>Pedido/orderManagement">Gestionar pedidos</a></li>
                <?php else: ?>
                    <li><a href="<?=base_url?>Pedido/myOrders">Mis pedidos</a></li>
                <?php endif; ?>
                <li><a href="<?= base_url ?>Usuario/logout">Cerrar sesión</a></li>
            </ul>
        <?php endif; ?>
    </div>
</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">

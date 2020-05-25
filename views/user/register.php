<h1>Registrarse</h1>

<?php if(isset($_SESSION['register'])): ?>
    <?php if($_SESSION['register']): ?>
        <strong class="alert-green">Registro completado exitosamente</strong>
    <?php else: ?>
        <strong class="alert-red">Registro fallido</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('register'); ?>
<?php endif; ?>
<?php if(isset($_SESSION['error-user'])): ?>
    <?php foreach ($_SESSION['error-user'] as $item): ?>
    <br><strong class="alert-red"><?= $item ?></strong>
    <?php endforeach; ?>
    <?php Utils::deleteSession('error-user'); ?>
<?php endif; ?>
<form action="<?=base_url?>Usuario/saveUser" method="post">
    <label for="name">Nombre</label>
    <input type="text" name="name" required>
    <label for="surnames">Apellidos</label>
    <input type="text" name="surnames" required>
    <label for="email">Correo</label>
    <input type="email" name="email" required>
    <label for="password">Contraseña</label>
    <input type="password" name="password" required>
    <input type="submit" value="Registrarse">
</form>

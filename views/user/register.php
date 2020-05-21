<h1>Registrarse</h1>
<form action="index.php?controller=Usuario&action=saveUser" method="post">
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

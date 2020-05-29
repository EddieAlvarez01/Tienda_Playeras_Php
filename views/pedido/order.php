<h1>Hacer pedido</h1>
<p>
    <a href="<?=base_url?>Pedido/viewCart">Ver los productos y el precio del pedido</a>
</p>
<br>
<h3>Datos para el envío:</h3>
<form action="<?=base_url?>Pedido/addOrder" method="post">
    <label for="province">Provincia:</label>
    <input type="text" name="province" required>
    <label for="location">Localidad:</label>
    <input type="text" name="location" required>
    <label for="address">Dirección:</label>
    <input type="text" name="address" required>
    <label for="province">Provincia:</label>
    <input type="text" name="province" required>
    <input type="submit" value="Confirmar">
</form>

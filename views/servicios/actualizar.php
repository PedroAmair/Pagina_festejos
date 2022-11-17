<h2 class="nombre-pagina">Actualizar servicio</h2>
<p class="descripcion-pagina">Modifica los campos que desees</p>

<?php include_once __DIR__."/../templates/alertas.php"; ?>
<?php include_once __DIR__."/../templates/barra.php"; ?>

<form method="POST" class="formulario">
    <?php include_once __DIR__."/formulario.php"; ?>
    <input type="submit" class="boton" value="Actualizar servicio">
</form>
<h2 class="nombre-pagina">Recuperar Password</h2>
<p class="descripcion-pagina">Escribe tu nueva contraseña</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Tu Nuevo Password"
        />
    </div>
    <input type="submit" class="boton" value="Guardar Nuevo Password">
</form>

<div class="opciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Obtener una</a>
</div>
<h2 class="nombre-pagina">Olvidé mi Password</h2>
<p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu correo electrónico</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" action="/olvidado" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu Email"
        />
    </div>

    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>

<div class="opciones">
    <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/">¿Aún no tienes una cuenta? ¡Créala!</a>
</div>

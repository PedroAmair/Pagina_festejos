<h2 class="nombre-pagina">Login</h2>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form class="formulario" action="/login" method="POST">
    <div class="campo">
        <Label for="email">Email</Label>
        <input type="text" placeholder="ingresa tu correo electrónico" name="email">
    </div>

    <div class="campo">
        <Label for="password">Password</Label>
        <input type="password" placeholder="ingresa tu contraseña" name="password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="opciones">
    <a href="/">Si no tienes una cuenta, regístrate aquí</a>
    <a href="/olvidado">Olvidé mi contraseña</a>
</div>
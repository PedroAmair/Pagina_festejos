<h2 class="nombre-pagina">Crear Cuenta</h2>
<p class="descripcion-pagina">Llena el siguiente formulario de registro y 
                              forma parte de la gran familia Merina, el club
                              ideal para celebrar todos tus momentos especiales.
</p>

<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Tu Nombre"
            value="<?php echo esc($usuario->nombre); ?>"
        />
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input
            type="text"
            id="apellido"
            name="apellido"
            placeholder="Tu Apellido"
            value="<?php echo esc($usuario->apellido); ?>"
        />
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="Tu Teléfono"
            value="<?php echo esc($usuario->telefono); ?>"
        />
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="Tu E-mail"
            value="<?php echo esc($usuario->email); ?>"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Tu Password"
        />
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">


</form>

<div class="opciones">
    <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvidado">¿Olvidaste tu password?</a>
</div>
<div class="barra">
    <p>¡Hola <?php echo $nombre ?? ""; ?>! </p>
    <a href="/logout" class="boton">Cerrar sesión</a>
</div>

<?php
    if(isset($_SESSION["admin"])) { ?>
        <div class="barra-servicios">
            <a class="boton" href="/admin">Ver reservas</a>
            <a class="boton" href="/servicios">Ver servicios</a>
            <a class="boton" href="/servicios/crear">Nuevo servicio</a>
        </div>
<?php } ?>
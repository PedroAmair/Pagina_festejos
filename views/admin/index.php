<h2 class="nombre-pagina">Administración</h2>

<?php include_once __DIR__."/../templates/barra.php"; ?>

<h2>Buscar reservas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php 
    if(count($reservas) === 0) {
        echo "<h2>No hay reservaciones para esta fecha</h2>";
    }
?>

<div id="reservas-admin">
    <ul class="reservas">
        <?php
            $idReserva = 0;
            foreach($reservas as $key => $reserva) {
                if($idReserva !== $reserva->id) {
                    $total = 0;
                    $idReserva = $reserva->id;
        ?>       
        <li>
            <p>ID de reservación: <span><?php echo $reserva->id; ?></span></p>
            <p>Hora: <span><?php echo $reserva->hora; ?></span></p>
            <p>Cliente: <span><?php echo $reserva->cliente; ?></span></p>
            <p>Correo electrónico: <span><?php echo $reserva->email; ?></span></p>
            <p>Teléfono: <span><?php echo $reserva->telefono; ?></span></p>

            <h3>Servicios</h3>
            <?php } //Fin del if ?>
            <?php if($reserva->precio != 0) { ?>
            <?php $total += $reserva->precio; ?>
            <p class="servicio"><?php echo $reserva->servicio." ".$reserva->precio." $"; ?></p>
            <?php } ?>
        
            <?php
                $actual = $reserva->id;
                $proximo = $reservas[$key+1]->id ?? 0;

                if(esUltimo($actual, $proximo)) { ?>
                    <p class="total">Total: <span><?php echo $total." $"; ?></span></p>

                    <form action="/api/eliminar" class="formulario" method="POST">
                        <input type="hidden" name="id" value="<?php echo $reserva->id; ?>">
                        <input type="submit" class="boton-eliminar" value="eliminar">
                    </form>
                    
                <?php } ?>
        <?php }  //Fin del foreach?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>";
?>
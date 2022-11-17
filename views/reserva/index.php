<h2 class="nombre-pagina">Reserva</h2>
<p class="descripcion-pagina">Complete todos los campos requeridos</p>

<?php include_once __DIR__."/../templates/barra.php"; ?>

<div class="app" id="app">

    <nav class="tabs">
        <button type="button" data-paso="1" class="actual">Servicios</button>
        <button type="button" data-paso="2">Información reserva</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Selecciona los servicios que deseas incluir</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>
        
    <div class="seccion" id="paso-2">
        <h2>Tus datos y reserva</h2>
        <p class="text-center">Coloca los datos y la fecha de la reservación</p>

        <form action="" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" value="<?php echo $nombre; ?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha"  min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>">
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora">
            </div>

            <input type="hidden" id="id" value="<?php echo $id; ?>">

        </form>
    </div>

    <div class="seccion contenido-resumen" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center">Confirma la información que escribiste</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">
            &laquo; Anterior
        </button>

        <button id="siguiente" class="boton">
            Siguiente &raquo;
        </button>
    </div>

</div>

<?php
    $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>  
    ";
?>
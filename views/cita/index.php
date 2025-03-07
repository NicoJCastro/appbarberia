<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?php include_once __DIR__  . '/../template/barra.php' ?>

<div id="app">

    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Datos y Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
    <h2>Servicios</h2>
    <p class="text-center">Elige tus servicios a continuación</p>
    <div class="listado-servicios" id="servicios"></div> <!-- Aquí se mostrarán los servicios con JS -->
    </div>
    <div id="paso-2" class="seccion">
    <h2>Tus Datos y Cita</h2>
    <p class="text-center">Coloca tus datos y fecha de tu cita</p>

    <form class="formulario">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo $nombre; ?>" disabled>
        </div>
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="campo">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora">
        </div>
        <input type="hidden" id="id" value= "<?php echo $id; ?>">
    </form> <!-- Aquí se mostrará el formulario con JS -->


    </div>
    <div id="paso-3" class="seccion contenido-resumen">
    <h2>Resumen</h2>
    <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Aterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>

</div>

<?php $script = "

    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='/appbarberia/public/build/js/app.js'></script>

"; ?>


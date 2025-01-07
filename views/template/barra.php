<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?> </p>

    <a href="/appbarberia/logout" class="boton" >Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>

    <div class="barra-servicios">
        <a class="boton" href="/appbarberia/admin">Ver Citas</a>
        <a class="boton" href="/appbarberia/servicios">Ver Servicios</a>
        <a class="boton" href="/appbarberia/servicios/crear">Nuevo Servicio</a>
    </div>

<?php } ?>
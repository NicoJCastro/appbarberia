<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>

<?php
 include_once __DIR__  . '/../template/barra.php';
 include_once __DIR__  . '/../template/alertas.php';

 ?>

<h2>Ingresa el Nombre y el Precio del Nuevo Servicio</h2>

<form action="/appbarberia/servicios/crear" method="POST" class="formulario">
<?php include_once __DIR__ . '/formulario.php'; ?>

<input type="submit" class="boton" value="Guardar Servicio">

</form>
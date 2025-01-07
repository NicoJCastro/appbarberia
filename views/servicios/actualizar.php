<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>

<?php
 include_once __DIR__  . '/../template/barra.php';
 include_once __DIR__  . '/../template/alertas.php';
 ?>

<h2>Ingresa el Nombre y el Precio del Nuevo Servicio</h2>

<form method="POST" class="formulario">
<?php include_once __DIR__ . '/formulario.php'; ?>
<input type="submit" class="boton" value="Actualizar Servicio">
</form>
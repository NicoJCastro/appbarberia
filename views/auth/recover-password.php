<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php include_once __DIR__ . "/../template/alertas.php"; ?>

<?php if ($error) return; ?>

<form  class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu nuevo password">
    </div>
    <input type="submit" class="boton" value="Guardar Nuevo Password">
</form>

<div class="acciones">
    <a href="/appbarberia/login">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/appbarberia/crear-cuenta">¿Aún no tienes cuenta? Obtener una</a>
</div>
<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php include_once __DIR__ . "/../template/alertas.php"; ?>

<form class="formulario" method="POST" action="/appbarberia/crear-cuenta">
   <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" placeholder="Tu Nombre" name="nombre" value="<?php echo s($usuario->nombre); ?>">
   </div>
   <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" placeholder="Tu apellido" name="apellido" value="<?php echo s($usuario->apellido); ?>">
   </div>
   <div class="campo">
        <label for="telefono">Telefono:</label>
        <input type="tel" id="telefono" placeholder="Tu telefono" name="telefono" value="<?php echo s($usuario->telefono); ?>">
   </div>
   <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo s($usuario->email); ?>">
   </div>
   <div class="campo">
        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
   </div>

   <input type="submit" class="boton" value="Crear Cuenta">

</form>

<div class="acciones">

    <a href="/appbarberia/login">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/appbarberia/forgot-password">¿Olvidaste tu Password?</a>


</div>
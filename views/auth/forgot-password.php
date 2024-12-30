<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<form action="/appbarberia/forgot-password" class="formulario" method="POST">

    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu Email">
    </div>

    <input type="submit" class="boton" value="Enviar Instrucciones">


</form>

<div class="acciones">

    <a href="/appbarberia/login">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/appbarberia/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>


</div>
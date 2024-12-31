<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<form class="formulario" method="POST" action="/appbarberia/login">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu Email">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu Password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/appbarberia/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
    <a href="/appbarberia/forgot-password">¿Olvidaste tu Password?</a>
</div>
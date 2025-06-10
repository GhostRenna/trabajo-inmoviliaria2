<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Inmobiliario - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Portal Inmobiliario</h1>
        <nav>
            <a href="index.html">Inicio</a>
            <a href="registro-propietario.html">Registro Propietario</a>
            <a href="registro-gestor.html">Registro Gestor</a>
            <a href="login.html">Iniciar Sesión</a>
        </nav>
    </header>

    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
        
        <p>¿No tienes una cuenta?<a href="registro.html">Registrate aquí</a></p>
    </div>

    <footer>
        <p>&copy; 2025 Portal Inmobiliario. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
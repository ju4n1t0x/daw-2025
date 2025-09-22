<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form action="../test.php" method="post">
            <label for="nombreUsuario">NombreUsuario:</label>
            <input type="text" id="nombreUsuario" name="nombreUsuario" required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <button type="submit" name="submit">Login</button>
        </form>
    </body>
</html>
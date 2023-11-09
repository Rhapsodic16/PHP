<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Inicio de sesión</title>
</head>
<body>
    <Form action="IniciarSesion.php" method="post">
        <h1>INICIAR SESIÓN</h1>
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <input type="text" name="Usuario" placeholder="Nombre de Usuario">
        <hr>
        <i class="fa-solid fa-unlock"></i>
        <label>Contraseña</label>
        <input type="text" name="Password" placeholder="Contraseña">
        <hr>
        <div class="boton">
            <button type="submit">Iniciar sesión</button>
        </div>
        <div class="crearCuenta">
            <a href="">Crear cuenta</a>
        </div>
    </Form>
</body>
</html>
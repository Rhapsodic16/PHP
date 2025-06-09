<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Crear cuenta</title>
</head>
<body>

    <Form  method="post" enctype="multipart/form-data">
        <h1>REGISTRO</h1>
        <hr>
        <label>Nombre</label>
        <input type="text" name="Nombre" id="Nombre" placeholder="Nombre de Usuario"  required>
        <hr>
        <label>Email</label>
        <input type="email" name="Correo" placeholder="Email" required>
        <hr>
        <label>Contraseña</label>
        <input type="password" name="Password" placeholder="Contraseña" required>
        <hr>
        <div class="boton">
            <button type="submit">Crear cuenta</button>
        </div>
    </Form>
    <?php include_once('../includes/Registro.php')?>
</body>
</html>
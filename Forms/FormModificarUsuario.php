<?php
    require_once('../includes/database.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM tusuarios WHERE ID_Usuario = ?";
    $result = executeQuery(true, $sql, [$id]);

    $sql = "SELECT Rol FROM rol WHERE Rol = ?";
    $autor = executeQuery(true, $sql, [$result[0]['Rol_id']]);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ingresar Libro</title>
</head>
<body>
    <Form method="post" enctype="multipart/form-data">
        <h1>REGISTRO</h1>
        <hr>
        <label>Nombre</label>
        <input type="text" name="Nombre" id="Nombre" placeholder="Nombre de Usuario"  required value = "<?php echo htmlspecialchars($result[0]['Nombre']); ?>">
        <hr>
        <label>Email</label>
        <input type="email" name="Correo" placeholder="Email" required value ="<?php echo htmlspecialchars($result[0]['Correo']);?>">
        <hr>
        <label>Contraseña</label>
        <input type="password" name="Password" placeholder="Contraseña" required>
        <hr>
        <div class="boton">
            <button type="submit">Crear cuenta</button>
        </div>
        <input type="hidden" name ="ID_Usuario" value = "<?php echo $id?>">
    </Form>
    <?php
        require_once('../includes/ModificarUsuario.php');         
    ?>
</body>
</html>
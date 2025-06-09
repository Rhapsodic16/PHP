<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Inicio de sesión</title>
</head>
<body>
    <form  method="post">
        <h1>Pedido</h1>
        <hr>
        <i class="fa-regular fa-calendar-days"></i>
        <label>Fecha del prestamo</label>
        <input type="date" name="FechaPrestamo" value="2023-11-21" >
        <hr>
        <i class="fa-regular fa-calendar-days"></i>
        <label>Fecha de entrega</label>
        <input type="date" name="FechaEntrega" value="2023-11-24">
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <select name="Usuario">
            <?php
                require('../includes/database.php');
                $query = "SELECT * FROM tusuarios";
                $resultado = executeQuery(true, $query, []);
               
                if ($resultado) {
                    foreach ($resultado as $usuario) {
                        echo '<option value="' . $usuario['ID_Usuario'] . '">' . $usuario['Nombre'] . '</option>';
                    }
                } else {
                        echo '<option value="">Error al obtener los estados</option>';
                }
            ?>
        </select>
        <hr>
        <i class="fa-solid fa-book"></i>
        <label>Libros</label>
        <select name="Libro">
            <?php
                $query = "SELECT * FROM tlibros";
                $resultado = executeQuery(true, $query, []);
               
                if ($resultado) {
                    foreach ($resultado as $libro) {
                        echo '<option value="' . $libro['ID_Libros'] . '">' . $libro['Nombre'] . '</option>';
                    }
                } else {
                        echo '<option value="">Error al obtener los estados</option>';
                }
            ?>
        </select>
        <hr>
        <div class="boton">
            <button type="submit">Hacer pedido</button>
        </div>
    </form>

    <?php include_once('../includes/HacerPrestamo.php')?>
</body>
</html>
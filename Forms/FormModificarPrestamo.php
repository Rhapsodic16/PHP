<?php
    require_once('../includes/database.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM tprestamos WHERE ID_Prestamo = ?";
    $result = executeQuery(true, $sql, [$id]);

    $sql = "SELECT * FROM tusuarios";
    $usuario = executeQuery(true, $sql, []);

    $sql = "SELECT * FROM tlibros";
    $libro = executeQuery(true, $sql, []);

    $query = "SELECT * FROM testados";
    $estado = executeQuery(true, $query, []);    
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
    <form  method="post">
        <h1>EDITAR PRESTAMO</h1>
        <hr>
        <i class="fa-regular fa-calendar-days"></i>
        <label>Fecha de prestamo</label>
        <input type="date" name="FechaPrestamo" placeholder="" value = "<?php echo htmlspecialchars($result[0]['FechaPrestamo']); ?>">
        <hr>
        <i class="fa-regular fa-calendar-days"></i>
        <label>Fecha de entrega</label>
        <input type="date" name="FechaEntrega" placeholder="" value ="<?php echo htmlspecialchars($result[0]['FechaEntrega']); ?>">
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <select name="Usuario" id="">
            <?php
                if ($usuario) {
                    foreach ($usuario as $user) {
                        $selected = ($user['ID_Usuario'] == $usuario[0]['TUsuarios_ID_Usuario']) ? 'selected' : '';
                        echo '<option value="' . $user['ID_Usuario'] . '" ' . $selected . '>' . $user['Nombre'] . '</option>';
                    }
                } else {
                    echo '<option value="">Error al obtener usuarios</option>';
                }
            ?>
        </select>
        <hr>
        <label>Estado</label>
        <select name="Estado">
            <?php
                if ($estado) {
                    foreach ($estado as $est) {
                        $selected = ($est['ID_Estados'] == $estado[0]['TEstado_ID_Estados']) ? 'selected' : '';
                        echo '<option value="' . $est['ID_Estados'] . '" ' . $selected . '>' . $est['Estado'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Error al obtener géneros</option>';
                    }
            ?>
        </select>
        <hr>
        <i class="fa-solid fa-book"></i>
        <label>Libro</label>
        <select name="Libro" id="">
            <?php
                if ($libro) {
                    foreach ($libro as $book) {
                        $selected = ($book['ID_Libros'] == $libro[0]['TLibros_ID_Libros']) ? 'selected' : '';
                        echo '<option value="' . $book['ID_Libros'] . '" ' . $selected . '>' . $book['Nombre'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Error al obtener géneros</option>';
                    }
            ?>
        </select>
        <input type="hidden" name ="ID_Prestamo" value = "<?php echo $id?>">
        <hr>
        <div class="boton">
            <button type="submit">Modificar prestamo</button>
        </div>
    </form>
    <?php
        require_once('../includes/ModificarPrestamo.php');         
    ?>
</body>
</html>
<?php
    require_once('../includes/database.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM tlibros WHERE ID_Libros = ?";
    $result = executeQuery(true, $sql, [$id]);

    $sql = "SELECT Autor FROM tautores WHERE ID_Autor = ?";
    $autor = executeQuery(true, $sql, [$result[0]['TAutores_ID_Autor']]);

    $sql = "SELECT Genero FROM tgeneros WHERE ID_Genero = ?";
    $genero = executeQuery(true, $sql, [$result[0]['TGeneros_ID_Genero']]);
    
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
        <h1>EDITAR LIBRO</h1>
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Nombre</label>
        <input type="text" name="Nombre" placeholder="Nombre del libro" value = "<?php echo htmlspecialchars($result[0]['Nombre']); ?>">
        <hr>
        <label>ISBN</label>
        <input type="text" name="ISBN" placeholder="ISBN" value ="<?php echo htmlspecialchars($result[0]['ISBN']); ?>">
        <hr>
        <label>Autor</label>
        <input type="text" name="Autor" placeholder="Nombre del autor" value="<?php echo htmlspecialchars($autor[0]['Autor']); ?>">
        <hr>
        <label>Género</label>
        <select name="Genero">
            <?php
                $query = "SELECT * FROM tgeneros";
                $resultado = executeQuery(true, $query, []);
       
                if ($resultado) {
                    foreach ($resultado as $gen) {
                        $selected = ($gen['ID_Genero'] == $result[0]['TGeneros_ID_Genero']) ? 'selected' : '';
                        echo '<option value="' . $gen['ID_Genero'] . '" ' . $selected . '>' . $gen['Genero'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Error al obtener géneros</option>';
                    }
            ?>
        </select>
        <input type="hidden" name ="ID_Libros" value = "<?php echo $id?>">
        <hr>
        <div class="boton">
            <button type="submit">Modificar Libro</button>
        </div>
    </form>
    <?php
        require_once('../includes/ModificarLibro.php');         
    ?>
</body>
</html>
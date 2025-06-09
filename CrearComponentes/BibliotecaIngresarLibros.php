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
    <form method="post">
        <h1>INGRESAR LIBRO</h1>
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Nombre</label>
        <input type="text" name="Nombre" placeholder="Nombre del libro">
        <hr>
        <label>ISBN</label>
        <input type="text" name="ISBN" placeholder="ISBN">
        <hr>
        <label>Autor</label>
        <input type="text" name="Autor" placeholder="Nombre del autor">
        <hr>
        <label>Género</label>
        <select name="Genero">
            <?php
                require('../includes/database.php');
                $query = "SELECT * FROM tgeneros";
                $resultado = executeQuery(true, $query, []);
               
                if ($resultado) {
                    foreach ($resultado as $genero) {
                        echo '<option value="' . $genero['ID_Genero'] . '">' . $genero['Genero'] . '</option>';
                    }
                } else {
                        echo '<option value="">Error al obtener géneros</option>';
                }
            ?>
        </select>
        <hr>
        <div class="boton">
            <button type="submit">Ingresar Libro</button>
        </div>
    </form>
    <?php
        require_once('../includes/IngresarLibros.php');         
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Inicio.css">
    <title>Biblioteca</title>
    <script src="https://kit.fontawesome.com/b408879b64.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php 
        require_once('includes/Header.php');
    ?>

    <div class="contenedorBuscador">
        <input type="text" placeholder="Buscar...">
        <button><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="presentacion">
        <h1>Presentación</h1>
    </div>
    <div class="presentacion">
        <h4>
            Este es un proyecto donde se busca administrar una biblioteca a partir de una base de datos SQL
        </h4>
    </div>
    <div class="secciones">
        <h1>Ingresar</h1>
    </div>
    <form action="CRUD/BibliotecaCRUDUsuarios.php" class = "botonIngresar">
        <button class="boton">Ingresar</button>
    </form>
</body>
</html>
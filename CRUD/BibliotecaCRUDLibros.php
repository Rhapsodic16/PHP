<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/CRUDs.css">
    <title>Libros</title>
    <script src="https://kit.fontawesome.com/15a7c335f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="barraHerramientas">
    <div class="contenido">
        <div class="logo">
            <img src="" alt="">
            <h2>Biblioteca Virtual</h2>
        </div>

        <div class="menu">
            <nav class="menu">
                <ul>
                    <li><a href="BibliotecaCRUDUsuarios.php">Usuarios</a></li>
                    <li class ="seleccionado"><a href="" class="itemSeleccionado">Libros</a></li>
                    <li><a href="BibliotecaCRUDPedidos.php">Pedidos</a></li>
                </ul>
            </nav>
        </div>
    </div>
  </header>
  <h1>Libros</h1>
    <div class="tabla">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>ISBN</th>
            <th>Género</th>
            <th>Autor</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            require_once('../includes/database.php');
            $query = "SELECT * FROM tlibros";

            $resultado = executeQuery(true, $query, []);

            foreach($resultado as $Valor){
              echo '<tr>';
              echo '<td>' . $Valor["ID_Libros"] . '</td>';
              echo '<td>' . $Valor["Nombre"] . '</td>';
              echo '<td>' . $Valor["ISBN"] . '</td>';
              $idGenero = $Valor["TGeneros_ID_Genero"]; // Ajusta esto según la estructura real de tu tabla
              $queryGenero = "SELECT Genero FROM tgeneros WHERE ID_Genero = ?";
              $resultadoGenero = executeQuery(true, $queryGenero, [$idGenero]);

              if ($resultadoGenero) {
                $nombreGenero = $resultadoGenero[0]["Genero"];
                echo '<td>' . $nombreGenero . '</td>';
              } else {
                echo '<td>Sin género</td>'; // Manejar caso sin género
              }

              $idAutor = $Valor["TAutores_ID_Autor"]; // Ajusta esto según la estructura real de tu tabla
              $queryAutor = "SELECT Autor FROM tautores WHERE ID_Autor = ?";
              $resultadoAutor = executeQuery(true, $queryAutor, [$idAutor]);

              if ($resultadoAutor) {
                $nombreAutor = $resultadoAutor[0]["Autor"];
                echo '<td>' . $nombreAutor . '</td>';
              } else {
                echo '<td>Sin autor</td>'; // Manejar caso sin género
              }
              echo '<td>';
              echo '<a class="botonEditar" href="../Forms/FormModificarLibro.php?id='.  $Valor["ID_Libros"].'"><i class="fa-regular fa-pen-to-square"></i></a>';
              echo '<a onclick="return eliminar()" class="botonBorrar" href="BibliotecaCRUDLibros.php?id='.$Valor["ID_Libros"].'"><i class="fa-solid fa-trash"></i></a>';
              echo '</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
    <?php require_once('../includes/EliminarLibro.php')?>
    <div class="MeterDatos">
      <button class="Ingresar"><a href="../CrearComponentes/BibliotecaIngresarLibros.php">Ingresar Libro</a></button>
    </div>
    <script>
      function eliminar(){
        var respuesta=confirm("¿Estás seguro que deseas eliminar?");
        return respuesta;
      }
    </script>
    <form class="contenedorBuscador" method="GET">
      <input type="search" id="buscar" name="buscar" placeholder="Buscar...">
      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <?php require_once('../includes/BuscarLibros.php');?>
</body>
</html>
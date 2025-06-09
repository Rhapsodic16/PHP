<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/CRUDs.css">
    <title>Usuarios</title>
    <script src="https://kit.fontawesome.com/15a7c335f1.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once('../includes/database.php')?>
    <header class="barraHerramientas">
    <div class="contenido">
        <div class="logo">
            <img src="" alt="">
            <h2>Biblioteca Virtual</h2>
        </div>
        <div class="menu">
            <nav class="menu">
                <ul>
                    <li class ="seleccionado"><a href="" class="itemSeleccionado">Usuarios</a></li>
                    <li><a href="BibliotecaCRUDLibros.php">Libros</a></li>
                    <li><a href="BibliotecaCRUDPedidos.php">Pedidos</a></li>
                </ul>
            </nav>
        </div>
    </div>
  </header>
  <h1>Usuarios</h1>
    <div class="tabla">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Password</th>
            <th>Rol</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            require_once('../includes/database.php');
            $query = "SELECT * FROM tusuarios";

            $resultado = executeQuery(true, $query, []);

            foreach($resultado as $Valor){
              echo '<tr>';
              echo '<td>' . $Valor["ID_Usuario"] . '</td>';
              echo '<td>' . $Valor["Nombre"] . '</td>';
              echo '<td>' . $Valor["Correo"] . '</td>';
              echo '<td>' . $Valor["Password"] . '</td>';
              $idRol = $Valor["Rol_id"]; // Ajusta esto según la estructura real de tu tabla
              $queryRol = "SELECT Rol FROM rol WHERE id = ?";
              $resultadoRol = executeQuery(true, $queryRol, [$idRol]);

              if ($resultadoRol) {
                $nombreRol = $resultadoRol[0]["Rol"];
                echo '<td>' . $nombreRol . '</td>';
              } else {
                echo '<td>Sin rol</td>'; // Manejar caso sin género
              }
              echo '<td>';
              echo '<a class="botonEditar" href="../Forms/FormModificarUsuario.php?id='. $Valor["ID_Usuario"].'"><i class="fa-regular fa-pen-to-square"></i></a>';
              echo '<a onclick="return eliminar()" class="botonBorrar" href="BibliotecaCRUDUsuarios.php?id='.$Valor["ID_Usuario"].'"><i class="fa-solid fa-trash"></i></a>';
              echo '</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
    <?php require_once('../includes/EliminarUsuario.php')?>
    <div class="MeterDatos">
      <button class="Ingresar"><a href="../CrearComponentes/BibliotecaRegistro.php">Ingresar Usuario</a></button>
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

    <?php require_once('../includes/BuscarUsuario.php');?>
</body>
</html>
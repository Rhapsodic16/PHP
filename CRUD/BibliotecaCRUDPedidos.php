<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/CRUDs.css">
    <title>Pedidos</title>
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
                    <li><a href="BibliotecaCRUDLibros.php">Libros</a></li>
                    <li class ="seleccionado"><a href="" class="itemSeleccionado">Pedidos</a></li>
                </ul>
            </nav>
        </div>
    </div>
  </header>
  <h1>Pedidos</h1>
    <div class="tabla">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha de entrega</th>
            <th>Fecha de recibido</th>
            <th>ID</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>ID</th>
            <th>Libros</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tr>
        <?php 
            require_once('../includes/database.php');
            $query = "SELECT * FROM tprestamos";

            $resultado = executeQuery(true, $query, []);

            foreach($resultado as $Valor){
              echo '<tr>';
              echo '<td>' . $Valor["ID_Prestamo"] . '</td>';
              echo '<td>' . $Valor["FechaPrestamo"] . '</td>';
              echo '<td>' . $Valor["FechaEntrega"] . '</td>';
              echo '<td>' . $Valor["TUsuarios_ID_Usuario"] . '</td>';
              $consultaUsuario = "SELECT Nombre FROM tusuarios WHERE ID_Usuario = ?";
              $resultadoUsuario = executeQuery(true, $consultaUsuario, [$Valor['TUsuarios_ID_Usuario']]);

              if ($resultadoUsuario) {
                echo '<td>' . $resultadoUsuario[0]["Nombre"]. '</td>';
              } else {
                echo '<td>Sin nombre</td>'; 
              }

              $consultaEstado = "SELECT Estado FROM testados WHERE ID_Estados = ?";
              $resultadoEstado = executeQuery(true, $consultaEstado, [$Valor['TEstados_ID_Estados']]);

              if ($resultadoEstado) {
                echo '<td>' . $resultadoEstado[0]["Estado"]. '</td>';
              } else {
                echo '<td>Sin estado</td>'; 
              }

              echo '<td>' . $Valor["TLibros_ID_Libros"] . '</td>';

              $consultaLibro = "SELECT Nombre FROM tlibros WHERE ID_Libros = ?";
              $resultadoLibro = executeQuery(true, $consultaLibro, [$Valor['TLibros_ID_Libros']]);

              if ($resultadoLibro) {
                echo '<td>' . $resultadoLibro[0]["Nombre"]. '</td>';
              } else {
                echo '<td>Sin libro</td>'; 
              }

              echo '<td>';
              echo '<a class="botonEditar" href="../Forms/FormModificarPrestamo.php?id='. $Valor["ID_Prestamo"].'"><i class="fa-regular fa-pen-to-square"></i></a>';
              echo '<a onclick="return eliminar()" class="botonBorrar" href="BibliotecaCRUDPedidos.php?id='.$Valor["ID_Prestamo"].'"><i class="fa-solid fa-trash"></i></a>';
              echo '</td>';
              echo '</tr>';
            }
          ?>
        </tr>
      </table>
    </div>
    <div class="MeterDatos">
      <button class="Ingresar"><a href="../CrearComponentes/BibliotecaHacerPedido.php">Hacer pedido</a></button>
    </div>
    <script>
      function eliminar(){
        var respuesta=confirm("¿Estás seguro que deseas eliminar?");
        return respuesta;
      }
    </script>
    <?php require_once('../includes/EliminarPrestamo.php')?>
    <form class="contenedorBuscador" method="GET">
      <input type="search" id="buscar" name="buscar" placeholder="Buscar...">
      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <form class="contenedorBuscador" method="GET">
      <input type="date" id="buscarFecha" name="buscarFecha">
      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <?php require_once('../includes/BuscarPrestamo.php');?>
</body>
</html>
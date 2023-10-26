<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tabla de multiplicar</title>
</head>
<body>
    <?php 
    if(isset($_POST['Enviar'])){
        echo "Bucle For <br>";
        $numero = $_POST['numero'];
        for($x = 1; $x<=10; $x++){
            echo "$x x $numero = ", $x*$numero,"<br>"; 
        }

        $x= 1;
        echo "<br> Bucle Do while <br>";

        do{
            echo "$x x $numero = ", $x*$numero,"<br>"; 
            $x++;
        }while($x <=10);

        $x= 1;
        echo "<br>Bucle While <br>";

        while($x <=10){
            echo "$x x $numero = ", $x*$numero,"<br>"; 
            $x++;
        }
    }    
    ?>
    
    <?php 
        $servername = "localhost";
        $database = "alumnos";
        $username = "root";
        $password = "";
        //Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        //Check connection
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        echo "Connected successfully <br>";
       
        
        $sql = "SELECT Ncontrol, Clave, Calif FROM cursa";
        $resultado = $conn->query($sql);
        
        // Verifica si hay resultados y muestra los datos
        if ($resultado->num_rows > 0) {
            // Itera sobre los resultados y muestra cada fila de datos
            while($fila = $resultado->fetch_assoc()) {
                echo "Columna1: " . $fila["Ncontrol"]. " - Columna2: " . $fila["Clave"]. " - Columna3: " . $fila["Calif"]. "<br>";
            }
        } else {
            echo "0 resultados encontrados";
        }

        mysqli_close($conn);
    ?>

</body>
</html>
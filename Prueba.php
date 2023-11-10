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
        require_once('../Biblioteca/database.php');
    ?>

</body>
</html>
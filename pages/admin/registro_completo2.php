<?php
    $fecha_inicio = trim(mysql_escape_string($_POST["fecha_inicio"]));
    $fecha_final = trim(mysql_escape_string($_POST["fecha_final"]));
    
    include("../../db/conf.php");
    $con = Conectarse();
    
    echo "<div id='tabla_registro' class='TablaDatosChica'>
        <table>
            <tr><td>Alumno</td><td>Entrada</td><td>Salida</td><td>Minutos acumulados</td></tr>";
            
            $query = "SELECT CONCAT(nombres_usuario, ' ', apellidos_usuario) AS nombre, inicio, fin, tiempo 
                        FROM Checadores, Usuarios 
                        WHERE inicio IS NOT NULL AND fin IS NOT NULL AND id_usuario_checador = id_usuario AND DATE_FORMAT(inicio,'%d/%m/%Y') BETWEEN '$fecha_final' AND '$fecha_inicio'
                        ORDER BY nombre, inicio;";
            $resultado = mysqli_query($con, $query);
            $filas = mysqli_num_rows($resultado);
            if($filas>0){
                while($fila=mysqli_fetch_array($resultado)){
                    
                    echo "<tr><td>".utf8_encode($fila[nombre])."</td><td>$fila[inicio]</td><td>$fila[fin]</td><td>$fila[tiempo]</td></tr>";
                }
            }else{
                echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
            }
            
    echo "</table>
    </div>";
?>
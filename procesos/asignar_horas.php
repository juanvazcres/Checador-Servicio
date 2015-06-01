<?php
    $id_usuario = trim(mysql_escape_string($_POST["id_usuario"]));
    $dia = trim(mysql_escape_string($_POST["dia"]));
    $ini = trim(mysql_escape_string($_POST["ini"]));
    $fin = trim(mysql_escape_string($_POST["fin"]));
    
    if($id_usuario==null || $dia==0 || $ini == 0 || $fin == null){
        echo "Seleccione todos los campos";
    }else{
    
    include("../db/conf.php");
    
    $con = Conectarse();
    
    $query = "INSERT INTO Agendas(id_usuario_agenda, dia_agenda, hora_inicio, hora_fin)
                VALUES('$id_usuario', '$dia', '$ini:00', '$fin:00');";
    
    $resultado = mysqli_query($con, $query);
    if($resultado){
        $query = "SELECT id_agenda, dia_agenda, hora_inicio, hora_fin FROM Agendas WHERE id_usuario_agenda = '$id_usuario' ORDER BY dia_agenda;";
        $resultado = mysqli_query($con, $query);
        $filas = mysqli_num_rows($resultado);
        if($filas>0){
            echo "<div class='TablaDatosChica'>
                    <table>
                    <tr><td>Día</td><td>Hora entrada</td><td>Hora salida</td></tr>";
            while($fila=mysqli_fetch_array($resultado)){
                echo "<tr><td>";
                switch ($fila[dia_agenda]){
                    case 1:
                        echo "Lunes";
                        break;
                    case 2:
                        echo "Martes";
                        break;
                    case 3:
                        echo "Miércoles";
                        break;
                    case 4:
                        echo "Jueves";
                        break;
                    case 5:
                        echo "Viernes";
                        break;
                }
                echo "</td><td>$fila[hora_inicio]</td><td>$fila[hora_fin]</td></tr>";
            }
            echo "</table></div>";
        }else{
            echo "No tiene un horario de servicio";
        }
    }else{
        echo "No se guardó la hora, intente nuevamente";
    }
    }    
?>
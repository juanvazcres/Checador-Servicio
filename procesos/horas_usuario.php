<?php
    $id_usuario = trim(mysql_escape_string($_POST["id_usuario"]));
    
    include("../db/conf.php");
    
    $con = Conectarse();
    
    echo "<div class='imagen'>";
    $sql = "SELECT horario_usuario FROM Usuarios WHERE id_usuario='".$id_usuario."';";
    $resultado = $con->query($sql);
   
    if(mysqli_num_rows($resultado)){
        while($fila=mysqli_fetch_array($resultado)){
            echo '<img src="../..'.$fila["horario_usuario"].'">';
        }
    }else{
        $error = "Hubo un error al cargar el horario, actualice";
        header("Location: asignar_horario.php?msg=".$error);
    }
    echo "</div>";
    
    $query = "SELECT id_agenda, dia_agenda, hora_inicio, hora_fin FROM Agendas WHERE id_usuario_agenda = '$id_usuario' ORDER BY dia_agenda;";
    $resultado = mysqli_query($con, $query);
    $filas = mysqli_num_rows($resultado);
    if($filas>0){
    echo "<div id='tabla_horario' class='TablaDatosChica'>
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
?>
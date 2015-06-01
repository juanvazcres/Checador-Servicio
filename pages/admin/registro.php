<?php
session_start();
	if ($_SESSION["rol_usuario"]==1 || $_SESSION["rol_usuario"]==2){

        if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: cuenta.php?msg=".$error);
        }
        
        include("../../db/conf.php");
        $con = Conectarse();
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head class="header">
        <title>Servicio social - Administrador</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="screen" >
   </head>
   <body>
       <div class="wrapper">
        <?php include ("header.html"); ?>
        <?php include ("nav.php"); ?>
        <!-- Contenido -->
        
       <div id="formulario-usuario" class="formulario" align="center">
            <h2>Registro general</h2>
            <form action="" method="post">
                <div class="elemento">
                    <label for="inicio">Fecha inicial</label>
                        <select id="fecha_inicio" name="fecha_inicio">
                            <?php
                                $query = "SELECT DISTINCT(DATE_FORMAT(inicio,'%d/%m/%Y')) Fecha_inicio FROM Checadores ORDER BY inicio;";
                                $resultado = mysqli_query($con, $query);
                                $filas = mysqli_num_rows($resultado);
                                if($filas>0){
                                    while($fila=mysqli_fetch_array($resultado)){
                                        echo "<option value='".$fila[Fecha_inicio]."'>$fila[Fecha_inicio]</option>";
                                    }
                                }else{
                                    echo "<option>No hay fechas iniciales</option>";
                                }
                            ?>
                        </select>
                </div>
                <div class="elemento">
                    <div id="fin"></div>
                </div>
                <div id='tabla_registro' class='TablaDatosChica'>
                    <table>
                        <tr><td>Alumno</td><td>Entrada</td><td>Salida</td><td>Minutos acumulados</td></tr>
                        <?php
                            $query = "SELECT CONCAT(nombres_usuario, ' ', apellidos_usuario) AS nombre, inicio, fin, tiempo 
                                        FROM Checadores, Usuarios 
                                        WHERE inicio IS NOT NULL AND fin IS NOT NULL AND id_usuario_checador = id_usuario 
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
                        ?>
                    </table>
                </div>
                <br>
                
                <div class="elemento"><input class="boton" value="Imprimir Grafica" type="submit"></div>
                <div class="elemento"><input class="boton" value="Mandar a excel" type="submit"></div>
            </form> 
        </div>
        
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
        
        <!-- Validación de lado del usuario -->
        <script src="../../js/jquery-1.9.1.js"></script>
        <script>
            $(document).ready(function() {
                
                $("select#fecha_inicio").change(function(){
                    var fecha_inicio = $("select#fecha_inicio option:selected").attr('value');
                    
                    $.ajax({
                        type : "POST",
                        url : "registro_completo.php",
                        data : {fecha_inicio: fecha_inicio},
                        cache : false,
                        beforeSend : function() {
                            $('#tabla_registro').html('Cargando...');
                        },
                        success : function(html) {
                            $('#tabla_registro').html(html);
                        }
                    });
                    
                    $.ajax({
                        type : "POST",
                        url : "fecha_final.php",
                        data : {fecha_inicio: fecha_inicio},
                        cache : false,
                        beforeSend : function() {
                            $('#fin').html('Cargando...');
                        },
                        success : function(html) {
                            $('#fin').html(html);
                        }
                    });
                });
                
            });
        </script>
    </body>
</html>
<?php
}else{
header('Location: ../../procesos/logout.php');
}
?>
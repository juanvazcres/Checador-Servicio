<?php
	session_start();
	if ($_SESSION["rol_usuario"]==3 ) {

    if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: contrasena.php?msg=".$error);
    }

?>
<!DOCTYPE html>
<html lang="es-ES">
    <head class="header">
        <title>Servicio social - Usuario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="screen" >
   </head>
   <body>
       <div class="wrapper">
        <?php include ("header.html"); ?>
        <?php include ("nav.html"); ?>
        <!-- Contenido -->
        <div id="formulario-usuario" class="formulario" align="center">        
            <h2 align="center">Mis horas</h2>
            <form id="suma_horas_usuario" name="suma_horas_usuario" method="post" action="<?php $_PHP_SELF ?>">
            <br>
            <?php
                include("../../db/conf.php");
                $con=Conectarse();
                $query = "SELECT SUM(tiempo) AS TIEMPO_TOTAL FROM `Checadores` WHERE id_usuario_checador='$_SESSION[id_usuario]';";
                $resultado = mysqli_query($con, $query);
                if($resultado){
                    echo "Tiempo cumplido:<br><br>";
                    while($fila=mysqli_fetch_array($resultado)){
                        $minutos = $fila['TIEMPO_TOTAL'];
                        $horas = (int)($minutos/60);
                        if($horas>0){
                            if($horas==1){
                                echo $horas." hora";
                            }else{
                                echo $horas." horas";
                            }
                        }
                        $minutos = $minutos - $horas*60;
                        if($minutos>0){
                            if($minutos==1){
                                echo "<br>".$minutos." minuto";
                            }else{
                                echo "<br>".$minutos." minutos";
                            }
                        }
                    }
                    
                    $query = "INSERT INTO Historiales(id_usuario_historia) VALUES('$_SESSION[id_usuario]');";
                    $resultado = mysqli_query($con, $query);
                    if($resultado){
                        echo "<br><br>Se creará un registro cada que se muestren sus horas cumplidas";
                    }
                }else{
                    echo "No tiene horas cumplidas, actualice";
                }
            ?>
            <br><br><br>
            </form>
        </div>
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
    </body>
</html>
<?php
}else{
header('Location: ../../procesos/logout.php');
}
?>
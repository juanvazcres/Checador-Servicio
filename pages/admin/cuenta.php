<?php
    if (isset($_GET['msg'])) {
        $msg=$_GET['msg'];
    }else{
        $msg='<br>';
    }
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
        
        
        <!-- No se si el cambio de contraseña va aquí e.e -->
        
        <h1 align="center">Cambio de contraseña de un usuario o administrador</h1>
<div id="changePassword" class="formulario" align="center">

            <form method="post" action="<?php $_PHP_SELF ?>">
                <div class="elemento">
                   <!-- <label for="usuarios_id_usuario">Contraseña Antigua</label> -->
                    <input name="oldPassword" type="password" id="oldPassword" placeholder="contraseña antigua" title="no compatible" required="required"/>
                    <span class="rojo">*</span>
                </div>
                
                <div class="elemento">
                    <!-- <label for="usuarios_clave_usuario">Nueva Contraseña</label> -->
                    <input name="newPassword" type="password" id="newPassword" placeholder="Nueva contraseña" title="no compatible" requiered="requiered"/>
                    <span class="rojo">*</span>
                </div>
                
                <div class="elemento">
                    <input name="add" class="boton" type="submit" id="add" value="Cambiar contraseña">
                </div>
                <p><?php echo $msg; ?></p>
            </form>

        </div>

         <!-- Kind of PHP -->
        <?php 
session_start();
    
    
if( isset($_POST['oldPassword']) )
{
      include("../../db/conf.php");
    $linkConexion = Conectarse();
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
            $query = "UPDATE Usuarios SET Usuarios.password_usuario = '".$newPassword."' WHERE Usuarios.id_usuario = 'admin' AND Usuarios.password_usuario = '".$oldPassword."'";
            $result = $linkConexion->query($query) or die("Error in the consulta y así ._.!.." . mysqli_error($linkConexion));

           if (!mysql_error($linkConexion)) {
mysqli_close($linkConexion);
$error="contraseña incorrecta";
            header('Location: cuenta.php?msg='.$error.'');
            } else {
mysqli_close($linkConexion);
                 header('Location: Inicio.php');
            }

} 


           
        ?>
        <!-- Kind of PHP -->
        
        <!-- cambio de contraseña... EOF -->





        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
    </body>
</html>
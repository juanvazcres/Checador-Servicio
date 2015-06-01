<?php
session_start();
include("../../db/conf.php");
	if ($_SESSION["rol_usuario"]==1){

        if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: cuenta.php?msg=".$error);
        }

        if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
         } else {
                    $msg = '<br>';
         }

        if(isset($_POST['id_usuario'])){
            $id = $_POST['id_usuario'];
            $nombre = $_POST['nombres'];
            $apellido = $_POST['apellidos'];
            $conn = Conectarse();
            $query = "UPDATE Usuarios SET nombres_usuario = '".$nombre."', apellidos_usuario = '".$apellido."' WHERE id_usuario = '".$id."' AND estado_usuario = 1";
            $conn->query($query);
            if(mysqli_affected_rows($conn) ===1){
                $msg = "Datos actualizados correctamente";
                 header("Location: editar_admin.php?msg=".$msg);
            } else {
                $error = "El RFC no existe o fué dado de baja";
                 header("Location: editar_admin.php?msg=".$error);
            }
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

            <div id="formulario-usuario" class="formulario" align="center">
            <h2>Modificar campos</h2>
                <form action="editar_admin.php" method="post">
                  <div class="elemento">
                        <label for="id_usuario">ID</label>
                        <input type="text" id="id_usuario" name="id_usuario" placeholder="RFC " required />
                        <span class="rojo">*</span>
                    </div>
                  <div class="elemento">
                        <label for="nombres">Nombre(s):</label>
                        <input type="text" id="nombres" name="nombres" placeholder="Nombre(s)" required />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento">
                        <label for="apellidos">Apellido(s):</label>
                        <input type="text" id="apellidos" name="apellidos" placeholder="Apellido(s)" required />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento"><input class="boton" value="Modificar" type="submit"></div>
                    <p><?php echo $msg; ?></p>
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
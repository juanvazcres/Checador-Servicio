<?php
session_start();
	if ($_SESSION["rol_usuario"]==1 ){

        if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: cuenta.php?msg=".$error);
        }

                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                } else {
                    $msg = '<br>';
                }
        include("../../db/conf.php");
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
            <h2>Bajas a usuarios</h2>
                <form action="darDeBajaUsuario.php" method="post">
                    <div class="elemento">
                        <label for="id_usuario">SELECCIONE:</label>
                        <select id="id_usuario" name="id_usuario">
                            <?php
                                $linkConexion = Conectarse();
                                $query = "SELECT id_usuario, nombres_usuario, apellidos_usuario FROM Usuarios WHERE estado_usuario = 1 AND rol_usuario = 3";
                                $resultado = $linkConexion->query($query); 
                                if(mysqli_num_rows($resultado)){
                                    while($fila=mysqli_fetch_array($resultado)){
                                        echo '<option value="'.$fila[id_usuario].'">'.utf8_encode($fila[nombres_usuario]).' '.utf8_encode($fila[apellidos_usuario]).'</option>';
                                    }
                                    echo '</select><span class="rojo">*</span></div><div class="elemento"><input class="boton" value="Dar Baja" type="submit"></div>';
                                }else{
                                    echo '<option value="nada">No hay Subadministradores</option>';
                                    echo '</select></div><div class="elemento"><input class="boton" value="Dar Baja" type="submit" disabled></div>';
                                 }
                            ?>
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
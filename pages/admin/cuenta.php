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
        <h1>Cambio de contraseña de un usuario o administrador</h1>
        <form method="post" action="<?php $_PHP_SELF ?>">
            <div class="elemento">
                <label for="usuarios_id_usuario">Nickname o RFC</label>
                <input name="usuarios_id_usuario" type="text" id="usuarios_id_usuario" placeholder="Nickname/RFC" title="no compatible"/>
                <span class="rojo">*</span>
            </div>
            
            <div class="elemento">
                <label for="usuarios_clave_usuario">Nueva Contraseña</label>
                <input name="usuarios_clave_usuario" type="password" id="usuarios_clave_usuario" placeholder="Nueva contraseña" title="no compatible"/>
                <span class="rojo">*</span>
            </div>
            
            <div class="elemento">
                <input name="add" class="boton" type="submit" id="add" value="Añadir usuario">
            </div>
        </form>
        
        
        <!-- Kind of PHP -->
        <?php 
            include ("../../db/conexion.php");
            $query = "UPDATE usuarios SET usuarios.password_usuario = 'default' WHERE usuarios.id_usuario = '".$clave."'";
            $result = $linkConexion->query($query) or die("Error in the consulta y así ._.!.." . mysqli_error($linkConexion));
            if (!$result) {
                echo mysql_error();
                echo "No se pudo realizar";
            } else {
                echo "<script>alert('Listo')</script>";
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

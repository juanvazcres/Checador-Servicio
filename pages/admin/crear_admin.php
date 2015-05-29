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
            <h2>Crear administrador</h2>
                <form action=".php" method="post">
                    <div class="elemento">
                        <label for="id_usuario">rfc:</label>
                        <input type="text" id="id_usuario" name="id_usuario" placeholder="RFC como id" value="<?php echo $id_usuario ?>" />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento">
                        <label for="nombres">Nombre(s):</label>
                        <input type="text" id="nombres" name="nombres" placeholder="Nombre(s)" value="<?php echo $nombres ?>" />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento">
                        <label for="apellidos">Apellido(s):</label>
                        <input type="text" id="apellidos" name="apellidos" placeholder="Apellido(s)" value="<?php echo $apellidos ?>" />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento"><input class="boton" value="Crear" type="submit"></div>
                    <p><?php echo $msg; ?></p>
                </form> 
        </div>
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
    </body>
</html>
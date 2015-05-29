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
            <h2>Correccion de  horas</h2>
                <form action=".php" method="post">
                  <div class="elemento">
                        <label for="id_usuario">ID</label>
                        <input type="text" id="id_usuario" name="id_usuario" placeholder="Número de control" value="<?php echo $id_usuario ?>" />
                        <span class="rojo">*</span>
                    </div>
                   <div class="elemento">
                        <label for="dia_agenda">Dia :</label>
                        <input type="text" id="dia_agenda" name="dia_agenda" placeholder="dia a modifcar" value="<?php echo $dia_agenda ?>" />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento">
                        <label for="inicio">Entrada :</label>
                        <input type="date" id="inicio" name="inicio" placeholder="inicio" value="<?php echo $inicio ?>" />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento">
                        <label for="fin">Salida :</label>
                        <input type="date" id="fin" name="fin" placeholder="fin" value="<?php echo $fin ?>" />
                        <span class="rojo">*</span>
                    </div>
                    <div class="elemento"><input class="boton" value="Corregir" type="submit"></div>
                    <p><?php echo $msg; ?></p>
                </form> 
        </div>
        
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
    </body>
</html>
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
         <h2>MODIFICAR CAMPOS</h2>
         <form action=".php" method="post">
           <div class="elemento">
                <label for="id_usuario">ID</label>
                <input name="id_usuario" type="text" id="id_usuario" placeholder="Número de control"
                title="no compatible"
                />
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="nombres_usuario">Nombres</label>
                <input name="nombres_usuario" type="text" id="nombres_usuario" placeholder="Nombre(s)"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="apellidos_usuario">Apellidos</label>
                <input name="apellidos_usuario" type="text" id="apellidos_usuario" placeholder="Apellido(s)"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="celular_usuario">Celular</label>
                <input name="celular_usuario" type="text" id="celular_usuario" placeholder="Celular"/>
                <span class="rojo">*</span>
            </div>
           </form> 
        </div>
        
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
    </body>
</html>
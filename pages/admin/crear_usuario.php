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
            
            <form method="post" action="<?php $_PHP_SELF ?>">
            <div class="elemento">
                <label for="usuarios_id_usuario">ID</label>
                <input name="usuarios_id_usuario" type="text" id="usuarios_id_usuario" placeholder="Número de control"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="usuarios_nombres_usuario">Nombres</label>
                <input name="usuarios_nombres_usuario" type="text" id="usuarios_nombres_usuario" placeholder="Nombre(s)"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="usuarios_apellidos_usuario">Apellidos</label>
                <input name="usuarios_apellidos_usuario" type="text" id="usuarios_apellidos_usuario" placeholder="Apellido(s)"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="usuarios_celular_usuario">Celular</label>
                <input name="usuarios_celular_usuario" type="text" id="usuarios_celular_usuario" placeholder="Celular"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="usuarios_carrera_usuario">Carrera</label>
                <select name="usuarios_carrera_usuario" id="usuarios_carrera_usuario" >
                    <option>Carrera bd</option>
                    <option>Carrera bd</option>
                    <option>Carrera bd</option>                    
                </select>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="usuarios_horario_usuario">Horario</label>
                <input name="usuarios_horario_usuario" type="text" id="usuarios_horario_usuario"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <input name="add" class="boton" type="submit" id="add" value="Añadir usuario">
            </div>
            </form>
        </div>
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
    </body>
</html>

<!DOCTYPE html>
<html lang="es-ES">
    <head class="header">
        <title>Servicio social - Administrador</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" >
   </head>
   <body>
       <div class="wrapper">
        <?php include ("header.html"); ?>
        <?php include ("nav.php"); ?>
        <!-- Contenido -->
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
<tr>
<td width="100">Numero de control</td>
<td><input name="usuarios_id_usuario" type="text" id="usuarios_id_usuario"></td>
</tr>

<tr>
<td width="100">Password</td>
<td><input name="usuarios_password_usuario" type="password" id="usuarios_password_usuario"></td>
</tr>

<tr>
<td width="100">Nombres</td>
<td><input name="usuarios_nombres_usuario" type="text" id="usuarios_nombres_usuario"></td>
</tr>

<tr>
<td width="100">Apellidos</td>
<td><input name="usuarios_apellidos_usuario" type="text" id="usuarios_apellidos_usuario"></td>
</tr>

<tr>
<td width="100">Telefono</td>
<td><input name="usuarios_telefono_usuario" type="text" id="usuarios_telefono_usuario"></td>
</tr>

<tr>
<td width="100">Carrera</td>
<td><input name="usuarios_carrera_usuario" type="text" id="usuarios_carrera_usuario"></td>
</tr>

<tr>
<td width="100">Horario</td>
<td><input name="usuarios_horario_usuario" type="text" id="usuarios_horario_usuario"></td>
</tr>

<tr>
<td width="100"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="add" type="submit" id="add" value="Añadir usuario">
</td>
</tr>
</table>
</form>
        
        
        
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../footer.php"); ?>
        <?php include ("../menu.html"); ?>
    </body>
</html>

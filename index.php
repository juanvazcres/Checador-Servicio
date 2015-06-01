<?php
	session_start();
	if (isset($_SESSION["id_usuario"])){
header('Location: procesos/logout.php');
}
    if (isset($_GET['msg'])) {
        $msg=$_GET['msg'];
    }else{
        $msg='<br>';
    }
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head class="header">
        <title>Servicio social</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" >
   </head>
   <body>
        <div class="wrapper">
        <?php include ("inc/header.html"); ?>
		<div id="login" class="formulario" align="center">
        <h2>Iniciar sesión</h2>
        <form action="procesos/proceso_login.php" method="post">
                    <div class="elemento"><input name="id" placeholder="Introduce tu ID" type="text"></div>
                    <div class="elemento"><input name="password" placeholder="Introduce tu contraseña" type="password"></div>
                    <div class="elemento"><input class="boton" value="Ingresar" type="submit"></div>
                    <p><?php echo $msg; ?></p>
                </form> 
        </div>
        
        <div class="push"></div>
        </div>
        
       <?php include ("inc/footer.php"); ?> 
    </body>
</html>		
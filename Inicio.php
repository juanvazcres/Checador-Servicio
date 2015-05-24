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
       <?php include ("header.html"); ?>
		<div id="login" align="center">
            <h2>Iniciar sesión</h2>
            <div class="formulario">
                <form action="proceso_login.php" method="post">
                    <div class="elemento"><input name="id" placeholder="Introduce tu ID" type="text"></div>
                    <div class="elemento"><input name="password" placeholder="Introduce tu contraseña" type="password"></div>
                    <div class="elemento"><input class="boton" value="Ingresar" type="submit"></div>
                    <p><?php echo $msg; ?></p>
                </form> 
            </div>
        </div>

            <div class="push"></div>
        </div>
        
       <?php include ("footer.php"); ?> 
    </body>
</html>
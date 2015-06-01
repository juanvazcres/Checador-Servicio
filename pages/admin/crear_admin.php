<?php
session_start();
    if ($_SESSION["rol_usuario"]==1 ){

        if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: cuenta.php?msg=".$error);
        }

    if (isset($_GET['msg'])) {
        $msg=$_GET['msg'];
    }else{
        $msg='<br>';
    }
    
    if( isset($_POST['id_usuario']) ){
      include("../../db/conf.php");
        $linkConexion = Conectarse();

        $usuarioRFC = $_POST['id_usuario'];
        $usuarioNombres = $_POST['nombres'];
        $usuarioApellidos = $_POST['apellidos'];
        
        
        $query = "INSERT INTO `Usuarios`(`id_usuario`, `nombres_usuario`, `apellidos_usuario`, `password_usuario`, `rol_usuario`, `estado_usuario`, `primera_usuario`) VALUES ('".utf8_decode($usuarioRFC)."', '".utf8_decode($usuarioNombres)."', '".utf8_decode($usuarioApellidos)."', 'default', '2', '1', '1')";
        if ($linkConexion->query($query) === TRUE) {
            mysqli_close($linkConexion);
            header('Location: Inicio.php');
        }else{
            mysqli_close($linkConexion);
            $error="Error, quizá el usuario ya existe en los registros.";
            header('Location: cuenta.php?msg='.$error.'');
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
            <h2>Crear administrador</h2>
                <form action="<?php $_PHP_SELF ?>" method="post">
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
    <!-- Validación de lado del usuario -->
        <script src="../js/externo/jquery-1.9.1.js"></script>
        <script src="../js/externo/jquery.validate.min.js"></script>
        <script>
            var jQuery_1_9_1 = $.noConflict(true);
            jQuery_1_9_1(function() {
                jQuery_1_9_1("#formularioContrasena").validate({
                    rules : {
                        contrasena : {
                            required : true,
                            minlength : 6,
                            maxlength : 20 
                        },
                        contrasena1 : {
                            required : true,
                            minlength : 6,
                            maxlength : 20 
                        },
                        contrasena2 : {
                            required : true,
                            equalTo : "#contrasena1"
                        }
                    },
                    messages : {
                        contrasena : {
                            required : "Por favor, ingrese su contraseña",
                            minlength : "Ingrese un mínimo de 6 caracteres",
                            maxlength : "Ingrese un máximo de 20 caracteres"
                        },
                        contrasena1 : {
                            required : "Por favor, ingrese su nueva contraseña",
                            minlength : "Ingrese un mínimo de 6 caracteres",
                            maxlength : "Ingrese un máximo de 20 caracteres"
                        },
                        contrasena2 : {
                            required : "Por favor, confirme su nueva contraseña",
                            equalTo : "Su contraseña no coincide"
                        }
                    }
                });
            });
        </script>
</html>
<?php
}else{
header('Location: ../../procesos/logout.php');
}
?>


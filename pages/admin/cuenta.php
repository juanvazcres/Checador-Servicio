<?php
    session_start();
    if ($_SESSION["rol_usuario"]==1 || $_SESSION["rol_usuario"]==2){

        if (isset($_GET['msg'])) {
            $msg=$_GET['msg'];
        }else{
            $msg='<br>';
        }
        if( isset($_POST['oldPassword']) ){
            include("../../db/conf.php");
            $linkConexion = Conectarse();
            $oldPassword = $_POST['oldPassword'];
            $newPassword1 = $_POST['newPassword1'];
            $query = "UPDATE Usuarios SET Usuarios.password_usuario = '".$newPassword1."' WHERE Usuarios.id_usuario = '".$_SESSION['id_usuario']."' AND Usuarios.password_usuario = '".$oldPassword."'";
            $linkConexion->query($query);
            if($linkConexion->affected_rows === 1){
                mysqli_close($linkConexion);
                header('Location: Inicio.php');
            } else {
                mysqli_close($linkConexion);
                $error="contraseña incorrecta";
                header('Location: cuenta.php?msg='.$error.'');
            }
        } 
?>
<!-- Kind of PHP -->
        
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
<div id="formulario-usuario" class="formulario" align="center">        
        <h2 align="center">Cambio de contraseña</h2>
            <form id="formularioContrasena" name="formularioContrasena" method="post" action="<?php $_PHP_SELF ?>">
                <div class="elemento">
                    <label for="oldPassword">Contraseña Actual</label>
                    <input name="oldPassword" type="password" id="oldPassword" placeholder="contraseña actual" title="no compatible"/>
                    <span class="rojo">*</span>
                </div>
                
                <div class="elemento">
                    <label for="newPassword1">Nueva Contraseña</label>
                    <input name="newPassword1" type="password" id="newPassword1" placeholder="Nueva contraseña" title="no compatible"/>
                    <span class="rojo">*</span>
                </div>

                <div class="elemento">
                    <label for="newPassword2">Confirme Contraseña</label>
                    <input name="newPassword2" type="password" id="newPassword2" placeholder="Confirme contraseña" title="no compatible"/>
                    <span class="rojo">*</span>
                </div>
                
                <div class="elemento">
                    <input name="add" class="boton" type="submit" id="add" value="Cambiar contraseña">
                </div>
                <p><?php echo $msg; ?></p>
            </form>
        </div>
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>

<script src="../../js/jquery-1.9.1.js"></script>
    <script src="../../js/jquery.validate.min.js"></script>
    <script>
            var jQuery_1_9_1 = $.noConflict(true);
            jQuery_1_9_1(function () {
                jQuery_1_9_1("#formularioContrasena").validate({
                    rules: {
                        oldPassword: {
                            required: true,
                            minlength: 6,
                            maxlength: 20
                        },
                        newPassword1: {
                            required: true,
                            minlength: 6,
                            maxlength: 20
                        },
                        newPassword2: {
                            required: true,
                            equalTo: "#newPassword1"
                        }
                    },
                    messages: {
                        oldPassword: {
                            required: "Por favor, ingrese su contraseña",
                            minlength: "Ingrese un mínimo de 6 caracteres",
                            maxlength: "Ingrese un máximo de 20 caracteres"
                        },
                        newPassword1: {
                            required: "Por favor, ingrese su nueva contraseña",
                            minlength: "Ingrese un mínimo de 6 caracteres",
                            maxlength: "Ingrese un máximo de 20 caracteres"
                        },
                        newPassword2: {
                            required: "Por favor, confirme su nueva contraseña",
                            equalTo: "Su contraseña no coincide"
                        }
                    }
                });
            });
    </script>


    </body>


<!-- Termina Parte de Validaciones :D! -->


</html>
<?php
}else{
header('Location: ../../procesos/logout.php');
}
?>	
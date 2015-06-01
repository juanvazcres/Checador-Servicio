<?php
    session_start();
    if ($_SESSION["rol_usuario"]==3 ) {
    
    if($_POST){
        $id_usuario = $_SESSION["id_usuario"];
        $password_usuario = $_SESSION["password_usuario"];
        
        $password = $_POST['contrasena'];
        $password_nueva = $_POST['contrasena1'];
        
        if($password != $password_usuario){
            $error = "La contraseña actual no coincide";
            header("Location: contrasena.php?msg=".$error);
        }else{
            include("../../db/conf.php");
            $con = Conectarse();
            $query = "UPDATE Usuarios SET password_usuario='".utf8_decode($password_nueva)."', primera_usuario='0' WHERE id_usuario='".$id_usuario."';";            
            $resultado = mysqli_query($con, $query);
            
            if($resultado){
                $_SESSION['password_usuario'] = $password_nueva;                
                
                mysqli_close($con);
                $val ="Se actualizó su contraseña";
                header('Location: contrasena.php?msg2='.$val.'');
            }else{
                $error = "Hubo un error al cambiar la contraseña, intente nuevamente";
                header("Location: contrasena.php?msg=".$error);                
                mysqli_close($con);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head class="header">
        <title>Servicio social - Usuario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="screen" >
   </head>
   <body>
       <div class="wrapper">
        <?php include ("header.html"); ?>
        <?php include ("nav.html"); ?>
        <!-- Contenido -->
        
        <div id="formulario-usuario" class="formulario" align="center">        
            <h2 align="center">Cambio de contraseña</h2>
            <form id="formularioContrasena" name="formularioContrasena" method="post" action="<?php $_PHP_SELF ?>">
                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    echo '<br><span class="rojo">';
                    echo $msg;
                    echo '</span>';
                } else {
                    $msg = '<br>';
                }
                if (isset($_GET['msg2'])) {
                    $msg2 = $_GET['msg2'];
                    echo '<br><span class="azul">';
                    echo $msg2;
                    echo '</span>';
                } else {
                    $msg = '<br>';
                }
                ?>
                <div class="elemento">
                   <label for="usuarios_id_usuario">Contraseña actual</label>
                    <input type="password"  id="contrasena" name="contrasena" placeholder="Contraseña actual" required="required"/>
                    <span class="rojo">*</span>
                </div>
                <div class="elemento">
                    <label for="usuarios_clave_usuario">Contraseña nueva</label>
                    <input type="password" id="contrasena1" name="contrasena1" placeholder="Nueva contraseña" requiered="requiered"/>
                    <span class="rojo">*</span>
                </div>
                <div class="elemento">
                    <label for="usuarios_clave_usuario">Confirme contraseña</label>
                    <input type="password" id="contrasena2" name="contrasena2" placeholder="Confirme contraseña" requiered="requiered"/>
                    <span class="rojo">*</span>
                </div>
                
                <div class="elemento">
                    <input name="add" class="boton" type="submit" id="add" value="Cambiar contraseña">
                </div>
            </form>
        </div>        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
        <!-- Validación de lado del usuario -->
        <script src="../../js/jquery-1.9.1.js"></script>
        <script src="../../js/jquery.validate.min.js"></script>
        <script src="../../js/addtional-methods.min.js"></script>
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
    </body>
</html>
<?php
}else{
header('Location: ../../procesos/logout.php');
}
?>
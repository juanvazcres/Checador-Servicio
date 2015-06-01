<?php
session_start();
	if ($_SESSION["rol_usuario"]==1 || $_SESSION["rol_usuario"]==2){

        if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: cuenta.php?msg=".$error);
        }

        if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                } else {
                    $msg = '<br>';
                }

        if( isset($_POST['id_usuario']) ){
            include("../../db/conf.php");
            $linkConexion = Conectarse();
            $id_usuario = $_POST['id_usuario'];
            $nombres_usuario = $_POST['nombres_usuario'];
            $apellidos_usuario = $_POST['apellidos_usuario'];
            $telefono_usuario = $_POST['celular_usuario']; 
            $query = "UPDATE Usuarios SET nombres_usuario = '".$nombres_usuario."', apellidos_usuario = '".$apellidos_usuario."', telefono_usuario = '".$telefono_usuario."' WHERE id_usuario = '".$id_usuario."' AND estado_usuario = '1' AND rol_usuario = '3'";
            $linkConexion->query($query);
            if($linkConexion->affected_rows === 1){
                mysqli_close($linkConexion);
                header('Location: Inicio.php');
            } else {
                mysqli_close($linkConexion);
                $error="número de control inválido";
                header('Location: editar_usuario.php?msg='.$error.'');
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
         <h2>MODIFICAR CAMPOS</h2>
         <form action="<?php $_PHP_SELF ?>" method="post">
           <div class="elemento">
                <label for="id_usuario">ID</label>
                <input name="id_usuario" type="text" id="id_usuario" placeholder="Número de control"
                title="no compatible" required
                />
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="nombres_usuario">Nombres</label>
                <input name="nombres_usuario" type="text" id="nombres_usuario" placeholder="Nombre(s)" required/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="apellidos_usuario">Apellidos</label>
                <input name="apellidos_usuario" type="text" id="apellidos_usuario" placeholder="Apellido(s)" required/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="celular_usuario">Celular</label>
                <input name="celular_usuario" type="text" id="celular_usuario" placeholder="Celular" required/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento"><input class="boton" value="Editar usuario" type="submit"></div>
            <p><?php echo $msg; ?></p>
           </form> 
        </div>
        
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
    </body>
</html>
<?php
}else{
header('Location: ../../procesos/logout.php');
}
?>
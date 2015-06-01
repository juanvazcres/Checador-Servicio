<?php
session_start();
	if ($_SESSION["rol_usuario"]==1 || $_SESSION["rol_usuario"]==2 ){

        if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: cuenta.php?msg=".$error);
        }

                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                } else {
                    $msg = '<br>';
                }
        include("../../db/conf.php");
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head class="header">
        <title>Servicio social - Administrador</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="screen" >
        <script>
function showUser(str) {
    if (str == "0") {
        document.getElementById("table").innerHTML = "";
        return;
    } else {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("table").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getDesfases.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
   </head>
   <body>
       <div class="wrapper">
        <?php include ("header.html"); ?>
        <?php include ("nav.php"); ?>
        <!-- Contenido -->
        
        <div id="formulario-usuario" class="formulario" align="center">
            <h2>Correccion de  horas</h2>
                <form action="#" method="post">
                    <div class="elemento">
                        <label for="id_usuario">SELECCIONE:</label>
                        <select id="id_usuario" name="id_usuario" onchange="showUser(this.value)">
                        <?php
                            $linkConexion = Conectarse();
                            $query = "SELECT id_usuario, nombres_usuario, apellidos_usuario FROM Usuarios WHERE estado_usuario = 1 AND rol_usuario = 3";
                            $resultado = $linkConexion->query($query); 
                            if(mysqli_num_rows($resultado)){
                                echo '<option value="0">Seleccione un usuario</option>';
                                while($fila=mysqli_fetch_array($resultado)){
                                    echo '<option value="'.$fila[id_usuario].'">'.$fila[nombres_usuario].' '.$fila[apellidos_usuario].'</option>';
                                }
                            }else{
                                echo '<option value="0">No hay Usuarios</option>';
                             }
                             mysqli_close ( $linkConexion );
                        ?>
                        </select>
                    </div>
                </form> 


                 <div id="table" name="table">
                 

                 </div>
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
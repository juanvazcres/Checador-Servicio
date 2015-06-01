<?php
    session_start();
    if ($_SESSION["rol_usuario"]==3 ) {
        
    $id_usuario = $_SESSION["id_usuario"];
    
    if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: contrasena.php?msg=".$error);
    }
    
    include("../../db/conf.php");
    $con=Conectarse();
    
    if(isset($_POST['entrada'])){
        $entrada = date('Y-m-d H:i:s');
        
        $query = "INSERT INTO Checadores(inicio, id_usuario_checador)
                VALUES('$entrada', '$id_usuario');";
        $resultado = mysqli_query($con, $query);
        if($resultado){
            $val="Se checó su entrada";
            header('Location: Inicio.php?msg2='.$val.'');
        }else{
            $error="No se agregó su entrada, intente nuevamente";
            header('Location: Inicio.php?msg='.$error.'');
        }
    }
    
    if(isset($_POST['salida'])){
        $id_checador = $_POST['id_checador'];
        $ini = $_POST['ini'];
        $fin = date('Y-m-d H:i:s');
        echo $id_checador;
        echo $ini;
        echo $fin;
        
        $query = "UPDATE Checadores SET fin='$fin', tiempo=(TIMESTAMPDIFF(MINUTE, '$ini', '$fin')) WHERE id_checador='$id_checador';";
        $resultado = mysqli_query($con, $query);
        if($resultado){
            $val="Se checó su salida";
            header('Location: Inicio.php?msg2='.$val.'');
        }else{
            $error="No se agregó su salida, intente nuevamente";
            header('Location: Inicio.php?msg='.$error.'');
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
        <h2 align="center">Checador</h2>
        <form id="checador" name="checador" method="post" action="<?php $_PHP_SELF ?>">
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
            
            $query = "SELECT id_checador, inicio FROM Checadores WHERE id_usuario_checador='$id_usuario' AND fin IS NULL;";
            $resultado = mysqli_query($con, $query);
            
            $filas = mysqli_num_rows($resultado);
            if($filas>0){
                while($fila=mysqli_fetch_array($resultado)){
                    echo '<input id="id_checador" name="id_checador" value="'.$fila[id_checador].'" type="hidden" readonly /><br>';
                    echo '<input id="ini" name="ini" value="'.$fila[inicio].'" type="hidden" readonly /><br>';
                    echo 'Entrada pendiente: <br>'.$fila[inicio].'<br>';
                }
                echo '
                <div class="elemento">  
                    <input name="salida" class="boton" type="submit" id="salida" value="Checar salida">
                </div>
                <br><br><br>
                Esto generará un desfase.
                <br> Comuníquese con el administrador.
                <br>
                <div class="elemento">
                    <input name="entrada" class="boton" type="submit" id="entrada" value="Checar entrada">
                </div>
                ';
            }else{
                echo '
                <br><br><br>
                <div class="elemento">
                    <input name="entrada" class="boton" type="submit" id="entrada" value="Checar entrada">
                </div>
                <br><br><br>
                ';
            }
            ?>
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
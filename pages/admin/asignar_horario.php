<?php
session_start();
    if ($_SESSION["rol_usuario"]==1 || $_SESSION["rol_usuario"]==2){

    if($_SESSION["primera_usuario"]==1){
        $error = "Por favor, cambia la contraseña por defecto.";
        header("Location: cuenta.php?msg=".$error);
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
   </head>
   <body>
       <div class="wrapper">
        <?php include ("header.html"); ?>
        <?php include ("nav.php"); ?>
        <!-- Contenido -->
        
        <div id="formulario-usuario" class="formulario" align="center">
            <h2>Asignar horario</h2>
            <form action="asignar_horario.php" method="post" enctype="multipart/form-data" name="asignar_horario" id="asignar_horario">
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
                if (isset($_GET['usr'])) {
                    $id_usuario = $_GET['usr'];
                    echo '<br><span class="azul">Usuario creado con éxito<br>';
                    echo $id_usuario;
                    echo '<br>Asigne un horario</span>';
                }
                ?>
                <div class="elemento">
                    <label for="id_usuario">ID</label>
                    <?php
                        if (isset($_GET['usr'])) {
                            echo '<input name="id_usuario" type="text" id="id_usuario" placeholder="Número de control" value="'.$id_usuario.'" disabled>';
                        } else{
                            $con = Conectarse();
                            $sql = "SELECT id_usuario FROM Usuarios WHERE estado_usuario='1' AND rol_usuario='3';";
                            $resultado = $con->query($sql);
                            if(mysqli_num_rows($resultado)){
                                echo '<select id="id_usuario" name="id_usuario">';
                                echo '<option value="0">Selecciona el id</option>';
                                while($fila=mysqli_fetch_array($resultado)){
                                    echo '<option value="'.$fila[id_usuario].'">'.$fila[id_usuario].'</option>';
                                }
                                echo '</select>';
                            }else{
                                echo "No hay usuarios";
                            }
                        }
                    ?>
                    <span class="rojo">*</span>
                </div>
                <?php
                        if (isset($_GET['usr'])) {
                            echo "<div class='imagen'>";
                            $con = Conectarse();
                            $sql = "SELECT horario_usuario FROM Usuarios WHERE id_usuario='".$id_usuario."';";
                            $resultado = $con->query($sql);
                           
                            if(mysqli_num_rows($resultado)){
                                while($fila=mysqli_fetch_array($resultado)){
                                    echo '<img src="../..'.$fila["horario_usuario"].'">';
                                }
                            }else{
                                $error = "Hubo un error al cargar el horario, actualice";
                                header("Location: asignar_horario.php?msg=".$error);
                            }
                            echo "</div>";
                        }else{
                            echo "<div class='elemento'><div id='foto'></div></div>";
                        }
                ?>
                <div class="elemento">
                    <div id="horario"></div>
                </div>
                <div class="elemento">
                    <label for="dia">Día</label>
                    <select id="dia" name="dia">
                        <option value="0">Selecciona día</option>
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miércoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                    </select>
                </div>
                <div class="elemento">
                    <label for="inicio">Inicio</label>
                    <select id="inicio" name="inicio">
                        <option value="0">Selecciona inicio</option>
                        <option value="7:00">7:00</option>
                        <option value="8:00">8:00</option>
                        <option value="9:00">9:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                    </select>
                </div>
                <div class="elemento">
                    <label for="fin">Fin</label>
                    <select id="fin" name="fin">
                    </select>
                </div>
                <div class="elemento">
                    <input class='boton' id='asignar' name='asignar' value='Asignar' type='button'>
                </div>
            </form>
        </div>
        
        
        
        <div class="push"></div>
        </div><!--wrapper-->
        <?php include ("../../inc/footer.php"); ?>
        <?php include ("../../inc/menu.html"); ?>
        
        <!-- Validación de lado del usuario -->
        <script src="../../js/jquery-1.9.1.js"></script>
        <script>
            $(document).ready(function() {
                
                $("select#id_usuario").change(function() {
                    var id_usuario = $("select#id_usuario option:selected").attr('value');
                    
                    $.ajax({
                        type : "POST",
                        url : "../../procesos/horas_usuario.php",
                        data : {id_usuario: id_usuario},
                        cache : false,
                        beforeSend : function() {
                            $('#foto').html('Cargando');
                        },
                        success : function(html) {
                            $("#foto").html(html);
                        }
                    });
                    
                });
                
                $("select#inicio").change(function() {
                    var ini = $("select#inicio option:selected").attr('value');
                    $("#fin").html("");
                    if(ini==0){
                        $("#fin").html("");    
                    }else{
                        var inicioDate = new Date("1/1/1900 " + ini);
                        var finDate = new Date("1/1/1900 22:00:00");

                        for(i=1; inicioDate < finDate; i++){
                            inicioDate.setHours(inicioDate.getHours() + 1);
                            $("#fin").append("<option value='"+inicioDate.getHours()+":00'>"+inicioDate.getHours()+":00"+"</option>");
                        }
                    }
                });
                
                $("#asignar").click(function(){
                    var dia = $("select#dia option:selected").attr('value');
                    var ini = $("select#inicio option:selected").attr('value');
                    var fin = $("select#fin option:selected").attr('value');
                    var usr = $("input#id_usuario").attr('value');
                    
                    if(usr==null){
                        usr = $("select#id_usuario option:selected").attr('value');
                    }
                    
                    $.ajax({
                        type : "POST",
                        url : "../../procesos/asignar_horas.php",
                        data : {id_usuario: usr, dia: dia, ini: ini, fin: fin},
                        cache : false,
                        beforeSend : function() {
                            $('#horario').html('Cargando');
                        },
                        success : function(html) {
                            $("#horario").html(html);
                            $("#tabla_horario").html("");
                        }
                    });
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
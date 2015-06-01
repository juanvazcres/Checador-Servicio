<?php
    session_start();
    if ($_SESSION["rol_usuario"]==1 || $_SESSION["rol_usuario"]==2){

        if($_SESSION["primera_usuario"]==1){
            $error = "Por favor, cambia la contraseña por defecto.";
            header("Location: cuenta.php?msg=".$error);
        }
        
        include("../../db/conf.php");
        if($_POST){
            $id_usuario = $_POST['id_usuario'];
            $nombres_usuario = $_POST['nombres_usuario'];
            $apellidos_usuario = $_POST['apellidos_usuario'];
            $celular_usuario = $_POST['celular_usuario'];
            $carrera_usuario = $_POST['carrera_usuario'];
            
            $con = Conectarse();
            $query = sprintf("SELECT id_usuario FROM Usuarios WHERE id_usuario='%s'", $id_usuario);
            $result = mysqli_query($con, $query);
            
            if(mysqli_num_rows($result)){
                $error = "Este id(".$id_usuario.") ya se encuentra registrado";
                header("Location: crear_usuario.php?msg=".$error);
                mysqli_close($con);
            }else{
                $target_dir = "../../img/horarios/";
                $target_dir2 = "/img/horarios/";
                $target_file = $target_dir . basename($_FILES["horario"]["name"]);
                
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $dir = $target_dir . $id_usuario . "." . $imageFileType;

                
                if (move_uploaded_file($_FILES["horario"]["tmp_name"], $dir)) {
                    mysqli_free_result($result);
                    $query = "INSERT INTO Usuarios(id_usuario, nombres_usuario, apellidos_usuario, telefono_usuario, id_carrera_usuario, horario_usuario)
                                VALUES('$id_usuario','".utf8_decode($nombres_usuario)."','".utf8_decode($apellidos_usuario)."','$celular_usuario', '$carrera_usuario', '$target_dir2$id_usuario.$imageFileType');";                      
                    $resultado = mysqli_query($con, $query);
                    if($resultado){
                        header('Location: asignar_horario.php?usr='.$id_usuario.'');
                    }else{
                        $error = "Ocurrió un error al crear el registro, intente nuevamente.";
                        header('Location: crear_usuario.php?msg='.$error.'');
                    }
                } else {
                    $error = "Hubo un error al ingresar los datos, intente nuevamente";
                    header("Location: crear_usuario.php?msg=".$error);
                    mysqli_close($con);
                }                
            }
            
            mysqli_close($con);
        }
?> 
<!DOCTYPE html>
<html lang="es-ES">
    <head class="header">
        <title>Servicio social - Administrador</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
            <h2>Crear usuario</h2>
            <form action="crear_usuario.php" method="post" enctype="multipart/form-data" name="crear_usuario" id="crear_usuario">
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
                <label for="id_usuario">ID</label>
                <input name="id_usuario" type="text" id="id_usuario" placeholder="Número de control"
                title="no compatible"
                />
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="nombres_usuario">Nombres</label>
                <input name="nombres_usuario" type="text" id="nombres_usuario" placeholder="Nombre(s)"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="apellidos_usuario">Apellidos</label>
                <input name="apellidos_usuario" type="text" id="apellidos_usuario" placeholder="Apellido(s)"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="celular_usuario">Celular</label>
                <input name="celular_usuario" type="text" id="celular_usuario" placeholder="Celular"/>
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <label for="carrera_usuario">Carrera</label>
                <?php
                    $con = Conectarse();
                    
                    $sql = "SELECT id_carrera, carrera FROM Carreras;";
                    $resultado = $con->query($sql);
                    $carreras = mysqli_num_rows($resultado);
                    if($carreras){
                        echo "<select class='lista' name='carrera_usuario' id='carrera_usuario'>
                                <option class='lista' value=''>Selecciona la carrera</option>";
                                    while($carreras=mysqli_fetch_array($resultado)){
                                        echo "<option class='lista' value=".$carreras["id_carrera"].">";
                                        echo utf8_encode($carreras["carrera"]);
                                        echo "</option>";
                                }                                                                       
                        echo "</select>";
                    }
                ?>
                <span class="rojo">*</span>
            </div>
            <div class="elemento"><br>
                <label for="horario">Horario</label>
                <input type="file" name="horario" id="horario">
                <span class="rojo">*</span>
            </div>
            <div class="elemento">
                <input class="boton" type="submit" value="Agregar" name="submit">
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
                
                jQuery_1_9_1.validator.addMethod("regex", function(value, element, regexpr) {
                    return regexpr.test(value);
                }, "Inserte un id válido");
                
                jQuery_1_9_1.validator.addMethod("size",function(value, element, param){
                    return element.files[0].size <= param;
                });
                
                jQuery_1_9_1.validator.addMethod("letras", function(value, element){
                    return /^[A-Za-zñÑáéíóúÁÉÍÓÚüÜ\s]+$/.test(value);  
                },"Sólo letras");

                jQuery_1_9_1("#crear_usuario").validate({
                    rules : {
                        id_usuario : {
                            required : true,
                            minlength : 9,
                            maxlength : 9,
                            //RFC
                            //regex : /^([A-Z|a-z|&amp;]{3}\d{2}((0[1-9]|1[012])(0[1-9]|1\d|2[0-8])|(0[13456789]|1[012])(29|30)|(0[13578]|1[02])31)|([02468][048]|[13579][26])0229)(\w{2})([A|a|0-9]{1})$|^([A-Z|a-z]{4}\d{2}((0[1-9]|1[012])(0[1-9]|1\d|2[0-8])|(0[13456789]|1[012])(29|30)|(0[13578]|1[02])31)|([02468][048]|[13579][26])0229)((\w{2})([A|a|0-9]{1})){0,3}$/
                            regex : /^E[0-9]{8}$/
                        },
                        nombres_usuario : {
                            required : true,
                            minlength : 2,
                            maxlength : 50,
                            letras : true
                        },
                        apellidos_usuario : {
                            required : true,
                            minlength : 2,
                            maxlength : 50,
                            letras : true
                        },
                        celular_usuario : {
                            required : true,
                            digits : true,
                            minlength : 10,
                            maxlength : 10
                        },
                        horario_usuario : {
                            required : true,
                            extension : "jpg|jpeg|png",
                            size : 1048576
                        },
                        carrera_usuario : {
                            required : true
                        }
                        
                    },
                    messages : {
                        id_usuario : {
                            required : "Por favor, ingresa el número de control",
                            minlength : "Ingresa los 9 dígitos",
                            maxlength : "Ingresa sólo los 9 dígitos",
                            regex : "Verifica el número de control"
                        },
                        nombres_usuario : {
                            required : "Por favor, ingresa el nombre",
                            minlength : "Este nombre es muy pequeño",
                            maxlength : "El máximo de caracteres es 50",
                            letras : "Sólo letras"
                        },
                        apellidos_usuario : {
                            required : "Por favor, ingresa el apellido",
                            minlength : "Este apellido es muy pequeño",
                            maxlength : "El máximo de caracteres es 50",
                            letras : "Sólo letras"
                        },
                        celular_usuario : {
                            required : "Por favor, ingresa un número de celular",
                            digits : "Ingresa sólo caracteres numéricos",
                            rangelength : "Ingresa los 10 dígitos del número"
                        },
                        horario_usuario : {
                            required : "Por favor, selecciona una imagen",
                            extension : "Solo imágenes con extensión .jpg .jpeg o .png",
                            size: "Sólo imágenes de hasta 1 MB"
                        },
                        carrera_usuario : {
                            required : "Por favor, selecciona la carrera"
                        }
                    },
                    errorPlacement : function(error, element) {
                        if (element.is(":radio")) {
                            error.appendTo(element.parents('.contenedor'));
                        }else {
                            if(element.is(":checkbox")){
                                error.appendTo(element.parents('.elemento'));
                            }else{
                                error.insertAfter(element);
                            }
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

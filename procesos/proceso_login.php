<?php
    session_start();
    
    include("../db/conf.php");
    $conexion = Conectarse();

    $id = $_POST['id'];
    $pass = $_POST['password'];
    
    $query=sprintf("
        SELECT id_usuario, password_usuario 
        FROM Usuarios 
        WHERE id_usuario='%s';
        ",$id);
    $result=mysqli_query($conexion,$query);
    if(mysqli_num_rows($result)){
        $query=sprintf("
        SELECT id_usuario, password_usuario, rol_usuario, estado_usuario, primera_usuario FROM Usuarios 
        WHERE id_usuario='%s' and password_usuario='%s';
            ", $id, $pass);
        $result=mysqli_query($conexion,$query);
       
        if(mysqli_num_rows($result)){
            $array=mysqli_fetch_array($result);
            mysqli_free_result($result);
            
            if($array['estado_usuario']!=1){
                mysqli_close($conexion);
                $error="Su perfil ha sido deshabilitado";
                header('Location: ../index.php?msg='.$error.'');
            }else{
                $_SESSION['id_usuario']=$array['id_usuario'];
                $_SESSION['password_usuario']=$array['password_usuario'];
                $_SESSION['rol_usuario']=$array['rol_usuario'];
                $_SESSION['primera_usuario']=$array['primera_usuario'];
                    
                switch ($_SESSION['rol_usuario']) {
                    case 1:
                        header('Location: ../pages/admin/Inicio.php');
                    break;
        
                    case 2:
                        header('Location: ../pages/admin/Inicio.php');
                    break;
        
                    case 3:
                        header('Location: ../pages/usuario/Inicio.php');
                    break;
                
                    default:
                        
                    break;
                }
            }
            
        }else{
            mysqli_close($conexion);
            $error="Contraseña errónea";
            header('Location: ../index.php?msg='.$error.'');
        }
    }else{
        mysqli_close($conexion);
        $error="Usted no está registrado";
        header('Location: ../index.php?msg='.$error.'');
    }
?>

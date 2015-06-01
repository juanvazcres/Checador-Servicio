<?php
    session_start();
    include("../../db/conf.php");
    if ($_SESSION["rol_usuario"]==1){
        $id = $_POST['id_usuario'];
        if($id === 0){
            $error = "Seleccione a un Administrador";
            header("Location: eliminar_admin.php?msg=".$error);
        } else {
            $conn = Conectarse();
            $query = "UPDATE Usuarios SET Usuarios.estado_usuario='2' WHERE id_usuario='".$id."'" ;
            $conn->query($query);
            if(mysqli_affected_rows($conn) ==1){
                $msg = "Operación exitosa";
                header("Location: eliminar_admin.php?msg=".$msg);
            } else {
                $error = "Error";
                header("Location: eliminar_admin.php?msg=".$error);
            }
        }

    } else {
    header('Location: ../../index.php');
    }
?>
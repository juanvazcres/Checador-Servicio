<?php
include_once '../db/conexion.php';
$id = trim($_POST['id']);
$password = trim($_POST['password']);
$query = "SELECT id_usuario, password_usuario, nombres_usuario, apellidos_usuario, telefono_usuario, horario_usuario, id_carrera_usuario, rol_usuario FROM Usuarios WHERE id_usuario = '".$id."' and password_usuario = '".$password."'";

$result = $linkConexion->query($query) or die("Error in the consulta y así ._.!.." . mysqli_error($linkConexion));

if ($result->num_rows > 0) {
    echo "<script>alert('Listo')</script>";
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id_usuario"]. " - Name: " . $row["nombres_usuario"]. " " . $row["apellidos_usuario"]. "<br>";
    }
} else {
    echo "0 results";
}
?>
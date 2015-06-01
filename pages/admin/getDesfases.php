<?php
$q = $_GET['q'];
include("../../db/conf.php");
$con = Conectarse();

$sql="SELECT id_checador, inicio, fin FROM Checadores WHERE id_usuario_checador = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table class='table'>
                    <thead>
                        <tr>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>";
while($row = mysqli_fetch_array($result)) {
    if($row['inicio'] == "" || $row['inicio'] === NULL){
        $varInicio = "<input type='hidden' id='valorInicio' name='valorInicio' placeholder='Nueva Hora'/>";
    } else {
        $varInicio =$row['inicio'];
    }

    if($row['fin'] == "" || $row['fin'] === NULL){
        $varFinal = "<input type='hidden' id='valorFinal' name='valorFinal' placeholder='Nueva Hora'/>";
    } else {
        $varFinal = $row['fin'];
    }
    echo "<tr><form method='post' action='#'>";

    echo "<td>" . $varInicio . "</td>";
    echo "<td>" . $varFinal . "</td>";
    echo "<td><input type='submit' value='cambiar'/></td>";
    echo "</form></tr>";
}
echo "</tbody></table>";
mysqli_close($con);
?>
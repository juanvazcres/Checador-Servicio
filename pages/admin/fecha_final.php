<?php
    $fecha_inicio = trim(mysql_escape_string($_POST["fecha_inicio"]));
    include("../../db/conf.php");
    $con = Conectarse();
    
    echo "<label for='fecha_fin'>Fecha final</label><select id='fecha_fin' name='fecha_fin'>";
    
    $query = "SELECT DISTINCT(DATE_FORMAT(fin,'%d/%m/%Y')) Fecha_fin FROM Checadores WHERE inicio <= '$fecha_inicio' AND fin IS NOT NULL ORDER BY fin;";
    $resultado = mysqli_query($con, $query);
    $filas = mysqli_num_rows($resultado);
    if($filas>0){
        while($fila=mysqli_fetch_array($resultado)){
            echo "<option value='".$fila[Fecha_fin]."'>$fila[Fecha_fin]</option>";
        }
    }else{
        echo "<option>$fecha_inicio</option>";
    }
    echo "</select>";
?>
<script src="../../js/jquery-1.9.1.js"></script>
<script>
    $(document).ready(function() {
        $("select#fecha_fin").change(function(){
            var fecha_inicio = $("select#fecha_inicio option:selected").attr('value');
            var fecha_final = $("select#fecha_fin option:selected").attr('value');
            
            $.ajax({
                type : "POST",
                url : "registro_completo2.php",
                data : {fecha_inicio: fecha_inicio, fecha_final: fecha_final},
                cache : false,
                beforeSend : function() {
                    $('#tabla_registro').html('Cargando...');
                },
                success : function(html) {
                    $('#tabla_registro').html(html);
                }
            });
        });
        
    });
</script>
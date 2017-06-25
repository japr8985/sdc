<?php
include("../../conexion/conexion.php");
ini_set('display_errors', 1);

if (isset($_POST['page'])) {
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if (!is_numeric($page_number)) {
        die('Numero invalido');
    }
}
else{
    $page_number = 1;
}

//obtiene la pagina actual y la adapta para realizar la consulta
$registros_por_pagina = 200;
$posicion = (($page_number -1)* $registros_por_pagina);
$sql = "SELECT   
        registros_total.id, 
        registros_total.codpdvsa, 
        registros_total.descripcion, 
        registros_total.rev, 
        registros_total.fecha_rev as fecha, 
        registros_total.codcliente, 
        registros_total.status, 
        registros_total.disciplina, 
        registros_total.fases
    FROM registros_total
    WHERE registros_total.status ='ACTIVO' 
    ORDER BY codpdvsa ASC limit $posicion, $registros_por_pagina";
$query = $mysqli->query($sql);
$i = 0;
    echo "<table class='table table-hover table--class' id='lista_maestra'>";
        echo "<thead>";
            echo "<th>";
                echo "Cod. Pdvsa";
            echo "</th>";
            echo "<th>";
                echo "Descripcion";
            echo "</th>";
            echo "<th>";
                echo "Rev";
            echo "</th>";
            echo "<th>";
                echo "Fecha";
            echo "</th>";
            echo "<th>";
                echo "Cod. Cliente";
            echo "</th>";
            echo "<th>";
                echo "Status";
            echo "</th>";
            echo "<th>";
                echo "Disciplina";
            echo "</th>";
            echo "<th>";
                echo "Fase";
            echo "</th>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $query->fetch_array()) {
            echo "<tr id='".$row[0]."'>";
                echo "<td> <input type='text' id='".$i."' class='form-control' value='".trim($row[1])."'></td>";
                echo "<td> ".$row[2]."</td>";
                echo "<td style='text-align:center;'> ".$row[3]."</td>";
                echo "<td style='text-align:center;'> ".$row[4]."</td>";
                echo "<td style='text-align:center;'> ".$row[5]."</td>";
                echo "<td style='text-align:center;'> ".$row[6]."</td>";
                echo "<td style='text-align:center;'> ".$row[7]."</td>";
                echo "<td style='text-align:center;'> ".$row[8]."</td>";
            echo "</tr>";
            $i++;
            }
        echo "</tbody>";
    echo "</table>";
    
?>
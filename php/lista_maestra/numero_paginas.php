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
        registros_total.id as id, 
        registros_total.codpdvsa as codpdvsa, 
        registros_total.descripcion as descripcion, 
        registros_total.rev as rev, 
        registros_total.fecha_rev as fecha, 
        registros_total.codcliente as codcliente, 
        fases.fase as fase,
        disciplina.disciplina as disciplina
    FROM registros_total, fases, disciplina
    WHERE registros_total.status ='ACTIVO' AND registros_total.fases = fases.codigo AND registros_total.disciplina = disciplina.simbolo
    ORDER BY codpdvsa ASC limit $posicion, $registros_por_pagina";
$query = $mysqli->query($sql);
$i = 0;
    echo "<table class='table table-hover table--class' id='lista_maestra'>";
        echo "<thead>";
            echo "<tr>";
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
                    echo "Fase";
                echo "</th>";
                echo "<th>";
                    echo "Disciplina";
                echo "</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $query->fetch_array()) {
            echo "<tr class='espaciado_de_columnas'>";
                echo "<td > 
                        <textarea id=".$i." cols='25' rows='3'>".$row[1]."</textarea>
                    </td>";
                echo "<td> ".$row[2]."</td>";
                echo "<td style='text-align:center;'> ".$row[3]."</td>";
                echo "<td style='text-align:center;'> ".$row[4]."</td>";
                echo "<td style='text-align:center;'> ".$row[5]."</td>";
                echo "<td style='text-align:center;'> ".$row[6]."</td>";
                echo "<td style='text-align:center;'> ".$row[7]."</td>";
            echo "</tr>";
            $i++;
            }
        echo "</tbody>";
    echo "</table>";
    
?>
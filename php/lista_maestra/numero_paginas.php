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
    ORDER BY registros_total.id ASC limit $posicion, $registros_por_pagina";
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
                echo "<th>";
                    echo "Detallado";
                echo "</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $query->fetch_array()) {
            $sql_num = "SELECT count(id) FROM registros_total WHERE id < ".$row['id']." AND status = 'ACTIVO'";
            $query_num = $mysqli->query($sql_num);
            $find_num = $query_num->fetch_array();
            $fecha = !is_null($row[4]) ? new DateTime($row[4]) : '';
            $fecha = ($fecha != '') ? $fecha->format('d-m-Y') : '';
            echo "<tr class='espaciado_de_columnas'>";
                echo "<td style='margin: 0px 20px 5px 5px;'> 
                        <textarea id=".$i." cols='24' rows='3' readonly onClick='seleccionado(this.id)'>".$row[1]."</textarea>
                    </td>";
                echo "<input type='hidden' id='hidden".$i."' value='".($find_num[0]+1)."'>";
                echo "<td style='margin-top: 20px;'> ".$row[2]."</td>";
                echo "<td style='text-align:center; margin-top: 20px;'> ".$row[3]."</td>";
                echo "<td style='text-align:center; margin-top: 20px;'> ".$fecha."</td>";
                echo "<td style='text-align:center; margin-top: 20px;'> ".$row[5]."</td>";
                echo "<td style='text-align:center; margin-top: 20px;'> ".$row[6]."</td>";
                echo "<td style='text-align:center; margin-top: 20px;'> ".$row[7]."</td>";
                //echo "<td style='text-align:center; margin-top: 20px;'> <a href='/sdc/php/lista_maestra/detallado.php?id=".$row['id']."' >Ver</a></td>";
                echo "<td style='text-align:center; margin-top: 20px;'> <button onclick='showDetail(".$row['id'].")' class='btn btn-info'>Ver</button>";
            echo "</tr>";
            $i++;
            }
        echo "</tbody>";
    echo "</table>";
    
?>
<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nomb_esp = $_POST["nomb_esp"];
$nomb_pru = $_POST["nomb_pru"];
$tiempo_duracion_min = $_POST["tiempo_duracion_min"];

$db->debug=true;
if ($nomb_esp or $nomb_pru or $tiempo_duracion_min){
    $sql3 = $db->Prepare("SELECT esp.*,pr.*
                            FROM especialidades esp 
                            INNER JOIN pruebas pr ON esp.id_especialidad=pr.id_especialidad
                            WHERE esp.nomb_esp LIKE ? 
                            AND pr.nomb_pru LIKE ? 
                            AND pr.tiempo_duracion_min LIKE ?   

                        ");
    $rs3 = $db->GetAll($sql3, array($nomb_esp."%", $nomb_pru."%", $tiempo_duracion_min."%"));
        if ($rs3) {
            echo"<center>
                <table class='listado'>
                    <tr>                                   
                    <th>ESPECIALIDAD</th><th>PRUEBA</th><th>DURACION MINIMA</th><th>SELECIONE</th>
                    </tr>";
                foreach ($rs3 as $k => $fila) {  
                    $str = $fila ["nomb_esp"];
                    $str1 = $fila ["nomb_pru"];
                    $str2 = $fila ["tiempo_duracion_min"];
                    
                echo"<tr>
                            <td align='center'>".resaltar($nomb_esp, $str)."</td>
                            <td>".resaltar($nomb_pru, $str1)."</td>
                            <td>".resaltar($tiempo_duracion_min, $str2)."</td>
                            <td align='center'>
                                <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_prueba"].")'>
                            </td>
                        </tr>";
                    }
                    echo"</table>
                    </center>";
        }else{
            echo"<center><b> LA PRUEBA NO EXISTE!!</b></center><br>";
        }
}  
?>
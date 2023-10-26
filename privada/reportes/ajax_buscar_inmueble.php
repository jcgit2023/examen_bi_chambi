<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$material = $_POST["material"];
$superficie = $_POST["superficie"];
$numero_dormitorios = $_POST["numero_dormitorios"];

//$db->debug=true;
if ($material or $superficie or $numero_dormitorios){
    $sql3 = $db->Prepare("SELECT *
                            FROM inmuebles
                            WHERE material LIKE ? 
                            AND superficie LIKE ? 
                            AND numero_dormitorios LIKE ? 
                            AND id_inmueble <> 'X'    

                        ");
    $rs3 = $db->GetAll($sql3, array($material."%", $superficie."%", $numero_dormitorios."%"));
        if ($rs3) {
            echo"<center>
                <table class='listado'>
                    <tr>                                   
                    <th>MATERIAL</th><th>SUPERFICIE</th><th>NRO_DORMITORIOS</th><th>SELECIONE</th>
                    </tr>";
                foreach ($rs3 as $k => $fila) {  
                    $str = $fila ["material"];
                    $str1 = $fila ["superficie"];
                    $str2 = $fila ["numero_dormitorios"];
                    
                echo"<tr>
                            <td align='center'>".resaltar($material, $str)."</td>
                            <td>".resaltar($superficie, $str1)."</td>
                            <td>".resaltar($numero_dormitorios, $str2)."</td>
                            <td align='center'>
                                <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_inmueble"].")'>
                            </td>
                        </tr>";
                    }
                    echo"</table>
                    </center>";
        }else{
            echo"<center><b> EL INMUEBLE NO EXISTE!!</b></center><br>";
        }
}  
?>
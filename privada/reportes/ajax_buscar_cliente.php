<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];

$db->debug=true;
if ($nombre or $apellido or $telefono){
    $sql3 = $db->Prepare("SELECT *
                            FROM clientes
                            WHERE nombre LIKE ? 
                            AND apellido LIKE ? 
                            AND telefono LIKE ? 
                            AND estado <> 'X'    

                        ");
    $rs3 = $db->GetAll($sql3, array($nombre."%", $apellido."%", $telefono."%"));
        if ($rs3) {
            echo"<center>
                <table class='listado'>
                    <tr>                                   
                    <th>NOMBRE</th><th>APELLIDO</th><th>TELEFONO</th>
                    </tr>";
                foreach ($rs3 as $k => $fila) {  
                    $str = $fila ["nombre"];
                    $str1 = $fila ["apellido"];
                    $str2 = $fila ["telefono"];
                    
                echo"<tr>
                            <td align='center'>".resaltar($nombre, $str)."</td>
                            <td>".resaltar($apellido, $str1)."</td>
                            <td>".resaltar($telefono, $str2)."</td>
                            <td align='center'>
                                <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_cliente"].")'>
                            </td>
                        </tr>";
                    }
                    echo"</table>
                    </center>";
        }else{
            echo"<center><b> EL CLIENTE NO EXISTE!!</b></center><br>";
        }
}  
?>
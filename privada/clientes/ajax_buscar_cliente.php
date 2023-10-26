<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre =$_POST["nombre"];
$apellido =$_POST["apellido"];
$telefono =$_POST["telefono"];

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
                    <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
            foreach ($rs3 as $k => $fila) {
                $str = $fila["nombre"];
                $str1 = $fila["apellido"];
                $str2 = $fila["telefono"];
            
            echo"<tr>
                    <td aling='center'>".resaltar($nombre, $str)."</td>
                    <td>".resaltar($apellido, $str1)."</td>
                    <td>".resaltar($telefono, $str2)."</td>
                    
                    <td aling='center'>
                    <form name='formModif".$fila["id_cliente"]."' method='post' action='clientes_modificar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila['id_cliente']."'>
                            <a href='javascript:document.formModif".$fila['id_cliente'].".submit();' title='Modificar Cliente Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_cliente"]."' method='post' action='clientes_eliminar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila["id_cliente"]."'>
                            <a href='javascript:document.formElimi".$fila['id_cliente'].".submit();' title='Eliminar Cliente Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al cliente ".$fila["nombre"]." ".$fila["apellido"]." ?\"))'; location.href='cliente_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form> 
                  </td>
                </tr>";
            }
                echo"</table>
            </center>";
    } else {
        echo"<center><b> EL CLIENTE NO EXISTE!!</b></center><br>";
    }
}
?>
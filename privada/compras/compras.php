<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";


$sql = $db->Prepare("SELECT CONCAT_WS(' ', prove.nombre, prove.apellido, prove.telefono) AS proveedor, com.* 
                     FROM proveedores prove, compras com 
                     WHERE prove.id_proveedor = com.id_proveedor
                     AND prove.estado <> 'X' 
                     AND com.estado <> 'X' 
                     ORDER BY com.id_proveedor DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
        <h1>LISTADO DE COMPRAS</h1>
        <a  href='compras_nuevo.php'>Nuevo Compras>>>></a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>DATOS DEL PROVEEDOR</th><th>MONTO</th><th>FECHA_COMPRAS</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['proveedor']."</td>                        
                        <td>".$fila['monto']."</td>
                        <td>".$fila['fec_compra']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_compra"]."' method='post' action='compras_modificar.php'>
                            <input type='hidden' name='id_compra' value='".$fila['id_compra']."'>
                            <input type='hidden' name='id_proveedor' value='".$fila['id_compra']."'>
                            <a href='javascript:document.formModif".$fila['id_compra'].".submit();' title='Modificar Compras Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_compra"]."' method='post' action='compras_eliminar.php'>
                            <input type='hidden' name='id_compra' value='".$fila["id_compra"]."'>
                            <a href='javascript:document.formElimi".$fila['id_compra'].".submit();' title='Eliminar Compras Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar la compra del proveedor ".$fila["proveedor"]." ?\"))'; location.href='compras_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>
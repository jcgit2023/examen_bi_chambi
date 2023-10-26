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

$sql = $db->Prepare("SELECT CONCAT_WS(' ', tp.tipo_producto) AS informacion_producto, p.*
                     FROM tipo_productos tp, productos p
                     WHERE p.id_tipo_producto = tp.id_tipo_producto
                     AND p.estado <> 'X' 
                     AND tp.estado <> 'X'
                     ORDER BY p.id_tipo_producto DESC
                                     
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
        <h1>LISTADO DE PRODUCTOS</h1>
        <a  href='productos_nuevo.php'>Nuevo Producto>>>></a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>PRODUCTO</th><th>PRODUCTO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['informacion_producto']."</td>                        
                        <td>".$fila['nombre']."</td>

                        <td align='center'>
                          <form name='formModif".$fila["id_producto"]."' method='post' action='productos_modificar.php'>
                          <input type='hidden' name='id_producto' value='".$fila['id_producto']."'>
                          <input type='hidden' name='id_tipo_producto' value='".$fila['id_tipo_producto']."'>
                            <a href='javascript:document.formModif".$fila['id_producto'].".submit();' title='Modificar Producto Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_producto"]."' method='post' action='productos_eliminar.php'>
                            <input type='hidden' name='id_producto' value='".$fila["id_producto"]."'>
                            <a href='javascript:document.formElimi".$fila['id_producto'].".submit();' title='Eliminar Producto Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar el producto ".$fila["nombre"]." ?\"))'; location.href='productos_eliminar.php''> 
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
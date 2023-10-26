<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
$id_tipo_producto = $_POST["id_tipo_producto"];
$id_producto = $_POST["id_producto"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                    FROM productos
                    WHERE id_producto = ? 
                    AND estado = 'A'                       
                        ");
$rs = $db->GetAll($sql, array($id_producto));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,tipo_producto ) as producto, id_tipo_producto
                    FROM tipo_productos
                    WHERE id_tipo_producto = ? 
                    AND estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_tipo_producto));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,tipo_producto ) as producto, id_tipo_producto
                    FROM tipo_productos
                    WHERE id_tipo_producto <> ? 
                    AND estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_tipo_producto));
echo"<form action='productos_modificar1.php' method='post' name='formu'>";
    echo"<center>
    <h1>MODIFICAR PRODUCTOS</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)Producto</th>
                    <td>
                      <select name='id_tipo_producto'>";
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_tipo_producto']."'>".$fila['producto']."</option>"; 
                        }
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_tipo_producto']."'>".$fila['producto']."</option>";    
                        }

                echo"</select>
                    </td>
                  </tr>";
                  foreach ($rs as $k => $fila) {
                    echo"<tr>
                    <th><b>(*)Nombre de producto</b></th>
                    <td><input type='text' name='nombre' size='10' value='".$fila['nombre']."'></td>
                  </tr>
                  <tr>
                    <th><b>fecha vencimiento</b></th>
                    <td><input type='text' name='fec_venc' size='10'></td>
                  </tr>

                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR PRODUCTO'><br>
                      (*)Datos Obligatorios
                      <input type='hidden' name='id_producto' value='".$fila["id_producto"]."'>
                    </td>
                  </tr>";

                  }  
                    echo"</table>
                    </center>";
                echo"</form>" ; 
          /*}*/

echo "</body>
      </html> ";

 ?>
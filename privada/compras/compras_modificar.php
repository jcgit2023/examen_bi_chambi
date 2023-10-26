<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
$id_proveedor = $_POST["id_proveedor"];
$id_compra = $_POST["id_compra"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
       
$sql = $db->Prepare("SELECT *
                    FROM compras
                    WHERE id_compra = ? 
                    AND estado = 'A'                       
                        ");
$rs = $db->GetAll($sql, array($id_compra));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, apellido ) as proveedor, id_proveedor
                    FROM proveedores
                    WHERE id_proveedor = ? 
                    AND estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_proveedor));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, apellido ) as proveedor, id_proveedor
                    FROM proveedores
                    WHERE id_proveedor <> ? 
                    AND estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_proveedor));
echo"<form action='compras_modificar1.php' method='post' name='formu'>";
    echo"<center>
    <h1>MODIFICAR COMPRAS</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)Proveedor</th>
                    <td>
                      <select name='id_proveedor'>";
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_proveedor']."'>".$fila['proveedor']."</option>"; 
                        }
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_proveedor']."'>".$fila['proveedor']."</option>";    
                        }

                echo"</select>
                    </td>
                  </tr>";
                  foreach ($rs as $k => $fila) {
                    echo"<tr>
                    <th><b>Fecha de compra</b></th>
                    <td><input type='text' name='fec_compra' size='10'value='".$fila['fec_compra']."'></td>
                  </tr>
                  <tr>
                    <th><b>monto</b></th>
                    <td><input type='text' name='monto' size='10'></td>
                  </tr>
                
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR COMPRAS'><br>
                      (*)Datos Obligatorios
                      <input type='hidden' name='id_compra' value='".$fila["id_compra"]."'>
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
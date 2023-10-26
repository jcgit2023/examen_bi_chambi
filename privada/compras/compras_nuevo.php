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

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre,apellido) as Proveedores, id_proveedor
                     FROM proveedores
                     WHERE estado <> 'x'                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
    echo"<form action='compras_nuevo1.php' method='post' name='formu'>";
    echo"<center>
    <h1>INSERTAR COMPRAS</h1>
            <table class='listado'>
              <tr>
                <th>(*)Proveedores</th>
                <td>
                  <select name='id_proveedor'>
                    <option value=''>--Seleccione--</option>";
                    foreach ($rs as $k => $fila) {
                    echo"<option value='".$fila['id_proveedor']."'>".$fila['Proveedores']."</option>";    
                    }  

            echo"</select>
                </td>
              </tr>";
         echo"<tr>
                <th><b>(*)Monto de la compra</b></th>
                <td><input type='text' name='monto' size='10'></td>
              </tr>
              <tr>
                <th><b>(*)Fecha compra</b></th>
                <td><input type='text' name='fec_compra' size='10'></td>
              </tr>
              
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='ADICIONAR PRODUCTO'><br>
                  (*)Datos Obligatorios
                </td>
              </tr>
            </table>
            </center>";
      echo"</form>" ; 
    }

echo "</body>
      </html> ";

 ?>
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
       

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,tp.tipo_producto) as producto, id_tipo_producto
                     FROM tipo_productos tp
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='productos_nuevo1.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR PRODUCTO</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)Producto</th>
                    <td>
                      <select name='id_tipo_producto'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_tipo_producto']."'>".$fila['producto']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre de producto</b></th>
                    <td><input type='text' name='nombre' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Fecha vencimiento</b></th>
                    <td><input type='text' name='fec_venc' size='10'></td>
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
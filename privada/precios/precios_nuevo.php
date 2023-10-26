<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='precios.php'>Listado de Precios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>INSERTAR PRECIO</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,p.nombre) as producto, id_producto
                     FROM productos p
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='precios_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Producto</th>
                    <td>
                      <select name='id_producto'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_producto']."'>".$fila['producto']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Precio</b></th>
                    <td><input type='text' name='precio' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Fecha asignacion</b></th>
                    <td><input type='date' name='fec_asignacion' size='10'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR PRECIO'><br>
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
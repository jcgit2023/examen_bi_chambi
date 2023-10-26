<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
$id_producto = $_POST["id_producto"];
$id_precio = $_POST["id_precio"];
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
       echo"<h1>MODIFICAR PRECIO</h1>"; 

$sql = $db->Prepare("SELECT *
                    FROM precios
                    WHERE id_precio = ? 
                    AND estado = 'A'                       
                        ");
$rs = $db->GetAll($sql, array($id_precio));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre) as producto, id_producto
                    FROM productos
                    WHERE id_producto = ? 
                    AND estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_producto));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre) as producto, id_producto
                    FROM productos
                    WHERE id_producto <> ? 
                    AND estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_producto));
echo"<form action='precios_modificar1.php' method='post' name='formu'>";
    echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Producto</th>
                    <td>
                      <select name='id_producto'>";
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_producto']."'>".$fila['producto']."</option>"; 
                        }
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_producto']."'>".$fila['producto']."</option>";    
                        } 

                echo"</select>
                    </td>
                  </tr>";
                  foreach ($rs as $k => $fila) {
                    echo"
                    <tr>
                    <th><b>(*)Nuevo Precio</b></th>
                    <td><input type='text' name='precio' size='10' value='".$fila['precio']."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Fecha asignacion</b></th>
                    <td><input type='date' name='fec_asignacion' size='10' value='".$fila['fec_asignacion']."'></td>
                  </tr>

                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR PRECIO'><br>
                      (*)Datos Obligatorios
                      <input type='hidden' name='id_precio' value='".$fila["id_precio"]."'>
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
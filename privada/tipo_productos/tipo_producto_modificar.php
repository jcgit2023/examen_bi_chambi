<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_tipo_producto = $_POST["id_tipo_producto"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='tipo_productos.php'>Listado de Tipos Productos</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>MODIFICAR CLIENTES</h1>";       

$sql = $db->Prepare("SELECT *
                    FROM tipo_productos
                    WHERE id_tipo_producto = ? 
                    AND estado <>'X'                       
                        ");
$rs = $db->GetAll($sql, array($id_tipo_producto));
/*  if ($rs) {*/
  foreach($rs as $k => $fila){
    echo"<form action='tipo_producto_modificar1.php' method='post' name='formu'>";
    echo"<center>
            <table class='listado'>
              <tr>
                <th><b>Tipo producto</b></th>
                <td><input type='text' name='tipo_producto' size='10' onkeyup='this.value=this.value.toUpperCase()' value ='".$fila["tipo_producto"]."'></td>
              </tr>

                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR TIPO PRODUCTO'  >
                      <input type='hidden' name='id_tipo_producto' value='".$fila["id_tipo_producto"]."'>
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/
}
echo "</body>
      </html> ";

 ?>
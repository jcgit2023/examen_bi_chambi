<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='tipo_productos.php'>Listado de Productos</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
      echo"<h1>INSERTAR TIPO PRODUCTO</h1>";
$sql = $db->Prepare("SELECT *
                     FROM tipo_productos
                     WHERE estado <> 'X'
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='tipo_producto_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th><b>(*)tipo_producto</b></th>
                    <td><input type='text' name='tipo_producto' size='10'></td>
                  </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR TIPO_PRODUCTO'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    }

echo "</body>
      </html> ";

 ?>
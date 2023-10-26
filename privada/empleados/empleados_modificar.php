<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
$id_tienda = $_POST["id_tienda"];
$id_empleado = $_POST["id_empleado"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                    FROM empleados
                    WHERE id_empleado = ? 
                    AND estado = 'A'                       
                        ");
$rs = $db->GetAll($sql, array($id_empleado));

$sql1 = $db->Prepare("SELECT nombre, id_tienda
                    FROM mini_super
                    WHERE id_tienda = ? 
                    AND estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_tienda));

$sql2 = $db->Prepare("SELECT nombre, id_tienda
                    FROM mini_super
                    WHERE id_tienda <> ?
                    AND estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_tienda));
echo"<form action='empleados_modificar1.php' method='post' name='formu'>";
    echo"<center>
    <h1>MODIFICAR EMPLEADO</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)Nombre</th>
                    <td>
                      <select name='id_tienda'>";
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_tienda']."'>".$fila['nombre']."</option>"; 
                        }
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_tienda']."'>".$fila['nombre']."</option>";    
                        } 

                echo"</select>
                    </td>
                  </tr>";
                  foreach ($rs as $k => $fila) {
                    echo"<tr>
                    <th><b>(*)Nombre de empleado2</b></th>
                    <td><input type='text' name='nombre' size='10'value='".$fila['nombre']."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Apellido</b></th>
                    <td><input type='text' name='apellido' size='10'value='".$fila['apellido']."'></td>
                  </tr>
                  <tr>
                  <th><b>(*)Turno</b></th>
                  <td><input type='text' name='turno' size='10'value='".$fila['turno']."'></td>
                </tr>
                <tr>
                <th><b>(*)Ci</b></th>
                <td><input type='text' name='ci' size='10'value='".$fila['ci']."'></td>
              </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR EMPLEADO'><br>
                      (*)Datos Obligatorios
                      <input type='hidden' name='id_usuario' value='".$fila["id_empleado"]."'>
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
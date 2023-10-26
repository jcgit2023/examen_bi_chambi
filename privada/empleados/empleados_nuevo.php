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

$sql = $db->Prepare("SELECT CONCAT_WS(' ', ms.nombre) as empleado, id_tienda
                     FROM mini_super ms
                     WHERE estado <> 'X'                 
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='empleados_nuevo1.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR EMPLEADO</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)Tienda</th>
                    <td>
                      <select name='id_tienda'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_tienda']."'>".$fila['empleado']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre de empleado</b></th>
                    <td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Apellido</b></th>
                    <td><input type='text' name='apellido' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Turno</b></th>
                    <td><input type='text' name='turno' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)C.I.</b></th>
                    <td><input type='text' name='ci' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR EMPLEADO'><br>
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
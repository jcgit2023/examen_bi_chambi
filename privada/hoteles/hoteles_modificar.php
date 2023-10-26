<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


//$db->debug=true;
$id_cadena_agencia_viaje = $_POST["id_cadena_agencia_viaje"];
$id_hotel = $_POST["id_hotel"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                    FROM hoteles
                    WHERE id_hotel = ? 
                    AND id_hotel <> 0                       
                        ");
$rs = $db->GetAll($sql, array($id_hotel));

$sql1 = $db->Prepare("SELECT nombre, id_cadena_agencia_viaje
                    FROM cadena_agencia_viajes
                    WHERE id_cadena_agencia_viaje = ? 
                    AND id_cadena_agencia_viaje <> 0                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_cadena_agencia_viaje));

$sql2 = $db->Prepare("SELECT nombre, id_cadena_agencia_viaje
                    FROM cadena_agencia_viajes
                    WHERE id_cadena_agencia_viaje <> ? 
                    AND id_cadena_agencia_viaje <> 0                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_cadena_agencia_viaje));
echo"<form action='hoteles_modificar1.php' method='post' name='formu'>";
    echo"<center>
    <h1>MODIFICAR HOTEL</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)Agencia</th>
                    <td>
                      <select name='id_cadena_agencia_viaje'>";
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_cadena_agencia_viaje']."'>".$fila['nombre']."</option>"; 
                        }
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_cadena_agencia_viaje']."'>".$fila['nombre']."</option>";    
                        } 

                echo"</select>
                    </td>
                  </tr>";
                  foreach ($rs as $k => $fila) {
                    echo"<tr>
                    <th><b>(*)Codigo</b></th>
                    <td><input type='text' name='codigo' size='10' value='".$fila["codigo"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Nombre</b></th>
                    <td><input type='text' name='nombre' size='10' value='".$fila["nombre"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Telefonos</b></th>
                    <td><input type='text' name='telefonos' size='10' value='".$fila["telefonos"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Numero Habitaciones Disponibles</b></th>
                    <td><input type='text' name='nro_plazas_disponibles' size='10' value='".$fila["nro_plazas_disponibles"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Ciudad</b></th>
                    <td><input type='text' name='ciudad' size='10' value='".$fila["ciudad"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Direccion</b></th>
                    <td><input type='text' name='direccion' size='10' value='".$fila["direccion"]."'></td>
                  </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR HOTEL'><br>
                      (*)Datos Obligatorios
                      <input type='hidden' name='id_hotel' value='".$fila["id_hotel"]."'>
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
<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

$id_persona = '{$_POST["id_persona"]}';
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT nombre, id_cadena_agencia_viaje
                     FROM cadena_agencia_viajes
                     WHERE id_cadena_agencia_viaje <> 0                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='hoteles_nuevo1.php' method='POST' name='formu'>";
        echo"<center>
        <h1>INSERTAR HOTEL</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)AGENCIA</th>
                    <td>
                      <select name='id_cadena_agencia_viaje'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_cadena_agencia_viaje']."'>".$fila['nombre']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Codigo</b></th>
                    <td><input type='text' name='codigo' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Nombre</b></th>
                    <td><input type='text' name='nombre' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Telefonos</b></th>
                    <td><input type='text' name='telefonos' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Numero Habitaciones Disponibles</b></th>
                    <td><input type='text' name='nro_plazas_disponibles' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Ciudad</b></th>
                    <td><input type='text' name='ciudad' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Direccion</b></th>
                    <td><input type='text' name='direccion' size='10'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR HOTEL'><br>
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
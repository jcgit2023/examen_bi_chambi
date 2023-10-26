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
       <a  href='cadena_agencia_hoteles.php'>Listado de Cadena Agencias Viajes</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>INSERTAR CADENA AGENCIA HOTELES</h1>";

$sql = $db->Prepare("SELECT *
                     FROM cadena_agencia_viajes
                     WHERE id_cadena_agencia_viaje <> 0                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='cadena_agencia_viajes_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th><b>(*)Nombre</b></th>
                    <td><input type='text' name='nombre' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th>
                    <td><input type='text' name='telefonos' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>Pag_web</b></th>
                    <td><input type='text' name='pag_web' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>                    
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR CADENA AGENCIA HOTELES'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    }

echo "</body>
      </html> ";

 ?>
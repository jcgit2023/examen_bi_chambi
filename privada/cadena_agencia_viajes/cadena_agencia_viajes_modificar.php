<?php
session_start();
require_once("../../conexion.php");

$id_cadena_agencia_viaje = $_POST["id_cadena_agencia_viaje"];

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='personas.php'>Listado de Personas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>MODIFICAR PERSONA</h1>";

$sql = $db->prepare("SELECT *
                     FROM cadena_agencia_viajes
                     WHERE id_cadena_agencia_viaje = ?
                     AND id_cadena_agencia_viaje <> 0
                        ");
$rs = $db->GetAll($sql, array($id_cadena_agencia_viaje));

foreach ($rs as $k => $fila){
    echo"<form action='cadena_agencia_viajes_modificar1.php' method='post' name='formu'>";
    echo"<center>
            <table class='listado'>
              <tr>
                <th><b>(*)Nombre</b></th>
                <td><input type='text' name='nombre' size='10' value='".$fila["nombre"]."'></td>
              </tr>
              <tr>
                <th><b>Telefonos</b></th>
                <td><input type='text' name='telefonos' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["telefonos"]."'></td>
              </tr>
              <tr>
                <th><b>Pagina Web</b></th>
                <td><input type='text' name='pag_web' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["pag_web"]."'>
                </td>                    
              </tr>
              
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR CADENA AGENCIA VIAJE'  >
                  <input type='hidden' name='id_cadena_agencia_viaje' value='".$fila["id_cadena_agencia_viaje"]."'
                </td>
              </tr>
            </table>
            </center>";
      echo"</form>" ;     
}
echo "</body>
      </html> ";
      
?>
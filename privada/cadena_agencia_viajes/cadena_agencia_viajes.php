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

$sql = $db->Prepare("SELECT *
                     FROM cadena_agencia_viajes
                     WHERE id_cadena_agencia_viaje <> '0' 
                     ORDER BY id_cadena_agencia_viaje DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
        <h1>LISTADO DE CADENA AGENCIA VIAJES</h1>
        <a  href='cadena_agencia_viajes_nuevo.php'>Nueva Cadena Agencia Viaje>>>></a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE</th><th>TELEFONO</th><th>PAGINA WEB</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['telefonos']."</td>
                        <td>".$fila['pag_web']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_cadena_agencia_viaje"]."' method='post' action='cadena_agencia_viajes_modificar.php'>
                            <input type='hidden' name='id_cadena_agencia_viaje' value='".$fila['id_cadena_agencia_viaje']."'>
                            <a href='javascript:document.formModif".$fila['id_cadena_agencia_viaje'].".submit();' title='Modificar Cadena Agencia Viaje Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_cadena_agencia_viaje"]."' method='post' action='cadena_agencia_viajes_eliminar.php'>
                            <input type='hidden' name='id_cadena_agencia_viaje' value='".$fila["id_cadena_agencia_viaje"]."'>
                            <a href='javascript:document.formElimi".$fila['id_cadena_agencia_viaje'].".submit();'
                             title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la Cadena Agencia Viaje ".$fila["nombre"]." ?\"))'; location.href='cadena_agencia_viajes_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>
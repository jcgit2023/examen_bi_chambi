<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
require_once("../../paginacion.inc.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

       echo"<div id='hoteles1'>";

contarRegistros($db, "hoteles");

paginacion("hoteles.php?");

$sql = $db->Prepare("SELECT ho.codigo,ho.nombre as nombre_hotel,ho.telefonos as tel_hotel,ho.nro_plazas_disponibles,ho.ciudad,ho.direccion,ca_ag.nombre as nombre_agencia ,ca_ag.*,ho.id_hotel
                     FROM cadena_agencia_viajes ca_ag
                     INNER JOIN hoteles ho ON ca_ag.id_cadena_agencia_viaje=ho.id_cadena_agencia_viaje
                     ORDER BY ca_ag.id_cadena_agencia_viaje DESC                      
                     LIMIT ? OFFSET ?
            ")  ;
$rs = $db->GetAll($sql, array($nElem, $regIni));
   if ($rs) {
        echo"<center>
        <h1>LISTADO DE HOTELES</h1>
        <a  href='hoteles_nuevo.php'>Nuevo Hotel>>>></a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>CODIGO</th><th>NOMBRE</th><th>TELEFONO</th><th>PLAZAS <br>DISPONIBLES</th><th>CIUDAD</th><th>DIRECCION</th><th>NOMBRE AGENCIA</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total=$pag-1;
                $a=$nElem*$total;
                $b=$b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['codigo']."</td>                        
                        <td>".$fila['nombre_hotel']."</td>
                        <td>".$fila['tel_hotel']."</td>
                        <td>".$fila['nro_plazas_disponibles']."</td>
                        <td>".$fila['ciudad']."</td>
                        <td>".$fila['direccion']."</td>
                        <td>".$fila['nombre_agencia']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_hotel"]."' method='post' action='hoteles_modificar.php'>
                            <input type='hidden' name='id_hotel' value='".$fila['id_hotel']."'>
                            <input type='hidden' name='id_cadena_agencia_viaje' value='".$fila['id_cadena_agencia_viaje']."'>
                            <a href='javascript:document.formModif".$fila['id_hotel'].".submit();' title='Modificar Hoteles Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_hotel"]."' method='post' action='hoteles_eliminar.php'>
                            <input type='hidden' name='id_hotel' value='".$fila["id_hotel"]."'>
                            <a href='javascript:document.formElimi".$fila['id_hotel'].".submit();' title='Eliminar Hotel Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al hotel ".$fila["nombre_hotel"]." ?\"))'; location.href='persona_eliminar.php''> 
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
    echo"</div>";
    echo"<!---PAGINACION----------------->";
    echo"<table border='0' align='center'>
        <tr>
          <td>";
            if(!empty($urlback)){
              echo"<a href=".$urlback." style='font-family: Verdana;font-size: 9px;cursor:pointer'; >&laquo;Anterior</a>";
            }
            if(!empty($paginas)){
              foreach($paginas as $k => $pagg) {
                if($pagg["npag"]==$pag) {
                  if($pag !='1'){
                  echo"|";
                }
                echo"<b style='color:#FB992F;font-size: 12px;'>";
              } else
                echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>";echo $pagg["npag"]; echo"</a>";
            }
          }
          if(($nPags > $nBotones) and (!empty($urlnext)) and ($pag < $nPags)){
            echo"  |<a href=".$urlnext." style='font-family: Verdana;font-size: 9px;cursor:pointer'>Siguiente&raquo;</a>";
          }
          echo"</td>
            </tr>
          </table>";
    echo"<!-----PAGINACION------------->";

echo "</body>
      </html> ";

 ?>
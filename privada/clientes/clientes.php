<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=uft-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_cliente.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>";

      echo"
      <!-----------  INICIO BUSCADOR  ----------->
          <center>
          <h1>LISTADO DE CLIENTES</h1>
          <a  href='clientes_nuevo.php'>Nuevo Cliente>>>></a>
          <form action='#'' method='post' name='formu'>
          <table border='1' class='listado'>
            <tr>
              <th>
               <b>Nombre</b><br />
               <input type='text' name='nombre' value='' size='10' onKeyUp='buscar_clientes()'>
              </th>
              <th>
                <b>Apellido</b><br />
                <input type='text' name='apellido' value='' size='10' onKeyUp='buscar_clientes()'>
              </th>
              <th>
                <b>Telefono</b><br />
                <input type='text' name='telefono' value='' size='10' onKeyUp='buscar_clientes()'>
              </th>
               
            </tr>
           </table>
       </form>
       </center>
<!---------- FIN BUSCADOR ---------->";
      
echo"<div id='clientes1'>";

contarRegistros($db, "clientes");

paginacion("clientes.php?");


/*$sql = $db->Prepare("SELECT *
                     FROM clientes
                     WHERE estado <> 'X' 
                     ORDER BY id_cliente DESC                      
                        ");
$rs = $db->GetAll($sql);*/

$sql3 = $db->Prepare("SELECT *
                    FROM clientes
                    WHERE estado <> 'X'
                    AND id_cliente>1
                    ORDER BY id_cliente DESC
                    LIMIT ? OFFSET ?
            ")  ;
$rs = $db->GetAll($sql3, array($nElem, $regIni));

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE</th><th>APELLIDO</th><th>TELEFONO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total=$pag-1;
                $a=$nElem*$total;
                $b=$b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre']."</td>
                        <td>".$fila['apellido']."</td>
                        <td>".$fila['telefono']."</td>
                        
                        <td align='center'>
                          <form name='formModif".$fila["id_cliente"]."' method='post' action='clientes_modificar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila['id_cliente']."'>
                            <a href='javascript:document.formModif".$fila['id_cliente'].".submit();' title='Modificar Cliente Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_cliente"]."' method='post' action='clientes_eliminar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila["id_cliente"]."'>
                            <a href='javascript:document.formElimi".$fila['id_cliente'].".submit();' title='Eliminar Cliente Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al cliente ".$fila["nombre"]." ".$fila["apellido"]." ?\"))'; location.href='cliente_eliminar.php''> 
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
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
$sql = $db->Prepare("SELECT CONCAT_WS(' ', em.nombre, em.apellido) AS empleado,em.turno, ms.*,em.id_empleado 
                     FROM empleados em, mini_super ms
                     WHERE em.id_tienda = ms.id_tienda
                     AND em.estado <> 'X' 
                     AND ms.estado <> 'X' 
                     ORDER BY ms.id_tienda DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
        <h1>LISTADO DE EMPLEADOS</h1>
        <a  href='empleados_nuevo.php'>Nuevo Empleado>>>></a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>EMPLEADO</th><th>TURNO</th><th>NOMBRE TIENDA</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['empleado']."</td> 
                        <td>".$fila['turno']."</td>                        
                        <td>".$fila['nombre']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_empleado"]."' method='post' action='empleados_modificar.php'>
                            <input type='hidden' name='id_empleado' value='".$fila['id_empleado']."'>
                            <input type='hidden' name='id_tienda' value='".$fila['id_tienda']."'>
                            <a href='javascript:document.formModif".$fila['id_empleado'].".submit();' title='Modificar Empleado Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_empleado"]."' method='post' action='empleados_eliminar.php'>
                            <input type='hidden' name='id_empleado' value='".$fila["id_empleado"]."'>
                            <a href='javascript:document.formElimi".$fila['id_empleado'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al Empleado ".$fila["empleado"]." ?\"))'; location.href='persona_eliminar.php''> 
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
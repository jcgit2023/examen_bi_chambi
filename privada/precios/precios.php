<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='precios_nuevo.php'>Nuevo Precio</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>LISTADO DE PRECIOS</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ',pro.nombre) AS producto, pre.* 
                     FROM productos pro, precios pre
                     WHERE pro.id_producto = pre.id_producto
                     AND pro.estado <> 'X' 
                     AND pre.estado <> 'X' 
                     ORDER BY pre.id_producto DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>producto</th><th>precio</th><th>Fecha asignacion</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['producto']."</td>                        
                        <td>".$fila['precio']."</td>
                        <td>".$fila['fec_asignacion']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_precio"]."' method='post' action='precios_modificar.php'>
                            <input type='hidden' name='id_precio' value='".$fila['id_precio']."'>
                            <input type='hidden' name='id_producto' value='".$fila['id_producto']."'>
                            <a href='javascript:document.formModif".$fila['id_precio'].".submit();' title='Modificar Precio Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_precio"]."' method='post' action='precios_eliminar.php'>
                            <input type='hidden' name='id_precio' value='".$fila["id_precio"]."'>
                            <a href='javascript:document.formElimi".$fila['id_precio'].".submit();' title='Eliminar Usuario Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar el precio ".$fila["precio"]." ?\"))'; location.href='precios_eliminar.php''> 
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
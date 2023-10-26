<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
echo"<html>
        <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
             <script type='text/javascript'>
            var ventanaCalendario=false
                function imprimir() {
                    ventanaCalendario = window.open('reporte_almacen1.php' , 'calendario', 'width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
                }
            </script>
            <script type='text/javascript'>
            var ventanaCalendario=false
                function generar_pdf() {
                    ventanaCalendario = window.open('reporte_almacen_pdf.php' , 'calendario', 'width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
                }
            </script>
        </head>
            <body>
            <p> &nbsp;</p>";

$sql =$db->Prepare("SELECT tp.tipo_producto,pr.nombre,al.cantidad
FROM almacen al
INNER JOIN productos pr ON al.id_producto=pr.id_producto
INNER JOIN tipo_productos tp ON tp.id_tipo_producto=pr.id_tipo_producto
WHERE al.estado <> 'X'
AND pr.estado <> 'X'
AND tp.estado <> 'X'
                    ");
$rs = $db->GetAll($sql);
if ($rs) {
    echo"<center>
    <h1>REPORTE DE ALMACEN Y PRODUCTOS</h1>
          <table class='listado'>
            <tr>                                   
            <th>Nro</th><th>PRODUCTO</th><th>TIPO PRODUCTO</th><th>CANTIDAD</th>
            </tr>";
            $b=1;
        foreach ($rs as $k => $fila) {                                       
            echo"<tr>
                    <td align='center'>".$b."</td>

                    <td>".$fila['nombre']."</td>
                    <td>".$fila['tipo_producto']."</td>
                    <td>".$fila['cantidad']."</td>
                 </tr>";
                 $b=$b+1;
        }
         echo"</table>
         <h2>
            <input type='radio' name='seleccionar' onclick='javascript:imprimir()''>Imprimir
         </h2>
         <h2>
            <input type='radio' name='seleccionar' onclick='javascript:generar_pdf()''>Generar pdf
         </h2>
      </center>";
    }
echo "</body>
        </html> ";

?>
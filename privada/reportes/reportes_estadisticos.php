<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
echo"<html>
        <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <script type='text/javascript'>
            var ventanaCalendario=false
                function reporte1() {
                    ventanaCalendario = window.open('Highcharts/examples/line-basic/index.php' , 'calendario', 'width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
                }
            </script>
            <script type='text/javascript'>
            var ventanaCalendario=false
                function reporte2() {
                    ventanaCalendario = window.open('Highcharts/examples/3d-pie/index.php' , 'calendario', 'width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
                }
            </script>
            </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;
       ' class='boton_cerrar'></a>";
      echo"<h1>REPORTES ESTADISTICOS GRAFICOS</h1>";

      echo"<center>
      <table class='listado'>
        <tr> 
            <th>Seleccione el reporte Estadistico</th>
        </tr>";

        echo"<tr>
                <td>
                    <input type='radio' name='seleccionar' onclick='javascript:reporte1()'>Reporte 1: LINEAS BÁSICAS
                </td>
            </tr>
            <tr>
                <td>
                    <input type='radio' name='seleccionar' onclick='javascript:reporte2()'>Reporte 2: TORTA 3D
                </td>
             </tr>";
            
        echo"</table>
    </center>";
echo "</body>
      </html>";
?>
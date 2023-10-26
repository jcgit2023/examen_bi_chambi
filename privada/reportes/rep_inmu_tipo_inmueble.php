<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>

            <script type= 'text/javascript'>
            function validar() {
                tipo_inmueble =document.formu.tipo_inmueble.value;
                if (document.formu.tipo_inmueble.value== ''){
                    alert('Seleccione el tipo_inmueble');
                    document.formu.tipo_inmueble.focus();
                    return;
                }
                ventanaCalendario=window.open('rep_inmu_tipo_inmueble1.php?tipo_inmueble=' + tipo_inmueble , 'calendario', 'width=600, heigth=550, left=100, top=100,scrollbars=yes,menubars=no, statusbar=NO,status=NO,resizable=YES,location=NO')
            }
        </script>
    </head>
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class='boton_cerrar'></a>
        
        <h1>REPORTE DE INMUEBLES POR TIPO DE INMUEBLE</h1>";
        $sql = $db->Prepare("SELECT CONCAT_WS (' ',ubicacion, tipo_inmueble) AS elegido, tipo_inmueble
                     FROM tipos_inmuebles
                     WHERE id_tipo_inmueble <> 0                        
                        ");
        $rs = $db->GetAll($sql);
            echo"<form method='post' name='formu'>";
                echo "<center>
                    <table border='1'>
                        <tr>
                            <th><h3>*Seleccione Tipos Inmuebles</th><th>:</th>
                            <td>
                  <select name='tipo_inmueble'>
                    <option value=''>--Seleccione--</option>
                    <option value='T'>Todos</option>";
                    foreach ($rs as $k => $fila) {
                    echo"<option value='".$fila['tipo_inmueble']."'>".$fila['elegido']."</option>";    
                    }  

            echo"</select>
                </td>
                        </tr>
                        <tr>
                            <td aling='center' colspan='6'>
                                <input type='hidden' name='accion' value=''>
                                <input type='button' value='Aceptar' onclick='validar();'' class='boton2'>
                            </td>
                        </tr>
                    </table>
                    </form>
                    </center>";

        echo "</body>
            </html>";

?>

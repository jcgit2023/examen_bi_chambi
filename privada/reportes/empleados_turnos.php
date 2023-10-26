<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>

            <script type= 'text/javascript'>
            function validar() {
                turno =document.formu.turno.value;
                if (document.formu.turno.value== ''){
                    alert('Seleccione el turno');
                    document.formu.turno.focus();
                    return;
                }
                ventanaCalendario=window.open('empleados_turnos1.php?turno=' + turno , 'calendario', 'width=600, heigth=550, left=100, top=100,scrollbars=yes,menubars=no, statusbar=NO,status=NO,resizable=YES,location=NO')
            }
        </script>
    </head>
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class='boton_cerrar'></a>
        
        <h1>REPORTE DE EMPLEADOS POR TURNOS</h1>";
        $sql = $db->Prepare("SELECT turno, id_empleado
                     FROM empleados
                     WHERE estado <> 'x'                        
                        ");
        $rs = $db->GetAll($sql);
            echo"<form method='post' name='formu'>";
                echo "<center>
                    <table border='1'>
                        <tr>
                            <th><h3>*Seleccione turno</th><th>:</th>
                            <td>
                  <select name='turno'>
                    <option value=''>--Seleccione--</option>
                    <option value='T'>Todos</option>";
                    foreach ($rs as $k => $fila) {
                    echo"<option value='".$fila['turno']."'>".$fila['turno']."</option>";    
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

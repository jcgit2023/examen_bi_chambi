<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>

            <script type= 'text/javascript'>
            function validar() {
                nomb_esp =document.formu.nomb_esp.value;
                if (document.formu.nomb_esp.value== ''){
                    alert('Seleccione el nomb_esp');
                    document.formu.nomb_esp.focus();
                    return;
                }
                ventanaCalendario=window.open('rtp_prueba_especialidad1.php?nomb_esp=' + nomb_esp , 'calendario', 'width=600, heigth=550, left=100, top=100,scrollbars=yes,menubars=no, statusbar=NO,status=NO,resizable=YES,location=NO')
            }
        </script>
    </head>
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class='boton_cerrar'></a>
        
        <h1>REPORTE DE PRUEBAS POR ESPECIALIDAD</h1>";
        $sql = $db->Prepare("SELECT CONCAT_WS (' ',nomb_esp, tipo_pista) AS seleccionado, nomb_esp
                     FROM especialidades                      
                        ");
        $rs = $db->GetAll($sql);
            echo"<form method='post' name='formu'>";
                echo "<center>
                    <table border='1'>
                        <tr>
                            <th><h3>*Seleccione Especialidad</th><th>:</th>
                            <td>
                  <select name='nomb_esp'>
                    <option value=''>--Seleccione--</option>
                    <option value='T'>TODOS</option>";
                    foreach ($rs as $k => $fila) {
                    echo"<option value='".$fila['nomb_esp']."'>".$fila['seleccionado']."</option>";    
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

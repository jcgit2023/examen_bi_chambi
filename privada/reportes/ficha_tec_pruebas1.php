<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

$id_prueba = $_REQUEST["id_prueba"];

$sql = $db->Prepare("SELECT esp.*,pr.*,CONCAT_WS('-',esp.nomb_esp,esp.tipo_pista) AS especialidad
                    FROM especialidades esp
                    INNER JOIN pruebas pr ON esp.id_especialidad=pr.id_especialidad
                    WHERE id_prueba = ?
                    ");
$rs = $db->GetAll($sql, array($id_prueba));

$sql1 = $db->Prepare("SELECT *
		 			FROM mini_super		 							 					
                    WHERE id_tienda=1
					AND estado = 'A'
					");
$rs1 = $db->GetAll($sql1);

$nombre =$rs1[0]["nombre"];
$logo =$rs1[0]["logo"];

echo"<html>
        <head>
             <script type='text/javascript'>
            var ventanaCalendario=false
                function imprimir() {
                    if (confirm(' Desea Imprimir ?')){
                        window.print();
                    }
                }
            </script>
        </head>
            <body style='cursor:hand' onClick='imprimir();'>";
            if($rs){
                echo"<table width='100%' border='0'>
                <tr>
                    <td><img src='../mini_super/logos/{$logo}' width='70%'></td>
                    <td align='center'  width='80%'><h1>FICHA TECNICA DE PRUEBA</h1></td>
                    </tr>
                    </table>";
            echo"
            <center>
              <table border='1' cellspacing='0'>";
              $b=1;
              foreach ($rs as $k => $fila) {
            echo"
                 <tr>
                    <th aling='right'>Nombre Prueba</th><th>;</th>
                    <td><input type='text' name='nomb_pru' value='".$fila['nomb_pru']."' disabled='' size='35'> </td>
                 </tr>
                 <tr>
                    <th aling='right'>tiempo duracion maxima</th><th>;</th>
                    <td><input type='text' name='tiempo_duracion_max' value='".$fila['tiempo_duracion_max']."' disabled='' size='35'> </td>
                 </tr>
                 <tr>
                    <th aling='right'>Numero tiempo duracion minima</th><th>;</th>
                    <td><input type='text' name='tiempo_duracion_min' value='".$fila['tiempo_duracion_min']."' disabled='' size='35'> </td>
                 </tr>
                 <tr>
                    <th aling='right'>especialidad</th><th>;</th>
                    <td><input type='text' name='nomb_esp' value='".$fila['especialidad']."' disabled='' size='35'> </td>
                </tr>
                    </table>";
                    $b=$b+1;
                }
            }
        echo"</body>
        </html> ";
        ?>

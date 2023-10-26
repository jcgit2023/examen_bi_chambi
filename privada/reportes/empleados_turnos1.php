<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

$turno = $_REQUEST["turno"];
$fecha = DATE("Y-m-d H:i:s");

if($turno == "T"){
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',nombre,apellido) as empleado, turno
                    FROM empleados		 					
                    WHERE estado = 'A'
                    ");
$rs = $db->GetAll($sql);
}else {
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',nombre,apellido) as empleado, turno
    FROM empleados
    WHERE turno=?		 					
    AND estado = 'A'
    ");
    $rs = $db->GetAll($sql, array($turno));
}

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
            function imprimir(){
                if(confirm(' Desea imprimir ?')){
                    window.print();
                }
            }
           </script>
           </head>
           <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

            if ($rs){
                echo"<table width='100%' border='0'>
                <tr>
                    <td><img src='../mini_super/logos/{$logo}' width='70%'></td>
                    <td align='center'  width='80%'><h1>REPORTES DE EMPLEADOS POR TURNO</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                        <th>Nro</th><th>EMPLEADO</th><th>TURNO</th>
                    </tr>";
                    $b=1;
                    foreach($rs as $k => $fila){
                        echo"<tr>
                            <td aling='center'>".$b."</td>
                            <td>".$fila['empleado']."</td>
                            <td><i>".$fila['turno']."</i></td>
                        </tr>";
                        $b=$b+1;
                    }
                    echo"<table><br>
                    <b>Fecha :</b>".$fecha."</b></center>";

            }
            echo"</body>
            </html>";

?>
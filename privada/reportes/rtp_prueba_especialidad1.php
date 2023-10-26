<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$nomb_esp = $_REQUEST["nomb_esp"];
$fecha = DATE("Y-m-d H:i:s");

if($nomb_esp == "T"){
    $sql = $db->Prepare("SELECT pr.nomb_pru,pr.tiempo_duracion_max,pr.tiempo_duracion_min,CONCAT_WS('-',esp.nomb_esp,esp.tipo_pista) AS especialidad
                    FROM especialidades esp
                    INNER JOIN pruebas pr ON esp.id_especialidad=pr.id_especialidad	 					
                    ");
$rs = $db->GetAll($sql);
}else {
    $sql = $db->Prepare("SELECT pr.nomb_pru,pr.tiempo_duracion_max,pr.tiempo_duracion_min,CONCAT_WS('-',esp.nomb_esp,esp.tipo_pista) AS especialidad
    FROM especialidades esp
    INNER JOIN pruebas pr ON esp.id_especialidad=pr.id_especialidad
    WHERE esp.nomb_esp=?
    ");
    $rs = $db->GetAll($sql, array($nomb_esp));
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
                    <td align='center'  width='80%'><h1>REPORTES DE PRUEBAS POR ESPECIALIDAD</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                        <th>Nro</th><th>NOM PRUEBA</th><th>TIEMPO MAXIMO</th><th>TIEMPO MINIMO</th><th>ESPECIALIDAD</th>
                    </tr>";
                    $b=1;
                    foreach($rs as $k => $fila){
                        echo"<tr>
                            <td aling='center'>".$b."</td>
                            <td>".$fila['nomb_pru']."</td>
                            <td>".$fila['tiempo_duracion_max']."</td>
                            <td>".$fila['tiempo_duracion_min']."</td>
                            <td><i>".$fila['especialidad']."</i></td>
                        </tr>";
                        $b=$b+1;
                    }
                    echo"<table><br>
                    <b>Fecha :</b>".$fecha."</b></center>";

            }
            echo"</body>
            </html>";

?>
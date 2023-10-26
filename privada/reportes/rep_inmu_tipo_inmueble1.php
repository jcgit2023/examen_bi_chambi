<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$tipo_inmueble = $_REQUEST["tipo_inmueble"];
$fecha = DATE("Y-m-d H:i:s");

if($tipo_inmueble == "T"){
    $sql = $db->Prepare("SELECT inmu.material,inmu.superficie,inmu.numero_dormitorios,inmu.precio,inmu.descripcion, CONCAT_WS(' ',t_inmu.ubicacion,t_inmu.tipo_inmueble) AS Tipo_Inmueble
                    FROM tipos_inmuebles t_inmu
                    INNER JOIN inmuebles inmu ON t_inmu.id_tipo_inmueble=inmu.id_tipo_inmueble	 					
                    WHERE t_inmu.id_tipo_inmueble<>0
                    AND inmu.id_inmueble<>0
                    ");
$rs = $db->GetAll($sql);
}else {
    $sql = $db->Prepare("SELECT inmu.material,inmu.superficie,inmu.numero_dormitorios,inmu.precio,inmu.descripcion, CONCAT_WS(' ',t_inmu.ubicacion,t_inmu.tipo_inmueble) AS Tipo_Inmueble
    FROM tipos_inmuebles t_inmu
    INNER JOIN inmuebles inmu ON t_inmu.id_tipo_inmueble=inmu.id_tipo_inmueble	 					
    WHERE tipo_inmueble=?
    AND t_inmu.id_tipo_inmueble<>0
    AND inmu.id_inmueble<>0
    ");
    $rs = $db->GetAll($sql, array($tipo_inmueble));
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
                    <td align='center'  width='80%'><h1>REPORTES DE INMUEBLES POR TIPO DE INMUEBLE</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                        <th>Nro</th><th>MATERIAL</th><th>SUPERFICIE</th><th>NRO_DORMITORIOS</th><th>PRECIO</th><th>DESCRIPCION</th><th>TIPO INMUEBLE</th>
                    </tr>";
                    $b=1;
                    foreach($rs as $k => $fila){
                        echo"<tr>
                            <td aling='center'>".$b."</td>
                            <td>".$fila['material']."</td>
                            <td>".$fila['superficie']."</td>
                            <td>".$fila['numero_dormitorios']."</td>
                            <td>".$fila['precio']."</td>
                            <td>".$fila['descripcion']."</td>
                            <td><i>".$fila['Tipo_Inmueble']."</i></td>
                        </tr>";
                        $b=$b+1;
                    }
                    echo"<table><br>
                    <b>Fecha :</b>".$fecha."</b></center>";

            }
            echo"</body>
            </html>";

?>
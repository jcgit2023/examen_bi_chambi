<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Highcharts Example</title>

		<style type="text/css">
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
	</head>
	<body>
<script src="../../code/highcharts.js"></script>
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>
<script src="../../code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        A basic column chart comparing emissions by pollutant.
        Oil and gas extraction has the overall highest amount of
        emissions, followed by manufacturing industries and mining.
        The chart is making use of the axis crosshair feature, to highlight
        years as they are hovered over.
    </p>
</figure>



		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Reporte Grafico'
    },
    subtitle: {
        text: 'elaborado por: jorge chambi'
    },
    xAxis: {
        categories: [
            <?php
            $sql = $db->Prepare("SELECT fec_venta, monto
            FROM ventas
            WHERE estado <> 'X'");
            $rs=$db->GetAll($sql);
            foreach($rs as $k => $fila)
            {
            ?>
                '<?php echo $fila["monto"];?>',
                <?php    
            }
            ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'ventas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Tokyo',
        data: [<?php
            $sql = $db->Prepare("SELECT fec_venta, monto
            FROM ventas
            WHERE estado <> 'X'");
            $rs=$db->GetAll($sql);
            foreach($rs as $k => $fila)
            {
            ?>
                '<?php echo $fila["fec_venta"];?>',
                <?php    
            }
            ?>]

    }/*, {
        name: 'New York',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5,
            106.6, 92.3]

    }, {
        name: 'London',
        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3,
            51.2]

    }, {
        name: 'Berlin',
        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8,
            51.1]

    }*/]
});
		</script>
	</body>
</html>

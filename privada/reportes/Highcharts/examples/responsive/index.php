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

#button-bar {
    min-width: 310px;
    max-width: 800px;
    margin: 0 auto;
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
        This demo shows how breakpoints can be defined in order to
        change the chart options depending on the screen width. All
        charts automatically scale to the container size, but in this
        case we also change the positioning of the legend and axis
        elements to accomodate smaller screens.
    </p>
</figure>

<div id="button-bar">
    <button id="small">Small</button>
    <button id="large">Large</button>
    <button id="auto">Auto</button>
</div>


		<script type="text/javascript">
// Data retrieved from https://www.ssb.no/statbank/table/10467/
var chart = Highcharts.chart('container', {

    chart: {
        type: 'column'
    },

    title: {
        text: 'Born persons, by girls\' name'
    },

    subtitle: {
        text: 'Resize the frame or click buttons to change appearance'
    },

    legend: {
        align: 'right',
        verticalAlign: 'middle',
        layout: 'vertical'
    },

    xAxis: {
        categories: [/*'2019', '2020', '2021'*/
        <?php
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
            ?>
        ],
        labels: {
            x: -10
        }
    },

    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Amount'
        }
    },

    series: [{
        name: 'monto',
        data: [/*38, 51, 34*/
            <?php
            $sql = $db->Prepare("SELECT fec_venta, monto
            FROM ventas
            WHERE estado <> 'X'");
            $rs=$db->GetAll($sql);
            foreach($rs as $k => $fila)
            {
            ?>
                <?php echo $fila["monto"];?>,
                <?php    
            }
            ?>
            ]
    }/*, {
        name: 'Dina',
        data: [31, 26, 27]
    }, {
        name: 'Malin',
        data: [38, 42, 41]
    }*/],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }
});

document.getElementById('small').addEventListener('click', function () {
    chart.setSize(400);
});

document.getElementById('large').addEventListener('click', function () {
    chart.setSize(600);
});

document.getElementById('auto').addEventListener('click', function () {
    chart.setSize(null);
});

		</script>
	</body>
</html>

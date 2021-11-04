<div id="graficoRelatorio" style="width:100%;height:100%;"></div>
<script type="text/javascript">

if('<?php echo $modelo_grafico->modelo_grafico;?>' == 1) {
    // GRÁFICO PIE (PIZZA)
    var graficoPie = AmCharts.makeChart("graficoRelatorio", {
        "type": "pie",
        "dataProvider": [ 
        {
            "status": "Aberto",
            "value": <?php echo $info_grafico_aberto; ?>,
            "color": "#F78181"
        },
        {
            "status": "Em análise",
            "value": <?php echo $info_grafico_analise; ?>,
            "color": "#A9D0F5"
        },
        {
            "status": "Concluído",
            "value": <?php echo $info_grafico_concluido; ?>,
            "color": "#CEF6CE"
        },
        {
            "status": "Cancelado",
            "value": <?php echo $info_grafico_cancelado; ?>,
            "color": "#F3E2A9"
        }
        ],
        "titleField": "status",
        "valueField": "value",
        "outlineColor": "#FFFFFF",
        "colorField": "color",
        "outlineAlpha": 0.8,
        "outlineThickness": 2,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "innerRadius": "30%",
        "depth3D": 15,
        "angle": 30,
        "language": "pt",
        "legend": {
            "position": "right",
            "markerType": "circle"
        },
        "export": {
            "enabled": true
        }
    });
} else {
    // GRÁFICO SERIAL (BARRAS)
    var graficoSerial = AmCharts.makeChart("graficoRelatorio", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "language": "pt",
        "dataProvider": [ 
        {
            "status": "Aberto",
            "value": <?php echo $info_grafico_aberto; ?>,
            "color": "#F78181"
        },
        {
            "status": "Em análise",
            "value": <?php echo $info_grafico_analise; ?>,
            "color": "#A9D0F5"
        },
        {
            "status": "Concluído",
            "value": <?php echo $info_grafico_concluido; ?>,
            "color": "#CEF6CE"
        },
        {
            "status": "Cancelado",
            "value": <?php echo $info_grafico_cancelado; ?>,
            "color": "#F3E2A9"
        }
        ],
        "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Demandas"
        }],
            "startDuration": 1,
            "graphs": [{
            "balloonText": "[[category]]<br><span style='font-size:14px'><b>[[value]]</b></span>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "value"
        }],
            "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
            "categoryField": "status",
            "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },

        "export": {
            "enabled": true
        }
    });
}
</script>
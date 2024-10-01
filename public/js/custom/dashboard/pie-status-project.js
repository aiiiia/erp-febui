// Data retrieved from https://netmarketshare.com/
// Build the chart
Highcharts.chart('pie-status-project', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [{
            name: 'Belum Mulai',
            y: 30
        },  {
            name: 'Berlangsung',
            y: 20
        },  {
            name: 'Selesai',
            y: 50,
            sliced: true,
            selected: true
        }]
    }]
});

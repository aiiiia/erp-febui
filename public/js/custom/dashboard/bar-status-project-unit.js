Highcharts.chart('bar-project-status-unit', {
    chart: {
        type: 'bar'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: [
            'Divisi Pengembangan Penelitian & Konsultasi', 'Divisi Keuangan & SDM', 'Divisi Pelatihan', 'Divisi Asesmen'
        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    credits: {
        enabled: false
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [{
        name: 'Belum Mulai',
        data: [85, 15, 135, 65]
    }, {
        name: 'Berlangsung',
        data: [65, 10, 50, 75]
    }, {
        name: 'Selesai',
        data: [200, 25, 115, 160]
    }]
});

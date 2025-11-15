    // ============================ Pie Chart Start ==========================
    var options = {
        series: [70, 80, 90, 30],
        chart: {
            height: 264,
            type: 'pie',
        },
        stroke: {
            show: false // This will remove the white border
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D'],
        colors: ['#487FFF', "#FF9F29", '#45B369', '#EF4A00'],
        plotOptions: {
            pie: {
                dataLabels: {
                    dropShadow: {
                        enabled: true,
                    },
                },
            }
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center' // Align the legend horizontally
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
                show: false,
                position: 'bottom', // Ensure the legend is at the bottom
                horizontalAlign: 'center', // Align the legend horizontally
                offsetX: -10,
                offsetY: 0
            }
          }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#pieChart"), options);
    chart.render();
    // ============================ Pie Chart End ==========================

    // ============================ Donut Chart Start ==========================
    var options = {
          series: [44, 55, 13, 33, 28, 14],
            chart: {
                height: 264,
                type: 'donut',
            },
            colors: ['#16a34a', '#487fff', '#2563eb', '#dc2626', '#f86624', '#ffc107'],
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                    width: 200
                    },
                    legend: {
                    show: false
                    }
                }
            }],
            legend: {
                position: 'right',
                offsetY: 0,
                height: 230,
                show: false
            }
    };

    var chart = new ApexCharts(document.querySelector("#basicDonutChart"), options);
    chart.render();
    // ============================ Donut Chart End ==========================

    // ============================ Radar Chart Start ==========================
    
    var options = {
          series: [{
            name: 'Product 1',
            data: [80, 50, 30, 40, 60, 20, 62, 30, 40, 80],
        }, {
          name: 'Product 2',
          data: [80, 60, 80, 70, 68, 60, 56, 50, 40, 45],
        }],
        colors: ['#FF9F29', '#487FFF'],
        chart: {
            height: 264,
            type: 'radar',
            toolbar: {
                show: false,
            },
            dropShadow: {
                enabled: true,
                blur: 1,
                left: 1,
                top: 1
            }
        },
        stroke: {
          width: 2
        },
        fill: {
          opacity: 0.25
        },
        markers: {
          size: 0
        },
        yaxis: {
          stepSize: 20
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
        }
    };

    var chart = new ApexCharts(document.querySelector("#radarChart"), options);
    chart.render();
    // ============================ Radar Chart End ==========================

    // ============================ Multiple series Chart Start ==========================
    var options = {
        series: [20, 22, 28, 10],
        chart: {
          type: 'polarArea',
          height: 264,
        },
        labels: ['Product 1', 'Product 2', 'Product 3', 'Product 4'],
        colors: ['#487FFF', '#FF9F29', '#9935FE', '#EF4A00'], 
        stroke: {
            colors: ['#487FFF', '#FF9F29', '#9935FE', '#EF4A00'], 
        },
        fill: {
          opacity: 0.8
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center' // Align the legend horizontally
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#multipleSeriesChart"), options);
    chart.render();
    // ============================ Multiple series Chart End ==========================

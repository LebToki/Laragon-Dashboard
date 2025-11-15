<?php $script = '<script>
    // ================================== Crm Home widgets charts Start =================================
    function createWidgetChart(chartId, chartColor) {

        let currentYear = new Date().getFullYear();

        var options = {
            series: [{
                name: "series1",
                data: [35, 45, 38, 41, 36, 43, 37, 55, 40],
            }, ],
            chart: {
                type: "area",
                width: 100,
                height: 42,
                sparkline: {
                    enabled: true // Remove whitespace
                },

                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 2,
                colors: [chartColor],
                lineCap: "round"
            },
            grid: {
                show: true,
                borderColor: "transparent",
                strokeDashArray: 0,
                position: "back",
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: -3,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            fill: {
                type: "gradient",
                colors: [chartColor], // Set the starting color (top color) here
                gradient: {
                    shade: "light", // Gradient shading type
                    type: "vertical", // Gradient direction (vertical)
                    shadeIntensity: 0.5, // Intensity of the gradient shading
                    gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
                    inverseColors: false, // Do not invert colors
                    opacityFrom: .75, // Starting opacity
                    opacityTo: 0.3, // Ending opacity
                    stops: [0, 100],
                },
            },
            // Customize the circle marker color on hover
            markers: {
                colors: [chartColor],
                strokeWidth: 2,
                size: 0,
                hover: {
                    size: 8
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`, `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`],
                tooltip: {
                    enabled: false,
                },
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                },
            },
        };

        var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
        chart.render();
    }

    // Call the function for each chart with the desired ID and color
    createWidgetChart("new-user-chart", "#487fff");
    createWidgetChart("active-user-chart", "#45b369");
    createWidgetChart("total-sales-chart", "#f4941e");
    createWidgetChart("conversion-user-chart", "#8252e9");
    // ================================== Crm Home widgets charts End =================================

    // ================================== Crm Home widgets charts Start =================================
    function createCoinChart(chartId, chartColor) {

        let currentYear = new Date().getFullYear();

        var options = {
            series: [{
                name: "series1",
                data: [31, 24, 30, 25, 32, 28, 40, 32, 42, 38, 40, 32, 38, 35, 45],
            }, ],
            chart: {
                type: "area",
                width: 150,
                height: 70,

                sparkline: {
                    enabled: true // Remove whitespace
                },

                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                },
                events: {
                    mounted: function(chartContext, config) {
                        // Apply CSS blur to markers
                        document.querySelectorAll(`#${chartId} .apexcharts-marker`).forEach(marker => {
                            marker.style.filter = "blur(2px)";
                        });
                    },
                    updated: function(chartContext, config) {
                        // Apply CSS blur to markers
                        document.querySelectorAll(`#${chartId} .apexcharts-marker`).forEach(marker => {
                            marker.style.filter = "blur(3px)";
                        });
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 2,
                colors: [chartColor],
                lineCap: "round"
            },
            grid: {
                show: true,
                borderColor: "transparent",
                strokeDashArray: 0,
                position: "back",
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: -3,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            fill: {
                type: "gradient",
                colors: [chartColor], // Set the starting color (top color) here
                gradient: {
                    shade: "light", // Gradient shading type
                    type: "vertical", // Gradient direction (vertical)
                    shadeIntensity: 0.5, // Intensity of the gradient shading
                    gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
                    inverseColors: false, // Do not invert colors
                    opacityFrom: .7, // Starting opacity
                    opacityTo: 0.3, // Ending opacity
                    stops: [0, 100],
                },
            },
            // Customize the circle marker color on hover
            markers: {
                colors: [chartColor],
                strokeWidth: 2,
                size: 0,
                hover: {
                    size: 8
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`, `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`],
                tooltip: {
                    enabled: false,
                },
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                },
            },
        };

        var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
        chart.render();
    }

    // Call the function for each chart with the desired ID and color
    createCoinChart("bitcoinAreaChart", "#F98C08");
    createCoinChart("ethereumAreaChart", "#5F80FF");
    createCoinChart("solanaAreaChart", "#C817F8");
    createCoinChart("litecoinAreaChart", "#2171EA");
    createCoinChart("dogecoinAreaChart", "#C2A633");
    // ================================== Crm Home widgets charts End =================================

    // =========================== Sales Statistic Line Chart Start ===============================
    var options = {
        series: [{
            name: "This month",
            data: [10, 20, 12, 30, 14, 35, 16, 32, 14, 25, 13, 28]
        }],
        chart: {
            height: 264,
            type: "line",
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                top: 6,
                left: 0,
                blur: 4,
                color: "#000",
                opacity: 0.1,
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: "smooth",
            colors: ["#487FFF"], // Specify the line color here
            width: 3
        },
        markers: {
            size: 0,
            strokeWidth: 3,
            hover: {
                size: 8
            }
        },
        tooltip: {
            enabled: true,
            x: {
                show: true,
            },
            y: {
                show: false,
            },
            z: {
                show: false,
            }
        },
        grid: {
            row: {
                colors: ["transparent", "transparent"], // takes an array which will be repeated on columns
                opacity: 0.5
            },
            borderColor: "#D1D5DB",
            strokeDashArray: 3,
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return "$" + value + "k";
                },
                style: {
                    fontSize: "14px"
                }
            },
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            tooltip: {
                enabled: false
            },
            labels: {
                formatter: function(value) {
                    return value;
                },
                style: {
                    fontSize: "14px"
                }
            },
            axisBorder: {
                show: false
            },
            crosshairs: {
                show: true,
                width: 20,
                stroke: {
                    width: 0
                },
                fill: {
                    type: "solid",
                    color: "#487FFF40",
                    // gradient: {
                    //   colorFrom: "#D8E3F0",
                    //   // colorTo: "#BED1E6",
                    //   stops: [0, 100],
                    //   opacityFrom: 0.4,
                    //   opacityTo: 0.5,
                    // },
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    // =========================== Sales Statistic Line Chart End ===============================

    // ================================ Earning Statistics bar chart Start ================================ 
    var options = {
        series: [{
            name: "Sales",
            data: [{
                x: "Jan",
                y: 85000,
            }, {
                x: "Feb",
                y: 70000,
            }, {
                x: "Mar",
                y: 40000,
            }, {
                x: "Apr",
                y: 50000,
            }, {
                x: "May",
                y: 60000,
            }, {
                x: "Jun",
                y: 50000,
            }, {
                x: "Jul",
                y: 40000,
            }, {
                x: "Aug",
                y: 50000,
            }, {
                x: "Sep",
                y: 40000,
            }, {
                x: "Oct",
                y: 60000,
            }, {
                x: "Nov",
                y: 30000,
            }, {
                x: "Dec",
                y: 50000,
            }]
        }],
        chart: {
            type: "bar",
            height: 310,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
                columnWidth: "23%",
                endingShape: "rounded",
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: "gradient",
            colors: ["#487FFF"], // Set the starting color (top color) here
            gradient: {
                shade: "light", // Gradient shading type
                type: "vertical", // Gradient direction (vertical)
                shadeIntensity: 0.5, // Intensity of the gradient shading
                gradientToColors: ["#487FFF"], // Bottom gradient color (with transparency)
                inverseColors: false, // Do not invert colors
                opacityFrom: 1, // Starting opacity
                opacityTo: 1, // Ending opacity
                stops: [0, 100],
            },
        },
        grid: {
            show: true,
            borderColor: "#D1D5DB",
            strokeDashArray: 4, // Use a number for dashed style
            position: "back",
        },
        xaxis: {
            type: "category",
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return (value / 1000).toFixed(0) + "k";
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(value) {
                    return value / 1000 + "k";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();
    // ================================ Earning Statistics bar chart End ================================ 

    // ================================ Users Overview Donut chart Start ================================ 
    var options = {
        series: [500, 500, 500],
        colors: ["#FF9F29", "#487FFF", "#E4F1FF"],
        labels: ["Active", "New", "Total"],
        legend: {
            show: false
        },
        chart: {
            type: "donut",
            height: 270,
            sparkline: {
                enabled: true // Remove whitespace
            },
            margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        stroke: {
            width: 0,
        },
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
                    position: "bottom"
                }
            }
        }],
    };

    var chart = new ApexCharts(document.querySelector("#userOverviewDonutChart"), options);
    chart.render();
    // ================================ Users Overview Donut chart End ================================ 

    // ================================ Client Payment Status chart End ================================ 
    var options = {
        series: [{
            name: "Net Profit",
            data: [44, 100, 40, 56, 30, 58, 50]
        }, {
            name: "Revenue",
            data: [90, 140, 80, 125, 70, 140, 110]
        }, {
            name: "Free Cash",
            data: [60, 120, 60, 90, 50, 95, 90]
        }],
        colors: ["#45B369", "#144bd6", "#FF9F29"],
        labels: ["Active", "New", "Total"],

        legend: {
            show: false
        },
        chart: {
            type: "bar",
            height: 350,
            toolbar: {
                show: false
            },
        },
        grid: {
            show: true,
            borderColor: "#D1D5DB",
            strokeDashArray: 4, // Use a number for dashed style
            position: "back",
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: 8,
            },
        },
        dataLabels: {
            enabled: false
        },
        states: {
            hover: {
                filter: {
                    type: "none"
                }
            }
        },
        stroke: {
            show: true,
            width: 0,
            colors: ["transparent"]
        },
        xaxis: {
            categories: ["Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun"],
        },
        yaxis: {
            categories: ["0", "10,000", "20,000", "30,000", "50,000", "1,00,000", "1,00,000"],
        },
        fill: {
            opacity: 1,
            width: 18,
        },
    };

    var chart = new ApexCharts(document.querySelector("#paymentStatusChart"), options);
    chart.render();
    // ================================ Client Payment Status chart End ================================ 

    // ================================ J Vector Map Start ================================ 
    $("#world-map").vectorMap({
        map: "world_mill_en",
        backgroundColor: "transparent",
        borderColor: "#fff",
        borderOpacity: 0.25,
        borderWidth: 0,
        color: "#000000",
        regionStyle: {
            initial: {
                fill: "#D1D5DB"
            }
        },
        markerStyle: {
            initial: {
                r: 5,
                "fill": "#fff",
                "fill-opacity": 1,
                "stroke": "#000",
                "stroke-width": 1,
                "stroke-opacity": 0.4
            },
        },
        markers: [{
                latLng: [35.8617, 104.1954],
                name: "China : 250"
            },

            {
                latLng: [25.2744, 133.7751],
                name: "AustrCalia : 250"
            },

            {
                latLng: [36.77, -119.41],
                name: "USA : 82%"
            },

            {
                latLng: [55.37, -3.41],
                name: "UK   : 250"
            },

            {
                latLng: [25.20, 55.27],
                name: "UAE : 250"
            }
        ],

        series: {
            regions: [{
                values: {
                    "US": "#487FFF ",
                    "SA": "#487FFF",
                    "AU": "#487FFF",
                    "CN": "#487FFF",
                    "GB": "#487FFF",
                },
                attribute: "fill"
            }]
        },
        hoverOpacity: null,
        normalizeFunction: "linear",
        zoomOnScroll: false,
        scaleColors: ["#000000", "#000000"],
        selectedColor: "#000000",
        selectedRegions: [],
        enableZoom: false,
        hoverColor: "#fff",
    });
    // ================================ J Vector Map End ================================ 

    // ================================ Total Transaction line chart Start ================================ 
    var options = {
        series: [{
            name: "This month",
            data: [4, 16, 12, 28, 22, 38, 23]
        }],
        chart: {
            height: 290,
            type: "line",
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                top: 6,
                left: 0,
                blur: 4,
                color: "#000",
                opacity: 0.1,
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: "smooth",
            width: 3
        },
        markers: {
            size: 0,
            strokeWidth: 3,
            hover: {
                size: 8
            }
        },
        tooltip: {
            enabled: true,
            x: {
                show: true,
            },
            y: {
                show: false,
            },
            z: {
                show: false,
            }
        },
        grid: {
            row: {
                colors: ["transparent", "transparent"], // takes an array which will be repeated on columns
                opacity: 0.5
            },
            borderColor: "#D1D5DB",
            strokeDashArray: 3,
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return "$" + value + "k";
                },
                style: {
                    fontSize: "14px"
                }
            },
        },
        xaxis: {
            categories: ["Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun"],
            tooltip: {
                enabled: false
            },
            labels: {
                formatter: function(value) {
                    return value;
                },
                style: {
                    fontSize: "14px"
                }
            },
            axisBorder: {
                show: false
            },
            crosshairs: {
                show: true,
                width: 20,
                stroke: {
                    width: 0
                },
                fill: {
                    type: "solid",
                    color: "#B1B9C4",
                    gradient: {
                        colorFrom: "#D8E3F0",
                        colorTo: "#BED1E6",
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    },
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#transactionLineChart"), options);
    chart.render();
    // ================================ Total Transaction line chart End ================================ 

    // ================================ Semi Circle Gauge (Daily Conversion) chart Start ================================ 
    var options = {
        series: [75],
        chart: {
            height: 165,
            width: 120,
            type: "radialBar",
            sparkline: {
                enabled: false // Remove whitespace
            },
            toolbar: {
                show: false
            },
            padding: {
                left: -32,
                right: -32,
                top: -32,
                bottom: -32
            },
            margin: {
                left: -32,
                right: -32,
                top: -32,
                bottom: -32
            }
        },
        plotOptions: {
            radialBar: {
                offsetY: -24,
                offsetX: -14,
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: "#E3E6E9",
                    // strokeWidth: 32,
                    dropShadow: {
                        enabled: false,
                        top: 2,
                        left: 0,
                        color: "#999",
                        opacity: 1,
                        blur: 2
                    }
                },
                dataLabels: {
                    show: false,
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                        fontSize: "22px"
                    }
                }
            }
        },
        fill: {
            type: "gradient",
            colors: ["#9DBAFF"],
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: 0.5,
                gradientToColors: ["#487FFF"],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            lineCap: "round",
        },
        labels: ["Percent"],
    };

    var chart = new ApexCharts(document.querySelector("#semiCircleGauge"), options);
    chart.render();
    // ================================ Semi Circle Gauge (Daily Conversion) chart End ================================ 

    // ================================ Area chart Start ================================ 
    function createChart(chartId, chartColor) {

        let currentYear = new Date().getFullYear();

        var options = {
            series: [{
                name: "series1",
                data: [0, 10, 8, 25, 15, 26, 13, 35, 15, 39, 16, 46, 42],
            }, ],
            chart: {
                type: "area",
                width: 164,
                height: 72,

                sparkline: {
                    enabled: true // Remove whitespace
                },

                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 2,
                colors: [chartColor],
                lineCap: "round"
            },
            grid: {
                show: true,
                borderColor: "transparent",
                strokeDashArray: 0,
                position: "back",
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: -3,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            fill: {
                type: "gradient",
                colors: [chartColor], // Set the starting color (top color) here
                gradient: {
                    shade: "light", // Gradient shading type
                    type: "vertical", // Gradient direction (vertical)
                    shadeIntensity: 0.5, // Intensity of the gradient shading
                    gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
                    inverseColors: false, // Do not invert colors
                    opacityFrom: .8, // Starting opacity
                    opacityTo: 0.3, // Ending opacity
                    stops: [0, 100],
                },
            },
            // Customize the circle marker color on hover
            markers: {
                colors: [chartColor],
                strokeWidth: 2,
                size: 0,
                hover: {
                    size: 8
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`, `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`],
                tooltip: {
                    enabled: false,
                },
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                },
            },
        };

        var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
        chart.render();
    }

    // Call the function for each chart with the desired ID and color
    createChart("areaChart", "#FF9F29");
    // ================================ Area chart End ================================ 

    // ================================ Bar chart (Today Income0 Start ================================ 
    var options = {
        series: [{
            name: "Sales",
            data: [{
                x: "Mon",
                y: 20,
            }, {
                x: "Tue",
                y: 40,
            }, {
                x: "Wed",
                y: 20,
            }, {
                x: "Thur",
                y: 30,
            }, {
                x: "Fri",
                y: 40,
            }, {
                x: "Sat",
                y: 35,
            }]
        }],
        chart: {
            type: "bar",
            width: 164,
            height: 80,
            sparkline: {
                enabled: true // Remove whitespace
            },
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 6,
                horizontal: false,
                columnWidth: 14,
            }
        },
        dataLabels: {
            enabled: false
        },
        states: {
            hover: {
                filter: {
                    type: "none"
                }
            }
        },
        fill: {
            type: "gradient",
            colors: ["#E3E6E9"], // Set the starting color (top color) here
            gradient: {
                shade: "light", // Gradient shading type
                type: "vertical", // Gradient direction (vertical)
                shadeIntensity: 0.5, // Intensity of the gradient shading
                gradientToColors: ["#E3E6E9"], // Bottom gradient color (with transparency)
                inverseColors: false, // Do not invert colors
                opacityFrom: 1, // Starting opacity
                opacityTo: 1, // Ending opacity
                stops: [0, 100],
            },
        },
        grid: {
            show: false,
            borderColor: "#D1D5DB",
            strokeDashArray: 1, // Use a number for dashed style
            position: "back",
        },
        xaxis: {
            labels: {
                show: false // Hide y-axis labels
            },
            type: "category",
            categories: ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat"]
        },
        yaxis: {
            labels: {
                show: false,
                formatter: function(value) {
                    return (value / 1000).toFixed(0) + "k";
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(value) {
                    return value / 1000 + "k";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#dailyIconBarChart"), options);
    chart.render();
    // ================================ Bar chart (Today Income0 End ================================ 
    </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Widgets</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Widgets</li>
                </ul>
            </div>

            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Metrics</h6>
                </div>
                <div class="card-body p-24">
                    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
                        <div class="col">
                            <div class="card shadow-none border bg-gradient-start-1">
                                <div class="card-body p-20">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                            <p class="fw-medium text-primary-light mb-1">Total Users</p>
                                            <h6 class="mb-0">20,000</h6>
                                        </div>
                                        <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="gridicons:multiple-users" class="text-base text-2xl mb-0"></iconify-icon>
                                        </div>
                                    </div>
                                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
                                        <span class="text-success-main">
                                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +5000
                                        </span>
                                        Last 30 days users
                                    </p>
                                </div>
                            </div><!-- card end -->
                        </div>
                        <div class="col">
                            <div class="card shadow-none border bg-gradient-start-2">
                                <div class="card-body p-20">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                            <p class="fw-medium text-primary-light mb-1">Total Subscription</p>
                                            <h6 class="mb-0">15,000</h6>
                                        </div>
                                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="fa-solid:award" class="text-base text-2xl mb-0"></iconify-icon>
                                        </div>
                                    </div>
                                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
                                        <span class="text-danger-main">
                                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -800
                                        </span>
                                        Last 30 days subscription
                                    </p>
                                </div>
                            </div><!-- card end -->
                        </div>
                        <div class="col">
                            <div class="card shadow-none border bg-gradient-start-3">
                                <div class="card-body p-20">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                            <p class="fw-medium text-primary-light mb-1">Total Free Users</p>
                                            <h6 class="mb-0">5,000</h6>
                                        </div>
                                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="fluent:people-20-filled" class="text-base text-2xl mb-0"></iconify-icon>
                                        </div>
                                    </div>
                                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
                                        <span class="text-success-main">
                                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +200
                                        </span>
                                        Last 30 days users
                                    </p>
                                </div>
                            </div><!-- card end -->
                        </div>
                        <div class="col">
                            <div class="card shadow-none border bg-gradient-start-4">
                                <div class="card-body p-20">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                            <p class="fw-medium text-primary-light mb-1">Total Income</p>
                                            <h6 class="mb-0">$42,000</h6>
                                        </div>
                                        <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="solar:wallet-bold" class="text-base text-2xl mb-0"></iconify-icon>
                                        </div>
                                    </div>
                                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
                                        <span class="text-success-main">
                                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$20,000
                                        </span>
                                        Last 30 days income
                                    </p>
                                </div>
                            </div><!-- card end -->
                        </div>
                        <div class="col">
                            <div class="card shadow-none border bg-gradient-start-5">
                                <div class="card-body p-20">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                            <p class="fw-medium text-primary-light mb-1">Total Expense</p>
                                            <h6 class="mb-0">$30,000</h6>
                                        </div>
                                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-base text-2xl mb-0"></iconify-icon>
                                        </div>
                                    </div>
                                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
                                        <span class="text-success-main">
                                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$5,000
                                        </span>
                                        Last 30 days expense
                                    </p>
                                </div>
                            </div><!-- card end -->
                        </div>
                    </div>

                    <div class="mt-24">
                        <div class="row gy-4">

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card p-3 shadow-none radius-8 border h-100 bg-gradient-end-1">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                            <div class="d-flex align-items-center gap-2">
                                                <span class="mb-0 w-48-px h-48-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                    <iconify-icon icon="mingcute:user-follow-fill" class="icon"></iconify-icon>
                                                </span>
                                                <div>
                                                    <span class="mb-2 fw-medium text-secondary-light text-sm">New Users</span>
                                                    <h6 class="fw-semibold">15,000</h6>
                                                </div>
                                            </div>

                                            <div id="new-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                        <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card p-3 shadow-none radius-8 border h-100 bg-gradient-end-2">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                            <div class="d-flex align-items-center gap-2">
                                                <span class="mb-0 w-48-px h-48-px bg-success-main flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <iconify-icon icon="mingcute:user-follow-fill" class="icon"></iconify-icon>
                                                </span>
                                                <div>
                                                    <span class="mb-2 fw-medium text-secondary-light text-sm">Active Users</span>
                                                    <h6 class="fw-semibold">8,000</h6>
                                                </div>
                                            </div>

                                            <div id="active-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                        <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card p-3 shadow-none radius-8 border h-100 bg-gradient-end-3">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                            <div class="d-flex align-items-center gap-2">
                                                <span class="mb-0 w-48-px h-48-px bg-yellow text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <iconify-icon icon="iconamoon:discount-fill" class="icon"></iconify-icon>
                                                </span>
                                                <div>
                                                    <span class="mb-2 fw-medium text-secondary-light text-sm">Total Sales</span>
                                                    <h6 class="fw-semibold">$5,00,000</h6>
                                                </div>
                                            </div>

                                            <div id="total-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                        <p class="text-sm mb-0">Increase by <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">-$10k</span> this week</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card p-3 shadow-none radius-8 border h-100 bg-gradient-end-3">
                                    <div class="card-body p-0">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                            <div class="d-flex align-items-center gap-2">
                                                <span class="mb-0 w-48-px h-48-px bg-purple text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                                    <iconify-icon icon="mdi:message-text" class="icon"></iconify-icon>
                                                </span>
                                                <div>
                                                    <span class="mb-2 fw-medium text-secondary-light text-sm">Conversion</span>
                                                    <h6 class="fw-semibold">25%</h6>
                                                </div>
                                            </div>

                                            <div id="conversion-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                        <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+5%</span> this week</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-24 gy-0">
                        <div class="col-xxl-3 col-sm-6 pe-0">
                            <div class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center border-end-0">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-12 w-44-px h-44-px text-primary-600 bg-primary-light border border-primary-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                            <iconify-icon icon="fa-solid:box-open" class="icon"></iconify-icon>
                                        </span>
                                        <span class="mb-1 fw-medium text-secondary-light text-md">Total Products</span>
                                        <h6 class="fw-semibold text-primary-light mb-1">300</h6>
                                    </div>
                                </div>
                                <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week</p>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6 px-0">
                            <div class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center border-end-0">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-12 w-44-px h-44-px text-yellow bg-yellow-light border border-yellow-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                            <iconify-icon icon="flowbite:users-group-solid" class="icon"></iconify-icon>
                                        </span>
                                        <span class="mb-1 fw-medium text-secondary-light text-md">Total Customer</span>
                                        <h6 class="fw-semibold text-primary-light mb-1">50,000</h6>
                                    </div>
                                </div>
                                <p class="text-sm mb-0">Increase by <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">-5k</span> this week</p>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6 px-0">
                            <div class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center border-end-0">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-12 w-44-px h-44-px text-lilac bg-lilac-light border border-lilac-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                            <iconify-icon icon="majesticons:shopping-cart" class="icon"></iconify-icon>
                                        </span>
                                        <span class="mb-1 fw-medium text-secondary-light text-md">Total Orders</span>
                                        <h6 class="fw-semibold text-primary-light mb-1">1500</h6>
                                    </div>
                                </div>
                                <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+1k</span> this week</p>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6 ps-0">
                            <div class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-12 w-44-px h-44-px text-pink bg-pink-light border border-pink-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                            <iconify-icon icon="ri:discount-percent-fill" class="icon"></iconify-icon>
                                        </span>
                                        <span class="mb-1 fw-medium text-secondary-light text-md">Total Sales</span>
                                        <h6 class="fw-semibold text-primary-light mb-1">$25,00,000.00</h6>
                                    </div>
                                </div>
                                <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+$10k</span> this week</p>
                            </div>
                        </div>
                    </div>

                    <!-- Crypto Home Widgets Start -->
                    <div class="mt-24">
                        <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">

                            <div class="col">
                                <div class="card shadow-none border bg-gradient-end-3">
                                    <div class="card-body p-20">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                            <img src="assets/images/currency/crypto-img1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-xl mb-1">Bitcoin</h6>
                                                <p class="fw-medium text-secondary-light mb-0">BTC</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                                            <div class="">
                                                <h6 class="mb-8">$45,138</h6>
                                                <span class="text-success-main text-md">+ 27%</span>
                                            </div>
                                            <div id="bitcoinAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card shadow-none border bg-gradient-end-1">
                                    <div class="card-body p-20">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                            <img src="assets/images/currency/crypto-img2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-xl mb-1">Ethereum </h6>
                                                <p class="fw-medium text-secondary-light mb-0">ETH</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                                            <div class="">
                                                <h6 class="mb-8">$45,138</h6>
                                                <span class="text-danger-main text-md">- 27%</span>
                                            </div>
                                            <div id="ethereumAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card shadow-none border bg-gradient-end-5">
                                    <div class="card-body p-20">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                            <img src="assets/images/currency/crypto-img3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-xl mb-1">Solana</h6>
                                                <p class="fw-medium text-secondary-light mb-0">SOL</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                                            <div class="">
                                                <h6 class="mb-8">$45,138</h6>
                                                <span class="text-success-main text-md">+ 27%</span>
                                            </div>
                                            <div id="solanaAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card shadow-none border bg-gradient-end-6">
                                    <div class="card-body p-20">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                            <img src="assets/images/currency/crypto-img4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-xl mb-1">Litecoin</h6>
                                                <p class="fw-medium text-secondary-light mb-0">LTE</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                                            <div class="">
                                                <h6 class="mb-8">$45,138</h6>
                                                <span class="text-success-main text-md">+ 27%</span>
                                            </div>
                                            <div id="litecoinAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card shadow-none border bg-gradient-end-3">
                                    <div class="card-body p-20">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                            <img src="assets/images/currency/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-xl mb-1">Dogecoin</h6>
                                                <p class="fw-medium text-secondary-light mb-0">DOGE</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center gap-1">
                                            <div class="">
                                                <h6 class="mb-8">$45,138</h6>
                                                <span class="text-success-main text-md">+ 27%</span>
                                            </div>
                                            <div id="dogecoinAreaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Crypto Home Widgets End -->
                </div>
            </div>


            <div class="row gy-4 mt-1">
                <div class="col-xxl-6 col-xl-6">
                    <div class="card h-100 border shadow-none">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <h6 class="text-lg mb-0">Sales Statistic</h6>
                                <select class="form-select form-select-sm w-auto">
                                    <option>Yearly</option>
                                    <option>Monthly</option>
                                    <option>Weekly</option>
                                    <option>Today</option>
                                </select>
                            </div>
                            <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
                                <h6 class="mb-0">$27,200</h6>
                                <span class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1">
                                    10% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                                </span>
                                <span class="text-xs fw-medium">+ $1500 Per Day</span>
                            </div>
                            <div id="chart" class="pt-28 apexcharts-tooltip-style-1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6">
                    <div class="card h-100 border shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Top Countries</h6>
                                <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                    <option>Today</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                    <option>Yearly</option>
                                </select>
                            </div>

                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div id="world-map" class="h-100 border radius-8"></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="h-100 border p-16 pe-0 radius-8">
                                        <div class="max-h-266-px overflow-y-auto scroll-sm pe-16">
                                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                <div class="d-flex align-items-center w-100">
                                                    <img src="assets/images/flags/flag1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-sm mb-0">USA</h6>
                                                        <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 w-100">
                                                    <div class="w-100 max-w-66 ms-auto">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-secondary-light font-xs fw-semibold">80%</span>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                <div class="d-flex align-items-center w-100">
                                                    <img src="assets/images/flags/flag2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-sm mb-0">Japan</h6>
                                                        <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 w-100">
                                                    <div class="w-100 max-w-66 ms-auto">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-orange rounded-pill" style="width: 60%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-secondary-light font-xs fw-semibold">60%</span>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                <div class="d-flex align-items-center w-100">
                                                    <img src="assets/images/flags/flag3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-sm mb-0">France</h6>
                                                        <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 w-100">
                                                    <div class="w-100 max-w-66 ms-auto">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-yellow rounded-pill" style="width: 49%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-secondary-light font-xs fw-semibold">49%</span>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                <div class="d-flex align-items-center w-100">
                                                    <img src="assets/images/flags/flag4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-sm mb-0">Germany</h6>
                                                        <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 w-100">
                                                    <div class="w-100 max-w-66 ms-auto">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success-main rounded-pill" style="width: 100%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-secondary-light font-xs fw-semibold">100%</span>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                <div class="d-flex align-items-center w-100">
                                                    <img src="assets/images/flags/flag5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-sm mb-0">South Korea</h6>
                                                        <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 w-100">
                                                    <div class="w-100 max-w-66 ms-auto">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-info-main rounded-pill" style="width: 30%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-secondary-light font-xs fw-semibold">30%</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="d-flex align-items-center w-100">
                                                    <img src="assets/images/flags/flag1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-sm mb-0">USA</h6>
                                                        <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 w-100">
                                                    <div class="w-100 max-w-66 ms-auto">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-secondary-light font-xs fw-semibold">80%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Client Payment Status Start -->
                <div class="col-xxl-4 col-lg-6">
                    <div class="card h-100 border shadow-none radius-8 border-0">
                        <div class="card-body p-24">
                            <h6 class="mb-2 fw-bold text-lg">Client Payment Status</h6>
                            <span class="text-sm fw-medium text-secondary-light">Weekly Report</span>

                            <ul class="d-flex flex-wrap align-items-center justify-content-center mt-32">
                                <li class="d-flex align-items-center gap-2 me-28">
                                    <span class="w-12-px h-12-px rounded-circle bg-success-main"></span>
                                    <span class="text-secondary-light text-sm fw-medium">Paid: 500</span>
                                </li>
                                <li class="d-flex align-items-center gap-2 me-28">
                                    <span class="w-12-px h-12-px rounded-circle bg-info-main"></span>
                                    <span class="text-secondary-light text-sm fw-medium">Pending: 500</span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <span class="w-12-px h-12-px rounded-circle bg-warning-main"></span>
                                    <span class="text-secondary-light text-sm fw-medium">Overdue: 1500</span>
                                </li>
                            </ul>
                            <div class="mt-40">
                                <div id="paymentStatusChart" class="margin-16-minus"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Client Payment Status End -->

                <!-- Earning Static start -->
                <div class="col-xxl-8 col-lg-6">
                    <div class="card h-100 border shadow-none radius-8 border-0">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <div>
                                    <h6 class="mb-2 fw-bold text-lg">Earning Statistic</h6>
                                    <span class="text-sm fw-medium text-secondary-light">Yearly earning overview</span>
                                </div>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-20 d-flex justify-content-center flex-wrap gap-3">

                                <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                                    <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                                        <iconify-icon icon="fluent:cart-16-filled" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="text-secondary-light text-sm fw-medium">Sales</span>
                                        <h6 class="text-md fw-semibold mb-0">$200k</h6>
                                    </div>
                                </div>

                                <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                                    <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                                        <iconify-icon icon="uis:chart" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="text-secondary-light text-sm fw-medium">Income</span>
                                        <h6 class="text-md fw-semibold mb-0">$200k</h6>
                                    </div>
                                </div>

                                <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                                    <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                                        <iconify-icon icon="ph:arrow-fat-up-fill" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="text-secondary-light text-sm fw-medium">Profit</span>
                                        <h6 class="text-md fw-semibold mb-0">$200k</h6>
                                    </div>
                                </div>
                            </div>

                            <div id="barChart" class="barChart"></div>
                        </div>
                    </div>
                </div>
                <!-- Earning Static End -->

                <div class="col-xxl-4 col-lg-6">
                    <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Users Overview</h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Today</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>
                            </div>


                            <div id="userOverviewDonutChart"></div>

                            <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                                <li class="d-flex align-items-center gap-2">
                                    <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                                    <span class="text-secondary-light text-sm fw-normal">New:
                                        <span class="text-primary-light fw-semibold">500</span>
                                    </span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                                    <span class="text-secondary-light text-sm fw-normal">Subscribed:
                                        <span class="text-primary-light fw-semibold">300</span>
                                    </span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <!-- Total Transactions Start -->
                <div class="col-xxl-4 col-lg-6">
                    <div class="card h-100 border shadow-none">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg">Total Transactions </h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <ul class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-28">
                                <li class="d-flex align-items-center gap-2">
                                    <span class="w-16-px h-16-px radius-2 bg-primary-600"></span>
                                    <span class="text-secondary-light text-lg fw-normal">Total Gain:
                                        <span class="text-primary-light fw-bold text-lg">$50,000</span>
                                    </span>
                                </li>
                            </ul>

                            <div id="transactionLineChart"></div>

                        </div>
                    </div>
                </div>
                <!-- Total Transactions End -->
                <!-- Statistics Start -->
                <div class="col-xxl-4 col-lg-6">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <h6 class="mb-2 fw-bold text-lg">Statistic</h6>

                            <div class="mt-24">
                                <div class="d-flex align-items-center gap-1 justify-content-between mb-44">
                                    <div>
                                        <span class="text-secondary-light fw-normal mb-12 text-xl">Daily Conversions</span>
                                        <h5 class="fw-semibold mb-0">%60</h5>
                                    </div>
                                    <div class="position-relative">
                                        <div id="semiCircleGauge"></div>

                                        <span class="w-36-px h-36-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center position-absolute start-50 translate-middle bottom-0">
                                            <iconify-icon icon="mdi:emoji" class="text-primary-600 text-md mb-0"></iconify-icon>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-1 justify-content-between mb-44">
                                    <div>
                                        <span class="text-secondary-light fw-normal mb-12 text-xl">Visits By Day</span>
                                        <h5 class="fw-semibold mb-0">20k</h5>
                                    </div>
                                    <div id="areaChart"></div>
                                </div>

                                <div class="d-flex align-items-center gap-1 justify-content-between">
                                    <div>
                                        <span class="text-secondary-light fw-normal mb-12 text-xl">Today Income</span>
                                        <h5 class="fw-semibold mb-0">$5.5k</h5>
                                    </div>
                                    <div id="dailyIconBarChart"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Statistics End -->

            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
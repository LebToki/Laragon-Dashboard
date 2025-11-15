<?php $script = '<script>
                    // ===================== Revenue Chart Start =============================== 
                    function createChartTwo(chartId, color1, color2) {
                        var options = {
                            series: [{
                                name: "series1",
                                data: [6, 20, 15, 48, 28, 55, 28, 52, 25, 32, 15, 25]
                            }, {
                                name: "series2",
                                data: [0, 8, 4, 36, 16, 42, 16, 40, 12, 24, 4, 12]
                            }],
                            legend: {
                                show: false
                            },
                            chart: {
                                type: "area",
                                width: "100%",
                                height: 150,
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
                                width: 3,
                                colors: [color1, color2], // Use two colors for the lines
                                lineCap: "round"
                            },
                            grid: {
                                show: true,
                                borderColor: "#D1D5DB",
                                strokeDashArray: 1,
                                position: "back",
                                xaxis: {
                                    lines: {
                                        show: false
                                    }
                                },
                                yaxis: {
                                    lines: {
                                        show: true
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
                                    top: -20,
                                    right: 0,
                                    bottom: -10,
                                    left: 0
                                },
                            },
                            fill: {
                                type: "gradient",
                                colors: [color1, color2], // Use two colors for the gradient
                                // gradient: {
                                //     shade: "light",
                                //     type: "vertical",
                                //     shadeIntensity: 0.5,
                                //     gradientToColors: [`${color1}`, `${color2}00`], // Bottom gradient colors with transparency
                                //     inverseColors: false,
                                //     opacityFrom: .6,
                                //     opacityTo: 0.3,
                                //     stops: [0, 100],
                                // },
                                gradient: {
                                    shade: "light",
                                    type: "vertical",
                                    shadeIntensity: 0.5,
                                    gradientToColors: [undefined, `${color2}00`], // Apply transparency to both colors
                                    inverseColors: false,
                                    opacityFrom: [0.4, 0.6], // Starting opacity for both colors
                                    opacityTo: [0.3, 0.3], // Ending opacity for both colors
                                    stops: [0, 100],
                                },
                            },
                            // markers: {
                            //     colors: [color1, color2], // Use two colors for the markers
                            //     strokeWidth: 3,
                            //     size: 0,
                            //     hover: {
                            //         size: 10
                            //     }
                            // },

                            markers: {
                                colors: [color1, color2],
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
                                }
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
                            tooltip: {
                                x: {
                                    format: "dd/MM/yy HH:mm"
                                }
                            }
                        };

                        var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
                        chart.render();
                    }

                    createChartTwo("revenueChart", "#CD20F9", "#6593FF");
                    // ===================== Revenue Chart End =============================== 

                    // ================================ Bar chart Start ================================ 
                    var options = {
                        series: [{
                            name: "Sales",
                            data: [{
                                x: "Sun",
                                y: 15,
                            }, {
                                x: "Mon",
                                y: 12,
                            }, {
                                x: "Tue",
                                y: 18,
                            }, {
                                x: "Wed",
                                y: 20,
                            }, {
                                x: "Thu",
                                y: 13,
                            }, {
                                x: "Fri",
                                y: 16,
                            }, {
                                x: "Sat",
                                y: 6,
                            }]
                        }],
                        chart: {
                            type: "bar",
                            height: 200,
                            toolbar: {
                                show: false
                            },
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 6,
                                horizontal: false,
                                columnWidth: 24,
                                columnWidth: "40%",
                                endingShape: "rounded",
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            type: "gradient",
                            colors: ["#dae5ff"], // Set the starting color (top color) here
                            gradient: {
                                shade: "light", // Gradient shading type
                                type: "vertical", // Gradient direction (vertical)
                                shadeIntensity: 0.5, // Intensity of the gradient shading
                                gradientToColors: ["#dae5ff"], // Bottom gradient color (with transparency)
                                inverseColors: false, // Do not invert colors
                                opacityFrom: 1, // Starting opacity
                                opacityTo: 1, // Ending opacity
                                stops: [0, 100],
                            },
                        },
                        grid: {
                            show: false,
                            borderColor: "#D1D5DB",
                            strokeDashArray: 4, // Use a number for dashed style
                            position: "back",
                            padding: {
                                top: -10,
                                right: -10,
                                bottom: -10,
                                left: -10
                            }
                        },
                        xaxis: {
                            type: "category",
                            categories: ["2hr", "4hr", "6hr", "8hr", "10hr", "12hr", "14hr"]
                        },
                        yaxis: {
                            show: false,
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#barChart"), options);
                    chart.render();
                    // ================================ Bar chart End ================================ 

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


                    // ================================ Users Overview Donut chart Start ================================ 
                    var options = {
                        series: [500, 500, 500],
                        colors: ["#FF9F29", "#487FFF", "#45B369"],
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
                    </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Analytics</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Analytics</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-body p-20">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="trail-bg h-100 text-center d-flex flex-column justify-content-between align-items-center p-16 radius-8">
                                <h6 class="text-white text-xl">Upgrade Your Plan</h6>
                                <div class="">
                                    <p class="text-white">Your free trial expired in 7 days</p>
                                    <a href="#" class="btn py-8 rounded-pill w-100 bg-gradient-blue-warning text-sm">Upgrade Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-purple-light">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-lilac-200 border border-lilac-400 text-lilac-600">
                                            <i class="ri-price-tag-3-fill"></i>
                                        </span>
                                        <span class="text-neutral-700 d-block">Total Sales</span>
                                        <h6 class="mb-0 mt-4">$170,500.09</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-success-100">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-success-200 border border-success-400 text-success-600">
                                            <i class="ri-shopping-cart-2-fill"></i>
                                        </span>
                                        <span class="text-neutral-700 d-block">Total Orders</span>
                                        <h6 class="mb-0 mt-4">1,500</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-info-focus">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-info-200 border border-info-400 text-info-600">
                                            <i class="ri-group-3-fill"></i>
                                        </span>
                                        <span class="text-neutral-700 d-block">Visitor</span>
                                        <h6 class="mb-0 mt-4">12,300</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="radius-8 h-100 text-center p-20 bg-danger-100">
                                        <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-xl mb-12 bg-danger-200 border border-danger-400 text-danger-600">
                                            <i class="ri-refund-2-line"></i>
                                        </span>
                                        <span class="text-neutral-700 d-block">Refunded</span>
                                        <h6 class="mb-0 mt-4">2756</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-body p-24 mb-8">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Revenue Statistic</h6>
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-24">
                        <li class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px rounded-pill bg-primary-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Profit </span>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <h6 class="mb-0">$26,201</h6>
                                <span class="text-success-600 d-flex align-items-center gap-1 text-sm fw-bolder">
                                    10%
                                    <i class="ri-arrow-up-s-fill d-flex"></i>
                                </span>
                            </div>
                        </li>
                        <li class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px rounded-pill bg-lilac-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Loss </span>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <h6 class="mb-0">$18,120</h6>
                                <span class="text-danger-600 d-flex align-items-center gap-1 text-sm fw-bolder">
                                    10%
                                    <i class="ri-arrow-down-s-fill d-flex"></i>
                                </span>
                            </div>
                        </li>
                    </ul>
                    <div id="revenueChart" class="apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Support Tracker</h6>
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                    <div class="mt-32 d-flex flex-wrap gap-24 align-items-center justify-content-between">
                        <div class="d-flex flex-column gap-24">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-primary-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/ticket1.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-bold">172</h6>
                                    <span class="text-sm text-secondary-light fw-normal">New Tickets </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-warning-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/ticket2.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-bold">172</h6>
                                    <span class="text-sm text-secondary-light fw-normal">Open Tickets</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-lilac-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/ticket3.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-bold">172</h6>
                                    <span class="text-sm text-secondary-light fw-normal">Response Time</span>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative">
                            <div id="userOverviewDonutChart" class="apexcharts-tooltip-z-none"></div>
                            <div class="text-center max-w-135-px max-h-135-px bg-warning-focus rounded-circle p-16 aspect-ratio-1 d-flex flex-column justify-content-center align-items-center position-absolute start-50 top-50 translate-middle">
                                <h6 class="fw-bold">120</h6>
                                <span class="text-secondary-light">Total Tickets</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Average Daily Sales</h6>
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                    <h6 class="text-center my-20">$27,500.00</h6>
                    <div id="barChart" class="barChart"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Transactions</h6>
                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="mt-32">
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-success-200 flex-shrink-0">
                                    <img src="assets/images/home-nine/payment1.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-normal">Wallet</h6>
                                    <span class="text-sm text-secondary-light fw-normal">Payment</span>
                                </div>
                            </div>
                            <span class="text-secondary-light text-md fw-medium">+$6200</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-info-200 flex-shrink-0">
                                    <img src="assets/images/home-nine/payment2.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-normal">PayPal</h6>
                                    <span class="text-sm text-secondary-light fw-normal">Payment</span>
                                </div>
                            </div>
                            <span class="text-secondary-light text-md fw-medium">+$6200</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-warning-200 flex-shrink-0">
                                    <img src="assets/images/home-nine/payment3.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-normal">Credit Card </h6>
                                    <span class="text-sm text-secondary-light fw-normal">Bill Payment</span>
                                </div>
                            </div>
                            <span class="text-secondary-light text-md fw-medium">-$6200</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-lilac-200 flex-shrink-0">
                                    <img src="assets/images/home-nine/payment4.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-normal">Bank</h6>
                                    <span class="text-sm text-secondary-light fw-normal">Bill Payment</span>
                                </div>
                            </div>
                            <span class="text-secondary-light text-md fw-medium">+$6200</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Sales by Countries</h6>
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option>This Month</option>
                            <option>This Week</option>
                            <option>This Year</option>
                        </select>
                    </div>

                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div id="world-map" class="h-100 border radius-8"></div>
                        </div>

                        <div class="col-lg-6">
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
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header border-bottom-0 pb-0 d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Source Visitors</h6>
                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                        <option>Last Month</option>
                        <option>Last Week</option>
                        <option>Last Year</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="position-relative h-100 min-h-320-px">
                        <div class="md-position-absolute start-0 top-0 mt-20">
                            <h6 class="mb-1">524,756</h6>
                            <span class="text-secondary-light">Total Platform Visitors</span>
                        </div>
                        <div class="row g-3 h-100">
                            <div class="col-md-3 col-sm-6 d-flex flex-column justify-content-end">
                                <div class="d-flex flex-column align-items-center p-24 pt-16 rounded-top-4 bg-tb-warning" style="min-height: 50%;">
                                    <span class="w-40-px h-40-px d-flex flex-shrink-0 justify-content-center align-items-center bg-warning-600 rounded-circle mb-12">
                                        <img src="assets/images/home-nine/source-icon1.png" alt="">
                                    </span>
                                    <span class="text-secondary-light">TikTok</span>
                                    <h6 class="mb-0">50%</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 d-flex flex-column justify-content-end">
                                <div class="d-flex flex-column align-items-center p-24 pt-16 rounded-top-4 bg-tb-lilac" style="min-height: 66%;">
                                    <span class="w-40-px h-40-px d-flex flex-shrink-0 justify-content-center align-items-center bg-lilac-600 rounded-circle mb-12">
                                        <img src="assets/images/home-nine/source-icon2.png" alt="">
                                    </span>
                                    <span class="text-secondary-light">Instagram</span>
                                    <h6 class="mb-0">66%</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 d-flex flex-column justify-content-end">
                                <div class="d-flex flex-column align-items-center p-24 pt-16 rounded-top-4 bg-tb-primary" style="min-height: 82%;">
                                    <span class="w-40-px h-40-px d-flex flex-shrink-0 justify-content-center align-items-center bg-primary-600 rounded-circle mb-12">
                                        <img src="assets/images/home-nine/source-icon3.png" alt="">
                                    </span>
                                    <span class="text-secondary-light">Facebook</span>
                                    <h6 class="mb-0">82%</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 d-flex flex-column justify-content-end">
                                <div class="d-flex flex-column align-items-center p-24 pt-16 rounded-top-4 bg-tb-success" style="min-height: 96%;">
                                    <span class="w-40-px h-40-px d-flex flex-shrink-0 justify-content-center align-items-center bg-success-600 rounded-circle mb-12">
                                        <img src="assets/images/home-nine/source-icon4.png" alt="">
                                    </span>
                                    <span class="text-secondary-light">Website</span>
                                    <h6 class="mb-0">96%</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex align-items-start flex-column gap-2">
                        <h6 class="mb-2 fw-bold text-lg">Monthly Campaign State</h6>
                        <span class="text-secondary-light">7.2k Social visitors</span>
                    </div>

                    <div class="d-flex flex-column gap-32 mt-32">
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-lilac-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/socials1.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-semibold">Email</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <span class="text-secondary-light text-md fw-medium">6,200</span>
                                <span class="text-success-600 text-md fw-medium">0.3%</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-warning-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/socials2.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-semibold">Clicked</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <span class="text-secondary-light text-md fw-medium">Clicked</span>
                                <span class="text-danger-600 text-md fw-medium">1.3%</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-info-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/socials3.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-semibold">Subscribe</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <span class="text-secondary-light text-md fw-medium">5,175</span>
                                <span class="text-success-600 text-md fw-medium">0.3%</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-success-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/socials4.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-semibold">Complaints </h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <span class="text-secondary-light text-md fw-medium">3,780</span>
                                <span class="text-success-600 text-md fw-medium">0.3%</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-danger-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/socials5.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-semibold">Unsubscribe</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <span class="text-secondary-light text-md fw-medium">4,120</span>
                                <span class="text-success-600 text-md fw-medium">0.3%</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="w-40-px h-40-px rounded-circle d-flex justify-content-center align-items-center bg-info-100 flex-shrink-0">
                                    <img src="assets/images/home-nine/socials3.png" alt="" class="">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-semibold">Subscribe</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <span class="text-secondary-light text-md fw-medium">5,175</span>
                                <span class="text-success-600 text-md fw-medium">0.3%</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xxl-8">
            <div class="card h-100">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Recent Activity</h6>
                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0 rounded-0 border-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-transparent rounded-0">Customer</th>
                                    <th scope="col" class="bg-transparent rounded-0">ID</th>
                                    <th scope="col" class="bg-transparent rounded-0">Retained</th>
                                    <th scope="col" class="bg-transparent rounded-0">Amount</th>
                                    <th scope="col" class="bg-transparent rounded-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Kristin Watson</h6>
                                                <span class="text-sm text-secondary-light fw-medium">ulfaha@mail.ru</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>#63254</td>
                                    <td>5 min ago</td>
                                    <td>$12,408.12</td>
                                    <td> <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Member</span> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Theresa Webb</h6>
                                                <span class="text-sm text-secondary-light fw-medium">joie@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>#63254</td>
                                    <td>12 min ago</td>
                                    <td>$12,408.12</td>
                                    <td> <span class="bg-lilac-100 text-lilac-600 px-10 py-4 radius-8 fw-medium text-sm">New Customer</span> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Brooklyn Simmons</h6>
                                                <span class="text-sm text-secondary-light fw-medium">warn@mail.ru</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>#63254</td>
                                    <td>15 min ago</td>
                                    <td>$12,408.12</td>
                                    <td> <span class="bg-warning-focus text-warning-main px-10 py-4 radius-8 fw-medium text-sm">Signed Up </span> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Robert Fox</h6>
                                                <span class="text-sm text-secondary-light fw-medium">fellora@mail.ru</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>#63254</td>
                                    <td>17 min ago</td>
                                    <td>$12,408.12</td>
                                    <td> <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Member</span> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Jane Cooper</h6>
                                                <span class="text-sm text-secondary-light fw-medium">zitka@mail.ru</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>#63254</td>
                                    <td>25 min ago</td>
                                    <td>$12,408.12</td>
                                    <td> <span class="bg-warning-focus text-warning-main px-10 py-4 radius-8 fw-medium text-sm">Signed Up </span> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>

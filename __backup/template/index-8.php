<?php $script = '<script>
                    // ===================== Average Enrollment Rate Start =============================== 
                    function createChartTwo(chartId, color1, color2) {
                        var options = {
                            series: [{
                                name: "series1",
                                data: [48, 35, 55, 32, 48, 30, 55, 50, 57]
                            }, {
                                name: "series2",
                                data: [12, 20, 15, 26, 22, 60, 40, 48, 25]
                            }],
                            legend: {
                                show: false
                            },
                            chart: {
                                type: "area",
                                width: "100%",
                                height: 270,
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
                            markers: {
                                colors: [color1, color2], // Use two colors for the markers
                                strokeWidth: 3,
                                size: 0,
                                hover: {
                                    size: 10
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

                    createChartTwo("enrollmentChart", "#487FFF", "#FF9F29");
                    // ===================== Average Enrollment Rate End =============================== 


                    // ================================ User Activities Donut chart End ================================ 
                    var options = {
                        series: [30, 25],
                        colors: ["#FF9F29", "#45B369"],
                        labels: ["Female", "Male"],
                        legend: {
                            show: false
                        },
                        chart: {
                            type: "donut",
                            height: 260,
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

                    var chart = new ApexCharts(document.querySelector("#statisticsDonutChart"), options);
                    chart.render();
                    // ================================ User Activities Donut chart End ================================ 


                    // ================================ Client Payment Status chart End ================================ 
                    var options = {
                        series: [{
                            name: "Net Profit",
                            data: [44, 100, 40, 56, 30, 58, 50]
                        }, {
                            name: "Free Cash",
                            data: [60, 120, 60, 90, 50, 95, 90]
                        }],
                        colors: ["#45B369", "#FF9F29"],
                        labels: ["Active", "New", "Total"],

                        legend: {
                            show: false
                        },
                        chart: {
                            type: "bar",
                            height: 260,
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
                        fill: {
                            opacity: 1,
                            width: 18,
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#paymentStatusChart"), options);
                    chart.render();
                    // ================================ Client Payment Status chart End ================================ 

                    // ================================= Multiple Radial Bar Chart Start =============================
                    var options = {
                        series: [80, 40, 10],
                        chart: {
                            height: 300,
                            type: "radialBar",
                        },
                        colors: ["#3D7FF9", "#ff9f29", "#16a34a"],
                        stroke: {
                            lineCap: "round",
                        },
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    size: "10%", // Adjust this value to control the bar width
                                },
                                dataLabels: {
                                    name: {
                                        fontSize: "16px",
                                    },
                                    value: {
                                        fontSize: "16px",
                                    },
                                    // total: {
                                    //     show: true,
                                    //     formatter: function (w) {
                                    //         return "82%"
                                    //     }
                                    // }
                                },
                                track: {
                                    margin: 20, // Space between the bars
                                }
                            }
                        },
                        labels: ["Cardiology", "Psychiatry", "Pediatrics"],
                    };

                    var chart = new ApexCharts(document.querySelector("#radialMultipleBar"), options);
                    chart.render();
                    // ================================= Multiple Radial Bar Chart End =============================
                    </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Dashboard</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Medical</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-xxxl-9">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="card p-3 shadow-2 radius-8 h-100 bg-gradient-end-6">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                        <div class="d-flex align-items-center gap-2">
                                            <span class="mb-0 w-48-px h-48-px bg-cyan-100 text-cyan-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                <i class="ri-group-fill"></i>
                                            </span>
                                            <div>
                                                <h6 class="fw-semibold mb-2">650</h6>
                                                <span class="fw-medium text-secondary-light text-sm">Doctors</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm mb-0"> <span class="text-cyan-600">4</span> Doctors joined this week</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="card p-3 shadow-2 radius-8 h-100 bg-gradient-end-4">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                        <div class="d-flex align-items-center gap-2">
                                            <span class="mb-0 w-48-px h-48-px bg-lilac-100 text-lilac-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                <i class="ri-award-fill"></i>
                                            </span>
                                            <div>
                                                <h6 class="fw-semibold mb-2">570</h6>
                                                <span class="fw-medium text-secondary-light text-sm">Staffs</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm mb-0"> <span class="text-lilac-600">8</span> Staffs on vacation</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="card p-3 shadow-2 radius-8 h-100 bg-gradient-end-1">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                        <div class="d-flex align-items-center gap-2">
                                            <span class="mb-0 w-48-px h-48-px bg-primary-100 text-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                <i class="ri-group-fill"></i>
                                            </span>
                                            <div>
                                                <h6 class="fw-semibold mb-2">15,750</h6>
                                                <span class="fw-medium text-secondary-light text-sm">Patients</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm mb-0"> <span class="text-primary-600">170</span>New patients admitted</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="card p-3 shadow-2 radius-8 h-100 bg-gradient-end-1">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                        <div class="d-flex align-items-center gap-2">
                                            <span class="mb-0 w-48-px h-48-px bg-success-100 text-success-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                <i class="ri-wallet-3-fill"></i>
                                            </span>
                                            <div>
                                                <h6 class="fw-semibold mb-2">$42,400</h6>
                                                <span class="fw-medium text-secondary-light text-sm">Pharmacies </span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm mb-0"> <span class="text-success-600">60,000 </span> Medicine on reserve</p>
                                </div>
                            </div>
                        </div>


                        <!-- Earning Statistic -->
                        <div class="col-xxl-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Earning Statistic</h6>
                                        <select class="form-select form-select-sm w-auto bg-base border-0 text-secondary-light">
                                            <option>This Month</option>
                                            <option>This Week</option>
                                            <option>This Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body p-24">
                                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-3">
                                        <li class="d-flex align-items-center gap-2">
                                            <span class="w-12-px h-8-px rounded-pill bg-primary-600"></span>
                                            <span class="text-secondary-light text-sm fw-semibold">New Patient:
                                                <span class="text-primary-light fw-bold">50</span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <span class="w-12-px h-8-px rounded-pill bg-warning-600"></span>
                                            <span class="text-secondary-light text-sm fw-semibold">Old Patient:
                                                <span class="text-primary-light fw-bold"> 500</span>
                                            </span>
                                        </li>
                                    </ul>
                                    <div id="enrollmentChart" class="apexcharts-tooltip-style-1"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Earning Statistic -->

                        <!-- Patient Visited by Depertment -->
                        <div class="col-xxl-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Patient Visited by Depertment</h6>
                                    </div>
                                </div>
                                <div class="card-body p-24 d-flex align-items-center gap-16">
                                    <div id="radialMultipleBar"></div>
                                    <ul class="d-flex flex-column gap-12">
                                        <li>
                                            <span class="text-lg">Cardiology: <span class="text-primary-600 fw-semibold">80%</span> </span>
                                        </li>
                                        <li>
                                            <span class="text-lg">Psychiatry: <span class="text-warning-600 fw-semibold">40%</span> </span>
                                        </li>
                                        <li>
                                            <span class="text-lg">Pediatrics: <span class="text-success-600 fw-semibold">10%</span> </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Patient Visited by Depertment -->

                        <!-- Patient Visit By Gender -->
                        <div class="col-xxl-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Patient Visit By Gender</h6>
                                        <select class="form-select form-select-sm w-auto bg-base border-0 text-secondary-light">
                                            <option>This Month</option>
                                            <option>This Week</option>
                                            <option>This Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body p-24">
                                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-3">
                                        <li class="d-flex align-items-center gap-2">
                                            <span class="w-12-px h-8-px rounded-pill bg-warning-600"></span>
                                            <span class="text-secondary-light text-sm fw-semibold">Male:
                                                <span class="text-primary-light fw-bold">200</span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <span class="w-12-px h-8-px rounded-pill bg-success-600"></span>
                                            <span class="text-secondary-light text-sm fw-semibold">Female:
                                                <span class="text-primary-light fw-bold"> 450</span>
                                            </span>
                                        </li>
                                    </ul>
                                    <div id="paymentStatusChart" class="margin-16-minus y-value-left"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Patient Visit By Gender -->

                        <!-- Top performance Start -->
                        <div class="col-xxl-4">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Doctors List</h6>
                                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                            View All
                                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column gap-24">
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/home-eight/doctor-img1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0">Dr. Davis</h6>
                                                    <span class="text-sm text-secondary-light fw-medium">Cardiology</span>
                                                </div>
                                            </div>
                                            <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Available</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/home-eight/doctor-img2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0">Dr. Riead</h6>
                                                    <span class="text-sm text-secondary-light fw-medium">Orthopedics</span>
                                                </div>
                                            </div>
                                            <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Available</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/home-eight/doctor-img3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0">Albert Flores</h6>
                                                    <span class="text-sm text-secondary-light fw-medium">Ophthalmology</span>
                                                </div>
                                            </div>
                                            <span class="bg-danger-focus text-danger-main px-10 py-4 radius-8 fw-medium text-sm">Not Available</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/home-eight/doctor-img4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0">Dr. Smith</h6>
                                                    <span class="text-sm text-secondary-light fw-medium">Cardiology</span>
                                                </div>
                                            </div>
                                            <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Available</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/home-eight/doctor-img6.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0">Dr. Johnson</h6>
                                                    <span class="text-sm text-secondary-light fw-medium">Cardiology</span>
                                                </div>
                                            </div>
                                            <span class="bg-danger-focus text-danger-main px-10 py-4 radius-8 fw-medium text-sm">Not Available</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/home-eight/doctor-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0">Dr. Martinez</h6>
                                                    <span class="text-sm text-secondary-light fw-medium">Cardiology</span>
                                                </div>
                                            </div>
                                            <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Available</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Top performance End -->

                        <div class="col-xxl-8">
                            <div class="card h-100">
                                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                                    <h6 class="text-lg fw-semibold mb-0">Latest Appointments</h6>
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
                                                    <th scope="col" class="bg-transparent rounded-0">Name</th>
                                                    <th scope="col" class="bg-transparent rounded-0">ID</th>
                                                    <th scope="col" class="bg-transparent rounded-0">Date</th>
                                                    <th scope="col" class="bg-transparent rounded-0">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>General Checkup</td>
                                                    <td>#63254</td>
                                                    <td>27 Mar 2024</td>
                                                    <td> <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Completed</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>Blood test results </td>
                                                    <td>3.053 ETH</td>
                                                    <td>2h 5m 40s</td>
                                                    <td> <span class="bg-danger-focus text-danger-main px-10 py-4 radius-8 fw-medium text-sm">Canceled</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>Heart Checkup</td>
                                                    <td>3.053 ETH</td>
                                                    <td>2h 5m 40s</td>
                                                    <td> <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Completed</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>Vaccination</td>
                                                    <td>3.053 ETH</td>
                                                    <td>2h 5m 40s</td>
                                                    <td> <span class="bg-danger-focus text-danger-main px-10 py-4 radius-8 fw-medium text-sm">Canceled</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>Dental Cleanup</td>
                                                    <td>3.053 ETH</td>
                                                    <td>2h 5m 40s</td>
                                                    <td> <span class="bg-success-focus text-success-main px-10 py-4 radius-8 fw-medium text-sm">Completed</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>Follow up Appointment </td>
                                                    <td>3.053 ETH</td>
                                                    <td>2h 5m 40s</td>
                                                    <td> <span class="bg-danger-focus text-danger-main px-10 py-4 radius-8 fw-medium text-sm">Canceled</span> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Latest Performance End -->
                    </div>
                </div>

                <div class="col-xxxl-3">
                    <div class="row gy-4">
                        <div class="col-xxl-12 col-xl-6">
                            <div class="card h-100 radius-8 border-0">
                                <div class="card-header border-bottom d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                    <h6 class="mb-2 fw-bold text-lg">Total Income</h6>
                                    <div class="">
                                        <select class="form-select form-select-sm w-auto bg-base border-0 text-secondary-light">
                                            <option>This Month</option>
                                            <option>This Week</option>
                                            <option>This Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body p-24">

                                    <div class="position-relative">
                                        <div id="statisticsDonutChart" class="mt-36 flex-grow-1 apexcharts-tooltip-z-none title-style circle-none"></div>
                                        <div class="text-center position-absolute top-50 start-50 translate-middle">
                                            <span class="text-secondary-light">Income</span>
                                            <h6 class="">$28,500</h6>
                                        </div>
                                    </div>

                                    <ul class="row gy-4 mt-3">
                                        <li class="col-6 d-flex flex-column align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-12-px h-8-px rounded-pill bg-warning-600"></span>
                                                <span class="text-secondary-light text-sm fw-normal">Net Income</span>
                                            </div>
                                            <h6 class="text-primary-light fw-bold mb-0">$50,000</h6>
                                        </li>
                                        <li class="col-6 d-flex flex-column align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-12-px h-8-px rounded-pill bg-success-600"></span>
                                                <span class="text-secondary-light text-sm fw-normal">Commission </span>
                                            </div>
                                            <h6 class="text-primary-light fw-bold mb-0">$20,000</h6>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Available Treatments</h6>
                                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                            View All
                                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="w-40-px h-40-px rounded-circle flex-shrink-0 bg-info-50 d-flex justify-content-center align-items-center">
                                                <img src="assets/images/home-eight/treatment-icon1.png" alt="" class="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-normal">Psychiatry</h6>
                                                <span class="text-sm text-secondary-light fw-normal">57 Doctors</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light">08:45 AM</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="w-40-px h-40-px rounded-circle flex-shrink-0 bg-success-50 d-flex justify-content-center align-items-center">
                                                <img src="assets/images/home-eight/treatment-icon2.png" alt="" class="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-normal">Orthopedic</h6>
                                                <span class="text-sm text-secondary-light fw-normal">85 Doctors</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light">08:45 AM</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="w-40-px h-40-px rounded-circle flex-shrink-0 bg-lilac-50 d-flex justify-content-center align-items-center">
                                                <img src="assets/images/home-eight/treatment-icon3.png" alt="" class="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-normal">Cardiology</h6>
                                                <span class="text-sm text-secondary-light fw-normal">60 Doctors</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light">08:45 AM</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="w-40-px h-40-px rounded-circle flex-shrink-0 bg-warning-50 d-flex justify-content-center align-items-center">
                                                <img src="assets/images/home-eight/treatment-icon4.png" alt="" class="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-normal">Pediatrics</h6>
                                                <span class="text-sm text-secondary-light fw-normal">120 Doctors</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light">08:45 AM</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="w-40-px h-40-px rounded-circle flex-shrink-0 bg-danger-50 d-flex justify-content-center align-items-center">
                                                <img src="assets/images/home-eight/treatment-icon5.png" alt="" class="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-normal">Neurology </h6>
                                                <span class="text-sm text-secondary-light fw-normal">25 Doctors</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light">08:45 AM</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-0">
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="w-40-px h-40-px rounded-circle flex-shrink-0 bg-primary-50 d-flex justify-content-center align-items-center">
                                                <img src="assets/images/home-eight/treatment-icon6.png" alt="" class="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-normal">Gastroenterology</h6>
                                                <span class="text-sm text-secondary-light fw-normal">95 Doctors</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light">08:45 AM</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Health Reports Document</h6>
                                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                            View All
                                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column gap-24">
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/home-eight/icon-pdf.png" alt="" class="">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Checkup Result.pdf</h6>
                                                    <span class="text-xs text-secondary-light fw-normal">2.5mb</span>
                                                </div>
                                            </div>
                                            <div class="flex-align gap-12">
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-danger-100 text-danger-600 bg-hover-danger-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                </button>
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-success-100 text-success-600 bg-hover-success-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-download-2-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/home-eight/icon-text.png" alt="" class="">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Checkup Result.doc</h6>
                                                    <span class="text-xs text-secondary-light fw-normal">2mb</span>
                                                </div>
                                            </div>
                                            <div class="flex-align gap-12">
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-danger-100 text-danger-600 bg-hover-danger-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                </button>
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-success-100 text-success-600 bg-hover-success-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-download-2-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/home-eight/icon-pdf.png" alt="" class="">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Prescription.pdf</h6>
                                                    <span class="text-xs text-secondary-light fw-normal">3mb</span>
                                                </div>
                                            </div>
                                            <div class="flex-align gap-12">
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-danger-100 text-danger-600 bg-hover-danger-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                </button>
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-success-100 text-success-600 bg-hover-success-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-download-2-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/home-eight/icon-text.png" alt="" class="">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Xray Result.doc</h6>
                                                    <span class="text-xs text-secondary-light fw-normal">3mb</span>
                                                </div>
                                            </div>
                                            <div class="flex-align gap-12">
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-danger-100 text-danger-600 bg-hover-danger-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                </button>
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-success-100 text-success-600 bg-hover-success-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-download-2-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/home-eight/icon-pdf.png" alt="" class="">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Glucose Level Report.pdf</h6>
                                                    <span class="text-xs text-secondary-light fw-normal">3mb</span>
                                                </div>
                                            </div>
                                            <div class="flex-align gap-12">
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-danger-100 text-danger-600 bg-hover-danger-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                </button>
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-success-100 text-success-600 bg-hover-success-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-download-2-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/home-eight/icon-text.png" alt="" class="">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Checkup Result.doc</h6>
                                                    <span class="text-xs text-secondary-light fw-normal">2mb</span>
                                                </div>
                                            </div>
                                            <div class="flex-align gap-12">
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-danger-100 text-danger-600 bg-hover-danger-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                </button>
                                                <button type="button" class="w-32-px h-32-px d-inline-flex justify-content-center align-items-center bg-success-100 text-success-600 bg-hover-success-600 text-hover-white text-md rounded-circle">
                                                    <i class="ri-download-2-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
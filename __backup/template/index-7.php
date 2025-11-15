<?php $script = '<script>
// ===================== Average Enrollment Rate Start =============================== 
function createChartTwo(chartId, color1, color2) {
    var options = {
        series: [{
            name: "series2",
            data: [20000, 45000, 30000, 50000, 32000, 40000, 30000, 42000, 28000, 34000, 38000, 26000]
        }],
        legend: {
            show: false
        },
        chart: {
            type: "area",
            width: "100%",
            height: 240,
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
            curve: "straight",
            width: 3,
            colors: [color1], // Use two colors for the lines
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
                bottom: 0,
                left: 0
            },
        },
        fill: {
            type: "gradient",
            colors: [color1], // Use two colors for the gradient
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
                opacityFrom: [0.4, 0.4], // Starting opacity for both colors
                opacityTo: [0.1, 0.1], // Ending opacity for both colors
                stops: [0, 100],
            },
        },
        markers: {
            colors: [color1], // Use two colors for the markers
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
                    fontSize: "12px"
                }
            }
        },
        yaxis: {
            labels: {
                // formatter: function (value) {
                //     return "$" + value + "k";
                // },
                style: {
                    fontSize: "12px"
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

createChartTwo("enrollmentChart", "#487FFF");
// ===================== Average Enrollment Rate End =============================== 


// ===================== Delete Table Item Start =============================== 
$(".remove-btn").on("click", function() {
    $(this).closest("tr").addClass("d-none");
});
// ===================== Delete Table Item End =============================== 


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


// ================================ Bar chart Start ================================ 
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
// ================================ Bar chart End ================================ 


// ================================ Follow Btn Start ================================ 
$(".follow-btn").on("click", function() {
    if ($(this).text() === "Follow") {
        $(this).text("Unfollow");
    } else {
        $(this).text("Follow");
    }
    $(this).toggleClass("bg-neutral-200 border-neutral-200 text-neutral-900");
});
// ================================ Follow Btn End ================================ 
</script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body nft-page">

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
            <li class="fw-medium">NFT & Gaming </li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-xxl-8">
            <div class="row gy-4">
                <div class="col-12">
                    <div class="nft-promo-card card radius-12 overflow-hidden position-relative z-1">
                        <img src="assets/images/nft/nft-gradient-bg.png" class="position-absolute start-0 top-0 w-100 h-100 z-n1" alt="">
                        <div class="nft-promo-card__inner d-flex align-items-center">
                            <div class="nft-promo-card__thumb w-100">
                                <img src="assets/images/nft/nf-card-img.png" alt="" class="w-100 h-100 object-fit-cover">
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="mb-16 text-white">Discover The Largest NFTs Marketplace</h4>
                                <p class="text-white text-md">The largest NFT (Non-Fungible Token) marketplace is OpenSea. Established in 2017, OpenSea has grown to become the leading platform for buying, selling, and trading digital assets,</p>
                                <div class="d-flex align-items-center flex-wrap mt-24 gap-16">
                                    <a href="#" class="btn rounded-pill border br-white text-white radius-8 px-32 py-11 hover-bg-white text-hover-neutral-900">Explore</a>
                                    <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-28 py-11">Create Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <h6 class="mb-16">Trending Bids</h6>
                    <div class="row gy-4">
                        <!-- Dashboard Widget Start -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="card px-24 py-16 shadow-none radius-12 border h-100 bg-gradient-start-3">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                        <div class="d-flex align-items-center flex-wrap gap-16">
                                            <span class="mb-0 w-40-px h-40-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                <iconify-icon icon="flowbite:users-group-solid" class="icon"></iconify-icon>
                                            </span>

                                            <div class="flex-grow-1">
                                                <h6 class="fw-semibold mb-0">24,000</h6>
                                                <span class="fw-medium text-secondary-light text-md">Artworks</span>
                                                <p class="text-sm mb-0 d-flex align-items-center flex-wrap gap-12 mt-12">
                                                    <span class="bg-success-focus px-6 py-2 rounded-2 fw-medium text-success-main text-sm d-flex align-items-center gap-8">
                                                        +168.001%
                                                        <i class="ri-arrow-up-line"></i>
                                                    </span> This week
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Dashboard Widget End -->

                        <!-- Dashboard Widget Start -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="card px-24 py-16 shadow-none radius-12 border h-100 bg-gradient-start-5">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                        <div class="d-flex align-items-center flex-wrap gap-16">
                                            <span class="mb-0 w-40-px h-40-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                <iconify-icon icon="flowbite:users-group-solid" class="icon"></iconify-icon>
                                            </span>

                                            <div class="flex-grow-1">
                                                <h6 class="fw-semibold mb-0">82,000</h6>
                                                <span class="fw-medium text-secondary-light text-md">Auction</span>
                                                <p class="text-sm mb-0 d-flex align-items-center flex-wrap gap-12 mt-12">
                                                    <span class="bg-danger-focus px-6 py-2 rounded-2 fw-medium text-danger-main text-sm d-flex align-items-center gap-8">
                                                        +168.001%
                                                        <i class="ri-arrow-down-line"></i>
                                                    </span> This week
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Dashboard Widget End -->

                        <!-- Dashboard Widget Start -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="card px-24 py-16 shadow-none radius-12 border h-100 bg-gradient-start-2">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                                        <div class="d-flex align-items-center flex-wrap gap-16">
                                            <span class="mb-0 w-40-px h-40-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                                <iconify-icon icon="flowbite:users-group-solid" class="icon"></iconify-icon>
                                            </span>

                                            <div class="flex-grow-1">
                                                <h6 class="fw-semibold mb-0">800</h6>
                                                <span class="fw-medium text-secondary-light text-md">Creators</span>
                                                <p class="text-sm mb-0 d-flex align-items-center flex-wrap gap-12 mt-12">
                                                    <span class="bg-success-focus px-6 py-2 rounded-2 fw-medium text-success-main text-sm d-flex align-items-center gap-8">
                                                        +168.001%
                                                        <i class="ri-arrow-up-line"></i>
                                                    </span> This week
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Dashboard Widget End -->
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-16 mt-8 d-flex flex-wrap justify-content-between gap-16">
                        <h6 class="mb-0">Trending NFTs</h6>
                        <ul class="nav button-tab nav-pills mb-16 gap-12" id="pills-tab-three" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-semibold text-secondary-light rounded-pill px-20 py-6 border border-neutral-300 active" id="pills-button-all-tab" data-bs-toggle="pill" data-bs-target="#pills-button-all" type="button" role="tab" aria-controls="pills-button-all" aria-selected="false" tabindex="-1">All</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-semibold text-secondary-light rounded-pill px-20 py-6 border border-neutral-300" id="pills-button-art-tab" data-bs-toggle="pill" data-bs-target="#pills-button-art" type="button" role="tab" aria-controls="pills-button-art" aria-selected="false" tabindex="-1">Art</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-semibold text-secondary-light rounded-pill px-20 py-6 border border-neutral-300" id="pills-button-music-tab" data-bs-toggle="pill" data-bs-target="#pills-button-music" type="button" role="tab" aria-controls="pills-button-music" aria-selected="false" tabindex="-1">Music</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-semibold text-secondary-light rounded-pill px-20 py-6 border border-neutral-300" id="pills-button-utility-tab" data-bs-toggle="pill" data-bs-target="#pills-button-utility" type="button" role="tab" aria-controls="pills-button-utility" aria-selected="true">Utility</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-semibold text-secondary-light rounded-pill px-20 py-6 border border-neutral-300" id="pills-button-fashion-tab" data-bs-toggle="pill" data-bs-target="#pills-button-fashion" type="button" role="tab" aria-controls="pills-button-fashion" aria-selected="true">Fashion</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tab-threeContent">
                        <div class="tab-pane fade show active" id="pills-button-all" role="tabpanel" aria-labelledby="pills-button-all-tab" tabindex="0">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">Fantastic Alien</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img1.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img2.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img3.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img4.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-button-art" role="tabpanel" aria-labelledby="pills-button-art-tab" tabindex="0">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">Fantastic Alien</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img1.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img2.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img3.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img4.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-button-music" role="tabpanel" aria-labelledby="pills-button-music-tab" tabindex="0">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">Fantastic Alien</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img1.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img2.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img3.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img4.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-button-utility" role="tabpanel" aria-labelledby="pills-button-utility-tab" tabindex="0">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">Fantastic Alien</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img1.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img2.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img3.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img4.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-button-fashion" role="tabpanel" aria-labelledby="pills-button-fashion-tab" tabindex="0">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">Fantastic Alien</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img1.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img2.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img3.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-sm-6 col-xs-6">
                                    <div class="nft-card bg-base radius-16 overflow-hidden">
                                        <div class="radius-16 overflow-hidden">
                                            <img src="assets/images/nft/nft-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="p-10">
                                            <h6 class="text-md fw-bold text-primary-light">New Figures</h6>
                                            <div class="d-flex align-items-center gap-8">
                                                <img src="assets/images/nft/nft-user-img4.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                <span class="text-sm text-secondary-light fw-medium">Watson Kristin</span>
                                            </div>
                                            <div class="mt-10 d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                                <span class="text-sm text-secondary-light fw-medium">Price:
                                                    <span class="text-sm text-primary-light fw-semibold">1.44 ETH</span>
                                                </span>
                                                <span class="text-sm fw-semibold text-primary-600">$4,224.96</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mt-12 gap-8">
                                                <a href="#" class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">History</a>
                                                <a href="#" class="btn rounded-pill btn-primary-600 radius-8 px-12 py-6 flex-grow-1">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Recent Bid</h6>
                                <select class="form-select form-select-sm w-auto bg-base border text-secondary-light rounded-pill">
                                    <option>All Items </option>
                                    <option>New Item</option>
                                    <option>Trending Item</option>
                                    <option>Old Item</option>
                                </select>
                            </div>
                            <div class="table-responsive scroll-sm">
                                <div class="table-responsive scroll-sm">
                                    <table class="table bordered-table sm-table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Items </th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Your Offer </th>
                                                <th scope="col">Recent Offer</th>
                                                <th scope="col">Time Left</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-items-img1.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold">Spanky & Friends</h6>
                                                            <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.44 ETH</td>
                                                <td>3.053 ETH</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-offer-img1.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold text-primary-light">1.44.00 ETH</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>2h 5m 40s</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center gap-12">
                                                        <button type="button" class="text-xl text-success-600"><i class="ri-edit-line"></i></button>
                                                        <button type="button" class="text-xl text-danger-600 remove-btn"><i class="ri-delete-bin-6-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-items-img2.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold">Nike Air Shoe</h6>
                                                            <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.44 ETH</td>
                                                <td>3.053 ETH</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-offer-img2.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold text-primary-light">1.44.00 ETH</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>2h 5m 40s</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center gap-12">
                                                        <button type="button" class="text-xl text-success-600"><i class="ri-edit-line"></i></button>
                                                        <button type="button" class="text-xl text-danger-600 remove-btn"><i class="ri-delete-bin-6-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-items-img3.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold">Woman Dresses</h6>
                                                            <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.44 ETH</td>
                                                <td>3.053 ETH</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-offer-img3.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold text-primary-light">1.44.00 ETH</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>2h 5m 40s</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center gap-12">
                                                        <button type="button" class="text-xl text-success-600"><i class="ri-edit-line"></i></button>
                                                        <button type="button" class="text-xl text-danger-600 remove-btn"><i class="ri-delete-bin-6-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-items-img4.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold">Smart Watch</h6>
                                                            <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.44 ETH</td>
                                                <td>3.053 ETH</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-offer-img4.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold text-primary-light">1.44.00 ETH</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>2h 5m 40s</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center gap-12">
                                                        <button type="button" class="text-xl text-success-600"><i class="ri-edit-line"></i></button>
                                                        <button type="button" class="text-xl text-danger-600 remove-btn"><i class="ri-delete-bin-6-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-items-img5.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold">Hoodie Rose</h6>
                                                            <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.44 ETH</td>
                                                <td>3.053 ETH</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-offer-img5.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold text-primary-light">1.44.00 ETH</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>2h 5m 40s</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center gap-12">
                                                        <button type="button" class="text-xl text-success-600"><i class="ri-edit-line"></i></button>
                                                        <button type="button" class="text-xl text-danger-600 remove-btn"><i class="ri-delete-bin-6-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-items-img6.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold">Hoodie Rose</h6>
                                                            <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.44 ETH</td>
                                                <td>3.053 ETH</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-offer-img6.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold text-primary-light">1.44.00 ETH</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>2h 5m 40s</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center gap-12">
                                                        <button type="button" class="text-xl text-success-600"><i class="ri-edit-line"></i></button>
                                                        <button type="button" class="text-xl text-danger-600 remove-btn"><i class="ri-delete-bin-6-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-items-img2.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold">Hoodie Rose</h6>
                                                            <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.44 ETH</td>
                                                <td>3.053 ETH</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/nft/nft-offer-img7.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-md mb-0 fw-semibold text-primary-light">1.44.00 ETH</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>2h 5m 40s</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center gap-12">
                                                        <button type="button" class="text-xl text-success-600"><i class="ri-edit-line"></i></button>
                                                        <button type="button" class="text-xl text-danger-600 remove-btn"><i class="ri-delete-bin-6-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4">
            <div class="row gy-4">
                <div class="col-xxl-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header border-bottom d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="fw-bold text-lg mb-0">ETH Price</h6>
                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light rounded-pill">
                                <option>November </option>
                                <option>December</option>
                                <option>January</option>
                                <option>February</option>
                                <option>March</option>
                                <option>April</option>
                                <option>May</option>
                                <option>June</option>
                                <option>July</option>
                                <option>August</option>
                                <option>September</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div id="enrollmentChart" class="apexcharts-tooltip-style-1 yaxies-more"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header border-bottom d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="fw-bold text-lg mb-0">Statistics</h6>
                            <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-1 justify-content-between mb-44">
                                <div>
                                    <h5 class="fw-semibold mb-12">145</h5>
                                    <span class="text-secondary-light fw-normal text-xl">Total Art Sold</span>
                                </div>
                                <div id="dailyIconBarChart"></div>
                            </div>
                            <div class="d-flex align-items-center gap-1 justify-content-between">
                                <div>
                                    <h5 class="fw-semibold mb-12">750 ETH</h5>
                                    <span class="text-secondary-light fw-normal text-xl">Total Earnings</span>
                                </div>
                                <div id="areaChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header border-bottom d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="fw-bold text-lg mb-0">Featured Creators</h6>
                            <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between gap-8 flex-wrap">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/nft/nft-items-img1.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-semibold">Theresa Webb</h6>
                                        <span class="text-sm text-secondary-light fw-normal">Owned by ABC</span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary-600 px-24 rounded-pill">Follow</button>
                            </div>
                            <div class="mt-24">
                                <div class="row gy-3">
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="nft-card bg-base radius-16 overflow-hidden shadow-4">
                                            <div class="radius-16 overflow-hidden">
                                                <img src="assets/images/nft/featured-creator1.png" alt="" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <div class="p-12">
                                                <h6 class="text-md fw-bold text-primary-light mb-12">New Figures</h6>
                                                <div class="d-flex align-items-center gap-8">
                                                    <img src="assets/images/nft/bitcoin.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                    <span class="text-sm text-secondary-light fw-medium">0.10 BTC</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="nft-card bg-base radius-16 overflow-hidden shadow-4">
                                            <div class="radius-16 overflow-hidden">
                                                <img src="assets/images/nft/featured-creator2.png" alt="" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <div class="p-12">
                                                <h6 class="text-md fw-bold text-primary-light mb-12">Abstrac Girl</h6>
                                                <div class="d-flex align-items-center gap-8">
                                                    <img src="assets/images/nft/bitcoin.png" class="w-28-px h-28-px rounded-circle object-fit-cover" alt="">
                                                    <span class="text-sm text-secondary-light fw-medium">0.10 BTC</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header border-bottom d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="fw-bold text-lg mb-0">Featured Creators</h6>
                            <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>
                        <div class="card-body pt-24">
                            <div class="d-flex align-items-center justify-content-between gap-8 flex-wrap mb-32">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/nft/creator-img1.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-semibold">Theresa Webb</h6>
                                        <span class="text-sm text-secondary-light fw-normal">@wishon</span>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-primary-600 border-primary-600 text-white px-24 rounded-pill follow-btn transition-2">Follow</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-8 flex-wrap mb-32">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/nft/creator-img2.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-semibold">Arlene McCoy</h6>
                                        <span class="text-sm text-secondary-light fw-normal">@nemccoy</span>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-primary-600 border-primary-600 text-white px-24 rounded-pill follow-btn transition-2">Follow</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-8 flex-wrap mb-32">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/nft/creator-img3.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-semibold">Kathryn Murphy</h6>
                                        <span class="text-sm text-secondary-light fw-normal">@kathrynmur</span>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-primary-600 border-primary-600 text-white px-24 rounded-pill follow-btn transition-2">Follow</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-8 flex-wrap mb-32">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/nft/creator-img4.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-semibold">Marvin McKinney</h6>
                                        <span class="text-sm text-secondary-light fw-normal">@marvinckin</span>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-primary-600 border-primary-600 text-white px-24 rounded-pill follow-btn transition-2">Follow</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-8 flex-wrap mb-0">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/nft/creator-img5.png" alt="" class="flex-shrink-0 me-12 w-40-px h-40-px rounded-circle me-12">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-semibold">Dianne Russell</h6>
                                        <span class="text-sm text-secondary-light fw-normal">@dinne_r</span>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-primary-600 border-primary-600 text-white px-24 rounded-pill follow-btn transition-2">Follow</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
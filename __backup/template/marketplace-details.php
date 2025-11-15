<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Marketplace Details</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Marketplace Details</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-xxl-9 col-lg-8">
                    <div class="card h-100 p-0 radius-12">
                        <div class="card-body px-24 py-32">

                            <div class="d-flex align-items-center justify-content-between mb-24">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/crypto/bitcoin.png" alt="" class="w-72-px h-72-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                    <div class="flex-grow-1 d-flex flex-column">
                                        <h4 class="mb-4">Bitcoin <span class="text-md text-neutral-400 fw-semibold">BTC</span> </h4>
                                        <span class="text-md mb-0 fw-medium text-neutral-500 d-block">Currency in USD. Market Open</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-24">
                                    <div class="d-flex flex-column align-items-end">
                                        <div class="d-flex align-items-center gap-8 mb-4">
                                            <h6 class="mb-0">$0.32533</h6>
                                            <span class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1 d-flex align-items-center gap-1">
                                                <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> 10%
                                            </span>
                                        </div>
                                        <div class="">
                                            <span class="fw-semibold text-secondary-light text-sm">+0,021301</span>
                                            <span class="fw-semibold text-success-600 text-sm">(+6.42%)</span>
                                        </div>
                                    </div>
                                    <button type="button" class="star-btn w-48-px h-48-px d-flex justify-content-center align-items-center border radius-8 text-2xl text-neutral-400 text-hover-primary-600 line-height-1">
                                        <i class="ri-star-line"></i>
                                    </button>
                                </div>
                            </div>

                            <h6 class="mb-16">About</h6>
                            <p class="text-secondary-light">IoT Chain (ITC) is a cryptocurrency and operates on the Ethereum platform. IoT Chain has a current supply of 99,999,999 with 87,214,657.4756 in circulation. The last known price of IoT Chain is 0.01318397 USD and is up 0.00 over the last 24 hours. It is currently trading on 5 active market(s) with $0.00 traded over the last 24 hours. More information can be found at https://iotchain.io/.</p>


                            <div class="my-24">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <h6 class="text-lg mb-0">Bitcoin Chain Price</h6>
                                    <select class="form-select bg-base form-select-sm w-auto radius-8">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>

                                <div class="">
                                    <div id="timeSeriesChart" class="apexcharts-tooltip-style-1"></div>
                                </div>
                            </div>

                            <!-- Table Start -->
                            <div class="border radius-12 p-24">
                                <h6 class="text-md mb-16">Market Stats</h6>
                                <div class="table-responsive scroll-sm">
                                    <table class="table bordered-table rounded-table sm-table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Market Cap</th>
                                                <th scope="col">Volume (24H)</th>
                                                <th scope="col">Circulating Supply</th>
                                                <th scope="col">Max Supply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h6 class="text-md mb-4">$1.15M</h6>
                                                    <span class="text-neutral-500 text-sm">39% of crypto market</span>
                                                </td>
                                                <td>
                                                    <h6 class="text-md mb-4">$146.36k</h6>
                                                    <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                                        <i class="ri-arrow-up-s-fill"></i>
                                                        1.37%
                                                    </span>
                                                </td>
                                                <td>
                                                    <h6 class="text-md mb-4">807.21M ITC</h6>
                                                    <span class="text-neutral-500 text-sm">91% of crypto market</span>
                                                </td>
                                                <td>
                                                    <h6 class="text-md mb-4">10B ITC</h6>
                                                    <div class="d-flex align-items-center gap-8 w-100-px">
                                                        <div class="progress w-100  bg-primary-50 rounded-pill h-4-px" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 50%"></div>
                                                        </div>
                                                        <span class="text-neutral-500 text-sm">8%</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Table End -->
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-0">
                            <div class="p-24 border-bottom">
                                <ul class="nav nav-pills style-three pill-tab border input-form-light p-0 radius-8 bg-neutral-50" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8 active" id="pills-Buy-tab" data-bs-toggle="pill" data-bs-target="#pills-Buy" type="button" role="tab" aria-controls="pills-Buy" aria-selected="true">Buy</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8" id="pills-Sell-tab" data-bs-toggle="pill" data-bs-target="#pills-Sell" type="button" role="tab" aria-controls="pills-Sell" aria-selected="false">Sell</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8" id="pills-Convert-tab" data-bs-toggle="pill" data-bs-target="#pills-Convert" type="button" role="tab" aria-controls="pills-Convert" aria-selected="false">Convert</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-Buy" role="tabpanel" aria-labelledby="pills-Buy-tab" tabindex="0">
                                        <div class="">
                                            <div class="text-center mt-24">
                                                <h3 class="text-neutral-400 mb-16">$0</h3>
                                                <span class="text-neutral-500 text-sm">You can buy up to $25,000</span>
                                            </div>
                                            <div class="mt-24 border radius-8 position-relative">
                                                <button type="button" class="bg-primary-600 w-40-px h-40-px rounded-circle border border-3 border-primary-100 d-flex justify-content-center align-items-center text-white position-absolute top-50 translate-middle-y end-0 me-60">
                                                    <i class="ri-arrow-up-down-line"></i>
                                                </button>
                                                <div class="p-16 d-flex align-items-center border-bottom">
                                                    <span class="text-neutral-500 fw-medium w-76-px border-end">Buy</span>
                                                    <div class="d-flex align-items-center justify-content-between flex-grow-1 ps-16">
                                                        <div class="d-flex align-items-center gap-8">
                                                            <img src="assets/images/crypto/crypto-img1.png" alt="" class="w-24-px h-24-px rounded-circle flex-shrink-0 overflow-hidden">
                                                            <div class="flex-grow-1 d-flex flex-column">
                                                                <span class="text-sm mb-0 fw-medium text-primary-light d-block">ITC</span>
                                                            </div>
                                                        </div>
                                                        <a href="" class="text-md text-neutral-500 text-hover-primary-600"><i class="ri-arrow-right-s-line"></i></a>
                                                    </div>
                                                </div>
                                                <div class="p-16 d-flex align-items-center">
                                                    <span class="text-neutral-500 fw-medium w-76-px border-end">Pay with</span>
                                                    <div class="d-flex align-items-center justify-content-between flex-grow-1 ps-16">
                                                        <div class="d-flex align-items-center gap-8">
                                                            <img src="assets/images/crypto/paypal.png" alt="" class="w-24-px h-24-px rounded-circle flex-shrink-0 overflow-hidden">
                                                            <div class="flex-grow-1 d-flex flex-column">
                                                                <span class="text-sm mb-0 fw-medium text-primary-light d-block">Paypal</span>
                                                            </div>
                                                        </div>
                                                        <a href="" class="text-md text-neutral-500 text-hover-primary-600"><i class="ri-arrow-right-s-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-8 mt-24 pb-8" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                Buy
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-Sell" role="tabpanel" aria-labelledby="pills-Sell-tab" tabindex="0">
                                        <div class="">
                                            <div class="text-center mt-24">
                                                <h3 class="text-neutral-400 mb-16">$0</h3>
                                                <span class="text-neutral-500 text-sm">You can buy up to $25,000</span>
                                            </div>
                                            <div class="mt-24 border radius-8 position-relative">
                                                <button type="button" class="bg-primary-600 w-40-px h-40-px rounded-circle border border-3 border-primary-100 d-flex justify-content-center align-items-center text-white position-absolute top-50 translate-middle-y end-0 me-60">
                                                    <i class="ri-arrow-up-down-line"></i>
                                                </button>
                                                <div class="p-16 d-flex align-items-center border-bottom">
                                                    <span class="text-neutral-500 fw-medium w-76-px border-end">Buy</span>
                                                    <div class="d-flex align-items-center justify-content-between flex-grow-1 ps-16">
                                                        <div class="d-flex align-items-center gap-8">
                                                            <img src="assets/images/crypto/crypto-img1.png" alt="" class="w-24-px h-24-px rounded-circle flex-shrink-0 overflow-hidden">
                                                            <div class="flex-grow-1 d-flex flex-column">
                                                                <span class="text-sm mb-0 fw-medium text-primary-light d-block">ITC</span>
                                                            </div>
                                                        </div>
                                                        <a href="" class="text-md text-neutral-500 text-hover-primary-600"><i class="ri-arrow-right-s-line"></i></a>
                                                    </div>
                                                </div>
                                                <div class="p-16 d-flex align-items-center">
                                                    <span class="text-neutral-500 fw-medium w-76-px border-end">Pay with</span>
                                                    <div class="d-flex align-items-center justify-content-between flex-grow-1 ps-16">
                                                        <div class="d-flex align-items-center gap-8">
                                                            <img src="assets/images/crypto/paypal.png" alt="" class="w-24-px h-24-px rounded-circle flex-shrink-0 overflow-hidden">
                                                            <div class="flex-grow-1 d-flex flex-column">
                                                                <span class="text-sm mb-0 fw-medium text-primary-light d-block">Paypal</span>
                                                            </div>
                                                        </div>
                                                        <a href="" class="text-md text-neutral-500 text-hover-primary-600"><i class="ri-arrow-right-s-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-8 mt-24 pb-8" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                Buy
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-Convert" role="tabpanel" aria-labelledby="pills-Convert-tab" tabindex="0">
                                        <div class="">
                                            <div class="text-center mt-24">
                                                <h3 class="text-neutral-400 mb-16">$0</h3>
                                                <span class="text-neutral-500 text-sm">You can buy up to $25,000</span>
                                            </div>
                                            <div class="mt-24 border radius-8 position-relative">
                                                <button type="button" class="bg-primary-600 w-40-px h-40-px rounded-circle border border-3 border-primary-100 d-flex justify-content-center align-items-center text-white position-absolute top-50 translate-middle-y end-0 me-60">
                                                    <i class="ri-arrow-up-down-line"></i>
                                                </button>
                                                <div class="p-16 d-flex align-items-center border-bottom">
                                                    <span class="text-neutral-500 fw-medium w-76-px border-end">Buy</span>
                                                    <div class="d-flex align-items-center justify-content-between flex-grow-1 ps-16">
                                                        <div class="d-flex align-items-center gap-8">
                                                            <img src="assets/images/crypto/crypto-img1.png" alt="" class="w-24-px h-24-px rounded-circle flex-shrink-0 overflow-hidden">
                                                            <div class="flex-grow-1 d-flex flex-column">
                                                                <span class="text-sm mb-0 fw-medium text-primary-light d-block">ITC</span>
                                                            </div>
                                                        </div>
                                                        <a href="" class="text-md text-neutral-500 text-hover-primary-600"><i class="ri-arrow-right-s-line"></i></a>
                                                    </div>
                                                </div>
                                                <div class="p-16 d-flex align-items-center">
                                                    <span class="text-neutral-500 fw-medium w-76-px border-end">Pay with</span>
                                                    <div class="d-flex align-items-center justify-content-between flex-grow-1 ps-16">
                                                        <div class="d-flex align-items-center gap-8">
                                                            <img src="assets/images/crypto/paypal.png" alt="" class="w-24-px h-24-px rounded-circle flex-shrink-0 overflow-hidden">
                                                            <div class="flex-grow-1 d-flex flex-column">
                                                                <span class="text-sm mb-0 fw-medium text-primary-light d-block">Paypal</span>
                                                            </div>
                                                        </div>
                                                        <a href="" class="text-md text-neutral-500 text-hover-primary-600"><i class="ri-arrow-right-s-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-8 mt-24 pb-8" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                Buy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="px-24 py-20">
                                <div class="d-flex align-items-center justify-content-between gap-8 pb-24 border-bottom">
                                    <h6 class="text-lg mb-0">Watchlist</h6>
                                    <a href="#" class="text-primary-600 fw-medium text-md">Sell all</a>
                                </div>

                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-8 py-16 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/crypto/crypto-img1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                        <div class="flex-grow-1 d-flex flex-column">
                                            <span class="text-md mb-0 fw-medium text-primary-light d-block">Bitcoin</span>
                                            <span class="text-xs mb-0 fw-normal text-secondary-light">BTC</span>
                                        </div>
                                    </div>
                                    <div class=" d-flex flex-column">
                                        <span class="text-md mb-0 fw-medium text-primary-light d-block">$1,236.21</span>
                                        <span class="text-xs mb-0 fw-normal text-secondary-light">1.4363 BTC </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-8 py-16 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/crypto/crypto-img2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                        <div class="flex-grow-1 d-flex flex-column">
                                            <span class="text-md mb-0 fw-medium text-primary-light d-block">Ethereum</span>
                                            <span class="text-xs mb-0 fw-normal text-secondary-light">ETH</span>
                                        </div>
                                    </div>
                                    <div class=" d-flex flex-column">
                                        <span class="text-md mb-0 fw-medium text-primary-light d-block">$1,236.21</span>
                                        <span class="text-xs mb-0 fw-normal text-secondary-light">1.4363 ETH </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-8 py-16 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/crypto/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                        <div class="flex-grow-1 d-flex flex-column">
                                            <span class="text-md mb-0 fw-medium text-primary-light d-block">Dogecoin</span>
                                            <span class="text-xs mb-0 fw-normal text-secondary-light">DOGE</span>
                                        </div>
                                    </div>
                                    <div class=" d-flex flex-column">
                                        <span class="text-md mb-0 fw-medium text-primary-light d-block">$1,658</span>
                                        <span class="text-xs mb-0 fw-normal text-secondary-light">1.4363 DOGE</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-8 py-16">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/crypto/crypto-img6.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                        <div class="flex-grow-1 d-flex flex-column">
                                            <span class="text-md mb-0 fw-medium text-primary-light d-block">Digibyte</span>
                                            <span class="text-xs mb-0 fw-normal text-secondary-light">DGB</span>
                                        </div>
                                    </div>
                                    <div class=" d-flex flex-column">
                                        <span class="text-md mb-0 fw-medium text-primary-light d-block">$165,8</span>
                                        <span class="text-xs mb-0 fw-normal text-secondary-light">1.4363 DGB</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include './partials/footer.php' ?>

    </main>

    <!-- Modal Edit Currecny -->
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-body px-32 py-56">
                    <div class="text-center">
                        <span class="w-100-px h-100-px bg-success-600 rounded-circle d-inline-flex justify-content-center align-items-center text-2xxl mb-32 text-white">
                            <i class="ri-check-line"></i>
                        </span>
                        <h5 class="mb-8 text-2xl">Your purchase was successful!</h5>
                        <p class="text-neutral-500 mb-0"> <span class="text-primary-600">16.2665 ITC</span> will be available in your portfolio on 10-10-2022</p>
                        <a href="index.php" class="btn btn-primary-600 mt-32 px-24">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $script = '<script>
    $(".star-btn").on("click", function() {
        if ($(this).children().hasClass("ri-star-line")) {
            $(this).children().removeClass("ri-star-line");
            $(this).children().addClass("ri-star-fill text-primary-600");
        } else {
            $(this).children().removeClass("ri-star-fill text-primary-600");
            $(this).children().addClass("ri-star-line");
        }
    });

    // Sample data
    var dates = [
        [1327359600000, 30.95],
        [1327446000000, 31.34],
        [1327532400000, 31.18],
        [1327618800000, 31.05],
        [1327878000000, 31.00],
        [1327964400000, 30.95],
        [1328050800000, 31.24],
        [1328137200000, 31.29],
        [1328223600000, 31.85],
        [1328482800000, 31.86],
        [1328569200000, 32.28],
        [1328655600000, 32.10],
        [1328742000000, 32.65],
        [1328828400000, 32.21],
        [1329087600000, 32.35],
        [1329174000000, 32.44],
        [1329260400000, 32.46],
        [1329346800000, 32.86],
        [1329433200000, 32.75],
        [1329778800000, 32.54],
        [1329865200000, 32.33],
        [1329951600000, 32.97],
        [1330038000000, 33.41],
        [1330297200000, 33.27],
        [1330383600000, 33.27],
        [1330470000000, 32.89],
        [1330556400000, 33.10],
        [1330642800000, 33.73],
    ];

    // Zoomable Time Series Chart Start
    var options = {
        series: [{
            name: "Bitcoin",
            data: dates
        }],
        chart: {
            type: "area",
            stacked: false,
            height: 350,
            zoom: {
                type: "x",
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                show: false
            },
        },
        stroke: {
            curve: "straight",
            width: 2,
            color: ["#000"],
            lineCap: "round",
        },
        dataLabels: {
            enabled: false
        },
        markers: {
            size: 0,
        },
        grid: {
            borderColor: "#D1D5DB",
            strokeDashArray: 3,
        },
        fill: {
            type: "gradient",
            gradient: {
                type: "vertical", // Gradient direction (vertical)
                shadeIntensity: 1, // Intensity of the gradient shading
                gradientToColors: ["#487FFF"], // Bottom gradient color (with transparency)
                inverseColors: false, // Do not invert colors
                opacityFrom: .4, // Starting opacity
                opacityTo: .1, // Ending opacity
                stops: [0, 100],
            },
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return (val / 1000000).toFixed(0);
                },
            },
            title: {
                text: "Price"
            },
        },
        xaxis: {
            type: "datetime",
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return (val / 1000000).toFixed(0);
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#timeSeriesChart"), options);
    chart.render();
    // Zoomable Time Series Chart End
    </script>';?>


    <?php include './partials/scripts.php' ?>

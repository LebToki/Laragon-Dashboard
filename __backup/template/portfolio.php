<?php $script = '<script>
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

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Portfolios</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Portfolios</li>
                </ul>
            </div>

            <div class="card h-100 p-0 radius-12">
                <div class="card-body p-24">
                    <!-- Card Top Start -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-36">
                        <div class="">
                            <span class="text-secondary-light fw-medium text-sm mb-4">PORTFOLIO VALUE</span>
                            <div class="d-flex align-items-center gap-8">
                                <h4 class="text-lg mb-0">$5,260</h4>
                                <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                    <i class="ri-arrow-up-s-fill"></i>
                                    1.37%
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-16">
                            <select class="form-select bg-base form-select-sm w-auto radius-8">
                                <option>All coins</option>
                                <option>Bitcoin</option>
                                <option>Litecoin</option>
                                <option>Dogecoin</option>
                            </select>
                            <select class="form-select bg-base form-select-sm w-auto radius-8">
                                <option>Yearly</option>
                                <option>Monthly</option>
                                <option>Weekly</option>
                                <option>Today</option>
                            </select>
                        </div>
                    </div>
                    <!-- Card Top End -->

                    <!-- Chart Start -->
                    <div id="timeSeriesChart"></div>
                    <!-- Chart End -->

                    <h6 class="text-xl mb-16">Your Assets</h6>
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                            </div>
                                            S.L
                                        </div>
                                    </th>
                                    <th scope="col">Aset</th>
                                    <th scope="col">Your Assets</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Change %</th>
                                    <th scope="col">Allocation</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="01">
                                            </div>
                                            01
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Bitcoin</span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">BTC</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.3464 BTC</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="02">
                                            </div>
                                            02
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Ethereum</span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">ETH</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 ETH</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="03">
                                            </div>
                                            03
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Litecoin</span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">LTC</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 LTC</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="04">
                                            </div>
                                            04
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Binance</span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">BNB</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 BNB</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 70%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="05">
                                            </div>
                                            05
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img6.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Dogecoin</span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">DOGE</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 DOGE</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="06">
                                            </div>
                                            06
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Polygon </span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">MATIC</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 MATIC</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="066">
                                            </div>
                                            06
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Polygon </span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">MATIC</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 MATIC</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="016">
                                            </div>
                                            06
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Polygon </span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">MATIC</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 MATIC</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="026">
                                            </div>
                                            06
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Polygon </span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">MATIC</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 MATIC</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="061">
                                            </div>
                                            06
                                        </div>
                                    </td>
                                    <td>
                                        <a href="marketplace-details.php" class="d-flex align-items-center">
                                            <img src="assets/images/crypto/crypto-img5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <span class="flex-grow-1 d-flex flex-column">
                                                <span class="text-md mb-0 fw-medium text-primary-light d-block">Polygon </span>
                                                <span class="text-xs mb-0 fw-normal text-secondary-light">MATIC</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>0.5464 MATIC</td>
                                    <td>$2,753.00</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress w-100  bg-primary-50 rounded-pill h-8-px" role="progressbar" aria-label="Basic example" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="py-4 px-16 text-primary-600 bg-primary-50 radius-4">Buy / Sell</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                        <span>Showing 1 to 10 of 12 entries</span>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md bg-primary-600 text-white" href="javascript:void(0)">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">
                                    <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

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

    // Function to render chart
    function renderChart(containerId, strokeColor, gradientToColor) {
        var options = {
            series: [{
                name: "Bitcoin",
                data: dates
            }],
            chart: {
                type: "area",
                stacked: false,
                width: 76,
                height: 40,
                sparkline: {
                    enabled: true // Remove whitespace
                },
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
                colors: [strokeColor],
                lineCap: "round",
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
                colors: [strokeColor],
                strokeWidth: 2,
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
                    gradientToColors: [gradientToColor], // Bottom gradient color (with transparency)
                    inverseColors: false, // Do not invert colors
                    opacityFrom: .4, // Starting opacity
                    opacityTo: .1, // Ending opacity
                    stops: [0, 100],
                },
            },
            yaxis: {
                labels: {
                    show: false,
                    formatter: function(val) {
                        return (val / 1000000).toFixed(0);
                    },
                },
            },
            xaxis: {
                type: "datetime",
                labels: {
                    show: false
                },
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

        var chart = new ApexCharts(document.querySelector("#" + containerId), options);
        chart.render();
    }

    // Render 10 charts with different colors
    renderChart("timeSeriesChart1", "#45B369", "#45B369");
    renderChart("timeSeriesChart2", "#45B369", "#45B369");
    renderChart("timeSeriesChart3", "#45B369", "#45B369");
    renderChart("timeSeriesChart4", "#45B369", "#45B369");
    renderChart("timeSeriesChart5", "#EF4A00", "#EF4A00");
    renderChart("timeSeriesChart6", "#45B369", "#45B369");
    renderChart("timeSeriesChart7", "#EF4A00", "#EF4A00");
    renderChart("timeSeriesChart8", "#45B369", "#45B369");
    renderChart("timeSeriesChart9", "#EF4A00", "#EF4A00");
    renderChart("timeSeriesChart10", "#45B369", "#45B369");
    </script>';?>


<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Marketplace</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Marketplace</li>
                </ul>
            </div>
            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
                        <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                        <form class="navbar-search">
                            <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>
                        <button type="button" class="btn border py-8 text-secondary-light fw-medium bg-hover-neutral-50 radius-8">Watchlist</button>
                    </div>
                    <a href="portfolio.php" class="btn btn-primary text-sm btn-sm px-24 py-10 radius-8">
                        Portfolios
                    </a>
                </div>
                <div class="card-body p-24">
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
                                    <th scope="col">Circulating Supply</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Market Cap</th>
                                    <th scope="col">Change %</th>
                                    <th scope="col">Last (24H)</th>
                                    <th scope="col" class="text-center">Watchlist</th>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart1" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart2" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart3" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-success-focus text-success-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-up-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart4" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart5" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart6" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart7" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart8" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart9" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
                                    <td>$361.32B</td>
                                    <td>
                                        <span class="bg-danger-focus text-danger-600 px-16 py-6 rounded-pill fw-semibold text-xs">
                                            <i class="ri-arrow-down-s-fill"></i>
                                            1.37%
                                        </span>
                                    </td>
                                    <td>
                                        <div id="timeSeriesChart10" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="star-btn text-2xl text-neutral-400 text-hover-primary-600 line-height-1"><i class="ri-star-line"></i></button>
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
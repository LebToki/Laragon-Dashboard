<?php $script = '<script src="assets/js/pieChartPageChart.js"></script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Pie Chart</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Pie Chart</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Basic Pie Chart</h6>
                        </div>
                        <div class="card-body p-24 text-center">
                            <div id="pieChart" class="d-flex justify-content-center apexcharts-tooltip-z-none"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Donut Chart</h6>
                        </div>
                        <div class="card-body p-24 text-center d-flex flex-wrap align-items-start gap-5 justify-content-center">
                            <div class="position-relative">
                                <div id="basicDonutChart" class="w-auto d-inline-block apexcharts-tooltip-z-none"></div>
                                <div class="position-absolute start-50 top-50 translate-middle">
                                    <span class="text-lg text-secondary-light fw-medium">Total Value</span>
                                    <h4 class="mb-0">72</h4>
                                </div>
                            </div>

                            <div class="max-w-290-px w-100">
                                <div class="d-flex align-items-center justify-content-between gap-12 border pb-12 mb-12 border-end-0 border-top-0 border-start-0">
                                    <span class="text-primary-light fw-medium text-sm">Label</span>
                                    <span class="text-primary-light fw-medium text-sm">Value</span>
                                    <span class="text-primary-light fw-medium text-sm">%</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                    <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                        <span class="w-12-px h-12-px bg-success-600 rounded-circle"></span> Label 1
                                    </span>
                                    <span class="text-primary-light fw-medium text-sm">12</span>
                                    <span class="text-primary-light fw-medium text-sm"> 30.6% </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                    <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                        <span class="w-12-px h-12-px bg-primary-600 rounded-circle"></span> Label 2
                                    </span>
                                    <span class="text-primary-light fw-medium text-sm">22</span>
                                    <span class="text-primary-light fw-medium text-sm"> 42.9%</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                    <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                        <span class="w-12-px h-12-px bg-info-600 rounded-circle"></span> Label 3
                                    </span>
                                    <span class="text-primary-light fw-medium text-sm">12</span>
                                    <span class="text-primary-light fw-medium text-sm"> 24.6% </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                    <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                        <span class="w-12-px h-12-px bg-danger-600 rounded-circle"></span> Label 4
                                    </span>
                                    <span class="text-primary-light fw-medium text-sm">12</span>
                                    <span class="text-primary-light fw-medium text-sm"> 26.6% </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                    <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                        <span class="w-12-px h-12-px bg-orange rounded-circle"></span> Label 5
                                    </span>
                                    <span class="text-primary-light fw-medium text-sm">7</span>
                                    <span class="text-primary-light fw-medium text-sm"> 13.3% </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                    <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                        <span class="w-12-px h-12-px bg-warning rounded-circle"></span> Label 6
                                    </span>
                                    <span class="text-primary-light fw-medium text-sm">7</span>
                                    <span class="text-primary-light fw-medium text-sm"> 15.3% </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Radar Chart</h6>
                        </div>
                        <div class="card-body p-24 text-center">
                            <div id="radarChart" class="square-marker check-marker series-gap-24 d-flex justify-content-center"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Multiple series</h6>
                        </div>
                        <div class="card-body p-24 text-center">
                            <div id="multipleSeriesChart" class="apexcharts-tooltip-z-none square-marker check-marker series-gap-24 d-flex justify-content-center"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
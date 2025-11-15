<?php $script = '<script src="assets/js/homethreeChart.js"></script>';?>

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
                    <li class="fw-medium">eCommerce</li>
                </ul>
            </div>
            <div class="row gy-4">
                <div class="col-xxl-9">
                    <div class="card radius-8 border-0">
                        <div class="row">
                            <div class="col-xxl-6 pe-xxl-0">
                                <div class="card-body p-24">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg">Revenue Report</h6>
                                        <div class="">
                                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                                <option>Yearly</option>
                                                <option>Monthly</option>
                                                <option>Weekly</option>
                                                <option>Today</option>
                                            </select>
                                        </div>
                                    </div>
                                    <ul class="d-flex flex-wrap align-items-center mt-3 gap-3">
                                        <li class="d-flex align-items-center gap-2">
                                            <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                                            <span class="text-secondary-light text-sm fw-semibold">Earning:
                                                <span class="text-primary-light fw-bold">$500,00,000.00</span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                                            <span class="text-secondary-light text-sm fw-semibold">Expense:
                                                <span class="text-primary-light fw-bold">$20,000.00</span>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="mt-40">
                                        <div id="paymentStatusChart" class="margin-16-minus"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div class="row h-100 g-0">
                                    <div class="col-6 p-0 m-0">
                                        <div class="card-body p-24 h-100 d-flex flex-column justify-content-center border border-top-0">
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
                                    <div class="col-6 p-0 m-0">
                                        <div class="card-body p-24 h-100 d-flex flex-column justify-content-center border border-top-0 border-start-0 border-end-0">
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
                                    <div class="col-6 p-0 m-0">
                                        <div class="card-body p-24 h-100 d-flex flex-column justify-content-center border border-top-0 border-bottom-0">
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
                                    <div class="col-6 p-0 m-0">
                                        <div class="card-body p-24 h-100 d-flex flex-column justify-content-center border border-top-0 border-start-0 border-end-0 border-bottom-0">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-6">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Customers Statistics</h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative">
                                <span class="w-80-px h-80-px bg-base shadow text-primary-light fw-semibold text-xl d-flex justify-content-center align-items-center rounded-circle position-absolute end-0 top-0 z-1">+30%</span>
                                <div id="statisticsDonutChart" class="mt-36 flex-grow-1 apexcharts-tooltip-z-none title-style circle-none"></div>
                                <span class="w-80-px h-80-px bg-base shadow text-primary-light fw-semibold text-xl d-flex justify-content-center align-items-center rounded-circle position-absolute start-0 bottom-0 z-1">+25%</span>
                            </div>

                            <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                                <li class="d-flex align-items-center gap-2">
                                    <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                                    <span class="text-secondary-light text-sm fw-normal">Male:
                                        <span class="text-primary-light fw-bold">20,000</span>
                                    </span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                                    <span class="text-secondary-light text-sm fw-normal">Female:
                                        <span class="text-primary-light fw-bold">25,000</span>
                                    </span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Recent Orders</h6>
                                <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                    View All
                                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                </a>
                            </div>
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Users</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Items</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user1.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                                    <span class="text-lg text-secondary-light fw-semibold flex-grow-1">Dianne Russell</span>
                                                </div>
                                            </td>
                                            <td>#6352148</td>
                                            <td>iPhone 14 max</td>
                                            <td>2</td>
                                            <td>$5,000.00</td>
                                            <td class="text-center"> <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user2.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                                    <span class="text-lg text-secondary-light fw-semibold flex-grow-1">Wade Warren</span>
                                                </div>
                                            </td>
                                            <td>#6352148</td>
                                            <td>Laptop HPH </td>
                                            <td>3</td>
                                            <td>$1,000.00</td>
                                            <td class="text-center"> <span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user3.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                                    <span class="text-lg text-secondary-light fw-semibold flex-grow-1">Albert Flores</span>
                                                </div>
                                            </td>
                                            <td>#6352148</td>
                                            <td>Smart Watch </td>
                                            <td>7</td>
                                            <td>$1,000.00</td>
                                            <td class="text-center"> <span class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Shipped</span> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user4.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                                    <span class="text-lg text-secondary-light fw-semibold flex-grow-1">Bessie Cooper</span>
                                                </div>
                                            </td>
                                            <td>#6352148</td>
                                            <td>Nike Air Shoe</td>
                                            <td>1</td>
                                            <td>$3,000.00</td>
                                            <td class="text-center"> <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Canceled</span> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user5.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                                    <span class="text-lg text-secondary-light fw-semibold flex-grow-1">Arlene McCoy</span>
                                                </div>
                                            </td>
                                            <td>#6352148</td>
                                            <td>New Headphone </td>
                                            <td>5</td>
                                            <td>$4,000.00</td>
                                            <td class="text-center"> <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Canceled</span> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3">
                    <div class="card h-100">

                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Transactions</h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>This Month</option>
                                        <option>Last Month</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-32">
                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/payment/payment1.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Paytm</h6>
                                            <span class="text-sm text-secondary-light fw-normal">Starbucks</span>
                                        </div>
                                    </div>
                                    <span class="text-danger text-md fw-medium">-$20</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/payment/payment2.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">PayPal</h6>
                                            <span class="text-sm text-secondary-light fw-normal">Client Payment</span>
                                        </div>
                                    </div>
                                    <span class="text-success-main text-md fw-medium">+$800</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/payment/payment3.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Stripe</h6>
                                            <span class="text-sm text-secondary-light fw-normal">Ordered iPhone 14</span>
                                        </div>
                                    </div>
                                    <span class="text-danger-main text-md fw-medium">-$300</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/payment/payment4.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Razorpay</h6>
                                            <span class="text-sm text-secondary-light fw-normal">Refund</span>
                                        </div>
                                    </div>
                                    <span class="text-success-main text-md fw-medium">+$500</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/payment/payment1.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Paytm</h6>
                                            <span class="text-sm text-secondary-light fw-normal">Starbucks</span>
                                        </div>
                                    </div>
                                    <span class="text-danger-main text-md fw-medium">-$1500</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/payment/payment3.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Stripe</h6>
                                            <span class="text-sm text-secondary-light fw-normal">Ordered iPhone 14</span>
                                        </div>
                                    </div>
                                    <span class="text-success-main text-md fw-medium">+$800</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4">
                    <div class="card h-100 radius-8 border">
                        <div class="card-body p-24">
                            <h6 class="mb-12 fw-bold text-lg mb-0">Recent Orders</h6>
                            <div class="d-flex align-items-center gap-2">
                                <h6 class="fw-semibold mb-0">$27,200</h6>
                                <p class="text-sm mb-0">
                                    <span class="bg-success-focus border border-success px-8 py-2 rounded-pill fw-semibold text-success-main text-sm d-inline-flex align-items-center gap-1">
                                        10%
                                        <iconify-icon icon="iconamoon:arrow-up-2-fill" class="icon"></iconify-icon>
                                    </span>
                                    Increases
                                </p>
                            </div>
                            <div id="recent-orders" class="mt-28"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6">
                    <div class="card radius-8 border-0">

                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Distribution Maps</h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="world-map"></div>

                        <div class="card-body p-24 max-h-266-px scroll-sm overflow-y-auto">
                            <div class="">

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

                                <div class="d-flex align-items-center justify-content-between gap-3">
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

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6">
                    <div class="card h-100">

                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Top Customers</h6>
                                <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                    View All
                                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                </a>
                            </div>

                            <div class="mt-32">

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/users/user6.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Dianne Russell</h6>
                                            <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                        </div>
                                    </div>
                                    <span class="text-primary-light text-md fw-medium">Orders: 30</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/users/user1.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Wade Warren</h6>
                                            <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                        </div>
                                    </div>
                                    <span class="text-primary-light text-md fw-medium">Orders: 30</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/users/user2.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Albert Flores</h6>
                                            <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                        </div>
                                    </div>
                                    <span class="text-primary-light text-md fw-medium">Orders: 35</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/users/user3.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Bessie Cooper</h6>
                                            <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                        </div>
                                    </div>
                                    <span class="text-primary-light text-md fw-medium">Orders: 20</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/users/user4.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">Arlene McCoy</h6>
                                            <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                        </div>
                                    </div>
                                    <span class="text-primary-light text-md fw-medium">Orders: 25</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/images/users/user6.png" alt="" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-normal">John Doe</h6>
                                            <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                        </div>
                                    </div>
                                    <span class="text-primary-light text-md fw-medium">Orders: 32</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Top Selling Product</h6>
                                <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                    View All
                                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                </a>
                            </div>
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Items</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount </th>
                                            <th scope="col">Sold</th>
                                            <th scope="col" class="text-center">Total Orders</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/product-img1.png" alt="" class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal">Blue t-shirt</h6>
                                                        <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$500.00</td>
                                            <td>15%</td>
                                            <td>300</td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/product-img2.png" alt="" class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal">Nike Air Shoe</h6>
                                                        <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$150.00</td>
                                            <td>N/A</td>
                                            <td>200</td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/product-img3.png" alt="" class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal">Woman Dresses</h6>
                                                        <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$300.00</td>
                                            <td>$50.00</td>
                                            <td>1500</td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/product-img4.png" alt="" class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal">Smart Watch</h6>
                                                        <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$400.00</td>
                                            <td>$50.00</td>
                                            <td>700</td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/product-img5.png" alt="" class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal">Hoodie Rose</h6>
                                                        <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$300.00</td>
                                            <td>25%</td>
                                            <td>500</td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Stock Report</h6>
                                <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                    View All
                                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                </a>
                            </div>
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Items</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">
                                                <div class="max-w-112 mx-auto">
                                                    <span>Stock</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nike Air Shoes</td>
                                            <td>$500.00</td>
                                            <td>
                                                <div class="max-w-112 mx-auto">
                                                    <div class="w-100">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 0%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="mt-12 text-secondary-light text-sm fw-medium">Out of Stock</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nike Air Shoes</td>
                                            <td>$300.00</td>
                                            <td>
                                                <div class="max-w-112 mx-auto">
                                                    <div class="w-100">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-danger-main rounded-pill" style="width: 40%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="mt-12 text-secondary-light text-sm fw-medium">18 Low Stock</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nike Air Shoes</td>
                                            <td>$500.00</td>
                                            <td>
                                                <div class="max-w-112 mx-auto">
                                                    <div class="w-100">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success-main rounded-pill" style="width: 80%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="mt-12 text-secondary-light text-sm fw-medium">80 High Stock</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nike Air Shoes</td>
                                            <td>$300.00</td>
                                            <td>
                                                <div class="max-w-112 mx-auto">
                                                    <div class="w-100">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success-main rounded-pill" style="width: 50%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="mt-12 text-secondary-light text-sm fw-medium">50 High Stock</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nike Air Shoes</td>
                                            <td>$150.00</td>
                                            <td>
                                                <div class="max-w-112 mx-auto">
                                                    <div class="w-100">
                                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success-main rounded-pill" style="width: 70%;"></div>
                                                        </div>
                                                    </div>
                                                    <span class="mt-12 text-secondary-light text-sm fw-medium">70 High Stock</span>
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

<?php include './partials/layouts/layoutBottom.php' ?>
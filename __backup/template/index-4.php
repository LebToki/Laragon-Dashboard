<?php $script = '<script src="assets/js/homeFourChart.js"></script>';?>

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
                    <li class="fw-medium">Cryptocracy</li>
                </ul>
            </div>

            <!-- Crypto Home Widgets Start -->
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
            <!-- Crypto Home Widgets End -->

            <div class="row gy-4 mt-4">

                <!-- Crypto Home Widgets Start -->
                <div class="col-xxl-8">
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="card h-100 radius-8 border-0">
                                <div class="card-body p-24">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg">Coin Analytics</h6>

                                        <div class="d-flex flex-wrap align-items-center gap-4">
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input" type="radio" name="crypto" id="BTC">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="BTC"> BTC </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input" type="radio" name="crypto" id="ETH">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="ETH"> ETH </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input" type="radio" name="crypto" id="SOL">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="SOL"> SOL </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input" type="radio" name="crypto" id="LTE">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="LTE"> LTE </label>
                                            </div>
                                        </div>

                                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                            <option>Yearly</option>
                                            <option>Monthly</option>
                                            <option>Weekly</option>
                                            <option>Today</option>
                                        </select>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 mt-12">
                                        <h6 class="fw-semibold mb-0">$25,000</h6>
                                        <p class="text-sm mb-0 d-flex align-items-center gap-1">
                                            Bitcoin (BTC)
                                            <span class="bg-success-focus border border-success px-8 py-2 rounded-pill fw-semibold text-success-main text-sm d-inline-flex align-items-center gap-1">
                                                10%
                                                <iconify-icon icon="iconamoon:arrow-up-2-fill" class="icon"></iconify-icon>
                                            </span>
                                        </p>
                                    </div>

                                    <div id="candleStickChart"></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div class="card h-100 radius-8 border-0">
                                <div class="card-body p-24">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                        <h6 class="mb-2 fw-bold text-lg">Coin Analytics</h6>
                                        <div class="border radius-4 px-3 py-2 pe-0 d-flex align-items-center gap-1 text-sm text-secondary-light">
                                            Currency:
                                            <select class="form-select form-select-sm w-auto bg-base border-0 text-primary-light fw-semibold text-sm">
                                                <option>USD</option>
                                                <option>BDT</option>
                                                <option>RUP</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                            <img src="assets/images/currency/crypto-img1.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Bitcoin</h6>
                                            </div>
                                        </div>
                                        <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                        <span class="text-success-main text-md fw-medium">+3.85%</span>
                                        <div id="markerBitcoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                            <img src="assets/images/currency/crypto-img2.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Ethereum</h6>
                                            </div>
                                        </div>
                                        <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                        <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                        <div id="markerEthereumChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                            <img src="assets/images/currency/crypto-img3.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Solana</h6>
                                            </div>
                                        </div>
                                        <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                        <span class="text-success-main text-md fw-medium">+3.85%</span>
                                        <div id="markerSolanaChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                            <img src="assets/images/currency/crypto-img4.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Litecoin</h6>
                                            </div>
                                        </div>
                                        <h6 class="text-md fw-medium mb-0">$55,000.00</h6>
                                        <span class="text-success-main text-md fw-medium">+3.85%</span>
                                        <div id="markerLitecoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-8 radius-4 mb-16">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                            <img src="assets/images/currency/crypto-img5.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Dogecoin</h6>
                                            </div>
                                        </div>
                                        <h6 class="text-md fw-medium mb-0">$15,000.00</h6>
                                        <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                        <div id="markerDogecoinChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 bg-neutral-200 px-8 py-4 radius-4">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                            <img src="assets/images/currency/crypto-img1.png" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Crypto</h6>
                                            </div>
                                        </div>
                                        <h6 class="text-md fw-medium mb-0">$15,000.00</h6>
                                        <span class="text-danger-main text-md fw-medium">-2.85%</span>
                                        <div id="markerCryptoChart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div class="card h-100 radius-8 border-0">
                                <div class="card-body p-24">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                        <h6 class="mb-2 fw-bold text-lg">My Orders</h6>
                                        <div class="">
                                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                                <option>Today</option>
                                                <option>Monthly</option>
                                                <option>Weekly</option>
                                                <option>Today</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="table-responsive scroll-sm">
                                        <table class="table bordered-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Rate</th>
                                                    <th scope="col">Amount ETH </th>
                                                    <th scope="col">Price PLN</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td><span class="text-success-main">0.265415.00</span></td>
                                                    <td>29.4251512</td>
                                                    <td>2.154</td>
                                                    <td class="text-center line-height-1">
                                                        <button type="button" class="text-lg text-danger-main remove-btn">
                                                            <iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="text-success-main">0.265415.00</span></td>
                                                    <td>29.4251512</td>
                                                    <td>2.154</td>
                                                    <td class="text-center line-height-1">
                                                        <button type="button" class="text-lg text-danger-main remove-btn">
                                                            <iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="text-danger-main">0.265415.00</span></td>
                                                    <td>29.4251512</td>
                                                    <td>2.154</td>
                                                    <td class="text-center line-height-1">
                                                        <button type="button" class="text-lg text-danger-main remove-btn">
                                                            <iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="text-success-main">0.265415.00</span></td>
                                                    <td>29.4251512</td>
                                                    <td>2.154</td>
                                                    <td class="text-center line-height-1">
                                                        <button type="button" class="text-lg text-danger-main remove-btn">
                                                            <iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="text-danger-main">0.265415.00</span></td>
                                                    <td>29.4251512</td>
                                                    <td>2.154</td>
                                                    <td class="text-center line-height-1">
                                                        <button type="button" class="text-lg text-danger-main remove-btn">
                                                            <iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="text-danger-main">0.265415.00</span></td>
                                                    <td>29.4251512</td>
                                                    <td>2.154</td>
                                                    <td class="text-center line-height-1">
                                                        <button type="button" class="text-lg text-danger-main remove-btn">
                                                            <iconify-icon icon="radix-icons:cross-2" class="icon"></iconify-icon>
                                                        </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12">
                            <div class="card h-100">
                                <div class="card-body p-24">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Recent Transaction</h6>
                                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                            View All
                                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                        </a>
                                    </div>
                                    <div class="table-responsive scroll-sm">
                                        <table class="table bordered-table mb-0 xsm-table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Ast</th>
                                                    <th scope="col">Date & Time</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col" class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                                <iconify-icon icon="tabler:arrow-up-right" class="icon"></iconify-icon>
                                                            </span>
                                                            <span class="fw-medium">Bitcoin</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                        <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                        <span class="text-secondary-light text-sm">$3,480.90</span>
                                                    </td>
                                                    <td>Abc.........np562</td>
                                                    <td class="text-center">
                                                        <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="text-danger-main bg-danger-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                                <iconify-icon icon="tabler:arrow-down-left" class="icon"></iconify-icon>
                                                            </span>
                                                            <span class="fw-medium">Bitcoin</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                        <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                        <span class="text-secondary-light text-sm">$3,480.90</span>
                                                    </td>
                                                    <td>Abc.........np562</td>
                                                    <td class="text-center">
                                                        <span class="bg-danger-focus text-danger-main px-16 py-4 radius-4 fw-medium text-sm">Terminated</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                                <iconify-icon icon="tabler:arrow-up-right" class="icon"></iconify-icon>
                                                            </span>
                                                            <span class="fw-medium">Bitcoin</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                        <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                        <span class="text-secondary-light text-sm">$3,480.90</span>
                                                    </td>
                                                    <td>Abc.........np562</td>
                                                    <td class="text-center">
                                                        <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="text-danger-main bg-danger-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                                <iconify-icon icon="tabler:arrow-down-left" class="icon"></iconify-icon>
                                                            </span>
                                                            <span class="fw-medium">Bitcoin</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                        <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                        <span class="text-secondary-light text-sm">$3,480.90</span>
                                                    </td>
                                                    <td>Abc.........np562</td>
                                                    <td class="text-center">
                                                        <span class="bg-danger-focus text-danger-main px-16 py-4 radius-4 fw-medium text-sm">Terminated</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="text-success-main bg-success-focus w-32-px h-32-px d-flex align-items-center justify-content-center rounded-circle text-xl">
                                                                <iconify-icon icon="tabler:arrow-up-right" class="icon"></iconify-icon>
                                                            </span>
                                                            <span class="fw-medium">Bitcoin</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">10:34 AM</span>
                                                        <span class="text-secondary-light text-sm">27 Mar 2024</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary-light d-block fw-medium">+ 0.431 BTC</span>
                                                        <span class="text-secondary-light text-sm">$3,480.90</span>
                                                    </td>
                                                    <td>Abc.........np562</td>
                                                    <td class="text-center">
                                                        <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">Completed</span>
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
                <!-- Crypto Home Widgets End -->

                <div class="col-xxl-4">
                    <div class="row gy-4">
                        <div class="col-xxl-12 col-lg-6">
                            <div class="card h-100 radius-8 border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                        <h6 class="mb-2 fw-bold text-lg">My Cards</h6>
                                        <a href="" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 text-sm btn-sm px-8 py-6">
                                            <iconify-icon icon="ph:plus-circle" class="icon text-xl"></iconify-icon> Button
                                        </a>
                                    </div>

                                    <div>
                                        <div class="card-slider">
                                            <div class="p-20 h-240-px radius-8 overflow-hidden position-relative z-1">
                                                <img src="assets/images/card/card-bg.png" alt="" class="position-absolute start-0 top-0 w-100 h-100 object-fit-cover z-n1">

                                                <div class="d-flex flex-column justify-content-between h-100">
                                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <h6 class="text-white mb-0">Master Card</h6>
                                                        <img src="assets/images/card/card-logo.png" alt="">
                                                    </div>

                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Credit Card Number</span>
                                                        <h6 class="text-white text-xl fw-semibold mt-1 mb-0">2356 9854 3652 5612</h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <span class="text-white text-xs fw-normal text-opacity-75">Name</span>
                                                            <h6 class="text-white text-xl fw-semibold mb-0">Arlene McCoy</h6>
                                                        </div>
                                                        <div>
                                                            <span class="text-white text-xs fw-normal text-opacity-75">Exp. Date</span>
                                                            <h6 class="text-white text-xl fw-semibold mb-0">05/26</h6>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="p-20 h-240-px radius-8 overflow-hidden position-relative z-1">
                                                <img src="assets/images/card/card-bg.png" alt="" class="position-absolute start-0 top-0 w-100 h-100 object-fit-cover z-n1">

                                                <div class="d-flex flex-column justify-content-between h-100">
                                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <h6 class="text-white mb-0">Master Card</h6>
                                                        <img src="assets/images/card/card-logo.png" alt="">
                                                    </div>

                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Credit Card Number</span>
                                                        <h6 class="text-white text-xl fw-semibold mt-1 mb-0">2356 9854 3652 5612</h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <span class="text-white text-xs fw-normal text-opacity-75">Name</span>
                                                            <h6 class="text-white text-xl fw-semibold mb-0">Arlene McCoy</h6>
                                                        </div>
                                                        <div>
                                                            <span class="text-white text-xs fw-normal text-opacity-75">Exp. Date</span>
                                                            <h6 class="text-white text-xl fw-semibold mb-0">05/26</h6>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="p-20 h-240-px radius-8 overflow-hidden position-relative z-1">
                                                <img src="assets/images/card/card-bg.png" alt="" class="position-absolute start-0 top-0 w-100 h-100 object-fit-cover z-n1">

                                                <div class="d-flex flex-column justify-content-between h-100">
                                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <h6 class="text-white mb-0">Master Card</h6>
                                                        <img src="assets/images/card/card-logo.png" alt="">
                                                    </div>

                                                    <div>
                                                        <span class="text-white text-xs fw-normal text-opacity-75">Credit Card Number</span>
                                                        <h6 class="text-white text-xl fw-semibold mt-1 mb-0">2356 9854 3652 5612</h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <span class="text-white text-xs fw-normal text-opacity-75">Name</span>
                                                            <h6 class="text-white text-xl fw-semibold mb-0">Arlene McCoy</h6>
                                                        </div>
                                                        <div>
                                                            <span class="text-white text-xs fw-normal text-opacity-75">Exp. Date</span>
                                                            <h6 class="text-white text-xl fw-semibold mb-0">05/26</h6>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-lg-6">
                            <div class="card h-100">
                                <div class="card-body p-24">
                                    <span class="mb-4 text-sm text-secondary-light">Total Balance</span>
                                    <h6 class="mb-4">$320,320.00</h6>

                                    <ul class="nav nav-pills pill-tab mb-24 mt-28 border input-form-light p-1 radius-8 bg-neutral-50" id="pills-tab" role="tablist">
                                        <li class="nav-item w-50" role="presentation">
                                            <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8 active" id="pills-Buy-tab" data-bs-toggle="pill" data-bs-target="#pills-Buy" type="button" role="tab" aria-controls="pills-Buy" aria-selected="true">Buy</button>
                                        </li>
                                        <li class="nav-item w-50" role="presentation">
                                            <button class="nav-link px-12 py-10 text-md w-100 text-center radius-8" id="pills-Sell-tab" data-bs-toggle="pill" data-bs-target="#pills-Sell" type="button" role="tab" aria-controls="pills-Sell" aria-selected="false">Sell</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-Buy" role="tabpanel" aria-labelledby="pills-Buy-tab" tabindex="0">
                                            <div class="mb-20">
                                                <label for="estimatedValue" class="fw-semibold mb-8 text-primary-light">Estimated Purchase Value</label>
                                                <div class="input-group input-group-lg border input-form-light radius-8">
                                                    <input type="text" class="form-control bg-base border-0 radius-8" id="estimatedValue" placeholder="Estimated Value">
                                                    <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                        <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                            <option class="bg-base">BTC</option>
                                                            <option class="bg-base">LTC</option>
                                                            <option class="bg-base">ETC</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-20">
                                                <label for="tradeValue" class="fw-semibold mb-8 text-primary-light">Trade Value</label>
                                                <div class="input-group input-group-lg border input-form-light radius-8">
                                                    <input type="text" class="form-control bg-base border-0 radius-8" id="tradeValue" placeholder="Trade Value">
                                                    <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                        <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                            <option class="bg-base">USD</option>
                                                            <option class="bg-base">BTC</option>
                                                            <option class="bg-base">LTC</option>
                                                            <option class="bg-base">ETC</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-20">
                                                <label class="fw-semibold mb-8 text-primary-light">Trade Value</label>
                                                <textarea class="form-control bg-base h-80-px radius-8" placeholder="Enter Address"></textarea>
                                            </div>
                                            <div class="mb-24">
                                                <span class="mb-4 text-sm text-secondary-light">Total Balance</span>
                                                <h6 class="mb-4 fw-semibold text-xl text-warning-main">$320,320.00</h6>
                                            </div>
                                            <a href="" class="btn btn-primary text-sm btn-sm px-8 py-12 w-100 radius-8"> Transfer Now</a>
                                        </div>
                                        <div class="tab-pane fade" id="pills-Sell" role="tabpanel" aria-labelledby="pills-Sell-tab" tabindex="0">
                                            <div class="mb-20">
                                                <label for="estimatedValueSell" class="fw-semibold mb-8 text-primary-light">Estimated Purchase Value</label>
                                                <div class="input-group input-group-lg border input-form-light radius-8">
                                                    <input type="text" class="form-control border-0 radius-8" id="estimatedValueSell" placeholder="Estimated Value">
                                                    <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                        <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                            <option>BTC</option>
                                                            <option>LTC</option>
                                                            <option>USD</option>
                                                            <option>ETC</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-20">
                                                <label for="tradeValueSell" class="fw-semibold mb-8 text-primary-light">Trade Value</label>
                                                <div class="input-group input-group-lg border input-form-light radius-8">
                                                    <input type="text" class="form-control border-0 radius-8" id="tradeValueSell" placeholder="Trade Value">
                                                    <div class="input-group-text bg-neutral-50 border-0 fw-normal text-md ps-1 pe-1">
                                                        <select class="form-select form-select-sm w-auto bg-transparent fw-bolder border-0 text-secondary-light">
                                                            <option>BTC</option>
                                                            <option>LTC</option>
                                                            <option>USD</option>
                                                            <option>ETC</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-20">
                                                <label class="fw-semibold mb-8">Trade Value</label>
                                                <textarea class="form-control h-80-px radius-8" placeholder="Enter Address"></textarea>
                                            </div>
                                            <div class="mb-24">
                                                <span class="mb-4 text-sm text-secondary-light">Total Balance</span>
                                                <h6 class="mb-4 fw-semibold text-xl text-warning-main">$320,320.00</h6>
                                            </div>
                                            <a href="" class="btn btn-primary text-sm btn-sm px-8 py-12 w-100 radius-8"> Transfer Now</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-lg-6">
                            <div class="card h-100 radius-8 border-0">
                                <div class="card-body p-24">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg">User Activates</h6>
                                        <div class="">
                                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                                <option>This Week</option>
                                                <option>This Month</option>
                                                <option>This Year</option>
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
                                            <span class="text-secondary-light text-sm fw-normal">Visits By Day:
                                                <span class="text-primary-light fw-bold">20,000</span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                                            <span class="text-secondary-light text-sm fw-normal">Referral Join:
                                                <span class="text-primary-light fw-bold">25,000</span>
                                            </span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

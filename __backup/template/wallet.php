<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Wallet</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Wallet</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-lg-9">
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
                                <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                                    <option>Status</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                                Connect Wallet
                            </button>
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
                                            <th scope="col">Amount</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Change %</th>
                                            <th scope="col">Allocation</th>
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
                <div class="col-lg-3">
                    <div class="card h-100">
                        <div class="card-body p-0">
                            <div class="px-24 py-20">
                                <span class="mb-8">Laragon Dashboard</span>
                                <h5 class="text-2xl">$40,570.85</h5>
                                <div class="mt-24 pb-24 mb-24 border-bottom d-flex align-items-center gap-16 justify-content-between flex-wrap">
                                    <div class="text-center d-flex align-items-center  flex-column">
                                        <span class="w-60-px h-60-px bg-primary-50 text-primary-600 text-2xl d-inline-flex justify-content-center align-items-center rounded-circle ">
                                            <i class="ri-add-line"></i>
                                        </span>
                                        <span class="text-primary-light fw-medium mt-6">Buy</span>
                                    </div>
                                    <div class="text-center d-flex align-items-center  flex-column">
                                        <span class="w-60-px h-60-px bg-primary-50 text-primary-600 text-2xl d-inline-flex justify-content-center align-items-center rounded-circle ">
                                            <i class="ri-arrow-left-right-line"></i>
                                        </span>
                                        <span class="text-primary-light fw-medium mt-6">Swap</span>
                                    </div>
                                    <div class="text-center d-flex align-items-center  flex-column">
                                        <span class="w-60-px h-60-px bg-primary-50 text-primary-600 text-2xl d-inline-flex justify-content-center align-items-center rounded-circle ">
                                            <i class="ri-upload-2-line"></i>
                                        </span>
                                        <span class="text-primary-light fw-medium mt-6">Send</span>
                                    </div>
                                    <div class="text-center d-flex align-items-center  flex-column">
                                        <span class="w-60-px h-60-px bg-primary-50 text-primary-600 text-2xl d-inline-flex justify-content-center align-items-center rounded-circle ">
                                            <i class="ri-download-2-line"></i>
                                        </span>
                                        <span class="text-primary-light fw-medium mt-6">Receive</span>
                                    </div>
                                </div>

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

<?php include './partials/layouts/layoutBottom.php' ?>
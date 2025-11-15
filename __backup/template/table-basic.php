<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Basic Table</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Basic Table</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Default Table</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table basic-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>S.L</th>
                                            <th>Invoice</th>
                                            <th>Name</th>
                                            <th>Issued Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#526534</a>
                                            </td>
                                            <td>Kathryn Murphy</td>
                                            <td>25 Jan 2024</td>
                                            <td>$200.00</td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#696589</a>
                                            </td>
                                            <td>Annette Black</td>
                                            <td>25 Jan 2024</td>
                                            <td>$200.00</td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#256584</a>
                                            </td>
                                            <td>Ronald Richards</td>
                                            <td>10 Feb 2024</td>
                                            <td>$200.00</td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#526587</a>
                                            </td>
                                            <td>Eleanor Pena</td>
                                            <td>10 Feb 2024</td>
                                            <td>$150.00</td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#105986</a>
                                            </td>
                                            <td>Leslie Alexander</td>
                                            <td>15 Mar 2024</td>
                                            <td>$150.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Bordered Tables</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table basic-border-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Invoice </th>
                                            <th>Name</th>
                                            <th>Issued Date</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#526534</a>
                                            </td>
                                            <td>Kathryn Murphy</td>
                                            <td>25 Jan 2024</td>
                                            <td>$200.00</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">View More ></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#696589</a>
                                            </td>
                                            <td>Annette Black</td>
                                            <td>25 Jan 2024</td>
                                            <td>$200.00</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">View More ></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#256584</a>
                                            </td>
                                            <td>256584</td>
                                            <td>10 Feb 2024</td>
                                            <td>$200.00</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">View More ></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#526587</a>
                                            </td>
                                            <td>Eleanor Pena</td>
                                            <td>10 Feb 2024</td>
                                            <td>$150.00</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">View More ></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">#105986</a>
                                            </td>
                                            <td>Leslie Alexander</td>
                                            <td>15 Mar 2024</td>
                                            <td>$150.00</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">View More ></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Striped Rows</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table striped-table mb-0">
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
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Striped Rows</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table vertical-striped-table mb-0">
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
                                                <h6 class="text-md mb-0 fw-normal">Blue t-shirt</h6>
                                                <span class="text-sm text-secondary-light fw-normal">Fashion</span>
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
                                                <h6 class="text-md mb-0 fw-normal">Blue t-shirt</h6>
                                                <span class="text-sm text-secondary-light fw-normal">Fashion</span>
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
                                                <h6 class="text-md mb-0 fw-normal">Blue t-shirt</h6>
                                                <span class="text-sm text-secondary-light fw-normal">Fashion</span>
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
                                                <h6 class="text-md mb-0 fw-normal">Blue t-shirt</h6>
                                                <span class="text-sm text-secondary-light fw-normal">Fashion</span>
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
                                                <h6 class="text-md mb-0 fw-normal">Blue t-shirt</h6>
                                                <span class="text-sm text-secondary-light fw-normal">Fashion</span>
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
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tables Border Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-primary-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox">
                                                    <label class="form-check-label">
                                                        S.L
                                                    </label>
                                                </div>
                                            </th>
                                            <th scope="col">Transaction ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox">
                                                    <label class="form-check-label">
                                                        01
                                                    </label>
                                                </div>
                                            </td>
                                            <td>5986124445445</td>
                                            <td>27 Mar 2024</td>
                                            <td>
                                                <span class="bg-warning-focus text-warning-main px-32 py-4 rounded-pill fw-medium text-sm">Pending</span>
                                            </td>
                                            <td>$20,000.00</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox">
                                                    <label class="form-check-label">
                                                        02
                                                    </label>
                                                </div>
                                            </td>
                                            <td>5986124445445</td>
                                            <td>27 Mar 2024</td>
                                            <td>
                                                <span class="bg-danger-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">Rejected</span>
                                            </td>
                                            <td>$20,000.00</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox">
                                                    <label class="form-check-label">
                                                        03
                                                    </label>
                                                </div>
                                            </td>
                                            <td>5986124445445</td>
                                            <td>27 Mar 2024</td>
                                            <td>
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Completed</span>
                                            </td>
                                            <td>$20,000.00</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox">
                                                    <label class="form-check-label">
                                                        04
                                                    </label>
                                                </div>
                                            </td>
                                            <td>5986124445445</td>
                                            <td>27 Mar 2024</td>
                                            <td>
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Completed</span>
                                            </td>
                                            <td>$20,000.00</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox">
                                                    <label class="form-check-label">
                                                        05
                                                    </label>
                                                </div>
                                            </td>
                                            <td>5986124445445</td>
                                            <td>27 Mar 2024</td>
                                            <td>
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Completed</span>
                                            </td>
                                            <td>$20,000.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tables Border Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table colored-row-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-base">Registered On</th>
                                            <th scope="col" class="bg-base">Users</th>
                                            <th scope="col" class="bg-base">Email</th>
                                            <th scope="col" class="bg-base">Plan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bg-primary-light">27 Mar 2024</td>
                                            <td class="bg-primary-light">
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Dianne Russell</h6>
                                                </div>
                                            </td>
                                            <td class="bg-primary-light">random@gmail.com</td>
                                            <td class="bg-primary-light">Free</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-success-focus">27 Mar 2024</td>
                                            <td class="bg-success-focus">
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Wade Warren</h6>
                                                </div>
                                            </td>
                                            <td class="bg-success-focus">random@gmail.com</td>
                                            <td class="bg-success-focus">Basic</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-info-focus">27 Mar 2024</td>
                                            <td class="bg-info-focus">
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Albert Flores</h6>
                                                </div>
                                            </td>
                                            <td class="bg-info-focus">random@gmail.com</td>
                                            <td class="bg-info-focus">Standard </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-warning-focus">27 Mar 2024</td>
                                            <td class="bg-warning-focus">
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Bessie Cooper</h6>
                                                </div>
                                            </td>
                                            <td class="bg-warning-focus">random@gmail.com</td>
                                            <td class="bg-warning-focus">Business </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-danger-focus">27 Mar 2024</td>
                                            <td class="bg-danger-focus">
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Arlene McCoy</h6>
                                                </div>
                                            </td>
                                            <td class="bg-danger-focus">random@gmail.com</td>
                                            <td class="bg-danger-focus">Enterprise </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tables Border Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
                    </div><!-- card end -->
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
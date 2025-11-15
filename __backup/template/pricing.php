<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Pricing</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Pricing</li>
                </ul>
            </div>

            <div class="card h-100 p-0 radius-12 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="mb-0 text-lg">Pricing Plan Multiple Color</h6>
                </div>
                <div class="card-body p-40">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10">
                            <div class="text-center">
                                <h4 class="mb-16">Pricing Plan</h4>
                                <p class="mb-0 text-lg text-secondary-light">No contracts. No surprise fees.</p>
                            </div>
                            <ul class="nav nav-pills button-tab mt-32 pricing-tab justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-24 py-10 text-md rounded-pill text-secondary-light fw-medium active" id="pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#pills-monthly" type="button" role="tab" aria-controls="pills-monthly" aria-selected="true">
                                        Monthly
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-24 py-10 text-md rounded-pill text-secondary-light fw-medium" id="pills-yearly-tab" data-bs-toggle="pill" data-bs-target="#pills-yearly" type="button" role="tab" aria-controls="pills-yearly" aria-selected="false" tabindex="-1">
                                        Yearly
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab" tabindex="0">
                                    <div class="row gy-4">
                                        <div class="col-xxl-4 col-sm-6 pricing-plan-wrapper">
                                            <div class="pricing-plan position-relative radius-24 overflow-hidden border bg-lilac-100">
                                                <div class="d-flex align-items-center gap-16">
                                                    <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-base">
                                                        <img src="assets/images/pricing/price-icon1.png" alt="">
                                                    </span>
                                                    <div class="">
                                                        <span class="fw-medium text-md text-secondary-light">For individuals</span>
                                                        <h6 class="mb-0">Basic</h6>
                                                    </div>
                                                </div>
                                                <p class="mt-16 mb-0 text-secondary-light mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                                <h3 class="mb-24">$99 <span class="fw-medium text-md text-secondary-light">/monthly</span> </h3>
                                                <span class="mb-20 fw-medium">What’s included</span>
                                                <ul>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">All analytics features</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 250,000 tracked visits</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Normal support</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 3 team members</span>
                                                    </li>
                                                </ul>
                                                <button type="button" class="bg-lilac-600 bg-hover-lilac-700 text-white text-center border border-lilac-600 text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-6 pricing-plan-wrapper">
                                            <div class="pricing-plan scale-item position-relative radius-24 overflow-hidden border bg-primary-600 text-white">
                                                <span class="bg-white bg-opacity-25 text-white radius-24 py-8 px-24 text-sm position-absolute end-0 top-0 z-1 rounded-start-top-0 rounded-end-bottom-0">Popular</span>
                                                <div class="d-flex align-items-center gap-16">
                                                    <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-base">
                                                        <img src="assets/images/pricing/price-icon2.png" alt="">
                                                    </span>
                                                    <div class="">
                                                        <span class="fw-medium text-md text-white">For startups</span>
                                                        <h6 class="mb-0 text-white">Pro</h6>
                                                    </div>
                                                </div>
                                                <p class="mt-16 mb-0 text-white mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                                <h3 class="mb-24 text-white">$199 <span class="fw-medium text-md text-white">/monthly</span> </h3>
                                                <span class="mb-20 fw-medium">What’s included</span>
                                                <ul>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">All analytics features</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">Up to 250,000 tracked visits</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">Normal support</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">Up to 3 team members</span>
                                                    </li>
                                                </ul>
                                                <button type="button" class="bg-white text-primary-600 text-white text-center border border-white text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>

                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-6 pricing-plan-wrapper">
                                            <div class="pricing-plan position-relative radius-24 overflow-hidden border bg-success-100">
                                                <div class="d-flex align-items-center gap-16">
                                                    <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-base">
                                                        <img src="assets/images/pricing/price-icon3.png" alt="">
                                                    </span>
                                                    <div class="">
                                                        <span class="fw-medium text-md text-secondary-light">For big companies</span>
                                                        <h6 class="mb-0">Enterprise</h6>
                                                    </div>
                                                </div>
                                                <p class="mt-16 mb-0 text-secondary-light mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                                <h3 class="mb-24">$399 <span class="fw-medium text-md text-secondary-light">/monthly</span> </h3>
                                                <span class="mb-20 fw-medium">What’s included</span>
                                                <ul>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">All analytics features</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 250,000 tracked visits</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Normal support</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 3 team members</span>
                                                    </li>
                                                </ul>
                                                <button type="button" class="bg-success-600 bg-hover-success-700 text-white text-center border border-success-600 text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-yearly" role="tabpanel" aria-labelledby="pills-yearly-tab" tabindex="0">
                                    <div class="row gy-4">
                                        <div class="col-xxl-4 col-sm-6 pricing-plan-wrapper">
                                            <div class="pricing-plan position-relative radius-24 overflow-hidden border bg-lilac-100">
                                                <div class="d-flex align-items-center gap-16">
                                                    <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-base">
                                                        <img src="assets/images/pricing/price-icon1.png" alt="">
                                                    </span>
                                                    <div class="">
                                                        <span class="fw-medium text-md text-secondary-light">For individuals</span>
                                                        <h6 class="mb-0">Basic</h6>
                                                    </div>
                                                </div>
                                                <p class="mt-16 mb-0 text-secondary-light mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                                <h3 class="mb-24">$399 <span class="fw-medium text-md text-secondary-light">/monthly</span> </h3>
                                                <span class="mb-20 fw-medium">What’s included</span>
                                                <ul>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">All analytics features</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 250,000 tracked visits</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Normal support</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-lilac-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 3 team members</span>
                                                    </li>
                                                </ul>
                                                <button type="button" class="bg-lilac-600 bg-hover-lilac-700 text-white text-center border border-lilac-600 text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>

                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-6 pricing-plan-wrapper">
                                            <div class="pricing-plan scale-item position-relative radius-24 px-40 py-50 overflow-hidden border bg-primary-600 text-white">
                                                <span class="bg-white bg-opacity-25 text-white radius-24 py-8 px-24 text-sm position-absolute end-0 top-0 z-1 rounded-start-top-0 rounded-end-bottom-0">Popular</span>
                                                <div class="d-flex align-items-center gap-16">
                                                    <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-base">
                                                        <img src="assets/images/pricing/price-icon2.png" alt="">
                                                    </span>
                                                    <div class="">
                                                        <span class="fw-medium text-md text-white">For startups</span>
                                                        <h6 class="mb-0 text-white">Pro</h6>
                                                    </div>
                                                </div>
                                                <p class="mt-16 mb-0 text-white mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                                <h3 class="mb-24 text-white">$699 <span class="fw-medium text-md text-white">/monthly</span> </h3>
                                                <span class="mb-20 fw-medium">What’s included</span>
                                                <ul>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">All analytics features</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">Up to 250,000 tracked visits</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">Normal support</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-white text-lg">Up to 3 team members</span>
                                                    </li>
                                                </ul>
                                                <button type="button" class="bg-white text-primary-600 text-white text-center border border-white text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>

                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-6 pricing-plan-wrapper">
                                            <div class="pricing-plan position-relative radius-24 overflow-hidden border bg-success-100">
                                                <div class="d-flex align-items-center gap-16">
                                                    <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-base">
                                                        <img src="assets/images/pricing/price-icon3.png" alt="">
                                                    </span>
                                                    <div class="">
                                                        <span class="fw-medium text-md text-secondary-light">For big companies</span>
                                                        <h6 class="mb-0">Enterprise</h6>
                                                    </div>
                                                </div>
                                                <p class="mt-16 mb-0 text-secondary-light mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                                <h3 class="mb-24">$999 <span class="fw-medium text-md text-secondary-light">/monthly</span> </h3>
                                                <span class="mb-20 fw-medium">What’s included</span>
                                                <ul>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">All analytics features</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 250,000 tracked visits</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16 mb-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Normal support</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-16">
                                                        <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-success-600 rounded-circle">
                                                            <iconify-icon icon="iconamoon:check-light" class="text-white text-lg   "></iconify-icon>
                                                        </span>
                                                        <span class="text-secondary-light text-lg">Up to 3 team members</span>
                                                    </li>
                                                </ul>
                                                <button type="button" class="bg-success-600 bg-hover-success-700 text-white text-center border border-success-600 text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card h-100 p-0 radius-12 overflow-hidden mt-24">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="mb-0 text-lg">Simple Pricing Plan</h6>
                </div>
                <div class="card-body p-40">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10">
                            <div class="text-center">
                                <h4 class="mb-16">Simple, Transparent Pricing</h4>
                                <p class="mb-0 text-lg text-secondary-light">Lorem ipsum dolor sit amet consectetur adipiscing elit dolor posuere vel venenatis eu sit massa volutpat.</p>
                            </div>

                            <div class="pricing-tab">
                                <div class="form-switch switch-primary d-flex align-items-center gap-3 mt-40 justify-content-center">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="yes">Monthly</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="yes">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="yes">Annually</label>
                                </div>
                            </div>

                            <div class="row gy-4">
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="pricing-plan position-relative radius-24 overflow-hidden border bg-base">
                                        <div class="d-flex align-items-center gap-16">
                                            <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-primary-50">
                                                <img src="assets/images/pricing/price-icon4.png" alt="">
                                            </span>
                                            <div class="">
                                                <span class="fw-medium text-md text-secondary-light">For individuals</span>
                                                <h6 class="mb-0">Basic</h6>
                                            </div>
                                        </div>
                                        <p class="mt-16 mb-0 text-secondary-light mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                        <h3 class="mb-24">$99 <span class="fw-medium text-md text-secondary-light">/monthly</span> </h3>
                                        <span class="mb-20 fw-medium">What’s included</span>
                                        <ul>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">All analytics features</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">Up to 250,000 tracked visits</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">Normal support</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">Up to 3 team members</span>
                                            </li>
                                        </ul>
                                        <button type="button" class="bg-primary-600 bg-hover-primary-700 text-white text-center border border-primary-600 text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="pricing-plan featured-item position-relative radius-24 overflow-hidden border bg-primary-600 text-white z-1">
                                        <img src="assets/images/pricing/pricing-shape.png" alt="" class="position-absolute end-0 top-10 z-n1">
                                        <span class="bg-white bg-opacity-25 text-white radius-24 py-8 px-24 text-sm position-absolute end-0 top-0 z-1 rounded-start-top-0 rounded-end-bottom-0">Popular</span>
                                        <div class="d-flex align-items-center gap-16">
                                            <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-base">
                                                <img src="assets/images/pricing/price-icon2.png" alt="">
                                            </span>
                                            <div class="">
                                                <span class="fw-medium text-md text-white">For startups</span>
                                                <h6 class="mb-0 text-white">Pro</h6>
                                            </div>
                                        </div>
                                        <p class="mt-16 mb-0 text-white mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                        <h3 class="mb-24 text-white">$199 <span class="fw-medium text-md text-white">/monthly</span> </h3>
                                        <span class="mb-20 fw-medium">What’s included</span>
                                        <ul>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                </span>
                                                <span class="text-white text-lg">All analytics features</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                </span>
                                                <span class="text-white text-lg">Up to 250,000 tracked visits</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                </span>
                                                <span class="text-white text-lg">Normal support</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-white rounded-circle text-primary-600">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-lg   "></iconify-icon>
                                                </span>
                                                <span class="text-white text-lg">Up to 3 team members</span>
                                            </li>
                                        </ul>
                                        <button type="button" class="bg-white text-primary-600 text-white text-center border border-white text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>

                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="pricing-plan position-relative radius-24 overflow-hidden border bg-base">
                                        <div class="d-flex align-items-center gap-16">
                                            <span class="w-72-px h-72-px d-flex justify-content-center align-items-center radius-16 bg-primary-50">
                                                <img src="assets/images/pricing/price-icon5.png" alt="">
                                            </span>
                                            <div class="">
                                                <span class="fw-medium text-md text-secondary-light">For big companies</span>
                                                <h6 class="mb-0">Enterprise</h6>
                                            </div>
                                        </div>
                                        <p class="mt-16 mb-0 text-secondary-light mb-28">Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit. </p>
                                        <h3 class="mb-24">$399 <span class="fw-medium text-md text-secondary-light">/monthly</span> </h3>
                                        <span class="mb-20 fw-medium">What’s included</span>
                                        <ul>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">All analytics features</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">Up to 250,000 tracked visits</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16 mb-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">Normal support</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-16">
                                                <span class="w-24-px h-24-px d-flex justify-content-center align-items-center bg-primary-600 rounded-circle">
                                                    <iconify-icon icon="iconamoon:check-light" class="text-white text-lg "></iconify-icon>
                                                </span>
                                                <span class="text-secondary-light text-lg">Up to 3 team members</span>
                                            </li>
                                        </ul>
                                        <button type="button" class="bg-primary-600 bg-hover-primary-700 text-white text-center border border-primary-600 text-sm btn-sm px-12 py-10 w-100 radius-8 mt-28" data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
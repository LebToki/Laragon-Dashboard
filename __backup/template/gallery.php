<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Gallery</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Gallery</li>
        </ul>
    </div>

    <div class="card h-100 p-0 radius-12 overflow-hidden">
        <div class="card-header border-bottom-0 pb-0 pt-0 px-0">
            <ul class="nav border-gradient-tab nav-pills mb-0 border-top-0" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">
                        All
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-ui-design-tab" data-bs-toggle="pill" data-bs-target="#pills-ui-design" type="button" role="tab" aria-controls="pills-ui-design" aria-selected="false" tabindex="-1">
                        UI Design
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-web-design-tab" data-bs-toggle="pill" data-bs-target="#pills-web-design" type="button" role="tab" aria-controls="pills-web-design" aria-selected="false" tabindex="-1">
                        Web Design
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-development-tab" data-bs-toggle="pill" data-bs-target="#pills-development" type="button" role="tab" aria-controls="pills-development" aria-selected="false" tabindex="-1">
                        Development
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-presentation-tab" data-bs-toggle="pill" data-bs-target="#pills-presentation" type="button" role="tab" aria-controls="pills-presentation" aria-selected="false" tabindex="-1">
                        Presentations
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body p-24">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img1.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img2.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img3.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img4.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img5.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img6.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img7.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img8.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img9.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img10.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img11.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img12.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-ui-design" role="tabpanel" aria-labelledby="pills-ui-design-tab" tabindex="0">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img3.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img4.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img5.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img6.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img7.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img8.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img9.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img10.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img11.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img12.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-web-design" role="tabpanel" aria-labelledby="pills-web-design-tab" tabindex="0">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img1.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img3.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img4.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img5.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img6.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img7.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img8.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img9.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img10.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img11.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img12.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-development" role="tabpanel" aria-labelledby="pills-development-tab" tabindex="0">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img4.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img5.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img1.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img2.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img3.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img6.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img7.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img8.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img9.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img10.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img11.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img12.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-presentation" role="tabpanel" aria-labelledby="pills-presentation-tab" tabindex="0">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img6.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img7.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img8.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img1.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img2.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img3.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img4.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img5.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img9.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img10.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img11.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="assets/images/gallery/gallery-img12.png" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                                <div class="py-16 px-24">
                                    <h6 class="mb-4">This is Image title</h6>
                                    <p class="mb-0 text-sm text-secondary-light">UI Design</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
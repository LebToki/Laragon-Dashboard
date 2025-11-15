<?php $script = '<script>
                    $(".generated-image-item .form-check-input").on("click", function() {
                        $(this).parent().parent(".generated-image-item").toggleClass("border border-primary-600 border-width-2-px")
                    });
                </script>';?>


<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Image Generator</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Image Generator</li>
        </ul>
    </div>
    <div class="row gy-4">
        <div class="col-xxl-3 col-lg-4">
            <div class="card h-100 p-0">
                <div class="card-body p-24">
                    <div class="mb-20">
                        <label for="resulation" class="text-sm fw-semibold text-primary-light mb-8">Image Resolution</label>
                        <input type="text" class="form-control px-16 py-14 h-48-px" id="resulation" value="1024 x 1024px">
                    </div>
                    <div class="mb-20">
                        <label for="style" class="text-sm fw-semibold text-primary-light mb-8">Image Resolution</label>
                        <select class="form-select form-control px-16 py-14 h-48-px" id="style">
                            <option value="">Carton</option>
                            <option value="">Oil painting</option>
                            <option value="">Pencil sketch</option>
                            <option value="">Paper collage</option>
                            <option value="">Street art</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label for="LightingStyle" class="text-sm fw-semibold text-primary-light mb-8">Lighting Style</label>
                        <select class="form-select form-control px-16 py-14 h-48-px" id="LightingStyle">
                            <option value="">Back lighting</option>
                            <option value="">None</option>
                            <option value="">Chiaroscuro</option>
                            <option value="">God rays</option>
                            <option value="">Studio lighting</option>
                            <option value="">Candlelight</option>
                            <option value="">Street lighting</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label for="Mood" class="text-sm fw-semibold text-primary-light mb-8">Mood</label>
                        <select class="form-select form-control px-16 py-14 h-48-px" id="Mood">
                            <option value="">None</option>
                            <option value="">Chiaroscuro</option>
                            <option value="">God rays</option>
                            <option value="">Studio lighting</option>
                            <option value="">Candlelight</option>
                            <option value="">Street lighting</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label for="imageNumber" class="text-sm fw-semibold text-primary-light mb-8">Number Of Image</label>
                        <input type="number" class="form-control px-16 py-14 h-48-px" id="imageNumber" value="4">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xxl-9 col-lg-8">
            <div class="chat-main card overflow-hidden">
                <div class="chat-sidebar-single gap-8 justify-content-between cursor-default flex-nowrap">
                    <div class="d-flex align-items-center gap-16">
                        <a href="text-generator-new.php" class="text-primary-light text-2xl line-height-1"><i class="ri-arrow-left-line"></i></a>
                        <h6 class="text-lg mb-0 text-line-1">Please, Make 4 variant of this image Quickly As Soon As possible</h6>
                    </div>

                    <div class="d-flex align-items-center gap-16 flex-shrink-0">
                        <button type="button" class="text-secondary-light text-xl line-height-1 text-hover-primary-600"><i class="ri-edit-2-line"></i></button>
                        <button type="button" class="text-secondary-light text-xl line-height-1 text-hover-primary-600"><i class="ri-delete-bin-6-line"></i></button>
                    </div>
                </div><!-- chat-sidebar-single end -->
                <div class="chat-message-list max-h-612-px min-h-612-px">

                    <!-- User generated Text Start -->
                    <div class="d-flex align-items-start justify-content-between gap-16 border-bottom border-neutral-200 pb-16 mb-16">
                        <div class="d-flex align-items-center gap-16">
                            <div class="img overflow-hidden flex-shrink-0">
                                <img src="assets/images/chat/1.png" alt="image" class="w-44-px h-44-px rounded-circle object-fit-cover">
                            </div>
                            <div class="info">
                                <h6 class="text-lg mb-4">Adam Milner</h6>
                                <p class="mb-0 text-secondary-light text-sm">Please, Make 4 variant of this image Quickly As Soon As possible </p>
                            </div>
                        </div>
                        <button type="button" class="d-flex align-items-center gap-6 px-8 py-4 bg-primary-50 radius-4 bg-hover-primary-100 flex-shrink-0"> <i class="ri-edit-2-fill"></i> Edit</button>
                    </div>
                    <!-- User generated Text End -->

                    <!-- WowDash generated Text Start -->
                    <div class="d-flex align-items-start gap-16 border-bottom border-neutral-200 pb-16 mb-16">
                        <div class="img overflow-hidden flex-shrink-0">
                            <img src="assets/images/wow-dash-favicon.png" alt="image" class="w-44-px h-44-px rounded-circle object-fit-cover">
                        </div>
                        <div class="info flex-grow-1">
                            <h6 class="text-lg mb-16 mt-8">WowDash</h6>

                            <div class="row g-3">
                                <div class="col-xl-3 col-sm-6">
                                    <div class="generated-image-item radius-8 overflow-hidden position-relative">
                                        <img src="assets/images/chatgpt/image-generator1.png" alt="" class="w-100 h-100 object-fit-cover">
                                        <div class="form-check style-check d-flex align-items-center position-absolute top-0 start-0 ms-8 mt-8">
                                            <input class="form-check-input radius-4 border border-neutral-400" id="image1" type="checkbox" name="checkbox">
                                        </div>
                                        <label for="image1" class="position-absolute start-0 top-0 w-100 h-100"></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="generated-image-item radius-8 overflow-hidden position-relative">
                                        <img src="assets/images/chatgpt/image-generator2.png" alt="" class="w-100 h-100 object-fit-cover">
                                        <div class="form-check style-check d-flex align-items-center position-absolute top-0 start-0 ms-8 mt-8">
                                            <input class="form-check-input radius-4 border border-neutral-400" id="image2" type="checkbox" name="checkbox">
                                        </div>
                                        <label for="image2" class="position-absolute start-0 top-0 w-100 h-100"></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="generated-image-item radius-8 overflow-hidden position-relative">
                                        <img src="assets/images/chatgpt/image-generator3.png" alt="" class="w-100 h-100 object-fit-cover">
                                        <div class="form-check style-check d-flex align-items-center position-absolute top-0 start-0 ms-8 mt-8">
                                            <input class="form-check-input radius-4 border border-neutral-400" id="image3" type="checkbox" name="checkbox">
                                        </div>
                                        <label for="image3" class="position-absolute start-0 top-0 w-100 h-100"></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="generated-image-item radius-8 overflow-hidden position-relative">
                                        <img src="assets/images/chatgpt/image-generator4.png" alt="" class="w-100 h-100 object-fit-cover">
                                        <div class="form-check style-check d-flex align-items-center position-absolute top-0 start-0 ms-8 mt-8">
                                            <input class="form-check-input radius-4 border border-neutral-400" id="image4" type="checkbox" name="checkbox">
                                        </div>
                                        <label for="image4" class="position-absolute start-0 top-0 w-100 h-100"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-16 mt-24 flex-wrap">
                                <button type="button" class="btn btn-outline-primary-600">🚀 Upscale (2x)</button>
                                <button type="button" class="btn btn-outline-primary-600">🎲 Make Square</button>
                                <button type="button" class="btn btn-outline-primary-600">⭐ Zoom Out 2x</button>
                                <button type="button" class="btn btn-outline-primary-600">🎉️ Upscale (4x) </button>
                                <button type="button" class="btn btn-outline-primary-600">🎁 Upscale (6x)</button>
                            </div>

                            <div class="mt-24 d-flex align-items-center justify-content-between gap-16">
                                <div class="d-flex align-items-center gap-20 bg-neutral-50 radius-8 px-16 py-10 line-height-1">
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-thumb-up-line line-height-1"></i></button>
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-thumb-down-line"></i></button>
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-share-forward-line"></i></button>
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-download-2-fill"></i></button>
                                </div>
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center gap-8"> <i class="ri-repeat-2-line"></i> Regenerate</button>
                            </div>
                        </div>
                    </div>
                    <!-- WowDash generated Text End -->

                    <!-- User generated Text Start -->
                    <div class="d-flex align-items-start justify-content-between gap-16 border-bottom border-neutral-200 pb-16 mb-16">
                        <div class="d-flex align-items-center gap-16">
                            <div class="img overflow-hidden flex-shrink-0">
                                <img src="assets/images/chat/1.png" alt="image" class="w-44-px h-44-px rounded-circle object-fit-cover">
                            </div>
                            <div class="info">
                                <h6 class="text-lg mb-4">Adam Milner</h6>
                                <p class="mb-0 text-secondary-light text-sm">Please, Make 4 variant of this image Quickly As Soon As possible </p>
                            </div>
                        </div>
                        <button type="button" class="d-flex align-items-center gap-6 px-8 py-4 bg-primary-50 radius-4 bg-hover-primary-100 flex-shrink-0"> <i class="ri-edit-2-fill"></i> Edit</button>
                    </div>
                    <!-- User generated Text End -->

                    <!-- WowDash generated Text Start -->
                    <div class="d-flex align-items-start gap-16 border-bottom border-neutral-200 pb-16 mb-16">
                        <div class="img overflow-hidden flex-shrink-0">
                            <img src="assets/images/wow-dash-favicon.png" alt="image" class="w-44-px h-44-px rounded-circle object-fit-cover">
                        </div>
                        <div class="info flex-grow-1">
                            <h6 class="text-lg mb-16 mt-8">WowDash</h6>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="generated-image-item radius-8 overflow-hidden position-relative">
                                        <img src="assets/images/chatgpt/image-generator5.png" alt="" class="w-100 h-100 object-fit-cover">
                                        <button type="button" class="download-btn position-absolute top-0 end-0 me-8 mt-8 w-50-px h-50-px bg-primary-600 text-white d-flex justify-content-center align-items-center radius-6 text-2xl bg-hover-primary-700">
                                            <i class="ri-download-2-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-24 d-flex align-items-center justify-content-between gap-16">
                                <div class="d-flex align-items-center gap-20 bg-neutral-50 radius-8 px-16 py-10 line-height-1">
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-thumb-up-line line-height-1"></i></button>
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-thumb-down-line"></i></button>
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-share-forward-line"></i></button>
                                    <button type="button" class="text-secondary-light text-2xl d-flex text-hover-info-600"><i class="ri-download-2-fill"></i></button>
                                </div>
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center gap-8"> <i class="ri-repeat-2-line"></i> Regenerate</button>
                            </div>
                        </div>
                    </div>
                    <!-- WowDash generated Text End -->

                </div>
                <form class="chat-message-box">
                    <input type="text" name="chatMessage" placeholder="Message wowdash...">
                    <button type="submit" class="w-44-px h-44-px d-flex justify-content-center align-items-center radius-8 bg-primary-600 text-white bg-hover-primary-700 text-xl">
                        <iconify-icon icon="f7:paperplane"></iconify-icon>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include './partials/layouts/layoutBottom.php' ?>
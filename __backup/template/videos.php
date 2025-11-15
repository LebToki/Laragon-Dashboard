<?php $script ='<script>
                    // ========================= magnific Popup Icon Js Start =====================
                    $(".magnific-video").magnificPopup({
                        type: "iframe"
                    });
                    // ========================= magnific Popup Icon Js End =====================
               </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Videos</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Videos</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-xxl-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Video</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="position-relative">
                                <img src="assets/images/videos/video-img1.png" class="w-100 h-100 object-fit-cover radius-8" alt="">
                                <a href="https://www.youtube.com/watch?v=Vr9WoWXkKeE" class="magnific-video bordered-shadow w-56-px h-56-px bg-white rounded-circle d-flex justify-content-center align-items-center position-absolute start-50 top-50 translate-middle z-1">
                                    <iconify-icon icon="ion:play" class="text-primary-600 text-xxl"></iconify-icon>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Videos With Content</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="border bg-base radius-8 overflow-hidden ">
                                        <div class="position-relative max-h-258-px overflow-hidden">
                                            <img src="assets/images/videos/video-img2.png" class="w-100 object-fit-cover" alt="">
                                            <a href="https://www.youtube.com/watch?v=Vr9WoWXkKeE" class="magnific-video bordered-shadow w-56-px h-56-px bg-white rounded-circle d-flex justify-content-center align-items-center position-absolute start-50 top-50 translate-middle z-1">
                                                <iconify-icon icon="ion:play" class="text-primary-600 text-xxl"></iconify-icon>
                                            </a>
                                        </div>
                                        <div class="p-16">
                                            <h6 class="text-xl mb-6 ">This is Video title</h6>
                                            <p class="text-secondary-light mb-0">We quickly learn to fear and thus autom atically avo id potentially stressful</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="border bg-base radius-8 overflow-hidden ">
                                        <div class="position-relative max-h-258-px overflow-hidden">
                                            <img src="assets/images/videos/video-img3.png" class="w-100 object-fit-cover" alt="">
                                            <a href="https://www.youtube.com/watch?v=Vr9WoWXkKeE" class="magnific-video bordered-shadow w-56-px h-56-px bg-white rounded-circle d-flex justify-content-center align-items-center position-absolute start-50 top-50 translate-middle z-1">
                                                <iconify-icon icon="ion:play" class="text-primary-600 text-xxl"></iconify-icon>
                                            </a>
                                        </div>
                                        <div class="p-16">
                                            <h6 class="text-xl mb-6 ">This is Video title here</h6>
                                            <p class="text-secondary-light mb-0">We quickly learn to fear and thus autom atically avo id potentially stressful</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Video</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="position-relative">
                                <img src="assets/images/videos/video-img4.png" class="w-100 h-100 object-fit-cover radius-8" alt="">
                                <a href="https://www.youtube.com/watch?v=Vr9WoWXkKeE" class="magnific-video bordered-shadow w-56-px h-56-px bg-white rounded-circle d-flex justify-content-center align-items-center position-absolute start-50 top-50 translate-middle z-1">
                                    <iconify-icon icon="ion:play" class="text-primary-600 text-xxl"></iconify-icon>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
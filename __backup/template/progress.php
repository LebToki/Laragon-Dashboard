<?php $script = '<script>
    // Floating progress bar
    $(".progress-wrapper").each(function() {
        var percentage = $(this).attr("data-perc");
        var floatingLabel = $(this).find(".floating-label");

        // Set CSS variable to be used in keyframes
        floatingLabel.css("--left-percentage", percentage);

        // Trigger reflow to restart animation
        floatingLabel[0].offsetWidth; // Force reflow
        floatingLabel.css("animation-name", "none");
        floatingLabel.css("left", percentage); // Ensure final position is correct
        floatingLabel.css("animation-name", "animateFloatingLabel");
    });



    // Semi Circle progress bar
    $(".progressBar").each(function() {
        var $bar = $(this).find(".circleBar");
        var $val = $(this).find(".barNumber");
        var perc = parseInt($val.text(), 10);

        $({
            p: 0
        }).animate({
            p: perc
        }, {
            duration: 3000,
            easing: "swing",
            step: function(p) {
                $bar.css({
                    transform: "rotate(" + (45 + (p * 1.8)) + "deg)", // 100%=180° so: ° = % * 1.8
                    // 45 is to add the needed rotation to have the green borders at the bottom
                });
                $val.text(p | 0);
            }
        });
    });
    </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Progress Bar</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Progress Bar</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Default Progress</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-column gap-4">
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-primary-600" style="width: 20%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-primary-600" style="width: 35%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-primary-600" style="width: 50%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-primary-600" style="width: 75%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-primary-600" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Progress with multiple color</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-column gap-4">
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-primary-600" style="width: 20%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-success-100" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-success-600" style="width: 35%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-info-100" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-info-600" style="width: 50%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-warning-100" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-warning-600" style="width: 75%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-danger-100" role="progressbar" aria-label="Basic example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill bg-danger-600" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Progress with right label</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-column gap-3">
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 10%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold line-height-1">10%</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 30%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold line-height-1">30%</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 50%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold line-height-1">50%</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 70%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold line-height-1">70%</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 90%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold line-height-1">90%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Striped Progress</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-column gap-4">
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill bg-primary-600" style="width: 20%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill bg-primary-600" style="width: 35%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill bg-primary-600" style="width: 50%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill bg-primary-600" style="width: 75%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill bg-primary-600" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Animated Progress</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-column gap-4">
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-primary-600" style="width: 20%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-success-100" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-success-600" style="width: 35%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-info-100" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-info-600" style="width: 50%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-warning-100" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-warning-600" style="width: 75%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-danger-100" role="progressbar" aria-label="Basic example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-danger-600" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0"> Gradient Progress </h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-column gap-4">
                                <div class="progress h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-primary-gradient" style="width: 20%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-success-100" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-success-gradient" style="width: 35%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-info-100" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-info-gradient" style="width: 50%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-warning-100" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-warning-gradient" style="width: 75%"></div>
                                </div>
                                <div class="progress h-8-px w-100 bg-danger-100" role="progressbar" aria-label="Basic example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar animated-bar rounded-pill bg-danger-gradient" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0"> Gradient Progress </h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="10%">
                                <div class="h-50-px position-relative w-100 d-flex">
                                    <span class="floating-label position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        10%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 10%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="30%">
                                <div class="h-50-px position-relative w-100 d-flex">
                                    <span class="floating-label position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        30%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 30%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="50%">
                                <div class="h-50-px position-relative w-100 d-flex">
                                    <span class="floating-label position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        50%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 50%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="70%">
                                <div class="h-50-px position-relative w-100 d-flex">
                                    <span class="floating-label position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        70%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 70%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="90%">
                                <div class="h-50-px position-relative w-100 d-flex">
                                    <span class="floating-label position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        90%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 90%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0"> Gradient Progress </h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="10%">
                                <div class="h-50-px position-relative w-100">
                                    <span class="floating-label bottom-0 top-auto mt-12 position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        10%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 10%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="30%">
                                <div class="h-50-px position-relative w-100">
                                    <span class="floating-label bottom-0 top-auto mt-12 position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        30%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 30%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="50%">
                                <div class="h-50-px position-relative w-100">
                                    <span class="floating-label bottom-0 top-auto mt-12 position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        50%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 50%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="70%">
                                <div class="h-50-px position-relative w-100">
                                    <span class="floating-label bottom-0 top-auto mt-12 position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        70%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 70%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper d-flex align-items-center flex-column gap-4" data-perc="90%">
                                <div class="h-50-px position-relative w-100">
                                    <span class="floating-label bottom-0 top-auto mt-12 position-absolute text-xs fw-semibold text-secondary-light bg-base border radius-8 w-50-px h-32-px z-1 shadow d-flex justify-content-center align-items-center">
                                        90%
                                    </span>
                                    <div class="progress mt-auto h-8-px w-100 bg-primary-50" role="progressbar" aria-label="Basic example" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar animated-bar rounded-pill bg-primary-gradien overflow-visible" style="width: 90%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="card p-0 overflow-hidden position-relative radius-12">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0"> Progress Circle </h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="">

                                <div class="progressBar w-90-px h-44-px position-relative text-primary-light fw-semibold">
                                    <div class="barOverflow">
                                        <div class="circleBar border-width-6-px"></div>
                                    </div>
                                    <div class="position-absolute start-50 translate-middle top-50 line-height-1 mt-8">
                                        <div class="d-flex align-items-center justify-content-center line-height-1 text-sm">
                                            <span class="barNumber line-height-1">40 </span>
                                            <span>%</span>
                                        </div>
                                        <span class="line-height-1 text-xs text-secondary-light">Users</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

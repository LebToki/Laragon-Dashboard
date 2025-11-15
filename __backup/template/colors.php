<?php $script = '<script>
                        // =========================== Copy Color Code when click on box Js Start ================================ 
                        $(".color-box").click(function() {
                            var clipboardText = $(this).find("[data-clipboard-text]").attr("data-clipboard-text");

                            // Create a temporary input element to hold the text to copy
                            var tempInput = $("<input>");
                            $("body").append(tempInput);
                            tempInput.val(clipboardText).select();

                            // Copy the text to the clipboard 
                            document.execCommand("copy");

                            // Remove the temporary input element
                            tempInput.remove();


                            // Remove any existing badge
                            $(this).find(".copied-message").remove();

                            // Create the notification badge
                            var $badge = $(`<span class="copied-message text-xs badge bg-success-main py-8 px-12 fw-normal rounded-pill position-absolute start-50 translate-middle-x top-0 mt-24">    Copied! </span>`)

                            // Append the badge to the color box
                            $(this).append($badge);

                            // Show the badge and then fade it out
                            $badge.fadeIn().delay(800).fadeOut(function() {
                                $(this).remove();
                            });

                        });
                        // =========================== Copy Color Code when click on box Js End ================================ 
    </script>';?>


<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Colors</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Colors</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-24">
                            <!-- Shade Start -->
                            <div class="mb-32">
                                <h6 class="text-md mb-24">Shades</h6>
                                <div class="d-flex flex-wrap">
                                    <div class="color-box h-190-px cursor-pointer max-w-150-px w-100 bg-base position-relative p-28 flex-grow-1 border">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">100</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-base">#FFFFFF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer max-w-150-px w-100 bg-neutral-900 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">100</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-neutral-900">#111827</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Shade End -->

                            <!-- Neutral Start -->
                            <div class="mb-32">
                                <h6 class="text-md mb-24">Neutral</h6>
                                <div class="d-flex flex-wrap">
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-50 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">50</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-neutral-50">#FAFAFA</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-100 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">100</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-neutral-100">#F5F5F5</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-200 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">200</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-neutral-200">#E5E5E5</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-300 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">300</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-neutral-300">#D4D4D4</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-400 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-bloc">400</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-neutral-400">#A3A3A3</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-500 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">500</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-neutral-500">#737373</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-600 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">600</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-neutral-600">#525252</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-700 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">700</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-neutral-700">#404040</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-800 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">800</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-neutral-800">#262626</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-neutral-900 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">900</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-neutral-900">#171717</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Neutral End -->

                            <!-- Primary Start -->
                            <div class="mb-32">
                                <h6 class="text-md mb-24">Primary Color</h6>
                                <div class="d-flex flex-wrap">
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-50 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">50</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-primary-50">#E4F1FF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-100 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">100</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-primary-100">#BFDCFF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-200 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">200</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-primary-200">#95C7FF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-300 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">300</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-primary-300">#6BB1FF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-400 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-bloc">400</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-primary-400">#519FFF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-500 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">500</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-primary-500">#458EFF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-600 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">600</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-primary-600">#487FFF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-700 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">700</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-primary-700">#486CEA</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-800 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">800</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-primary-800">#4759D6</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-primary-900 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">900</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-primary-900">#4536B6</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Primary End -->

                            <!-- Error Start -->
                            <div class="mb-32">
                                <h6 class="text-md mb-24">Error Color</h6>
                                <div class="d-flex flex-wrap">
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-50 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">50</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-danger-50">#FEF2F2</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-100 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">100</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-danger-100">#FEE2E2</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-200 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">200</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-danger-200">#FECACA</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-300 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">300</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-danger-300">#FCA5A5</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-400 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-bloc">400</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-danger-400">#F87171</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-500 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">500</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-danger-500">#EF4444</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-600 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">600</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-danger-600">#DC2626</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-700 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">700</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-danger-700">#B91C1C</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-800 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">800</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-danger-800">#991B1B</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-danger-900 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">900</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-danger-900">#7F1D1D</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Error End -->

                            <!-- Success Start -->
                            <div class="mb-32">
                                <h6 class="text-md mb-24">Success Color</h6>
                                <div class="d-flex flex-wrap">
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-50 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">50</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-success-50">#F0FDF4</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-100 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">100</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-success-100">#DCFCE7</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-200 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">200</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-success-200">#BBF7D0</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-300 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">300</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-success-300">#86EFAC</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-400 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-bloc">400</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-success-400">#4ADE80</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-500 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">500</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-success-500">#22C55E</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-600 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">600</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-success-600">#16A34A</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-700 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">700</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-success-700">#15803D</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-800 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">800</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-success-800">#166534</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-success-900 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">900</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-success-900">#14532D</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Success End -->

                            <!-- Warning Start -->
                            <div class="mb-32">
                                <h6 class="text-md mb-24">Warning Color</h6>
                                <div class="d-flex flex-wrap">
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-50 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">50</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-warning-50">#FEFCE8</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-100 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-block">100</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-warning-100">#FEF9C3</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-200 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-block">200</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-warning-200">#FEF08A</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-300 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-block">300</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-warning-300">#FDE047</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-400 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-bloc">400</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-warning-400">#FACC15</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-500 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">500</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-warning-500">#EAB308</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-600 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">600</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-warning-600">#CA8A04</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-700 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">700</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-warning-700">#A16207</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-800 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">800</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-warning-800">#854D0E</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-warning-900 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">900</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-warning-900">#713F12</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Warning End -->

                            <!-- Info Start -->
                            <div class="mb-32">
                                <h6 class="text-md mb-24">Info Color</h6>
                                <div class="d-flex flex-wrap">
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-50 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block">50</span>
                                            <span class="fw-medium text-md text-primary-light d-block" data-clipboard-text="bg-info-50">#EFF6FF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-100 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-block">100</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-info-100">#DBEAFE</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-200 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-block">200</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-info-200">#BFDBFE</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-300 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-block">300</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-info-300">#93C5FD</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-400 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-dark-1 d-bloc">400</span>
                                            <span class="fw-medium text-md text-dark-1 d-block" data-clipboard-text="bg-info-400">#60A5FA</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-500 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">500</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-info-500">#3B82F6</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-600 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">600</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-info-600">#2563EB</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-700 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">700</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-info-700">#1D4ED8</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-800 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">800</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-info-800">#1E40AF</span>
                                        </div>
                                    </div>
                                    <div class="color-box h-190-px cursor-pointer min-w-120-px bg-info-900 position-relative p-28 flex-grow-1">
                                        <div class="position-absolute start-50 translate-middle-x bottom-0 text-center mb-28">
                                            <span class="fw-medium text-lg text-primary-light d-block text-base">900</span>
                                            <span class="fw-medium text-md text-primary-light d-block text-base" data-clipboard-text="bg-info-900">#1E3A8A</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Info End -->

                        </div>
                    </div>
                </div>
            </div>


        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
<?php $script = '<script>
                            // ================== Image Upload Js Start ===========================
                            function readURL(input, previewElementId) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $("#" + previewElementId).css("background-image", "url(" + e.target.result + ")");
                                        $("#" + previewElementId).hide();
                                        $("#" + previewElementId).fadeIn(650);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#imageUpload").change(function() {
                                readURL(this, "previewImage1");
                            });

                            $("#imageUploadTwo").change(function() {
                                readURL(this, "previewImage2");
                            });
                            // ================== Image Upload Js End ===========================
                            </script>'
                ;?>


<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Theme</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Settings - Theme</li>
                </ul>
            </div>

            <div class="card h-100 p-0 radius-12">
                <div class="card-body p-24">
                    <form action="#">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <label for="imageUpload" class="form-label fw-semibold text-secondary-light text-md mb-8">Logo <span class="text-secondary-light fw-normal">(140px X 140px)</span></label>
                                <input type="file" class="form-control radius-8" id="imageUpload">
                                <div class="avatar-upload mt-16">
                                    <div class="avatar-preview style-two">
                                        <div id="previewImage1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="imageUploadTwo" class="form-label fw-semibold text-secondary-light text-md mb-8">Logo <span class="text-secondary-light fw-normal">(140px X 140px)</span></label>
                                <input type="file" class="form-control radius-8" id="imageUploadTwo">
                                <div class="avatar-upload mt-16">
                                    <div class="avatar-preview style-two">
                                        <div id="previewImage2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-32">
                            <h6 class="text-xl mb-16">Theme Colors</h6>
                            <div class="row gy-4">
                                <div class="col-xxl-2 col-md-4 col-sm-6">
                                    <input class="form-check-input payment-gateway-input" name="payment-gateway" type="radio" id="blue" hidden>
                                    <label for="blue" class="payment-gateway-label border radius-8 p-8 w-100">
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-primary-600 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Blue</span>
                                            </span>
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-primary-100 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Focus</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-xxl-2 col-md-4 col-sm-6">
                                    <input class="form-check-input payment-gateway-input" name="payment-gateway" type="radio" id="magenta" hidden>
                                    <label for="magenta" class="payment-gateway-label border radius-8 p-8 w-100">
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-lilac-600 radius-4"></span>
                                                <span class="text-lilac-light text-md fw-semibold mt-8">Magenta</span>
                                            </span>
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-lilac-100 radius-4"></span>
                                                <span class="text-lilac-light text-md fw-semibold mt-8">Focus</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-xxl-2 col-md-4 col-sm-6">
                                    <input class="form-check-input payment-gateway-input" name="payment-gateway" type="radio" id="orange" hidden>
                                    <label for="orange" class="payment-gateway-label border radius-8 p-8 w-100">
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-warning-600 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Orange</span>
                                            </span>
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-warning-100 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Focus</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-xxl-2 col-md-4 col-sm-6">
                                    <input class="form-check-input payment-gateway-input" name="payment-gateway" type="radio" id="green" hidden>
                                    <label for="green" class="payment-gateway-label border radius-8 p-8 w-100">
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-success-600 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Green</span>
                                            </span>
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-success-100 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Focus</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-xxl-2 col-md-4 col-sm-6">
                                    <input class="form-check-input payment-gateway-input" name="payment-gateway" type="radio" id="red" hidden>
                                    <label for="red" class="payment-gateway-label border radius-8 p-8 w-100">
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-danger-600 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Red</span>
                                            </span>
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-danger-100 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Focus</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-xxl-2 col-md-4 col-sm-6">
                                    <input class="form-check-input payment-gateway-input" name="payment-gateway" type="radio" id="blueDark" hidden>
                                    <label for="blueDark" class="payment-gateway-label border radius-8 p-8 w-100">
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-info-600 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Blue Dark</span>
                                            </span>
                                            <span class="w-50 text-center">
                                                <span class="h-72-px w-100 bg-info-100 radius-4"></span>
                                                <span class="text-secondary-light text-md fw-semibold mt-8">Focus</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                    <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                        Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                                        Save Change
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
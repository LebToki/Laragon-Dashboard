<?php $script = '<script>
                        $(".remove-button").on("click", function() {
                            $(this).closest(".alert").addClass("d-none")
                        });
                </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Alerts</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Alerts</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Alerts</h6>
                        </div>
                        <div class="card-body p-24 d-flex flex-column gap-4">
                            <div class="alert alert-primary bg-primary-50 text-primary-600 border-primary-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Primary alert
                                <button class="remove-button text-primary-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-lilac bg-lilac-50 text-lilac-600 border-lilac-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Secondary alert
                                <button class="remove-button text-lilac-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-warning bg-warning-100 text-warning-600 border-warning-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Warning alert
                                <button class="remove-button text-warning-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-info bg-info-100 text-info-600 border-info-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Info alert
                                <button class="remove-button text-info-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Danger alert
                                <button class="remove-button text-danger-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Outline Alerts</h6>
                        </div>
                        <div class="card-body p-24 d-flex flex-column gap-4">
                            <div class="alert alert-primary bg-transparent text-primary-600 border-primary-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Primary alert
                                <button class="remove-button text-primary-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-lilac bg-transparent text-lilac-600 border-lilac-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Secondary alert
                                <button class="remove-button text-lilac-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-warning bg-transparent text-warning-600 border-warning-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Warning alert
                                <button class="remove-button text-warning-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-info bg-transparent text-info-600 border-info-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Info alert
                                <button class="remove-button text-info-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-danger bg-transparent text-danger-600 border-danger-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                This is a Danger alert
                                <button class="remove-button text-danger-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Solid Alerts</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column gap-4">
                                        <div class="alert alert-primary bg-primary-600 text-white border-primary-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                            This is a Primary alert
                                            <button class="remove-button text-white text-xxl line-height-1">
                                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                            </button>
                                        </div>
                                        <div class="alert alert-success bg-success-600 text-white border-success-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                            This is a Success alert
                                            <button class="remove-button text-white text-xxl line-height-1">
                                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                            </button>
                                        </div>
                                        <div class="alert alert-info bg-info-600 text-white border-info-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                            This is a Info alert
                                            <button class="remove-button text-white text-xxl line-height-1">
                                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column gap-4">
                                        <div class="alert alert-lilac bg-lilac-600 text-white border-lilac-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                            This is a Secondary alert
                                            <button class="remove-button text-white text-xxl line-height-1">
                                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                            </button>
                                        </div>
                                        <div class="alert alert-warning bg-warning-600 text-white border-warning-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                            This is a Warning alert
                                            <button class="remove-button text-white text-xxl line-height-1">
                                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                            </button>
                                        </div>
                                        <div class="alert alert-danger bg-danger-600 text-white border-danger-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                            This is a Danger alert
                                            <button class="remove-button text-white text-xxl line-height-1">
                                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Outline Alerts</h6>
                        </div>
                        <div class="card-body p-24 d-flex flex-column gap-4">
                            <div class="alert alert-primary bg-primary-50 text-primary-600 border-primary-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mingcute:emoji-line" class="icon text-xl"></iconify-icon>
                                    This is a Primary alert
                                </div>
                                <button class="remove-button text-primary-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-lilac bg-lilac-50 text-lilac-600 border-lilac-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mingcute:emoji-line" class="icon text-xl"></iconify-icon>
                                    This is a Secondary alert
                                </div>
                                <button class="remove-button text-lilac-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
                                    This is a Success alert
                                </div>
                                <button class="remove-button text-success-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-warning bg-warning-100 text-warning-600 border-warning-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
                                    This is a Warning alert
                                </div>
                                <button class="remove-button text-warning-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-info bg-info-100 text-info-600 border-info-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="ci:link" class="icon text-xl"></iconify-icon>
                                    This is a Info alert
                                </div>
                                <button class="remove-button text-info-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mingcute:delete-2-line" class="icon text-xl"></iconify-icon>
                                    This is a Danger alert
                                </div>
                                <button class="remove-button text-danger-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Left Border Alerts</h6>
                        </div>
                        <div class="card-body p-24 d-flex flex-column gap-4">
                            <div class="alert alert-primary bg-primary-50 text-primary-600 border-primary-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mingcute:emoji-line" class="icon text-xl"></iconify-icon>
                                    This is a Primary alert
                                </div>
                                <button class="remove-button text-primary-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-lilac bg-lilac-50 text-lilac-600 border-lilac-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mingcute:emoji-line" class="icon text-xl"></iconify-icon>
                                    This is a Secondary alert
                                </div>
                                <button class="remove-button text-lilac-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-success bg-success-100 text-success-600 border-success-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
                                    This is a Success alert
                                </div>
                                <button class="remove-button text-success-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-warning bg-warning-100 text-warning-600 border-warning-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
                                    This is a Warning alert
                                </div>
                                <button class="remove-button text-warning-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-info bg-info-100 text-info-600 border-info-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="ci:link" class="icon text-xl"></iconify-icon>
                                    This is a Info alert
                                </div>
                                <button class="remove-button text-info-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="mingcute:delete-2-line" class="icon text-xl"></iconify-icon>
                                    This is a Danger alert
                                </div>
                                <button class="remove-button text-danger-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Alerts</h6>
                        </div>
                        <div class="card-body p-24 d-flex flex-column gap-4">
                            <div class="alert alert-primary bg-primary-50 text-primary-600 border-primary-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-center justify-content-between text-lg">
                                    This is a Primary alert
                                    <button class="remove-button text-primary-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                                <p class="fw-medium text-primary-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                            </div>
                            <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-center justify-content-between text-lg">
                                    This is a Success alert
                                    <button class="remove-button text-success-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                                <p class="fw-medium text-success-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                            </div>
                            <div class="alert alert-warning bg-warning-100 text-warning-600 border-warning-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-center justify-content-between text-lg">
                                    This is a Warning alert
                                    <button class="remove-button text-warning-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                                <p class="fw-medium text-warning-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                            </div>
                            <div class="alert alert-info bg-info-100 text-info-600 border-info-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-center justify-content-between text-lg">
                                    This is a Info alert
                                    <button class="remove-button text-info-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                                <p class="fw-medium text-info-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                            </div>
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-center justify-content-between text-lg">
                                    This is a Danger alert
                                    <button class="remove-button text-danger-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                                <p class="fw-medium text-danger-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Alerts</h6>
                        </div>
                        <div class="card-body p-24 d-flex flex-column gap-4">
                            <div class="alert alert-primary bg-primary-50 text-primary-600 border-primary-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-start justify-content-between text-lg">
                                    <div class="d-flex align-items-start gap-2">
                                        <iconify-icon icon="mingcute:emoji-line" class="icon text-xl mt-4 flex-shrink-0"></iconify-icon>
                                        <div>
                                            This is a Primary alert
                                            <p class="fw-medium text-primary-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                        </div>
                                    </div>
                                    <button class="remove-button text-primary-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-start justify-content-between text-lg">
                                    <div class="d-flex align-items-start gap-2">
                                        <iconify-icon icon="bi:patch-check" class="icon text-xl mt-4 flex-shrink-0"></iconify-icon>
                                        <div>
                                            This is a Success alert
                                            <p class="fw-medium text-success-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                        </div>
                                    </div>
                                    <button class="remove-button text-success-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="alert alert-warning bg-warning-100 text-warning-600 border-warning-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-start justify-content-between text-lg">
                                    <div class="d-flex align-items-start gap-2">
                                        <iconify-icon icon="mdi:clock-outline" class="icon text-xl mt-4 flex-shrink-0"></iconify-icon>
                                        <div>
                                            This is a Warning alert
                                            <p class="fw-medium text-warning-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                        </div>
                                    </div>
                                    <button class="remove-button text-warning-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="alert alert-info bg-info-100 text-info-600 border-info-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-start justify-content-between text-lg">
                                    <div class="d-flex align-items-start gap-2">
                                        <iconify-icon icon="mynaui:check-octagon" class="icon text-xl mt-4 flex-shrink-0"></iconify-icon>
                                        <div>
                                            This is a Info alert
                                            <p class="fw-medium text-info-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                        </div>
                                    </div>
                                    <button class="remove-button text-info-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8" role="alert">
                                <div class="d-flex align-items-start justify-content-between text-lg">
                                    <div class="d-flex align-items-start gap-2">
                                        <iconify-icon icon="mingcute:delete-2-line" class="icon text-xl mt-4 flex-shrink-0"></iconify-icon>
                                        <div>
                                            This is a Danger alert
                                            <p class="fw-medium text-danger-600 text-sm mt-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                        </div>
                                    </div>
                                    <button class="remove-button text-danger-600 text-xxl line-height-1">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

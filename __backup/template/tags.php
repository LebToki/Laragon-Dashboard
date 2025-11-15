<?php $script = '<script>
                        $(".remove-tag").on("click", function() {
                            $(this).closest("li").remove();
                        });
                 </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Tags</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Tags</li>
                </ul>
            </div>
            <div class="row gy-4">
                <div class="col-sm-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Tags</h6>
                        </div>
                        <div class="card-body p-24">
                            <ul class="d-flex flex-wrap align-items-center gap-32">
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
                            </ul>
                            <ul class="tag-list d-flex flex-wrap align-items-center gap-20 mt-20">
                                <li class="text-secondary-light border radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Colors tags</h6>
                        </div>
                        <div class="card-body p-24">
                            <ul class="d-flex flex-wrap align-items-center gap-32">
                                <li class="text-white bg-primary-600 border border-primary-600 radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
                                <li class="text-white bg-lilac-600 border border-lilac-600 radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
                                <li class="text-white bg-warning-600 border border-warning-600 radius-4 px-8 py-4 text-sm line-height-1 fw-medium">Label</li>
                            </ul>
                            <ul class="tag-list d-flex flex-wrap align-items-center gap-20 mt-20">
                                <li class="text-primary-600 border border-primary-600 radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-lilac-600 border border-lilac-600 radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-warning-600 border border-warning-600 radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Tags With Image</h6>
                        </div>
                        <div class="card-body p-24">
                            <ul class="d-flex flex-wrap align-items-center gap-20 mt-20">
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <img src="assets/images/flags/flag-tag.png" class="w-16-px h-16-px rounded-circle" alt="">
                                    Label
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <img src="assets/images/flags/flag-tag.png" class="w-16-px h-16-px rounded-circle" alt="">
                                    Label
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <img src="assets/images/flags/flag-tag.png" class="w-16-px h-16-px rounded-circle" alt="">
                                    Label
                                </li>
                            </ul>
                            <ul class="tag-list d-flex flex-wrap align-items-center gap-20 mt-20">
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <img src="assets/images/flags/flag-tag.png" class="w-16-px h-16-px rounded-circle" alt="">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <img src="assets/images/flags/flag-tag.png" class="w-16-px h-16-px rounded-circle" alt="">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <img src="assets/images/flags/flag-tag.png" class="w-16-px h-16-px rounded-circle" alt="">
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Tags Indicator </h6>
                        </div>
                        <div class="card-body p-24">
                            <ul class="d-flex flex-wrap align-items-center gap-32">
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <span class="w-8-px h-8-px bg-success-main rounded-circle"></span>
                                    Label
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <span class="w-8-px h-8-px bg-success-main rounded-circle"></span>
                                    Label
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-4 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <span class="w-8-px h-8-px bg-success-main rounded-circle"></span>
                                    Label
                                </li>
                            </ul>
                            <ul class="tag-list d-flex flex-wrap align-items-center gap-20 mt-20">
                                <li class="text-secondary-light border radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <span class="w-8-px h-8-px bg-success-main rounded-circle"></span>
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <span class="w-8-px h-8-px bg-success-main rounded-circle"></span>
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                                <li class="text-secondary-light border radius-4 px-8 py-2 text-sm line-height-1 fw-medium d-flex align-items-center gap-1">
                                    <span class="w-8-px h-8-px bg-success-main rounded-circle"></span>
                                    Label
                                    <button class="remove-tag text-lg d-flex justify-content-center align-items-center" type="button">
                                        <iconify-icon icon="iconamoon:sign-times-light" class="icon line-height-1"></iconify-icon>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

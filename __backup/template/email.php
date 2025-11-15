<?php $script = '<script>
                    // Table Header Checkbox checked all js Start
                    $("#selectAll").on("change", function() {
                        $(".form-check .form-check-input").prop("checked", $(this).prop("checked"));

                        if ($(this).prop("checked")) {
                            $(".email-item").addClass("active");
                        } else {
                            $(".email-item").removeClass("active");
                        }
                    });

                    // Active Item with js
                    $(".form-check .form-check-input").on("change", function() {
                        if ($(this).is(":checked")) {
                            $(this).closest(".email-item").addClass("active");
                        } else {
                            $(this).closest(".email-item").removeClass("active");
                        }
                    });

                    // Selected Checkbox count amount js Start
                    $(".email-card .form-check-input").on("change", function() {
                        let selectedCount = $(".email-card .form-check-input:checked").length;

                        if (selectedCount > 0) {
                            $(".delete-button").removeClass("d-none");
                        } else {
                            $(".delete-button").addClass("d-none")
                        }
                    });
                    // Selected Checkbox count amount js End

                    $(".delete-button").on("click", function() {
                        $(".email-item.active").addClass("d-none")
                    });

                    // Page Reload Js
                    $(".reload-button").on("click", function() {
                        history.go(0);
                    });

                    // Starred Button js
                    $(".starred-button").on("click", function() {
                        $(this).toggleClass("active")
                    });
                </script>';?>


<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Email</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Email</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-xxl-3">
                    <div class="card h-100 p-0">
                        <div class="card-body p-24">
                            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 w-100 radius-8 d-flex align-items-center gap-2 mb-16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <iconify-icon icon="fa6-regular:square-plus" class="icon text-lg line-height-1"></iconify-icon>
                                Compose
                            </button>

                            <div class="mt-16">
                                <ul>
                                    <li class="item-active mb-4">
                                        <a href="email.php" class="bg-hover-primary-50 px-12 py-8 w-100 radius-8 text-secondary-light">
                                            <span class="d-flex align-items-center gap-10 justify-content-between w-100">
                                                <span class="d-flex align-items-center gap-10">
                                                    <span class="icon text-xxl line-height-1 d-flex">
                                                        <iconify-icon icon="uil:envelope" class="icon line-height-1"></iconify-icon>
                                                    </span>
                                                    <span class="fw-semibold">Inbox</span>
                                                </span>
                                                <span class="fw-medium">800</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="starred.php" class="bg-hover-primary-50 px-12 py-8 w-100 radius-8 text-secondary-light">
                                            <span class="d-flex align-items-center gap-10 justify-content-between w-100">
                                                <span class="d-flex align-items-center gap-10">
                                                    <span class="icon text-xxl line-height-1 d-flex">
                                                        <iconify-icon icon="ph:star-bold" class="icon line-height-1"></iconify-icon>
                                                    </span>
                                                    <span class="fw-semibold">Starred</span>
                                                </span>
                                                <span class="fw-medium">250</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="email.php" class="bg-hover-primary-50 px-12 py-8 w-100 radius-8 text-secondary-light">
                                            <span class="d-flex align-items-center gap-10 justify-content-between w-100">
                                                <span class="d-flex align-items-center gap-10">
                                                    <span class="icon text-xxl line-height-1 d-flex">
                                                        <iconify-icon icon="ion:paper-plane-outline" class="icon line-height-1"></iconify-icon>
                                                    </span>
                                                    <span class="fw-semibold">Sent</span>
                                                </span>
                                                <span class="fw-medium">80</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="email.php" class="bg-hover-primary-50 px-12 py-8 w-100 radius-8 text-secondary-light">
                                            <span class="d-flex align-items-center gap-10 justify-content-between w-100">
                                                <span class="d-flex align-items-center gap-10">
                                                    <span class="icon text-xxl line-height-1 d-flex">
                                                        <iconify-icon icon="lucide:pencil" class="icon line-height-1"></iconify-icon>
                                                    </span>
                                                    <span class="fw-semibold">Draft</span>
                                                </span>
                                                <span class="fw-medium">50</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="email.php" class="bg-hover-primary-50 px-12 py-8 w-100 radius-8 text-secondary-light">
                                            <span class="d-flex align-items-center gap-10 justify-content-between w-100">
                                                <span class="d-flex align-items-center gap-10">
                                                    <span class="icon text-xxl line-height-1 d-flex">
                                                        <iconify-icon icon="ph:warning-bold" class="icon line-height-1"></iconify-icon>
                                                    </span>
                                                    <span class="fw-semibold">Spam</span>
                                                </span>
                                                <span class="fw-medium">30</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="email.php" class="bg-hover-primary-50 px-12 py-8 w-100 radius-8 text-secondary-light">
                                            <span class="d-flex align-items-center gap-10 justify-content-between w-100">
                                                <span class="d-flex align-items-center gap-10">
                                                    <span class="icon text-xxl line-height-1 d-flex">
                                                        <iconify-icon icon="material-symbols:delete-outline" class="icon line-height-1"></iconify-icon>
                                                    </span>
                                                    <span class="fw-semibold">Bin</span>
                                                </span>
                                                <span class="fw-medium">20</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="mt-24">
                                    <h6 class="text-lg fw-semibold text-primary-light mb-16">TAGS</h6>
                                    <ul>
                                        <li class="mb-20">
                                            <span class="line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-10">
                                                <span class="w-8-px h-8-px bg-primary-600 rounded-circle"></span>
                                                Personal
                                            </span>
                                        </li>
                                        <li class="mb-20">
                                            <span class="line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-10">
                                                <span class="w-8-px h-8-px bg-lilac-600 rounded-circle"></span>
                                                Social
                                            </span>
                                        </li>
                                        <li class="mb-20">
                                            <span class="line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-10">
                                                <span class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                                Promotions
                                            </span>
                                        </li>
                                        <li class="mb-20">
                                            <span class="line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-10">
                                                <span class="w-8-px h-8-px bg-warning-600 rounded-circle"></span>
                                                Business
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-9">
                    <div class="card h-100 p-0 email-card">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                        <div class="dropdown line-height-1">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="line-height-1 d-flex">
                                                <iconify-icon icon="typcn:arrow-sorted-down" class="icon line-height-1"></iconify-icon>
                                            </button>
                                            <ul class="dropdown-menu p-12 border bg-base shadow">
                                                <li>
                                                    <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                                        All
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                        None
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                        Read
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                        Unread
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                        Starred
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                        Unstarred
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="button" class="delete-button d-none text-secondary-light text-xl d-flex">
                                        <iconify-icon icon="material-symbols:delete-outline" class="icon line-height-1"></iconify-icon>
                                    </button>
                                    <button type="button" class="reload-button text-secondary-light text-xl d-flex">
                                        <iconify-icon icon="tabler:reload" class="icon"></iconify-icon>
                                    </button>
                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class=" d-flex">
                                            <iconify-icon icon="entypo:dots-three-vertical" class="icon text-secondary-light"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-lg p-12 border bg-base shadow">
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                                    <iconify-icon icon="gravity-ui:envelope-open" class="icon text-lg line-height-1"></iconify-icon>
                                                    Mark all as read
                                                </button>
                                            </li>
                                            <li>
                                                <p class="ms-40 mt-8 text-secondary-light mb-0">
                                                    Select messages to see more actions
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <form class="navbar-search d-lg-block d-none">
                                        <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                                    </form>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="text-secondary-light line-height-1">1-12 of 1,253</span>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link d-flex bg-base border text-secondary-light text-xl" href="javascript:void(0)">
                                                    <iconify-icon icon="iconamoon:arrow-left-2" class="icon"></iconify-icon>
                                                </a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link d-flex bg-base border text-secondary-light text-xl" href="javascript:void(0)">
                                                    <iconify-icon icon="iconamoon:arrow-right-2" class="icon"></iconify-icon>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="overflow-x-auto">
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Jerome Bell</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Kristin Watson</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Cody Fisher</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Dianne Russell</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Floyd Miles</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Devon Lane</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Dianne Russell</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Annette Black</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Bessie Cooper</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Courtney Henry</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                                <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <button type="button" class="starred-button icon text-xl text-secondary-light line-height-1 d-flex">
                                        <iconify-icon icon="ph:star" class="icon-outline line-height-1"></iconify-icon>
                                        <iconify-icon icon="ph:star-fill" class="icon-fill line-height-1 text-warning-600"></iconify-icon>
                                    </button>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium text-md text-line-1 w-190-px">Wade Warren</a>
                                    <a href="veiw-details.php" class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus. Aliquam pulvinar vestibulum blandit. Donec sed nisl libero. Fusce dignissim luctus sem eu dapibus</a>
                                    <span class="text-primary-light fw-medium min-w-max-content ms-auto">6:07 AM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
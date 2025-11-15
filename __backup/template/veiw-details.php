<?php $script ='    <script>
    // ========================= Adjust Textarea Height depending of text lines(default height 40px) Js Start ===========================
    function adjustHeight(textarea) {
        // Calculate the scroll height of the content
        let scrollHeight = textarea.scrollHeight;

        // Set the textarea height to the scroll height, but not exceeding the maximum height
        if (scrollHeight > 44 && scrollHeight <= 60) {
            textarea.style.height = scrollHeight + "px";
        } else if (scrollHeight > 60) {
            // textarea.style.height = "60px !important";
            textarea.setAttribute("style", "height: 60px !important;");
        }
    }
    // ========================= Adjust Textarea Height depending of text lines(default height 40px) Js End ===========================
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
                    <div class="card h-100 p-0 email-card overflow-x-auto d-block">
                        <div class="min-w-450-px d-flex flex-column justify-content-between h-100">
                            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <button class="text-secondary-light d-flex me-8">
                                        <iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon>
                                    </button>
                                    <h6 class="mb-0 text-lg">Kathryn Murphy</h6>
                                    <span class="bg-primary-50 text-primary-600 text-sm radius-4 px-8">Personal</span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <button class="text-secondary-light d-flex">
                                        <iconify-icon icon="mi:print" class="icon text-xxl line-height-1"></iconify-icon>
                                    </button>
                                    <button class="text-secondary-light d-flex">
                                        <iconify-icon icon="mdi:star-outline" class="icon text-xxl line-height-1"></iconify-icon>
                                    </button>
                                    <button class="text-secondary-light d-flex">
                                        <iconify-icon icon="material-symbols:delete-outline" class="icon text-xxl line-height-1"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="py-16 px-24 border-bottom">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="assets/images/user-list/user-list1.png" alt="" class="w-40-px h-40-px rounded-pill">
                                        <div class="">
                                            <div class="d-flex align-items-center flex-wrap gap-2">
                                                <h6 class="mb-0 text-lg">Kathryn Murphy</h6>
                                                <span class="text-secondary-light text-md">kathrynmurphy@gmail.com</span>
                                            </div>
                                            <div class="mt-20">
                                                <p class="mb-16 text-primary-light">Hi William</p>
                                                <p class="mb-16 text-primary-light">Just confirming that we transferred $63.86 to you via PayPal <a href="javascript:void(0)" class="text-primary-600 text-decoration-underline">(info367@gmail.com)</a> which you earned on the themewow Market since your last payout.</p>
                                                <p class="mb-0 text-primary-light">Thank you for selling with us!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-16 px-24 border-bottom">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="assets/images/user-list/user-list2.png" alt="" class="w-40-px h-40-px rounded-pill">
                                        <div class="">
                                            <div class="d-flex align-items-center flex-wrap gap-2">
                                                <h6 class="mb-0 text-lg">Subrata Sen</h6>
                                                <span class="text-secondary-light text-md">subratasen@gmail.com</span>
                                            </div>
                                            <div class="mt-20">
                                                <p class="mb-0 text-primary-light">Awesome, thank you so much!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-16 px-24 bg-base shadow-top">
                                <form action="#">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <textarea class="textarea-max-height form-control p-0 border-0 py-8 pe-16 resize-none scroll-sm" oninput="adjustHeight(this)" placeholder="Write massage"></textarea>
                                        <div class="d-flex align-items-center gap-4 ms-16">
                                            <div class="">
                                                <label for="attatchment" class="text-secondary-light text-xl">
                                                    <iconify-icon icon="octicon:link-16" class="icon line-height-1"></iconify-icon>
                                                </label>
                                                <input type="file" id="attatchment" hidden>
                                            </div>
                                            <div class="">
                                                <label for="gallery" class="text-secondary-light text-xl">
                                                    <iconify-icon icon="solar:gallery-bold" class="icon line-height-1"></iconify-icon>
                                                </label>
                                                <input type="file" id="gallery" hidden>
                                            </div>
                                            <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-12 w-100 radius-8 d-flex align-items-center justify-content-center gap-1 h-44-px">
                                                <iconify-icon icon="ion:paper-plane-outline" class="icon text-lg line-height-1"></iconify-icon>
                                                Send
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Code Generator</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Code Generator</li>
                </ul>
            </div>

            <div class="row gy-4 flex-wrap-reverse">
                <div class="col-xxl-3 col-lg-4">
                    <div class="card h-100 p-0">
                        <div class="card-body p-0">
                            <div class="p-24">
                                <a href="code-generator-new.php" class="btn btn-primary text-sm btn-sm px-12 py-12 w-100 radius-8 d-flex align-items-center justify-content-center gap-2">
                                    <i class="ri-messenger-line"></i>
                                    New Page
                                </a>
                            </div>
                            <ul class="ai-chat-list scroll-sm pe-24 ps-24 pb-24">
                                <li class="mb-16 mt-0"><span class="text-primary-600 text-sm fw-semibold">Today</span></li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Please create a 5 Column table with HTML Css and js </a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>

                                <li class="mb-16 mt-24"><span class="text-primary-600 text-sm fw-semibold">Yesterday</span></li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Online School Education Learning</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>

                                <li class="mb-16 mt-24"><span class="text-primary-600 text-sm fw-semibold">17/06/2024</span></li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Online School Education Learning</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>
                                <li class="mb-16">
                                    <a href="code-generator.php" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>

                                <li class="mb-16 mt-24"><span class="text-primary-600 text-sm fw-semibold">15/06/2024</span></li>
                                <li class="mb-0">
                                    <a href="" class="text-line-1 text-secondary-light text-hover-primary-600">Calorie-dense foods: Needs, healthy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <div class="chat-main card overflow-hidden">
                        <div class="chat-sidebar-single gap-8 justify-content-between cursor-default flex-nowrap">
                            <div class="d-flex align-items-center gap-16">
                                <a href="code-generator-new.php" class="text-primary-light text-2xl line-height-1"><i class="ri-arrow-left-line"></i></a>
                                <h6 class="text-lg mb-0 text-line-1">Please create a 5 Column table with HTML Css and js</h6>
                            </div>

                            <div class="d-flex align-items-center gap-16 flex-shrink-0">
                                <button type="button" class="text-secondary-light text-xl line-height-1 text-hover-primary-600"><i class="ri-edit-2-line"></i></button>
                                <button type="button" class="text-secondary-light text-xl line-height-1 text-hover-primary-600"><i class="ri-delete-bin-6-line"></i></button>
                            </div>
                        </div><!-- chat-sidebar-single end -->
                        <div class="chat-message-list max-h-612-px min-h-612-px position-relative">
                            <div class="d-flex align-items-center justify-content-center flex-column h-100 position-absolute top-50 start-50 translate-middle">
                                <img src="assets/images/chatgpt/empty-message-icon2.png" alt="">
                                <span class="text-secondary-light text-md mt-16">Type New Message </span>
                            </div>
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
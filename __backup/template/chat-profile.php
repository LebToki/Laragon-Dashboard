<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Chat</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Chat</li>
        </ul>
    </div>

    <div class="chat-wrapper">
        <div class="chat-sidebar profile-setting card">
            <div class="text-end">
                <a href="chat-message.php">
                    <iconify-icon icon="akar-icons:cross"></iconify-icon>
                </a>
            </div>
            <div class="chat-main-profile">
                <div class="img">
                    <img src="assets/images/chat/chat-main.png" alt="image">
                </div>
                <div class="text-center">
                    <h6 class="text-md mb-0">Kathryn Murphy</h6>
                    <p class="mb-0 text-sm">Admin</p>
                </div>
            </div>
            <div class="mt-24">
                <label class="form-label">About Me</label>
                <textarea name="about" class="form-control" placeholder="Write some description"></textarea>
            </div>

            <div class="mt-24">
                <ul class="d-flex flex-column gap-1">
                    <li class="d-flex flex-wrap align-items-center justify-content-between">
                        <span class="d-inline-flex gap-2 align-items-center">
                            <iconify-icon icon="mingcute:location-line" class="text-lg"></iconify-icon>
                            Location
                        </span>
                        <span class="text-primary-light">United State</span>
                    </li>
                    <li class="d-flex flex-wrap align-items-center justify-content-between">
                        <span class="d-inline-flex gap-2 align-items-center">
                            <iconify-icon icon="fluent:person-24-regular" class="text-lg"></iconify-icon>
                            Member since
                        </span>
                        <span class="text-primary-light">25 Jan 2025</span>
                    </li>
                    <li class="d-flex flex-wrap align-items-center justify-content-between">
                        <span class="d-inline-flex gap-2 align-items-center">
                            <iconify-icon icon="cil:language" class="text-lg"></iconify-icon>
                            Language
                        </span>
                        <span class="text-primary-light">English</span>
                    </li>
                </ul>
            </div>

            <div class="mt-24">
                <h6 class="text-lg">Status</h6>

                <div class="d-flex flex-column gap-1">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="status" id="status1" checked>
                        <label class="form-check-label" for="status1">
                            Active
                        </label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="status" id="status2">
                        <label class="form-check-label" for="status2">
                            Do Not Disturb
                        </label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="status" id="status3">
                        <label class="form-check-label" for="status3">
                            Away
                        </label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="status" id="status4">
                        <label class="form-check-label" for="status4">
                            Offline
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-main card">
            <div class="chat-sidebar-single active">
                <div class="img">
                    <img src="assets/images/chat/11.png" alt="image">
                </div>
                <div class="info">
                    <h6 class="text-md mb-0">Kathryn Murphy</h6>
                    <p class="mb-0">Available</p>
                </div>
                <div class="action d-inline-flex align-items-center gap-3">
                    <button type="button" class="text-xl text-primary-light">
                        <iconify-icon icon="mi:call"></iconify-icon>
                    </button>
                    <button type="button" class="text-xl text-primary-light">
                        <iconify-icon icon="fluent:video-32-regular"></iconify-icon>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="text-primary-light text-xl" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <iconify-icon icon="tabler:dots-vertical"></iconify-icon>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end border">
                            <li>
                                <button class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" type="button">
                                    <iconify-icon icon="mdi:clear-circle-outline"></iconify-icon>
                                    Clear All
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" type="button">
                                    <iconify-icon icon="ic:baseline-block"></iconify-icon>
                                    Block
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- chat-sidebar-single end -->
            <div class="chat-message-list">
                <div class="chat-single-message left">
                    <img src="assets/images/chat/11.png" alt="image" class="avatar-lg object-fit-cover rounded-circle">
                    <div class="chat-message-content">
                        <p class="mb-3">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                        <p class="chat-time mb-0">
                            <span>6.30 pm</span>
                        </p>
                    </div>
                </div><!-- chat-single-message end -->
                <div class="chat-single-message right">
                    <div class="chat-message-content">
                        <p class="mb-3">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                        <p class="chat-time mb-0">
                            <span>6.30 pm</span>
                        </p>
                    </div>
                </div><!-- chat-single-message end -->
                <div class="chat-single-message left">
                    <img src="assets/images/chat/11.png" alt="image" class="avatar-lg object-fit-cover rounded-circle">
                    <div class="chat-message-content">
                        <p class="mb-3">The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.Contrary to popular belief, Lorem Ipsum is not simply random text is the model text for your company.</p>
                        <p class="chat-time mb-0">
                            <span>6.30 pm</span>
                        </p>
                    </div>
                </div><!-- chat-single-message end -->
            </div>
            <form class="chat-message-box">
                <input type="text" name="chatMessage" placeholder="Write message">
                <div class="chat-message-box-action">
                    <button type="button" class="text-xl">
                        <iconify-icon icon="ph:link"></iconify-icon>
                    </button>
                    <button type="button" class="text-xl">
                        <iconify-icon icon="solar:gallery-linear"></iconify-icon>
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                        Send
                        <iconify-icon icon="f7:paperplane"></iconify-icon>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php include './partials/layouts/layoutBottom.php' ?>
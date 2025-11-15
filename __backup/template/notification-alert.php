<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Notification Alert</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Settings - Notification Alert</li>
                </ul>
            </div>

            <div class="card h-100 p-0 radius-12 overflow-hidden">
                <div class="card-body p-40">
                    <form action="#">
                        <div class="mb-24">
                            <h6 class="mb-16">Mail Notification Messages</h6>
                            <div class="d-flex flex-wrap justify-content-between gap-1">
                                <label class="form-label fw-medium text-secondary-light text-md mb-8">Admin New Order Message</label>
                                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="On" checked>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="On">On</label>
                                </div>
                            </div>
                            <textarea class="form-control radius-8 h-80-px" placeholder="You have a new order."></textarea>
                        </div>
                        <div class="mb-24">
                            <h6 class="mb-16">Sms Notification Messages</h6>
                            <div class="d-flex flex-wrap justify-content-between gap-1">
                                <label class="form-label fw-medium text-secondary-light text-md mb-8">Admin New Order Message</label>
                                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="Off">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="Off">OFF</label>
                                </div>
                            </div>
                            <textarea class="form-control radius-8 h-80-px" placeholder="You have a new order."></textarea>
                        </div>
                        <div class="mb-24">
                            <h6 class="mb-16">Push Notification Messages</h6>
                            <div class="d-flex flex-wrap justify-content-between gap-1">
                                <label class="form-label fw-medium text-secondary-light text-md mb-8">Admin New Order Message</label>
                                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="Offf">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="Offf">OFF</label>
                                </div>
                            </div>
                            <textarea class="form-control radius-8 h-80-px" placeholder="You have a new order."></textarea>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                            <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                                Save Change
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
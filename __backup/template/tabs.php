<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Tab & Accordion</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Tab & Accordion</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-xxl-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Default Tabs </h6>
                        </div>
                        <div class="card-body p-24 pt-10">
                            <ul class="nav bordered-tab border border-top-0 border-start-0 border-end-0 d-inline-flex nav-pills mb-16" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10" id="pills-details-tab" data-bs-toggle="pill" data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details" aria-selected="false">Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10" id="pills-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-settings" type="button" role="tab" aria-controls="pills-settings" aria-selected="false">Settings</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Focus Tabs </h6>
                        </div>
                        <div class="card-body p-24 pt-10">
                            <ul class="nav focus-tab nav-pills mb-16" id="pills-tab-two" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10 active" id="pills-focus-home-tab" data-bs-toggle="pill" data-bs-target="#pills-focus-home" type="button" role="tab" aria-controls="pills-focus-home" aria-selected="true">Home</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-focus-details-tab" data-bs-toggle="pill" data-bs-target="#pills-focus-details" type="button" role="tab" aria-controls="pills-focus-details" aria-selected="false">Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-focus-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-focus-profile" type="button" role="tab" aria-controls="pills-focus-profile" aria-selected="false">Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-focus-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-focus-settings" type="button" role="tab" aria-controls="pills-focus-settings" aria-selected="false">Settings</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tab-twoContent">
                                <div class="tab-pane fade show active" id="pills-focus-home" role="tabpanel" aria-labelledby="pills-focus-home-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-focus-details" role="tabpanel" aria-labelledby="pills-focus-details-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-focus-profile" role="tabpanel" aria-labelledby="pills-focus-profile-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-focus-settings" role="tabpanel" aria-labelledby="pills-focus-settings-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Button Tabs</h6>
                        </div>
                        <div class="card-body p-24 pt-10">
                            <ul class="nav button-tab nav-pills mb-16" id="pills-tab-three" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10 active" id="pills-button-home-tab" data-bs-toggle="pill" data-bs-target="#pills-button-home" type="button" role="tab" aria-controls="pills-button-home" aria-selected="true">Home</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-button-details-tab" data-bs-toggle="pill" data-bs-target="#pills-button-details" type="button" role="tab" aria-controls="pills-button-details" aria-selected="false">Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-button-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-button-profile" type="button" role="tab" aria-controls="pills-button-profile" aria-selected="false">Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-button-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-button-settings" type="button" role="tab" aria-controls="pills-button-settings" aria-selected="false">Settings</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tab-threeContent">
                                <div class="tab-pane fade show active" id="pills-button-home" role="tabpanel" aria-labelledby="pills-button-home-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image1.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-button-details" role="tabpanel" aria-labelledby="pills-button-details-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image2.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-button-profile" role="tabpanel" aria-labelledby="pills-button-profile-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image1.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-button-settings" role="tabpanel" aria-labelledby="pills-button-settings-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image2.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Button Tabs</h6>
                        </div>
                        <div class="card-body p-24 pt-10">
                            <ul class="nav button-tab nav-pills mb-16" id="pills-tab-four" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10 active" id="pills-button-icon-home-tab" data-bs-toggle="pill" data-bs-target="#pills-button-icon-home" type="button" role="tab" aria-controls="pills-button-icon-home" aria-selected="true">
                                        <iconify-icon icon="solar:home-smile-angle-outline" class="text-xl"></iconify-icon>
                                        <span class="line-height-1">Home</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-button-icon-details-tab" data-bs-toggle="pill" data-bs-target="#pills-button-icon-details" type="button" role="tab" aria-controls="pills-button-icon-details" aria-selected="false">
                                        <iconify-icon icon="hugeicons:folder-details" class="text-xl"></iconify-icon>
                                        <span class="line-height-1">Details</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-button-icon-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-button-icon-profile" type="button" role="tab" aria-controls="pills-button-icon-profile" aria-selected="false">
                                        <iconify-icon icon="iconamoon:profile" class="text-xl"></iconify-icon>
                                        <span class="line-height-1">Profile</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-button-icon-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-button-icon-settings" type="button" role="tab" aria-controls="pills-button-icon-settings" aria-selected="false">
                                        <iconify-icon icon="uil:setting" class="text-xl"></iconify-icon>
                                        <span class="line-height-1">Settings</span>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tab-fourContent">
                                <div class="tab-pane fade show active" id="pills-button-icon-home" role="tabpanel" aria-labelledby="pills-button-icon-home-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image2.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-button-icon-details" role="tabpanel" aria-labelledby="pills-button-icon-details-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image1.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-button-icon-profile" role="tabpanel" aria-labelledby="pills-button-icon-profile-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image2.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-button-icon-settings" role="tabpanel" aria-labelledby="pills-button-icon-settings-tab" tabindex="0">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/tabs/tabs-image1.png" class="radius-8" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                            <p class="text-secondary-light mb-0"> make a type specimen book. It has survived not industry's standard dummy</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                            <h6 class="text-lg mb-0">Vertical Nav Tabs</h6>
                        </div>
                        <div class="card-body p-24 pt-10">
                            <div class="d-flex align-items-start">
                                <ul class="nav button-tab nav-pills mb-16" id="pills-tab-five" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10 active" id="pills-vertical-home-tab" data-bs-toggle="pill" data-bs-target="#pills-vertical-home" type="button" role="tab" aria-controls="pills-vertical-home" aria-selected="true">Home</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-vertical-details-tab" data-bs-toggle="pill" data-bs-target="#pills-vertical-details" type="button" role="tab" aria-controls="pills-vertical-details" aria-selected="false">Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-vertical-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-vertical-profile" type="button" role="tab" aria-controls="pills-vertical-profile" aria-selected="false">Profile</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold text-primary-light radius-4 px-16 py-10" id="pills-vertical-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-vertical-settings" type="button" role="tab" aria-controls="pills-vertical-settings" aria-selected="false">Settings</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tab-fiveContent">
                                    <div class="tab-pane fade show active" id="pills-vertical-home" role="tabpanel" aria-labelledby="pills-vertical-home-tab" tabindex="0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type </p>
                                            <p class="text-secondary-light mb-0"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktopLorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-vertical-details" role="tabpanel" aria-labelledby="pills-vertical-details-tab" tabindex="0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type </p>
                                            <p class="text-secondary-light mb-0"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktopLorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-vertical-profile" role="tabpanel" aria-labelledby="pills-vertical-profile-tab" tabindex="0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type </p>
                                            <p class="text-secondary-light mb-0"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktopLorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-vertical-settings" role="tabpanel" aria-labelledby="pills-vertical-settings-tab" tabindex="0">
                                        <div class="flex-grow-1">
                                            <h6 class="text-lg mb-8">Title</h6>
                                            <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type </p>
                                            <p class="text-secondary-light mb-0"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktopLorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                        <div class="card-header pt-16 pb-0 px-24 bg-base border border-end-0 border-start-0 border-top-0 d-flex align-items-center flex-wrap justify-content-between">
                            <h6 class="text-lg mb-0">Card Header Tabs</h6>
                            <ul class="nav bordered-tab d-inline-flex nav-pills mb-0" id="pills-tab-six" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10 active" id="pills-header-home-tab" data-bs-toggle="pill" data-bs-target="#pills-header-home" type="button" role="tab" aria-controls="pills-header-home" aria-selected="true">Home</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10" id="pills-header-details-tab" data-bs-toggle="pill" data-bs-target="#pills-header-details" type="button" role="tab" aria-controls="pills-header-details" aria-selected="false">Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10" id="pills-header-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-header-profile" type="button" role="tab" aria-controls="pills-header-profile" aria-selected="false">Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-16 py-10" id="pills-header-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-header-settings" type="button" role="tab" aria-controls="pills-header-settings" aria-selected="false">Settings</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-24 pt-10">
                            <div class="tab-content" id="pills-tabContent-six">
                                <div class="tab-pane fade show active" id="pills-header-home" role="tabpanel" aria-labelledby="pills-header-home-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-header-details" role="tabpanel" aria-labelledby="pills-header-details-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-header-profile" role="tabpanel" aria-labelledby="pills-header-profile-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-header-settings" role="tabpanel" aria-labelledby="pills-header-settings-tab" tabindex="0">
                                    <div>
                                        <h6 class="text-lg mb-8">Title</h6>
                                        <p class="text-secondary-light mb-16">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </p>
                                        <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
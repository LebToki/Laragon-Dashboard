<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Radio</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Radio</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Radio</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-28">
                                <div class="form-check checked-primary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio1" checked>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio1"> Radio Active </label>
                                </div>
                                <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio2" id="radio2" checked>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio2"> Radio Active </label>
                                </div>
                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio3" id="radio3" checked>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio3"> Radio Active </label>
                                </div>
                                <div class="form-check checked-warning d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio4" id="radio4" checked>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio4"> Radio Active </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-wrap gap-28 mt-24">
                                <div class="form-check checked-primary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio" id="radio11">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio11"> Radio Inactive </label>
                                </div>
                                <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio" id="radio22">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio22"> Radio Inactive </label>
                                </div>
                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio" id="radio33">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio33"> Radio Inactive </label>
                                </div>
                                <div class="form-check checked-warning d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio" id="radio44">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio44"> Radio Inactive </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Radio Disable</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-28">
                                <div class="form-check checked-primary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio11" id="radio111" checked disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio111"> Radio Active </label>
                                </div>
                                <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio22" id="radio222" checked disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio222"> Radio Active </label>
                                </div>
                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio33" id="radio333" checked disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio333"> Radio Active </label>
                                </div>
                                <div class="form-check checked-warning d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio44" id="radio444" checked disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio444"> Radio Active </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-wrap gap-28 mt-24">
                                <div class="form-check checked-primary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio0" id="radio1011" disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio1011"> Radio Inactive </label>
                                </div>
                                <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio0" id="radio2022" disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio2022"> Radio Inactive </label>
                                </div>
                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio0" id="radio3033" disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio3033"> Radio Inactive </label>
                                </div>
                                <div class="form-check checked-warning d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="radio0" id="radio4044" disabled>
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio4044"> Radio Inactive </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Radio With Button</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-24">
                                <div class="bg-primary-50 px-20 py-12 radius-8">
                                    <span class="form-check checked-primary d-flex align-items-center gap-2">
                                        <input class="form-check-input" type="radio" name="radio100" id="radio100" checked>
                                        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio100"> Radio Active </label>
                                    </span>
                                </div>
                                <div class="bg-neutral-100 px-20 py-12 radius-8">
                                    <span class="form-check checked-success d-flex align-items-center gap-2">
                                        <input class="form-check-input" type="radio" name="radio200" id="radio200" checked>
                                        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio200"> Radio Active </label>
                                    </span>
                                </div>
                                <div class="bg-success-100 px-20 py-12 radius-8">
                                    <span class="form-check checked-success d-flex align-items-center gap-2">
                                        <input class="form-check-input" type="radio" name="radio300" id="radio300" checked>
                                        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio300"> Radio Active </label>
                                    </span>
                                </div>
                                <div class="bg-warning-100 px-20 py-12 radius-8">
                                    <span class="form-check checked-warning d-flex align-items-center gap-2">
                                        <input class="form-check-input" type="radio" name="radio400" id="radio400" checked>
                                        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio400"> Radio Active </label>
                                    </span>
                                </div>
                                <div class="bg-neutral-200 px-20 py-12 radius-8">
                                    <span class="form-check checked-dark d-flex align-items-center gap-2">
                                        <input class="form-check-input" type="radio" name="radio500" id="radio500" checked>
                                        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="radio500"> Radio Active </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-28">
                            <h6 class="text-lg fw-semibold mb-0">Radio Horizontal</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-28">
                                <div class="form-check checked-primary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="horizontal" id="horizontal1">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal1"> Horizontal 1 </label>
                                </div>
                                <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="horizontal" id="horizontal2">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal2"> Horizontal 2 </label>
                                </div>
                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="horizontal" id="horizontal3">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal3"> Horizontal 3 </label>
                                </div>
                                <div class="form-check checked-warning d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="horizontal" id="horizontal4">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal4"> Horizontal 4 </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Radio Vertical</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-start flex-column flex-wrap gap-3">
                                <div class="form-check checked-primary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="vertical" id="vertical11">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="vertical11"> Vertical 1 </label>
                                </div>
                                <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="vertical" id="vertical22">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="vertical22"> Vertical 2 </label>
                                </div>
                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="vertical" id="vertical33">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="vertical33"> Vertical 3 </label>
                                </div>
                                <div class="form-check checked-warning d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="vertical" id="vertical44">
                                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="vertical44"> Vertical 4 </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
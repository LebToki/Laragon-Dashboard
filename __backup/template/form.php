<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Input From</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Input Form</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Default Inputs</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Basic Input</label>
                            <input type="text" name="#0" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input with Placeholder</label>
                            <input type="text" name="#0" class="form-control" placeholder="info@gmail.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input with Phone </label>
                            <input type="text" class="form-control flex-grow-1" placeholder="+1 (555) 253-08515">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input Date</label>
                            <input type="date" name="#0" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input with Payment</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base">
                                    <img src="assets/images/card/payment-icon.png" alt="image">
                                </span>
                                <input type="text" class="form-control flex-grow-1" placeholder="Card number">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
            <div class="card mt-24">
                <div class="card-header">
                    <h6 class="card-title mb-0">Input Group</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Input</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base">
                                    <iconify-icon icon="mynaui:envelope"></iconify-icon>
                                </span>
                                <input type="text" class="form-control flex-grow-1" placeholder="info@gmail.com">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input</label>
                            <div class="input-group">
                                <select class="form-select input-group-text w-90-px flex-grow-0">
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                </select>
                                <input type="text" class="form-control flex-grow-1" placeholder="info@gmail.com">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input</label>
                            <div class="input-group">
                                <input type="text" class="form-control flex-grow-1" placeholder="info@gmail.com">
                                <select class="form-select input-group-text w-90-px flex-grow-0">
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base"> http:// </span>
                                <input type="text" class="form-control" placeholder="www.random.com">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="www.random.com">
                                <button type="button" class="input-group-text bg-base">
                                    <iconify-icon icon="lucide:copy"></iconify-icon> Copy
                                </button>
                            </div>
                            <p class="text-sm mt-1 mb-0">This is a hint text to help user.</p>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Input Sizing</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Input Large</label>
                            <input type="text" name="#0" class="form-control form-control-lg" placeholder="info@gmail.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input Medium</label>
                            <input type="text" name="#0" class="form-control" placeholder="info@gmail.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input Small</label>
                            <input type="text" name="#0" class="form-control form-control-sm" placeholder="info@gmail.com">
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
            <div class="card mt-24">
                <div class="card-header">
                    <h6 class="card-title mb-0">File Input Sizing</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Large Size File Input </label>
                            <input class="form-control form-control-lg" name="#0" type="file">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Medium Size File Input </label>
                            <input class="form-control" type="file" name="#0">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Small Size File Input </label>
                            <input class="form-control form-control-sm" name="#0" type="file">
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
            <div class="card mt-24">
                <div class="card-header">
                    <h6 class="card-title mb-0">Custom Forms</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Readonly Input</label>
                            <input type="text" name="#0" class="form-control" placeholder="info@gmail.com" value="info@gmail.com" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Input with Phone </label>
                            <div class="form-mobile-field">
                                <select class="form-select">
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                    <option>US</option>
                                </select>
                                <input type="text" name="#0" class="form-control" placeholder="+1 (555) 000-0000">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Medium Size File Input </label>
                            <input class="form-control" type="file" name="#0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Textarea input field</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="form-label">Description</label>
                            <textarea name="#0" class="form-control" rows="4" cols="50" placeholder="Enter a description..."></textarea>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Description</label>
                            <textarea name="#0" class="form-control" rows="4" cols="50" placeholder="Enter a description..." readonly></textarea>
                        </div>
                        <div class="col-lg-4 was-validated">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4" cols="50" placeholder="Enter a description..." required=""></textarea>
                            <div class="invalid-feedback">
                                Please enter a message in the textarea.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include './partials/layouts/layoutBottom.php' ?>
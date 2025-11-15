<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Input Layout</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Input Layout</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Vertical Input Form</h5>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="#0" class="form-control" placeholder="Enter First Name">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="#0" class="form-control" placeholder="Enter Last Name">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="#0" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Phone</label>
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
                                    <label class="form-label">Password</label>
                                    <input type="password" name="#0" class="form-control" placeholder="*******">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-600">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Input Form With Icons</h5>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <label class="form-label">First Name</label>
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Last Name</label>
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="mage:email"></iconify-icon>
                                        </span>
                                        <input type="email" name="#0" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Phone</label>
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="+1 (555) 000-0000">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                        </span>
                                        <input type="password" name="#0" class="form-control" placeholder="*******">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-600">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Horizontal Input Form</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="#0" class="form-control" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="#0" class="form-control" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="#0" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Phone</label>
                                <div class="col-sm-10">
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
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="#0" class="form-control" placeholder="*******">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Horizontal Input Form With Icons</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">First Name</label>
                                <div class="col-sm-10">
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="Enter First Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Last Name</label>
                                <div class="col-sm-10">
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Email</label>
                                <div class="col-sm-10">
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="mage:email"></iconify-icon>
                                        </span>
                                        <input type="email" name="#0" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Phone</label>
                                <div class="col-sm-10">
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="+1 (555) 000-0000">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-24 gy-3 align-items-center">
                                <label class="form-label mb-0 col-sm-2">Password</label>
                                <div class="col-sm-10">
                                    <div class="icon-field">
                                        <span class="icon">
                                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                        </span>
                                        <input type="password" name="#0" class="form-control" placeholder="*******">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
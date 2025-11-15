<?php $script = '<script>
                        (() => {
                            "use strict"

                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            const forms = document.querySelectorAll(".needs-validation")

                            // Loop over them and prevent submission
                            Array.from(forms).forEach(form => {
                                form.addEventListener("submit", event => {
                                    if (!form.checkValidity()) {
                                        event.preventDefault()
                                        event.stopPropagation()
                                    }

                                    form.classList.add("was-validated")
                                }, false)
                            })
                        })()
            </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Form Validation</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Form Validation</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Input Custom Styles</h5>
                        </div>
                        <div class="card-body">
                            <form class="row gy-3 needs-validation" novalidate>
                                <div class="col-md-6">
                                    <label class="form-label">Input with Placeholder</label>
                                    <input type="text" name="#0" class="form-control" value="info@gmail.com" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Medium Size File Input </label>
                                    <input class="form-control" type="file" name="#0" required>
                                    <div class="invalid-feedback">
                                        Please choose a file.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Input with Icon</label>
                                    <input type="email" name="#0" class="form-control" placeholder="Enter Email" required>
                                    <div class="invalid-feedback">
                                        Please provide email address.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Input with Payment </label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text bg-base">
                                            <img src="assets/images/card/payment-icon.png" alt="image">
                                        </span>
                                        <input type="text" class="form-control flex-grow-1" placeholder="Card number" required>
                                        <div class="invalid-feedback">
                                            Please provide card number.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Input with Phone </label>
                                    <div class="form-mobile-field has-validation">
                                        <select class="form-select" required>
                                            <option value="">MU</option>
                                            <option value="1">US</option>
                                            <option value="2">BN</option>
                                            <option value="3">EN</option>
                                            <option value="4">AM</option>
                                        </select>
                                        <input type="text" name="#0" class="form-control" placeholder="+1 (555) 000-0000" required>
                                        <div class="invalid-feedback">
                                            Please provide phone number.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Input</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" placeholder="www.random.com" value="www.random.com">
                                        <button type="button" class="input-group-text bg-base">
                                            <iconify-icon icon="lucide:copy"></iconify-icon> Copy
                                        </button>
                                        <div class="invalid-feedback">
                                            Looks good.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary-600" type="submit">Submit form</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Input Status</h5>
                        </div>
                        <div class="card-body">
                            <form class="row gy-3 needs-validation" novalidate>
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="Enter First Name" required>
                                        <div class="invalid-feedback">
                                            Please provide first name
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="Enter Last Name" required>
                                        <div class="invalid-feedback">
                                            Please provide last name
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="mage:email"></iconify-icon>
                                        </span>
                                        <input type="email" name="#0" class="form-control" placeholder="Enter Email" required>
                                        <div class="invalid-feedback">
                                            Please provide email address
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                        </span>
                                        <input type="text" name="#0" class="form-control" placeholder="+1 (555) 000-0000" required>
                                        <div class="invalid-feedback">
                                            Please provide phone number
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                        </span>
                                        <input type="password" name="#0" class="form-control" placeholder="*******" required>
                                        <div class="invalid-feedback">
                                            Please provide password
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                        </span>
                                        <input type="password" name="#0" class="form-control" placeholder="*******" required>
                                        <div class="invalid-feedback">
                                            Please confirm password
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary-600" type="submit">Submit form</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

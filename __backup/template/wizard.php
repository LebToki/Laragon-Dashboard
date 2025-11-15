<?php $script = '<script>
                        $(".remove-tag").on("click", function() {
                            $(this).closest("li").remove();
                        });
                 </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Wizard</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Wizard</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-xl">Numbering wizard</h6>
                            <p class="text-neutral-500">Fill up your details and proceed next steps.</p>

                            <!-- Form Wizard Start -->
                            <div class="form-wizard">
                                <form action="#" method="post">
                                    <div class="form-wizard-header overflow-x-auto scroll-sm pb-8 my-32">
                                        <ul class="list-unstyled form-wizard-list">
                                            <li class="form-wizard-list__item active">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">1</span>
                                                </div>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">2</span>
                                                </div>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">3</span>
                                                </div>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">4</span>
                                                </div>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">5</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <fieldset class="wizard-fieldset show">
                                        <h6 class="text-md text-neutral-500">Personal Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">First Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter First Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Last Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Last Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email*</label>
                                                <div class="position-relative">
                                                    <input type="email" class="form-control wizard-required" placeholder="Enter Email" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Confirm Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Confirm Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group text-end">
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Account Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-12">
                                                <label class="form-label">User Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter User Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Number " required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Expiration(MM/YY)*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Expiration" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">CVV Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="CVV Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Bank Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Bank Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Bank Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Branch Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Branch Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Account Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Account Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Payment Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-12">
                                                <label class="form-label">Holder Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Holder Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Card Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">CVC Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="CVC Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Expiry Date*</label>
                                                <div class="row gy-4">
                                                    <div class="col-sm-4">
                                                        <div class="position-relative">
                                                            <select class="form-control form-select">
                                                                <option value="">Date</option>
                                                                <option value="">1</option>
                                                                <option value="">2</option>
                                                                <option value="">3</option>
                                                                <option value="">4</option>
                                                                <option value="">5</option>
                                                                <option value="">6</option>
                                                                <option value="">7</option>
                                                                <option value="">8</option>
                                                                <option value="">9</option>
                                                                <option value="">10</option>
                                                                <option value="">11</option>
                                                                <option value="">12</option>
                                                                <option value="">13</option>
                                                                <option value="">14</option>
                                                                <option value="">15</option>
                                                                <option value="">16</option>
                                                                <option value="">17</option>
                                                                <option value="">18</option>
                                                                <option value="">19</option>
                                                                <option value="">20</option>
                                                                <option value="">21</option>
                                                                <option value="">22</option>
                                                                <option value="">23</option>
                                                                <option value="">24</option>
                                                                <option value="">25</option>
                                                                <option value="">26</option>
                                                                <option value="">27</option>
                                                                <option value="">28</option>
                                                                <option value="">29</option>
                                                                <option value="">30</option>
                                                                <option value="">31</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="position-relative">
                                                            <select class="form-control form-select">
                                                                <option value="">Month</option>
                                                                <option value="">jan</option>
                                                                <option value="">Feb</option>
                                                                <option value="">March</option>
                                                                <option value="">April</option>
                                                                <option value="">May</option>
                                                                <option value="">June</option>
                                                                <option value="">Jully</option>
                                                                <option value="">August</option>
                                                                <option value="">Sept</option>
                                                                <option value="">Oct</option>
                                                                <option value="">Nov</option>
                                                                <option value="">Dec</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="position-relative">
                                                            <select class="form-control form-select">
                                                                <option value="">Years</option>
                                                                <option value="">2019</option>
                                                                <option value="">2020</option>
                                                                <option value="">2021</option>
                                                                <option value="">2022</option>
                                                                <option value="">2023</option>
                                                                <option value="">2024</option>
                                                                <option value="">2025</option>
                                                                <option value="">2026</option>
                                                                <option value="">2027</option>
                                                                <option value="">2028</option>
                                                                <option value="">2029</option>
                                                                <option value="">2030</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <div class="text-center mb-40">
                                            <img src="assets/images/gif/success-img3.gif" alt="" class="gif-image mb-24">
                                            <h6 class="text-md text-neutral-600">Congratulations </h6>
                                            <p class="text-neutral-400 text-sm mb-0">Well done! You have successfully completed.</p>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                            <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                            <button type="button" class="form-wizard-submit btn btn-primary-600 px-32">Publish</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- Form Wizard End -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-xl">Numbering wizard with label</h6>
                            <p class="text-neutral-500">Fill up your details and proceed next steps.</p>

                            <!-- Form Wizard Start -->
                            <div class="form-wizard">
                                <form action="#" method="post">
                                    <div class="form-wizard-header overflow-x-auto scroll-sm pb-8 my-32">
                                        <ul class="list-unstyled form-wizard-list">
                                            <li class="form-wizard-list__item active">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">1</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Create Account </span>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">2</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Import Data</span>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">3</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Setup Privacy</span>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">4</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Add Location</span>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">5</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Completed</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <fieldset class="wizard-fieldset show">
                                        <h6 class="text-md text-neutral-500">Personal Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">First Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter First Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Last Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Last Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email*</label>
                                                <div class="position-relative">
                                                    <input type="email" class="form-control wizard-required" placeholder="Enter Email" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Confirm Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Confirm Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group text-end">
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Account Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-12">
                                                <label class="form-label">User Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter User Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Number " required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Expiration(MM/YY)*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Expiration" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">CVV Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="CVV Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Bank Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Bank Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Bank Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Branch Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Branch Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Account Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Account Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Payment Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-12">
                                                <label class="form-label">Holder Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Holder Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Card Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">CVC Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="CVC Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Expiry Date*</label>
                                                <div class="row gy-4">
                                                    <div class="col-sm-4">
                                                        <div class="position-relative">
                                                            <select class="form-control form-select">
                                                                <option value="">Date</option>
                                                                <option value="">1</option>
                                                                <option value="">2</option>
                                                                <option value="">3</option>
                                                                <option value="">4</option>
                                                                <option value="">5</option>
                                                                <option value="">6</option>
                                                                <option value="">7</option>
                                                                <option value="">8</option>
                                                                <option value="">9</option>
                                                                <option value="">10</option>
                                                                <option value="">11</option>
                                                                <option value="">12</option>
                                                                <option value="">13</option>
                                                                <option value="">14</option>
                                                                <option value="">15</option>
                                                                <option value="">16</option>
                                                                <option value="">17</option>
                                                                <option value="">18</option>
                                                                <option value="">19</option>
                                                                <option value="">20</option>
                                                                <option value="">21</option>
                                                                <option value="">22</option>
                                                                <option value="">23</option>
                                                                <option value="">24</option>
                                                                <option value="">25</option>
                                                                <option value="">26</option>
                                                                <option value="">27</option>
                                                                <option value="">28</option>
                                                                <option value="">29</option>
                                                                <option value="">30</option>
                                                                <option value="">31</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="position-relative">
                                                            <select class="form-control form-select">
                                                                <option value="">Month</option>
                                                                <option value="">jan</option>
                                                                <option value="">Feb</option>
                                                                <option value="">March</option>
                                                                <option value="">April</option>
                                                                <option value="">May</option>
                                                                <option value="">June</option>
                                                                <option value="">Jully</option>
                                                                <option value="">August</option>
                                                                <option value="">Sept</option>
                                                                <option value="">Oct</option>
                                                                <option value="">Nov</option>
                                                                <option value="">Dec</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="position-relative">
                                                            <select class="form-control form-select">
                                                                <option value="">Years</option>
                                                                <option value="">2019</option>
                                                                <option value="">2020</option>
                                                                <option value="">2021</option>
                                                                <option value="">2022</option>
                                                                <option value="">2023</option>
                                                                <option value="">2024</option>
                                                                <option value="">2025</option>
                                                                <option value="">2026</option>
                                                                <option value="">2027</option>
                                                                <option value="">2028</option>
                                                                <option value="">2029</option>
                                                                <option value="">2030</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <div class="text-center mb-40">
                                            <img src="assets/images/gif/success-img3.gif" alt="" class="gif-image mb-24">
                                            <h6 class="text-md text-neutral-600">Congratulations </h6>
                                            <p class="text-neutral-400 text-sm mb-0">Well done! You have successfully completed.</p>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                            <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                            <button type="button" class="form-wizard-submit btn btn-primary-600 px-32">Publish</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- Form Wizard End -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-xl">Order By Following Step</h6>
                            <p class="text-neutral-500">Fill up your details and proceed next steps.</p>

                            <!-- Form Wizard Start -->
                            <div class="form-wizard">
                                <form action="#" method="post">
                                    <div class="form-wizard-header overflow-x-auto scroll-sm pb-8 my-32">
                                        <ul class="list-unstyled form-wizard-list style-two">
                                            <li class="form-wizard-list__item active">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">1</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Order Details </span>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">2</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Manufactures</span>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">3</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Order Plan</span>
                                            </li>
                                            <li class="form-wizard-list__item">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">4</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Completed</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <fieldset class="wizard-fieldset show">
                                        <h6 class="text-md text-neutral-500">Personal Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">First Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter First Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Last Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Last Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email*</label>
                                                <div class="position-relative">
                                                    <input type="email" class="form-control wizard-required" placeholder="Enter Email" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Confirm Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Confirm Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group text-end">
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Account Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-12">
                                                <label class="form-label">User Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter User Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Number " required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Expiration(MM/YY)*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Expiration" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">CVV Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="CVV Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Bank Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Bank Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Bank Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Branch Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Branch Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Account Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Account Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <div class="text-center mb-40">
                                            <img src="assets/images/gif/success-img3.gif" alt="" class="gif-image mb-24">
                                            <h6 class="text-md text-neutral-600">Congratulations </h6>
                                            <p class="text-neutral-400 text-sm mb-0">Well done! You have successfully completed.</p>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                            <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                            <button type="button" class="form-wizard-submit btn btn-primary-600 px-32">Publish</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- Form Wizard End -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-xl">Wizard with beside label</h6>
                            <p class="text-neutral-500">Fill up your details and proceed next steps.</p>

                            <!-- Form Wizard Start -->
                            <div class="form-wizard">
                                <form action="#" method="post">
                                    <div class="form-wizard-header overflow-x-auto scroll-sm pb-8 my-32">
                                        <ul class="list-unstyled form-wizard-list style-three">
                                            <li class="form-wizard-list__item d-flex align-items-center gap-8 active">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">1</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Order Details </span>
                                            </li>
                                            <li class="form-wizard-list__item d-flex align-items-center gap-8">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">2</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Manufactures</span>
                                            </li>
                                            <li class="form-wizard-list__item d-flex align-items-center gap-8">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">3</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Order Plan</span>
                                            </li>
                                            <li class="form-wizard-list__item d-flex align-items-center gap-8">
                                                <div class="form-wizard-list__line">
                                                    <span class="count">4</span>
                                                </div>
                                                <span class="text text-xs fw-semibold">Completed</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <fieldset class="wizard-fieldset show">
                                        <h6 class="text-md text-neutral-500">Personal Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">First Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter First Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Last Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Last Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email*</label>
                                                <div class="position-relative">
                                                    <input type="email" class="form-control wizard-required" placeholder="Enter Email" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Confirm Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Confirm Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group text-end">
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Account Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-12">
                                                <label class="form-label">User Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter User Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Number " required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Card Expiration(MM/YY)*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Card Expiration" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">CVV Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="CVV Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password*</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control wizard-required" placeholder="Enter Password" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <h6 class="text-md text-neutral-500">Bank Information</h6>
                                        <div class="row gy-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Bank Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Bank Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Branch Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Branch Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Name*</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control wizard-required" placeholder="Enter Account Name" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Account Number*</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control wizard-required" placeholder="Enter Account Number" required>
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                                <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                                <button type="button" class="form-wizard-next-btn btn btn-primary-600 px-32">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="wizard-fieldset">
                                        <div class="text-center mb-40">
                                            <img src="assets/images/gif/success-img3.gif" alt="" class="gif-image mb-24">
                                            <h6 class="text-md text-neutral-600">Congratulations </h6>
                                            <p class="text-neutral-400 text-sm mb-0">Well done! You have successfully completed.</p>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                            <button type="button" class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">Back</button>
                                            <button type="button" class="form-wizard-submit btn btn-primary-600 px-32">Publish</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- Form Wizard End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
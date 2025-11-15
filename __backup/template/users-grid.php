<?php $script = '<script>
                        $(".delete-btn").on("click", function() {
                            $(this).closest(".user-grid-card").addClass("d-none")
                        });
                </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Users List</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Users List</li>
                </ul>
            </div>

            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
                        <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                        <form class="navbar-search">
                            <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>
                    </div>
                    <a href="view-profile.php" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Add New User
                    </a>
                </div>
                <div class="card-body p-24">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg1.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img1.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Jacob Jones</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg2.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img2.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Darrell Steward</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg3.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img3.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Jerome Bell</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg4.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img4.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Eleanor Pena</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg5.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img5.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Ralph Edwards</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg6.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img6.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Annette Black</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg7.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img7.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Robert Fox</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg8.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img8.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Albert Flores</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg9.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img9.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Dianne Russell</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg10.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img10.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Esther Howard</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg11.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img11.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Marvin McKinney</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 user-grid-card   ">
                            <div class="position-relative border radius-16 overflow-hidden">
                                <img src="assets/images/user-grid/user-grid-bg12.png" alt="" class="w-100 object-fit-cover">

                                <div class="dropdown position-absolute top-0 end-0 me-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white-gradient-light w-32-px h-32-px radius-8 border border-light-white d-flex justify-content-center align-items-center text-white">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon "></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" href="#">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="delete-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ps-16 pb-16 pe-16 text-center mt--50">
                                    <img src="assets/images/user-grid/user-grid-img12.png" alt="" class="border br-white border-width-2-px w-100-px h-100-px rounded-circle object-fit-cover">
                                    <h6 class="text-lg mb-0 mt-4">Guy Hawkins</h6>
                                    <span class="text-secondary-light mb-16">ifrandom@gmail.com</span>

                                    <div class="center-border position-relative bg-danger-gradient-light radius-8 p-12 d-flex align-items-center gap-4">
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">Design</h6>
                                            <span class="text-secondary-light text-sm mb-0">Department</span>
                                        </div>
                                        <div class="text-center w-50">
                                            <h6 class="text-md mb-0">UI UX Designer</h6>
                                            <span class="text-secondary-light text-sm mb-0">Designation</span>
                                        </div>
                                    </div>
                                    <a href="view-profile.php" class="bg-primary-50 text-primary-600 bg-hover-primary-600 hover-text-white p-10 text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center mt-16 fw-medium gap-2 w-100">
                                        View Profile
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon text-xl line-height-1"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                        <span>Showing 1 to 10 of 12 entries</span>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">
                                    <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md bg-primary-600 text-white" href="javascript:void(0)">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-neutral-200 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">
                                    <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
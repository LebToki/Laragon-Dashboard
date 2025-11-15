<?php $script = '<script src="assets/js/full-calendar.js"></script>
                 <script src="assets/js/flatpickr.js"></script>
                 <script>
                 // Flat pickr or date picker js 
                 function getDatePicker(receiveID) {
                     flatpickr(receiveID, {
                         enableTime: true,
                         dateFormat: "d/m/Y H:i",
                     });
                 }
                 getDatePicker("#startDate");
                 getDatePicker("#endDate");
             
                 getDatePicker("#editstartDate");
                 getDatePicker("#editendDate");
                 </script>';?>


<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Calendar</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Calendar</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-xxl-3 col-lg-4">
                    <div class="card h-100 p-0">
                        <div class="card-body p-24">
                            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 w-100 radius-8 d-flex align-items-center gap-2 mb-32" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <iconify-icon icon="fa6-regular:square-plus" class="icon text-lg line-height-1"></iconify-icon>
                                Add Currency
                            </button>

                            <div class="mt-32">
                                <div class="event-item d-flex align-items-center justify-content-between gap-4 pb-16 mb-16 border border-start-0 border-end-0 border-top-0">
                                    <div class="">
                                        <div class="d-flex align-items-center gap-10">
                                            <span class="w-12-px h-12-px bg-warning-600 rounded-circle fw-medium"></span>
                                            <span class="text-secondary-light">Today, 10:30 PM - 02:30 AM</span>
                                        </div>
                                        <span class="text-primary-light fw-semibold text-md mt-4">Design Conference</span>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="entypo:dots-three-vertical" class="icon text-secondary-light"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu p-12 border bg-base shadow">
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                                    <iconify-icon icon="hugeicons:view" class="icon text-lg line-height-1"></iconify-icon>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                    <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="delete-item dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">
                                                    <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="event-item d-flex align-items-center justify-content-between gap-4 pb-16 mb-16 border border-start-0 border-end-0 border-top-0">
                                    <div class="">
                                        <div class="d-flex align-items-center gap-10">
                                            <span class="w-12-px h-12-px bg-success-600 rounded-circle fw-medium"></span>
                                            <span class="text-secondary-light">Today, 10:30 PM - 02:30 AM</span>
                                        </div>
                                        <span class="text-primary-light fw-semibold text-md mt-4">Weekend Festival</span>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="entypo:dots-three-vertical" class="icon text-secondary-light"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu p-12 border bg-base shadow">
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                                    <iconify-icon icon="hugeicons:view" class="icon text-lg line-height-1"></iconify-icon>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                    <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="delete-item dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">
                                                    <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="event-item d-flex align-items-center justify-content-between gap-4 pb-16 mb-16 border border-start-0 border-end-0 border-top-0">
                                    <div class="">
                                        <div class="d-flex align-items-center gap-10">
                                            <span class="w-12-px h-12-px bg-info-600 rounded-circle fw-medium"></span>
                                            <span class="text-secondary-light">Today, 10:30 PM - 02:30 AM</span>
                                        </div>
                                        <span class="text-primary-light fw-semibold text-md mt-4">Design Conference</span>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="entypo:dots-three-vertical" class="icon text-secondary-light"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu p-12 border bg-base shadow">
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                                    <iconify-icon icon="hugeicons:view" class="icon text-lg line-height-1"></iconify-icon>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                    <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="delete-item dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">
                                                    <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="event-item d-flex align-items-center justify-content-between gap-4 pb-16 mb-16 border border-start-0 border-end-0 border-top-0">
                                    <div class="">
                                        <div class="d-flex align-items-center gap-10">
                                            <span class="w-12-px h-12-px bg-warning-600 rounded-circle fw-medium"></span>
                                            <span class="text-secondary-light">Today, 10:30 PM - 02:30 AM</span>
                                        </div>
                                        <span class="text-primary-light fw-semibold text-md mt-4">Ultra Europe 2019</span>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="entypo:dots-three-vertical" class="icon text-secondary-light"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu p-12 border bg-base shadow">
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                                    <iconify-icon icon="hugeicons:view" class="icon text-lg line-height-1"></iconify-icon>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                    <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="delete-item dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">
                                                    <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="event-item d-flex align-items-center justify-content-between gap-4 pb-16 mb-16 border border-start-0 border-end-0 border-top-0">
                                    <div class="">
                                        <div class="d-flex align-items-center gap-10">
                                            <span class="w-12-px h-12-px bg-warning-600 rounded-circle fw-medium"></span>
                                            <span class="text-secondary-light">Today, 10:30 PM - 02:30 AM</span>
                                        </div>
                                        <span class="text-primary-light fw-semibold text-md mt-4">Design Conference</span>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="entypo:dots-three-vertical" class="icon text-secondary-light"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu p-12 border bg-base shadow">
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalView">
                                                    <iconify-icon icon="hugeicons:view" class="icon text-lg line-height-1"></iconify-icon>
                                                    View
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                    <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="delete-item dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-danger-100 text-hover-danger-600 d-flex align-items-center gap-10" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">
                                                    <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <div class="card h-100 p-0">
                        <div class="card-body p-24">
                            <div id='wrap'>
                                <div id='calendar'></div>
                                <div style='clear:both'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Event -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
                    <div class="modal-content radius-16 bg-base">
                        <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Event</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-24">
                            <form action="#">
                                <div class="row">
                                    <div class="col-12 mb-20">
                                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Event Title : </label>
                                        <input type="text" class="form-control radius-8" placeholder="Enter Event Title ">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label for="startDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Start Date</label>
                                        <div class=" position-relative">
                                            <input class="form-control radius-8 bg-base" id="startDate" type="text" placeholder="03/12/2024, 10:30 AM">
                                            <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1">
                                                <iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label for="endDate" class="form-label fw-semibold text-primary-light text-sm mb-8">End Date </label>
                                        <div class=" position-relative">
                                            <input class="form-control radius-8 bg-base" id="endDate" type="text" placeholder="03/12/2024, 2:30 PM">
                                            <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1">
                                                <iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="endDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Label </label>
                                        <div class="d-flex align-items-center flex-wrap gap-28">
                                            <div class="form-check checked-success d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="Personal">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="Personal">
                                                    <span class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                                    Personal
                                                </label>
                                            </div>
                                            <div class="form-check checked-primary d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="Business">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="Business">
                                                    <span class="w-8-px h-8-px bg-primary-600 rounded-circle"></span>
                                                    Business
                                                </label>
                                            </div>
                                            <div class="form-check checked-warning d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="Family">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="Family">
                                                    <span class="w-8-px h-8-px bg-warning-600 rounded-circle"></span>
                                                    Family
                                                </label>
                                            </div>
                                            <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="Important">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="Important">
                                                    <span class="w-8-px h-8-px bg-lilac-600 rounded-circle"></span>
                                                    Important
                                                </label>
                                            </div>
                                            <div class="form-check checked-danger d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="Holiday">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="Holiday">
                                                    <span class="w-8-px h-8-px bg-danger-600 rounded-circle"></span>
                                                    Holiday
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                        <textarea class="form-control" id="desc" rows="4" cols="50" placeholder="Write some text"></textarea>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                        <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal View Event -->
            <div class="modal fade" id="exampleModalView" tabindex="-1" aria-labelledby="exampleModalViewLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
                    <div class="modal-content radius-16 bg-base">
                        <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                            <h1 class="modal-title fs-5" id="exampleModalViewLabel">View Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-24">
                            <div class="mb-12">
                                <span class="text-secondary-light txt-sm fw-medium">Title</span>
                                <h6 class="text-primary-light fw-semibold text-md mb-0 mt-4">Design Conference</h6>
                            </div>
                            <div class="mb-12">
                                <span class="text-secondary-light txt-sm fw-medium">Start Date</span>
                                <h6 class="text-primary-light fw-semibold text-md mb-0 mt-4">25 Jan 2024, 10:30AM</h6>
                            </div>
                            <div class="mb-12">
                                <span class="text-secondary-light txt-sm fw-medium">End Date</span>
                                <h6 class="text-primary-light fw-semibold text-md mb-0 mt-4">25 Jan 2024, 2:30AM</h6>
                            </div>
                            <div class="mb-12">
                                <span class="text-secondary-light txt-sm fw-medium">Description</span>
                                <h6 class="text-primary-light fw-semibold text-md mb-0 mt-4">N/A</h6>
                            </div>
                            <div class="mb-12">
                                <span class="text-secondary-light txt-sm fw-medium">Label</span>
                                <h6 class="text-primary-light fw-semibold text-md mb-0 mt-4 d-flex align-items-center gap-2">
                                    <span class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                    Business
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Event -->
            <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
                    <div class="modal-content radius-16 bg-base">
                        <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                            <h1 class="modal-title fs-5" id="exampleModalEditLabel">Edit Event</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-24">
                            <form action="#">
                                <div class="row">
                                    <div class="col-12 mb-20">
                                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Event Title : </label>
                                        <input type="text" class="form-control radius-8" placeholder="Enter Event Title ">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label for="editstartDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Start Date</label>
                                        <div class=" position-relative">
                                            <input class="form-control radius-8 bg-base" id="editstartDate" type="text" placeholder="03/12/2024, 10:30 AM">
                                            <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1">
                                                <iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label for="editendDate" class="form-label fw-semibold text-primary-light text-sm mb-8">End Date </label>
                                        <div class=" position-relative">
                                            <input class="form-control radius-8 bg-base" id="editendDate" type="text" placeholder="03/12/2024, 2:30 PM">
                                            <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1">
                                                <iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Label </label>
                                        <div class="d-flex align-items-center flex-wrap gap-28">
                                            <div class="form-check checked-success d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="editPersonal">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="editPersonal">
                                                    <span class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                                    Personal
                                                </label>
                                            </div>
                                            <div class="form-check checked-primary d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="editBusiness">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="editBusiness">
                                                    <span class="w-8-px h-8-px bg-primary-600 rounded-circle"></span>
                                                    Business
                                                </label>
                                            </div>
                                            <div class="form-check checked-warning d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="editFamily">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="editFamily">
                                                    <span class="w-8-px h-8-px bg-warning-600 rounded-circle"></span>
                                                    Family
                                                </label>
                                            </div>
                                            <div class="form-check checked-secondary d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="editImportant">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="editImportant">
                                                    <span class="w-8-px h-8-px bg-lilac-600 rounded-circle"></span>
                                                    Important
                                                </label>
                                            </div>
                                            <div class="form-check checked-danger d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="radio" name="label" id="editHoliday">
                                                <label class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1" for="editHoliday">
                                                    <span class="w-8-px h-8-px bg-danger-600 rounded-circle"></span>
                                                    Holiday
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                        <textarea class="form-control" id="editdesc" rows="4" cols="50" placeholder="Write some text"></textarea>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                        <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Delete Event -->
            <div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog modal-dialog-centered">
                    <div class="modal-content radius-16 bg-base">
                        <div class="modal-body p-24 text-center">
                            <span class="mb-16 fs-1 line-height-1 text-danger">
                                <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                            </span>
                            <h6 class="text-lg fw-semibold text-primary-light mb-0">Are your sure you want to delete this event</h6>
                            <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                <button type="reset" class="w-50 border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                    Cancel
                                </button>
                                <button type="button" class="w-50 btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
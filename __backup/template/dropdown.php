<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Dropdown</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Components / Dropdown</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Basic Dropdown Primary</h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="dropdown">
                            <button class="btn btn-primary-600 not-active px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary-600 not-active px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Outline Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary-600 bg-primary-50 border-primary-50 text-primary-600 hover-text-primary not-active px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn text-primary-600 hover-text-primary px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Dropup Primary</h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="btn-group dropup">
                            <button class="btn btn-primary-600 not-active px-18 py-11 dropdown-toggle toggle-icon icon-up" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropup">
                            <button class="btn btn-outline-primary-600 not-active px-18 py-11 dropdown-toggle toggle-icon icon-up" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Outline Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropup">
                            <button class="btn btn-primary-600 bg-primary-50 border-primary-50 text-primary-600 hover-text-primary not-active px-18 py-11 dropdown-toggle toggle-icon icon-up" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropup">
                            <button class="btn text-primary-600 hover-text-primary px-18 py-11 dropdown-toggle toggle-icon icon-up" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Dropright Warning </h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="btn-group dropend">
                            <button class="btn btn-warning-600 not-active px-18 py-11 dropdown-toggle toggle-icon icon-right" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropend">
                            <button class="btn btn-outline-warning-600 not-active px-18 py-11 dropdown-toggle toggle-icon icon-right" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Outline Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropend">
                            <button class="btn btn-warning-600 bg-warning-100 border-warning-100 text-warning-600 hover-text-warning not-active px-18 py-11 dropdown-toggle toggle-icon icon-right" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropend">
                            <button class="btn text-warning-600 hover-text-warning px-18 py-11 dropdown-toggle toggle-icon icon-right" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Dropleft Warning </h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="btn-group dropstart">
                            <button class="btn btn-warning-600 not-active px-18 py-11 dropdown-toggle toggle-icon icon-left" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropstart">
                            <button class="btn btn-outline-warning-600 not-active px-18 py-11 dropdown-toggle toggle-icon icon-left" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Outline Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropstart">
                            <button class="btn btn-warning-600 bg-warning-100 border-warning-100 text-warning-600 hover-text-warning not-active px-18 py-11 dropdown-toggle toggle-icon icon-left" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="btn-group dropstart">
                            <button class="btn text-warning-600 hover-text-warning px-18 py-11 dropdown-toggle toggle-icon icon-left" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Placement</h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="dropdown">
                            <button class="btn btn-success-600 not-active px-18 py-11" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-success-600 not-active px-18 py-11" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Outline Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-success-600 bg-success-100 border-success-100 text-success-600 hover-text-success not-active px-18 py-11" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Focus Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Grouped Dropdown Buttons</h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-primary-600 py-11 px-20">1</button>
                            <button type="button" class="btn btn-primary-600 py-11 px-20">2</button>

                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary-600 dropdown-toggle toggle-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Dropdown link</a></li>
                                    <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Dropdown link</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-outline-primary-600 py-11 px-20">1</button>
                            <button type="button" class="btn btn-outline-primary-600 py-11 px-20">2</button>

                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary-600 dropdown-toggle toggle-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Dropdown link</a></li>
                                    <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Dropdown link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Custom Dropdown</h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="dropdown">
                            <button class="btn px-18 py-11 text-primary-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="entypo:dots-three-vertical" class="menu-icon"></iconify-icon>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn px-18 py-11 text-primary-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="ph:dots-three-outline-fill" class="menu-icon"></iconify-icon>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn px-18 py-11 text-primary-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="entypo:dots-three-vertical" class="menu-icon"></iconify-icon>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn px-18 py-11 text-primary-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="ph:dots-three-outline-fill" class="menu-icon"></iconify-icon>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100 p-0">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Dropdown Sizes</h6>
                </div>
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="dropdown">
                            <button class="btn btn-primary-600 not-active px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary-600 not-active px-16 py-9 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary-600 not-active px-12 py-6 text-sm dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Default Action </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Primary action</a></li>
                                <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
<?php $script = <<<EOD
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]'); 
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)); 

    // Boxed Tooltip
    \$(document).ready(function() {
        \$('.tooltip-button').each(function () {
            var tooltipButton = \$(this);
            var tooltipContent = \$(this).siblings('.my-tooltip').html(); 
    
            // Initialize the tooltip
            tooltipButton.tooltip({
                title: tooltipContent,
                trigger: 'hover',
                html: true
            });
    
            // Optionally, reinitialize the tooltip if the content might change dynamically
            tooltipButton.on('mouseenter', function() {
                tooltipButton.tooltip('dispose').tooltip({
                    title: tooltipContent,
                    trigger: 'hover',
                    html: true
                }).tooltip('show');
            });
        });
    });
</script>
EOD;?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Tooltip & Popover</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Components / Tooltip & Popover</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Tooltip</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <button type="button" class="btn btn-primary-50 text-primary-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-title="Primary Tooltip">
                                    Primary
                                </button>
                                <button type="button" class="btn btn-lilac-100 text-lilac-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-purple" data-bs-title="Secondary Tooltip">
                                    Secondary
                                </button>
                                <button type="button" class="btn btn-success-100 text-success-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Success Tooltip">
                                    Success
                                </button>
                                <button type="button" class="btn btn-info-100 text-info-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-title="Info Tooltip">
                                    Info
                                </button>
                                <button type="button" class="btn btn-warning-100 text-warning-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-title="Warning Tooltip">
                                    Warning
                                </button>
                                <button type="button" class="btn btn-danger-100 text-danger-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-title="Danger Tooltip">
                                    Danger
                                </button>
                                <button type="button" class="btn btn-neutral-100 text-neutral-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-title="Dark Tooltip">
                                    Dark
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Tooltip</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <button type="button" class="btn text-secondary-light border input-form-dark radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-title="Primary Tooltip">
                                    Tooltip On Top
                                </button>
                                <button type="button" class="btn text-secondary-light border input-form-dark radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="tooltip-primary" data-bs-title="Primary Tooltip">
                                    Tooltip On Right
                                </button>
                                <button type="button" class="btn text-secondary-light border input-form-dark radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="tooltip-primary" data-bs-title="Primary Tooltip">
                                    Tooltip On Left
                                </button>
                                <button type="button" class="btn text-secondary-light border input-form-dark radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-primary" data-bs-title="Primary Tooltip">
                                    Tooltip On Bottom
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Default Tooltip</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <button type="button" class="btn bg-transparent bg-hover-primary-50 text-primary-600 text-hover-primary-600 border border-primary-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-title="primary Tooltip">
                                    Primary
                                </button>
                                <button type="button" class="btn bg-transparent bg-hover-lilac-100 text-lilac-600 text-hover-lilac-600 border border-lilac-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-purple" data-bs-title="Secondary Tooltip">
                                    Secondary
                                </button>
                                <button type="button" class="btn bg-transparent bg-hover-success-100 text-success-600 text-hover-success-600 border border-success-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Success Tooltip">
                                    Success
                                </button>
                                <button type="button" class="btn bg-transparent bg-hover-info-100 text-info-600 text-hover-info-600 border border-info-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-title="Info Tooltip">
                                    Info
                                </button>
                                <button type="button" class="btn bg-transparent bg-hover-warning-100 text-warning-600 text-hover-warning-600 border border-warning-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-title="Warning Tooltip">
                                    Warning
                                </button>
                                <button type="button" class="btn bg-transparent bg-hover-danger-100 text-danger-600 text-hover-danger-600 border border-danger-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-title="Danger Tooltip">
                                    Danger
                                </button>
                                <button type="button" class="btn bg-transparent bg-hover-neutral-100 text-neutral-600 text-hover-neutral-600 border border-neutral-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-title="Dark Tooltip">
                                    Dark
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Tooltip Popover Positions</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="">
                                    <button type="button" class="tooltip-button btn bg-primary-600 text-white border border-primary-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-primary" title="">
                                        Primary
                                    </button>
                                    <div class="my-tooltip tip-content hidden text-start shadow">
                                        <h6 class="text-white">Primary</h6>
                                        <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="tooltip-button btn bg-success-600 text-white border border-success-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-success" title="">
                                        Success
                                    </button>
                                    <div class="my-tooltip tip-content hidden text-start shadow">
                                        <h6 class="text-white">Success</h6>
                                        <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="tooltip-button btn bg-info-600 text-white border border-info-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-info" title="">
                                        Info
                                    </button>
                                    <div class="my-tooltip tip-content hidden text-start shadow">
                                        <h6 class="text-white">Info</h6>
                                        <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="tooltip-button btn bg-warning-600 text-white border border-warning-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-warning" title="">
                                        warning
                                    </button>
                                    <div class="my-tooltip tip-content hidden text-start shadow">
                                        <h6 class="text-white">Warning</h6>
                                        <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="tooltip-button btn bg-danger-600 text-white border border-danger-600 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-danger" title="">
                                        Danger
                                    </button>
                                    <div class="my-tooltip tip-content hidden text-start shadow">
                                        <h6 class="text-white">Danger</h6>
                                        <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="tooltip-button btn bg-neutral-900 text-base border border-neutral-900 radius-8 px-32 py-11" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-dark" title="">
                                        Dark
                                    </button>
                                    <div class="my-tooltip tip-content hidden text-start shadow">
                                        <h6 class="text-white">Dark</h6>
                                        <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Tooltip Text popup</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <ul class="list-decimal ps-20">
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">popup</button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">popup</button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">popup</button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">popup</button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light">
                                        This is tooltip text
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">popup</button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Tooltip Text with icon popup </h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <ul class="list-decimal ps-20">
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text popup
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">
                                            <iconify-icon icon="jam:alert" class="text-primary-light text-lg mt-4"></iconify-icon>
                                        </button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text popup
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">
                                            <iconify-icon icon="jam:alert" class="text-primary-light text-lg mt-4"></iconify-icon>
                                        </button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text popup
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">
                                            <iconify-icon icon="jam:alert" class="text-primary-light text-lg mt-4"></iconify-icon>
                                        </button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light mb-8">
                                        This is tooltip text popup
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">
                                            <iconify-icon icon="jam:alert" class="text-primary-light text-lg mt-4"></iconify-icon>
                                        </button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                    <li class="text-secondary-light">
                                        This is tooltip text popup
                                        <button type="button" class="tooltip-button text-primary-600" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary" data-bs-placement="right">
                                            <iconify-icon icon="jam:alert" class="text-primary-light text-lg mt-4"></iconify-icon>
                                        </button>
                                        <div class="my-tooltip tip-content hidden text-start shadow">
                                            <h6 class="text-white">This is title</h6>
                                            <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
<?php $script = '<script src="assets/js/editor.highlighted.min.js"></script>
                 <script src="assets/js/editor.quill.js"></script>
                 <script src="assets/js/editor.katex.min.js"></script>
                 <script>
                    // Editor Js Start
                    const quill = new Quill("#editor", {
                        modules: {
                            syntax: true,
                            toolbar: "#toolbar-container",
                        },
                        placeholder: "Compose an epic...",
                        theme: "snow",
                    });
                    // Editor Js End
                    </script>'
                ;?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Terms & Conditions</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Terms & Conditions</li>
                </ul>
            </div>

            <div class="card basic-data-table radius-12 overflow-hidden">
                <div class="card-body p-0">

                    <!-- Editor Toolbar Start -->
                    <div id="toolbar-container">
                        <span class="ql-formats">
                            <select class="ql-font"></select>
                            <select class="ql-size"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <button class="ql-strike"></button>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-color"></select>
                            <select class="ql-background"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-script" value="sub"></button>
                            <button class="ql-script" value="super"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-blockquote"></button>
                            <button class="ql-code-block"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-list" value="ordered"></button>
                            <button class="ql-list" value="bullet"></button>
                            <button class="ql-indent" value="-1"></button>
                            <button class="ql-indent" value="+1"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-direction" value="rtl"></button>
                            <select class="ql-align"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                            <button class="ql-video"></button>
                            <button class="ql-formula"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-clean"></button>
                        </span>
                    </div>
                    <!-- Editor Toolbar Start -->

                    <!-- Editor start -->
                    <div id="editor">
                        <p class="">This policy explains how 6amMart website and related applications (the “Site”, “we” or “us”) collects, uses, shares and protects the personal information that we collect through this site or different channels. 6amMart has established the site to link up the users </p>
                        <p><br /></p>

                        <h6>Using ChatGPT</h6>
                        <p class="">This policy explains how 6amMart website and related applications (the “Site”, “we” or “us”) collects, uses, shares and protects the personal information that we collect through this site or different channels. 6amMart has established the site to link up the users who need foods or grocery items to be shipped or </p>
                        <p><br /></p>

                        <h6>Intellectual Property</h6>
                        <p class="">This policy explains how 6amMart website and related applications (the “Site”, “we” or “us”) collects, uses, shares and protects the personal information that we collect through this site or different channels. 6amMart has established the site to link up the users who need foods or grocery items to be shipped or delivered by the riders from the affiliated restaurants or shops to the desired location. This policy also applies to any mobile applications that we develop for use </p>
                        <p><br /></p>

                        <h6>Using ChatGPT</h6>
                        <p class="">This policy explains how 6amMart website and related applications (the “Site”, “we” or “us”) collects, uses, shares and protects the personal information that we collect through this site or different channels. 6amMart has established the site to link up the users who need foods or grocery items to be shipped or delivered by the riders from the affiliated restaurants or shops to the desired location. This policy also applies to any mobile applications that we develop for use with </p>
                        <p><br /></p>
                        <p> our services on the Site, and references to this “Site”, “we” or “us” is intended . grocery items to be shipped or delivered by the riders from the affiliated restaurants or shops to the desired location. This policy also applies to any mobile applications that we develop for use</p>

                        <p>Some initial <strong>bold</strong> text</p>
                        <p><br /></p>
                    </div>
                    <!-- Edit End -->

                </div>

                <div class="card-footer p-24 bg-base border border-bottom-0 border-end-0 border-start-0">
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary border border-primary-600 text-md px-28 py-12 radius-8">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

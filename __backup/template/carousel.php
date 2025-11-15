<?php 
$script = '<script>
    var rtlDirection = $("html").attr("dir") === "rtl";
  
    // ================================ Default Slider Start ================================ 
    $(".default-carousel").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1, 
        arrows: false, 
        dots: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        rtl: rtlDirection
    });

    // Arrow Carousel
    $(".arrow-carousel").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1, 
        arrows: true, 
        dots: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        prevArrow: "<button type=\'button\' class=\'slick-prev\'><iconify-icon icon=\'ic:outline-keyboard-arrow-left\' class=\'menu-icon\'></iconify-icon></button>",
        nextArrow: "<button type=\'button\' class=\'slick-next\'><iconify-icon icon=\'ic:outline-keyboard-arrow-right\' class=\'menu-icon\'></iconify-icon></button>",
        rtl: rtlDirection
    });

    // Pagination Carousel
    $(".pagination-carousel").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1, 
        arrows: false, 
        dots: true,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        prevArrow: "<button type=\'button\' class=\'slick-prev\'><iconify-icon icon=\'ic:outline-keyboard-arrow-left\' class=\'menu-icon\'></iconify-icon></button>",
        nextArrow: "<button type=\'button\' class=\'slick-next\'><iconify-icon icon=\'ic:outline-keyboard-arrow-right\' class=\'menu-icon\'></iconify-icon></button>",
        rtl: rtlDirection
    });

    // Multiple Carousel
    $(".multiple-carousel").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1, 
        arrows: false, 
        dots: true,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        gap: 24,
        prevArrow: "<button type=\'button\' class=\'slick-prev\'><iconify-icon icon=\'ic:outline-keyboard-arrow-left\' class=\'menu-icon\'></iconify-icon></button>",
        nextArrow: "<button type=\'button\' class=\'slick-next\'><iconify-icon icon=\'ic:outline-keyboard-arrow-right\' class=\'menu-icon\'></iconify-icon></button>",
        rtl: rtlDirection,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });

    // Carousel with Progress Bar
    jQuery(document).ready(function($) {
        var sliderTimer = 5000;
        var beforeEnd = 500;
        var $imageSlider = $(".progress-carousel");
        $imageSlider.slick({
            autoplay: true,
            autoplaySpeed: sliderTimer,
            speed: 1000,
            arrows: false,
            dots: false,
            adaptiveHeight: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            rtl: rtlDirection
        });

        function progressBar(){
            $(".slider-progress").find("span").removeAttr("style");
            $(".slider-progress").find("span").removeClass("active");
            setTimeout(function(){
                $(".slider-progress").find("span").css("transition-duration", (sliderTimer/1000)+"s").addClass("active");
            }, 100);
        }
        progressBar();
        $imageSlider.on("beforeChange", function(e, slick) {
            progressBar();
        });
        $imageSlider.on("afterChange", function(e, slick, nextSlide) {
            titleAnim(nextSlide);
        });

        // Title Animation JS
        function titleAnim(ele){
            $imageSlider.find(".slick-current").find("h1").addClass("show");
            setTimeout(function(){
                $imageSlider.find(".slick-current").find("h1").removeClass("show");
            }, sliderTimer - beforeEnd);
        }
        titleAnim();
    });

    // ================================ Default Slider End ================================ 
</script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Carousel</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Components / Carousel</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-sm-6">
            <div class="card p-0 overflow-hidden position-relative radius-12">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Default Carousel</h6>
                </div>
                <div class="card-body p-0 default-carousel">
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-24 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide One</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-24 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide Two</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-24 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide Three</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card p-0 overflow-hidden position-relative radius-12">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Carousel With Arrows</h6>
                </div>
                <div class="card-body p-0 arrow-carousel">
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-24 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide One</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-24 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide Two</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-24 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide Three</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card p-0 overflow-hidden position-relative radius-12">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Carousel With Pagination</h6>
                </div>
                <div class="card-body p-0 pagination-carousel dots-style-circle dots-positioned">
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide One</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide Two</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide Three</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                    <div class="gradient-overlay bottom-0 start-0 h-100">
                        <img src="assets/images/carousel/carousel-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                            <h5 class="card-title text-white text-lg mb-6">Carousel Slide Four</h5>
                            <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card p-0 overflow-hidden position-relative radius-12">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Carousel with progress</h6>
                </div>
                <div class="card-body p-0 position-relative">
                    <div class="p-0 progress-carousel dots-style-circle dots-positioned">
                        <div class="gradient-overlay bottom-0 start-0 h-100 position-relative">
                            <img src="assets/images/carousel/carousel-img4.png" alt="" class="w-100 h-100 object-fit-cover">
                            <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                                <h5 class="card-title text-white text-lg mb-6">Carousel Slide One</h5>
                                <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                            </div>
                        </div>
                        <div class="gradient-overlay bottom-0 start-0 h-100">
                            <img src="assets/images/carousel/carousel-img2.png" alt="" class="w-100 h-100 object-fit-cover">
                            <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                                <h5 class="card-title text-white text-lg mb-6">Carousel Slide Two</h5>
                                <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                            </div>
                        </div>
                        <div class="gradient-overlay bottom-0 start-0 h-100">
                            <img src="assets/images/carousel/carousel-img3.png" alt="" class="w-100 h-100 object-fit-cover">
                            <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                                <h5 class="card-title text-white text-lg mb-6">Carousel Slide Three</h5>
                                <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                            </div>
                        </div>
                        <div class="gradient-overlay bottom-0 start-0 h-100">
                            <img src="assets/images/carousel/carousel-img1.png" alt="" class="w-100 h-100 object-fit-cover">
                            <div class="position-absolute start-50 translate-middle-x bottom-0 pb-64 z-1 text-center w-100 max-w-440-px">
                                <h5 class="card-title text-white text-lg mb-6">Carousel Slide Four</h5>
                                <p class="card-text text-white mx-auto text-sm">User Interface (UI) and User Experience (UX) Design play key roles in the experience users have when </p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-progress">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card p-0 overflow-hidden position-relative radius-12">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Multiple slides</h6>
                </div>
                <div class="card-body py-24 px-16 multiple-carousel dots-style-circle">
                    <div class="mx-8 mb-24">
                        <img src="assets/images/carousel/mutiple-carousel-img1.png" class="w-100 h-100 object-fit-cover" alt="">
                    </div>
                    <div class="mx-8 mb-24">
                        <img src="assets/images/carousel/mutiple-carousel-img2.png" class="w-100 h-100 object-fit-cover" alt="">
                    </div>
                    <div class="mx-8 mb-24">
                        <img src="assets/images/carousel/mutiple-carousel-img3.png" class="w-100 h-100 object-fit-cover" alt="">
                    </div>
                    <div class="mx-8 mb-24">
                        <img src="assets/images/carousel/mutiple-carousel-img4.png" class="w-100 h-100 object-fit-cover" alt="">
                    </div>
                    <div class="mx-8 mb-24">
                        <img src="assets/images/carousel/mutiple-carousel-img2.png" class="w-100 h-100 object-fit-cover" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
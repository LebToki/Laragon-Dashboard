<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<?php include './partials/head.php' ?>

<body>

    <div class="custom-bg">
        <div class="container container--xl">
            <div class="d-flex align-items-center justify-content-between py-24">
                <a href="index.php" class="">
                    <img src="assets/images/logo.png" alt="">
                </a>
                <a href="index.php" class="btn btn-outline-primary-600 text-sm"> Go To Home </a>
            </div>

            <div class="py-res-120">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="mb-32 max-w-1000-px">Our site is under maintenance. Please keep patience.</h3>
                        <p class="text-neutral-500 max-w-700-px text-lg">We have been spending extended periods to send off our new site. Join our mailing list or follow us on Facebook for get most recent update.</p>
                        <div class="mt-56 max-w-500-px text-start">
                            <span class="fw-semibold text-neutral-600 text-lg text-hover-neutral-600"> Do you want to get update? Please subscribe now</span>
                            <form action="#" class="mt-16 d-flex gap-16 flex-sm-row flex-column">
                                <input type="email" class="form-control text-start py-24 flex-grow-1" placeholder="wowdash@gmail.com" required>
                                <button type="submit" class="btn btn-primary-600 px-24 flex-shrink-0 d-flex align-items-center justify-content-center gap-8">
                                    <i class="ri-notification-2-line"></i> Knock Us
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 d-lg-block d-none">
                        <img src="assets/images/coming-soon/maintenance.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include './partials/scripts.php' ?>

</body>

</html>
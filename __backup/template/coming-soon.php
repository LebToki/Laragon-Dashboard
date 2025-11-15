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
                        <h3 class="mb-32 max-w-1000-px">Our site is creating. Keep persistence, we are not far off</h3>
                        <p class="text-neutral-500 max-w-700-px text-lg">We have been spending extended periods to send off our new site. Join our mailing list or follow us on Facebook for get most recent update.</p>

                        <div class="countdown my-56 d-flex align-items-center flex-wrap gap-md-4 gap-3" id="coming-soon">
                            <div class="d-flex flex-column align-items-center">
                                <h4 class="days countdown-item mb-0 w-110-px fw-medium h-110-px bg-neutral-900 w-100 h-100 rounded-circle text-white aspect-ratio-1 d-flex justify-content-center align-items-center">0</h4>
                                <span class="text-neutral-500 text-md text-uppercase fw-medium mt-8">days</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <h4 class="hours countdown-item mb-0 w-110-px fw-medium h-110-px bg-neutral-900 w-100 h-100 rounded-circle text-white aspect-ratio-1 d-flex justify-content-center align-items-center">0</h4>
                                <span class="text-neutral-500 text-md text-uppercase fw-medium mt-8">Hours</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <h4 class="minutes countdown-item mb-0 w-110-px fw-medium h-110-px bg-neutral-900 w-100 h-100 rounded-circle text-white aspect-ratio-1 d-flex justify-content-center align-items-center">0</h4>
                                <span class="text-neutral-500 text-md text-uppercase fw-medium mt-8">Minutes</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <h4 class="seconds countdown-item mb-0 w-110-px fw-medium h-110-px bg-neutral-900 w-100 h-100 rounded-circle text-white aspect-ratio-1 d-flex justify-content-center align-items-center">0</h4>
                                <span class="text-neutral-500 text-md text-uppercase fw-medium mt-8">Seconds</span>
                            </div>
                        </div>

                        <div class="mt-24 max-w-500-px text-start">
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
                        <img src="assets/images/coming-soon/coming-soon.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $script = '<script>
                        (function() {
                            /***** CALCULATE THE TIME REMAINING *****/
                            function getTimeRemaining(endtime) {
                                var t = Date.parse(endtime) - Date.parse(new Date());

                                /***** CONVERT THE TIME TO A USEABLE FORMAT *****/
                                var seconds = Math.floor((t / 1000) % 60);
                                var minutes = Math.floor((t / 1000 / 60) % 60);
                                var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
                                var days = Math.floor(t / (1000 * 60 * 60 * 24));

                                /***** OUTPUT THE CLOCK DATA AS A REUSABLE OBJECT *****/
                                return {
                                    total: t,
                                    days: days,
                                    hours: hours,
                                    minutes: minutes,
                                    seconds: seconds,
                                };
                            }

                            /***** DISPLAY THE CLOCK AND STOP IT WHEN IT REACHES ZERO *****/
                            function initializeClock(id, endtime) {
                                var clock = document.getElementById(id);
                                var daysSpan = clock.querySelector(".days");
                                var hoursSpan = clock.querySelector(".hours");
                                var minutesSpan = clock.querySelector(".minutes");
                                var secondsSpan = clock.querySelector(".seconds");

                                function updateClock() {
                                    var t = getTimeRemaining(endtime);

                                    daysSpan.innerHTML = t.days;
                                    hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
                                    minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
                                    secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);

                                    if (t.total <= 0) {
                                        clearInterval(timeinterval);
                                    }
                                }

                                updateClock(); // run function once at first to avoid delay
                                var timeinterval = setInterval(updateClock, 1000);
                            }

                            /***** SET A VALID END DATE *****/
                            var deadline = new Date(Date.parse(new Date()) + 99 * 24 * 60 * 60 * 1000);
                            initializeClock("coming-soon", deadline);
                        })();
                        </script>';?>
<?php include './partials/scripts.php' ?>

</body>

</html>
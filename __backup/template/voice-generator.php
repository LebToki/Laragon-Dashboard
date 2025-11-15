<?php $script ='<script>
                        // ================== Audio Js Start ===========================
                        $(function() {
                            $("audio").audioPlayer();
                        });
                        // ================== Audio Js End ===========================
                </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Voice Generator</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Voice Generator</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-xxl-3 col-lg-4">
                    <div class="card h-100 p-0">
                        <div class="card-body p-24">
                            <div class="mb-20">
                                <label for="language" class="text-sm fw-semibold text-primary-light mb-8">Language</label>
                                <select class="form-select form-control px-16 py-14 h-48-px" id="language">
                                    <option value="">English</option>
                                    <option value="">Bangla</option>
                                    <option value="">Hindi</option>
                                    <option value="">Urdhu</option>
                                </select>
                            </div>
                            <div class="mb-20">
                                <label for="audioEffect" class="text-sm fw-semibold text-primary-light mb-8">Audio Effect</label>
                                <select class="form-select form-control px-16 py-14 h-48-px" id="audioEffect">
                                    <option value="">Smart Voice</option>
                                    <option value="">Old Voice</option>
                                    <option value="">Similar Voice</option>
                                </select>
                            </div>
                            <div class="mb-20">
                                <label for="voice" class="text-sm fw-semibold text-primary-light mb-8">Voice</label>
                                <select class="form-select form-control px-16 py-14 h-48-px" id="voice">
                                    <option value="">Amber Heath</option>
                                    <option value="">Amber Heath</option>
                                    <option value="">Amber Heath</option>
                                    <option value="">Amber Heath</option>
                                </select>
                            </div>
                            <div class="mb-20">
                                <label for="format" class="text-sm fw-semibold text-primary-light mb-8">Format</label>
                                <select class="form-select form-control px-16 py-14 h-48-px" id="format">
                                    <option value="">Mp3</option>
                                    <option value="">Mp4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <div class="chat-main card overflow-hidden">
                        <div class="chat-sidebar-single gap-8 justify-content-between cursor-default flex-nowrap">
                            <div class="d-flex align-items-center gap-16">
                                <a href="text-generator-new.php" class="text-primary-light text-2xl line-height-1"><i class="ri-arrow-left-line"></i></a>
                                <h6 class="text-lg mb-0 text-line-1">Alright guys, so I've just seen this website...</h6>
                            </div>

                            <div class="d-flex align-items-center gap-16 flex-shrink-0">
                                <button type="button" class="text-secondary-light text-xl line-height-1 text-hover-primary-600"><i class="ri-edit-2-line"></i></button>
                                <button type="button" class="text-secondary-light text-xl line-height-1 text-hover-primary-600"><i class="ri-delete-bin-6-line"></i></button>
                            </div>
                        </div><!-- chat-sidebar-single end -->
                        <div class="chat-message-list max-h-612-px min-h-612-px">

                            <!-- User generated Text Start -->
                            <div class="d-flex align-items-start justify-content-between gap-16 border-bottom border-neutral-200 pb-16 mb-16">
                                <div class="d-flex align-items-start gap-16">
                                    <div class="img overflow-hidden flex-shrink-0">
                                        <img src="assets/images/chat/1.png" alt="image" class="w-44-px h-44-px rounded-circle object-fit-cover">
                                    </div>
                                    <div class="info">
                                        <h6 class="text-lg mb-4">Adam Milner</h6>
                                        <p class="mb-0 text-secondary-light text-sm">Alright guys, so I've just seen this website, Fortunanest website, it's an investment website and you invest there. So I actually tried it some months, I tried it just for 3 months and I realized everything was working correct. I was thinking it was this fake website, I never met this website.</p>
                                    </div>
                                </div>
                                <button type="button" class="d-flex align-items-center gap-6 px-8 py-4 bg-primary-50 radius-4 bg-hover-primary-100 flex-shrink-0"> <i class="ri-edit-2-fill"></i> Edit</button>
                            </div>
                            <!-- User generated Text End -->

                            <!-- AI Assistant generated Text Start -->
                            <div class="d-flex align-items-start gap-16 border-bottom border-neutral-200 pb-16 mb-16">
                                <div class="img overflow-hidden flex-shrink-0">
                                    <img src="assets/images/logo-icon.png" alt="image" class="w-44-px h-44-px rounded-circle object-fit-cover">
                                </div>
                                <div class="info flex-grow-1">
                                    <h6 class="text-lg mb-16 mt-8">AI Assistant</h6>


                                    <audio preload="auto" controls>
                                        <source src="https://www.w3schools.com/html/horse.mp3">
                                    </audio>

                                    <!-- <audio src="assets/audio/1.ogg" preload="auto" controls autoplay loop></audio> -->


                                    <!-- <audio controls>
                                <source src="assets/audio/1.ogg" type="audio/ogg">
                                <source src="assets/audio/1.ogg" type="audio/mpeg">
                                Your browser does not support the audio tag.
                            </audio> -->

                                    <div class="mt-24 d-flex align-items-center gap-16">
                                        <button type="button" class="btn btn-primary d-flex align-items-center gap-8 px-20 flex-shrink-0">
                                            Download
                                            <i class="ri-download-2-line"></i>
                                        </button>
                                        <select class="form-select form-control min-w-132-px px-16 py-14 h-48-px w-auto">
                                            <option value="">Mp3</option>
                                            <option value="">Mp4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- AI Assistant generated Text End -->

                        </div>
                        <form class="chat-message-box">
                            <input type="text" name="chatMessage" placeholder="Type your message...">
                            <button type="submit" class="w-44-px h-44-px d-flex justify-content-center align-items-center radius-8 bg-primary-600 text-white bg-hover-primary-700 text-xl">
                                <iconify-icon icon="f7:paperplane"></iconify-icon>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

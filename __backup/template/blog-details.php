<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Blog Details</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Blog Details</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card p-0 radius-12 overflow-hidden">
                <div class="card-body p-0">
                    <img src="assets/images/blog/blog-details.png" alt="" class="w-100 h-100 object-fit-cover">
                    <div class="p-32">
                        <div class="d-flex align-items-center gap-16 justify-content-between flex-wrap mb-24">
                            <div class="d-flex align-items-center gap-8">
                                <img src="assets/images/user-list/user-list1.png" alt="" class="w-48-px h-48-px rounded-circle object-fit-cover">
                                <div class="d-flex flex-column">
                                    <h6 class="text-lg mb-0">John Doe</h6>
                                    <span class="text-sm text-neutral-500">1 day ago</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-md-3 gap-2 flex-wrap">
                                <div class="d-flex align-items-center gap-8 text-neutral-500 text-lg fw-medium">
                                    <i class="ri-chat-3-line"></i>
                                    10 Comments
                                </div>
                                <div class="d-flex align-items-center gap-8 text-neutral-500 text-lg fw-medium">
                                    <i class="ri-calendar-2-line"></i>
                                    Jan 17, 2024
                                </div>
                            </div>
                        </div>
                        <h3 class="mb-16"> How to hire a right business executive for your company </h3>
                        <p class="text-neutral-500 mb-16">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi voluptate quaerat possimus neque animi ex placeat ducimus reiciendis saepe mollitia tenetur aspernatur unde illum fugiat</p>
                        <p class="text-neutral-500 mb-16">reprehenderit repellendus dicta accusantium laborum eum et inventore. Perferendis temporibus reiciendis ut magni numquam molestiae fugit, laboriosam adipisci modi, quisquam, rem aspernatur fugiat neque velit ratione? Ipsum maxime aperiam minus dolorem voluptatibus suscipit debitis delectus numquam.</p>
                        <p class="text-neutral-500 mb-16">reprehenderit repellendus dicta accusantium laborum eum et inventore. Perferendis temporibus reiciendis ut magni numquam molestiae fugit, laboriosam adipisci modi, quisquam, rem aspernatur fugiat neque velit ratione? Ipsum maxime aperiam minus dolorem voluptatibus suscipit debitis delectus numquam. Illum delectus dicta sit soluta dolores odit facilis exercitationem animi quibusdam, autem nulla omnis harum magnam est ad aperiam quasi qui? Enim, natus porro debitis maiores ad soluta totam nesciunt deleniti tempora ipsum id consectetur? Alias dignissimos vel corrupti!</p>
                    </div>
                </div>
            </div>
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">Comments</h6>
                </div>
                <div class="card-body p-24">
                    <div class="comment-list d-flex flex-column">
                        <div class="comment-list__item">
                            <div class="d-flex align-items-start gap-16">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/user-list/user-list1.png" alt="" class="w-60-px h-60-px rounded-circle object-fit-cover">
                                </div>
                                <div class="flex-grow-1 border-bottom pb-40 mb-40 border-dashed">
                                    <h6 class="text-lg mb-4">Jenny Wilson</h6>
                                    <span class="text-neutral-500 text-sm">Jan 21, 2024 at 11:25 pm</span>
                                    <p class="text-neutral-600 text-md my-16">Lorem ipsum dolor sit amet consectetur. Nec nunc pellentesque massa pretium. Quam sapien nec venenatis vivamus sed cras faucibus mi viverra. Quam faucibus morbi cras vitae neque. Necnunc pellentesque massa pretium.</p>
                                    <div class="d-flex align-items-center gap-8">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-heart-3-line text-xs line-height-1"></i>
                                            Like
                                        </a>
                                        <a href="#comment-form" class="btn btn-sm btn-primary-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-reply-line text-xs line-height-1"></i>
                                            Reply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list__item ms--48">
                            <div class="d-flex align-items-start gap-16">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/user-list/user-list2.png" alt="" class="w-60-px h-60-px rounded-circle object-fit-cover">
                                </div>
                                <div class="flex-grow-1 border-bottom pb-40 mb-40 border-dashed">
                                    <h6 class="text-lg mb-4">Robiul Hasan</h6>
                                    <span class="text-neutral-500 text-sm">Jan 21, 2024 at 11:25 pm</span>
                                    <p class="text-neutral-600 text-md my-16">Lorem ipsum dolor sit amet consectetur. Nec nunc pellentesque massa pretium. Quam sapien nec venenatis vivamus sed cras faucibus mi viverra. Quam faucibus morbi cras vitae neque. Necnunc pellentesque massa pretium.</p>
                                    <div class="d-flex align-items-center gap-8">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-heart-3-line text-xs line-height-1"></i>
                                            Like
                                        </a>
                                        <a href="#comment-form" class="btn btn-sm btn-primary-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-reply-line text-xs line-height-1"></i>
                                            Reply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list__item ms--48">
                            <div class="d-flex align-items-start gap-16">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/user-list/user-list3.png" alt="" class="w-60-px h-60-px rounded-circle object-fit-cover">
                                </div>
                                <div class="flex-grow-1 border-bottom pb-40 mb-40 border-dashed">
                                    <h6 class="text-lg mb-4">John Doe</h6>
                                    <span class="text-neutral-500 text-sm">Jan 21, 2024 at 11:25 pm</span>
                                    <p class="text-neutral-600 text-md my-16">Lorem ipsum dolor sit amet consectetur. Nec nunc pellentesque massa pretium. Quam sapien nec venenatis vivamus sed cras faucibus mi viverra. Quam faucibus morbi cras vitae neque. Necnunc pellentesque massa pretium.</p>
                                    <div class="d-flex align-items-center gap-8">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-heart-3-line text-xs line-height-1"></i>
                                            Like
                                        </a>
                                        <a href="#comment-form" class="btn btn-sm btn-primary-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-reply-line text-xs line-height-1"></i>
                                            Reply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list__item">
                            <div class="d-flex align-items-start gap-16">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/user-list/user-list4.png" alt="" class="w-60-px h-60-px rounded-circle object-fit-cover">
                                </div>
                                <div class="flex-grow-1 border-bottom pb-40 mb-40 border-dashed">
                                    <h6 class="text-lg mb-4">Mariam Akter</h6>
                                    <span class="text-neutral-500 text-sm">Jan 21, 2024 at 11:25 pm</span>
                                    <p class="text-neutral-600 text-md my-16">Lorem ipsum dolor sit amet consectetur. Nec nunc pellentesque massa pretium. Quam sapien nec venenatis vivamus sed cras faucibus mi viverra. Quam faucibus morbi cras vitae neque. Necnunc pellentesque massa pretium.</p>
                                    <div class="d-flex align-items-center gap-8">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-heart-3-line text-xs line-height-1"></i>
                                            Like
                                        </a>
                                        <a href="#comment-form" class="btn btn-sm btn-primary-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-reply-line text-xs line-height-1"></i>
                                            Reply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list__item ms--48">
                            <div class="d-flex align-items-start gap-16">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/user-list/user-list6.png" alt="" class="w-60-px h-60-px rounded-circle object-fit-cover">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-lg mb-4">Dainel Defoe</h6>
                                    <span class="text-neutral-500 text-sm">Jan 21, 2024 at 11:25 pm</span>
                                    <p class="text-neutral-600 text-md my-16">Lorem ipsum dolor sit amet consectetur. Nec nunc pellentesque massa pretium. Quam sapien nec venenatis vivamus sed cras faucibus mi viverra. Quam faucibus morbi cras vitae neque. Necnunc pellentesque massa pretium.</p>
                                    <div class="d-flex align-items-center gap-8">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-heart-3-line text-xs line-height-1"></i>
                                            Like
                                        </a>
                                        <a href="#comment-form" class="btn btn-sm btn-primary-600 d-flex align-items-center gap-1 text-xxs px-8 py-6">
                                            <i class="ri-reply-line text-xs line-height-1"></i>
                                            Reply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-24" id="comment-form">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">Add A Comment</h6>
                </div>
                <div class="card-body p-24">
                    <form action="#" class="d-flex flex-column gap-16">
                        <div>
                            <label class="form-label fw-semibold" for="username">Username </label>
                            <input type="text" class="form-control border border-neutral-200 radius-8" id="username" placeholder="Enter your username">
                        </div>
                        <div>
                            <label class="form-label fw-semibold" for="email">Email </label>
                            <input type="email" class="form-control border border-neutral-200 radius-8" id="email" placeholder="Enter your email">
                        </div>
                        <div>
                            <label class="form-label fw-semibold" for="desc">Email </label>
                            <textarea class="form-control border border-neutral-200 radius-8" rows="4" cols="50" id="desc" placeholder="Enter a description..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-600 radius-8">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Start -->
        <div class="col-lg-4">
            <div class="d-flex flex-column gap-24">

                <!-- Search -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h6 class="text-xl mb-0">Search Here</h6>
                    </div>
                    <div class="card-body p-24">
                        <form class="position-relative">
                            <input type="text" class="form-control border border-neutral-200 radius-8 ps-40" name="search" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon position-absolute positioned-icon top-50 translate-middle-y"></iconify-icon>
                        </form>
                    </div>
                </div>

                <!-- Latest Blog -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h6 class="text-xl mb-0">Latest Posts</h6>
                    </div>
                    <div class="card-body d-flex flex-column gap-24 p-24">
                        <div class="d-flex flex-wrap">
                            <a href="blog-details.php" class="blog__thumb w-100 radius-12 overflow-hidden">
                                <img src="assets/images/blog/blog5.png" alt="" class="w-100 h-100 object-fit-cover">
                            </a>
                            <div class="blog__content">
                                <h6 class="mb-8">
                                    <a href="blog-details.php" class="text-line-2 text-hover-primary-600 text-md transition-2">How to hire a right business executive for your company</a>
                                </h6>
                                <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="blog-details.php" class="blog__thumb w-100 radius-12 overflow-hidden">
                                <img src="assets/images/blog/blog6.png" alt="" class="w-100 h-100 object-fit-cover">
                            </a>
                            <div class="blog__content">
                                <h6 class="mb-8">
                                    <a href="blog-details.php" class="text-line-2 text-hover-primary-600 text-md transition-2">The Gig Economy: Adapting to a Flexible Workforce</a>
                                </h6>
                                <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="blog-details.php" class="blog__thumb w-100 radius-12 overflow-hidden">
                                <img src="assets/images/blog/blog7.png" alt="" class="w-100 h-100 object-fit-cover">
                            </a>
                            <div class="blog__content">
                                <h6 class="mb-8">
                                    <a href="blog-details.php" class="text-line-2 text-hover-primary-600 text-md transition-2">The Future of Remote Work: Strategies for Success</a>
                                </h6>
                                <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="blog-details.php" class="blog__thumb w-100 radius-12 overflow-hidden">
                                <img src="assets/images/blog/blog6.png" alt="" class="w-100 h-100 object-fit-cover">
                            </a>
                            <div class="blog__content">
                                <h6 class="mb-8">
                                    <a href="blog-details.php" class="text-line-2 text-hover-primary-600 text-md transition-2">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                                </h6>
                                <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h6 class="text-xl mb-0">Tags</h6>
                    </div>
                    <div class="card-body p-24">
                        <ul>
                            <li class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                <a href="blog.php" class="text-hover-primary-600 transition-2"> Techbology </a>
                                <span class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold"> 01 </span>
                            </li>
                            <li class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                <a href="blog.php" class="text-hover-primary-600 transition-2"> Business </a>
                                <span class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold"> 01 </span>
                            </li>
                            <li class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                <a href="blog.php" class="text-hover-primary-600 transition-2"> Consulting </a>
                                <span class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold"> 01 </span>
                            </li>
                            <li class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                <a href="blog.php" class="text-hover-primary-600 transition-2"> Course </a>
                                <span class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold"> 01 </span>
                            </li>
                            <li class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8">
                                <a href="blog.php" class="text-hover-primary-600 transition-2"> Real Estate </a>
                                <span class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold"> 01 </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tags -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h6 class="text-xl mb-0">Tags</h6>
                    </div>
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center flex-wrap gap-8">
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> Development </a>
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> Design </a>
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> Technology </a>
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> Popular </a>
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> Codignator </a>
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> Javascript </a>
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> Bootstrap </a>
                            <a href="blog.php" class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6"> PHP </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
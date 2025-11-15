<?php $script = '<script>
                    $(function() {
                        $("#sortable-wrapper").sortable();
                    });

                    $(function() {
                        $("#sortable1, #sortable2, #sortable3").sortable({
                            connectWith: ".connectedSortable"
                        }).disableSelection();
                    });
                    </script>


                    <!--=========================== Delete & Duplicate js code start ==============================-->
                    <script>
                    // Duplicate Item js
                    document.addEventListener("DOMContentLoaded", function() {
                        document.querySelectorAll(".duplicate-button").forEach(button => {
                            button.addEventListener("click", function() {
                                // Find the closest card to the clicked button
                                const card = this.closest(".kanban-item");
                                // Clone the card
                                const clone = card.cloneNode(true);
                                // Append the cloned card to the parent container
                                card.parentNode.appendChild(clone);

                                // Add event listener to delete button of the cloned card
                                clone.querySelector(".delete-button").addEventListener("click", function() {
                                    clone.remove();
                                });
                            });
                        });

                        $(document).on("click", ".delete-button", function() {
                            $(this).closest(".kanban-item").addClass("d-none");
                        });
                    });
                    </script>
                    <!--=========================== Delete & Duplicate js code End ==============================-->


                    <!--=========================== Add new Task & Edit Task js code Start ==============================-->
                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Show the modal to add a new task
                        document.querySelectorAll(".add-kanban, .add-task-button").forEach(button => {
                            button.addEventListener("click", function() {
                                var addTaskModal = new bootstrap.Modal(document.getElementById("addTaskModal"));
                                document.getElementById("editTaskId").value = ""; // Clear edit ID
                                document.getElementById("taskTitle").value = ""; // Clear title
                                document.getElementById("taskDescription").value = ""; // Clear description
                                document.getElementById("taskTag").value = ""; // Clear Tag
                                document.getElementById("startDate").value = ""; // Clear Date
                                document.getElementById("taskImage").value = ""; // Clear file input
                                document.getElementById("taskImagePreview").style.display = "none"; // Hide image preview
                                document.getElementById("taskImagePreview").src = ""; // Clear image preview
                                addTaskModal.show();
                            });
                        });

                        // Preview the image when a file is selected
                        document.getElementById("taskImage").addEventListener("change", function() {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById("taskImagePreview").src = e.target.result;
                                document.getElementById("taskImagePreview").style.display = "block";
                            };
                            if (file) {
                                reader.readAsDataURL(file);
                            }
                        });

                        // Save task button click handler
                        document.getElementById("saveTaskButton").addEventListener("click", function() {
                            var title = document.getElementById("taskTitle").value;
                            var description = document.getElementById("taskDescription").value;
                            var tag = document.getElementById("taskTag").value;
                            var date = document.getElementById("startDate").value;
                            var editTaskId = document.getElementById("editTaskId").value;
                            var imageSrc = document.getElementById("taskImagePreview").src;

                            if (title === "" || description === "") {
                                alert("Title and Description cannot be empty");
                                return;
                            }

                            var kanbanCardHTML = `
                                <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="${editTaskId ? editTaskId : "kanban-" + new Date().getTime()}">
                                    ${imageSrc ? `<div class="radius-8 mb-12 max-h-350-px overflow-hidden"><img src="${imageSrc}" alt="" class="w-100 h-100 object-fit-cover"></div>` : ""}
                                    <h6 class="kanban-title text-lg fw-semibold mb-8">${title}</h6>
                                    <p class="kanban-desc text-secondary-light">${description}</p>
                                    <button type="button" class="start-date btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                        <iconify-icon icon="lucide:tag" class="icon"></iconify-icon> <span class="kanban-tag fw-semibold">${tag}</span>
                                    </button>
                                    <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                        <div class="d-flex align-items-center justify-content-between gap-10">
                                            <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                            <span class="start-date text-secondary-light">${date}</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-10">
                                            <button type="button" class="card-edit-button text-success-600"><iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon></button>
                                            <button type="button" class="card-delete-button text-danger-600"><iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon></button>
                                        </div>
                                    </div>
                                </div>
                                `;

                            if (editTaskId) {
                                // Edit existing card
                                var editCard = document.getElementById(editTaskId);
                                if (editCard) {
                                    editCard.outerHTML = kanbanCardHTML;
                                }
                            } else {
                                // Add new card
                                var targetKanbanItem = document.querySelector(".kanban-item");
                                if (targetKanbanItem) {
                                    var firstKanbanCard = targetKanbanItem.querySelector(".card-body .kanban-card");
                                    if (firstKanbanCard) {
                                        firstKanbanCard.insertAdjacentHTML("beforebegin", kanbanCardHTML);
                                    } else {
                                        targetKanbanItem.querySelector(".card-body").insertAdjacentHTML("afterbegin", kanbanCardHTML);
                                    }
                                }
                            }

                            var addTaskModal = bootstrap.Modal.getInstance(document.getElementById("addTaskModal"));
                            addTaskModal.hide();
                        });

                        // Delegate edit and delete button events to dynamically added kanban cards
                        document.addEventListener("click", function(e) {
                            if (e.target.closest(".card-edit-button")) {
                                var card = e.target.closest(".kanban-card");
                                document.getElementById("taskTitle").value = card.querySelector(".kanban-title").textContent;
                                document.getElementById("taskDescription").value = card.querySelector(".kanban-desc").textContent;
                                document.getElementById("taskTag").value = card.querySelector(".kanban-tag").textContent;
                                document.getElementById("startDate").value = card.querySelector(".start-date").textContent;
                                document.getElementById("editTaskId").value = card.id;
                                var img = card.querySelector("img");
                                if (img) {
                                    document.getElementById("taskImagePreview").src = img.src;
                                    document.getElementById("taskImagePreview").style.display = "block";
                                } else {
                                    document.getElementById("taskImagePreview").style.display = "none";
                                    document.getElementById("taskImagePreview").src = "";
                                }

                                var addTaskModal = new bootstrap.Modal(document.getElementById("addTaskModal"));
                                addTaskModal.show();
                            }
                            if (e.target.closest(".card-delete-button")) {
                                var card = e.target.closest(".kanban-card");
                                if (card) {
                                    card.remove();
                                }
                            }
                        });
                    });
                    </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Kanban</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Kanban</li>
                </ul>
            </div>

            <div class="overflow-x-auto scroll-sm pb-8">
                <div class="kanban-wrapper">
                    <div class="d-flex align-items-start gap-24" id="sortable-wrapper">
                        <div class="w-25 kanban-item radius-12 progress-card">
                            <div class="card p-0 radius-12 overflow-hidden shadow-none">
                                <div class="card-body p-0 pb-24">
                                    <div class="d-flex align-items-center gap-2 justify-content-between ps-24 pt-24 pe-24">
                                        <h6 class="text-lg fw-semibold mb-0">In Progress</h6>
                                        <div class="d-flex align-items-center gap-3 justify-content-between mb-0">
                                            <button type="button" class="text-2xl hover-text-primary add-task-button">
                                                <iconify-icon icon="ph:plus-circle" class="icon"></iconify-icon>
                                            </button>
                                            <div class="dropdown">
                                                <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <iconify-icon icon="entypo:dots-three-vertical" class="text-xl"></iconify-icon>
                                                </button>
                                                <ul class="dropdown-menu p-12 border bg-base shadow">
                                                    <li>
                                                        <a class="duplicate-button dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2" href="javascript:void(0)">
                                                            <iconify-icon class="text-xl" icon="humbleicons:duplicate"></iconify-icon>
                                                            Duplicate
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="delete-button dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2" href="javascript:void(0)">
                                                            <iconify-icon class="text-xl" icon="mingcute:delete-2-line"></iconify-icon>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="connectedSortable ps-24 pt-24 pe-24" id="sortable1">
                                        <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="kanban-1">
                                            <div class="radius-8 mb-12 max-h-350-px overflow-hidden">
                                                <img src="assets/images/kanban/kanban-1.png" alt="" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <h6 class="kanban-title text-lg fw-semibold mb-8">Creating a new website</h6>
                                            <p class="kanban-desc text-secondary-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                            <button type="button" class="btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                                <iconify-icon icon="lucide:tag" class="icon"></iconify-icon>
                                                <span class="kanban-tag fw-semibold">UI Design</span>
                                            </button>
                                            <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                    <span class="start-date text-secondary-light">25 Aug 2024</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                    <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="kanban-2">
                                            <div class="radius-8 mb-12 max-h-350-px overflow-hidden">
                                                <img src="assets/images/kanban/kanban-2.png" alt="" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <h6 class="kanban-title text-lg fw-semibold mb-8">Creating a new website</h6>
                                            <p class="kanban-desc text-secondary-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                            <button type="button" class="btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                                <iconify-icon icon="lucide:tag" class="icon"></iconify-icon>
                                                <span class="kanban-tag fw-semibold">UI Design</span>
                                            </button>
                                            <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                    <span class="start-date text-secondary-light">25 Aug 2024</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                    <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Task Button -->
                                    <button type="button" class="d-flex align-items-center gap-2 fw-medium w-100 text-primary-600 justify-content-center text-hover-primary-800 add-task-button">
                                        <iconify-icon icon="ph:plus-circle" class="icon text-xl"></iconify-icon>
                                        Add Task
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 kanban-item radius-12 pending-card">
                            <div class="card p-0 radius-12 overflow-hidden shadow-none">
                                <div class="card-body p-0 pb-24">
                                    <div class="d-flex align-items-center gap-2 justify-content-between ps-24 pt-24 pe-24">
                                        <h6 class="text-lg fw-semibold mb-0">Pending</h6>
                                        <div class="d-flex align-items-center gap-3 justify-content-between mb-0">
                                            <button type="button" class="text-2xl hover-text-primary add-task-button">
                                                <iconify-icon icon="ph:plus-circle" class="icon"></iconify-icon>
                                            </button>
                                            <div class="dropdown">
                                                <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <iconify-icon icon="entypo:dots-three-vertical" class="text-xl"></iconify-icon>
                                                </button>
                                                <ul class="dropdown-menu p-12 border bg-base shadow">
                                                    <li>
                                                        <a class="duplicate-button dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2" href="javascript:void(0)">
                                                            <iconify-icon class="text-xl" icon="humbleicons:duplicate"></iconify-icon>
                                                            Duplicate
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="delete-button dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2" href="javascript:void(0)">
                                                            <iconify-icon class="text-xl" icon="mingcute:delete-2-line"></iconify-icon>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="connectedSortable ps-24 pt-24 pe-24" id="sortable2">
                                        <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="kanban-3">
                                            <h6 class="kanban-title text-lg fw-semibold mb-8">Creating a new website</h6>
                                            <p class="kanban-desc text-secondary-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                            <button type="button" class="btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                                <iconify-icon icon="lucide:tag" class="icon"></iconify-icon>
                                                <span class="kanban-tag fw-semibold">UI Design</span>
                                            </button>
                                            <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                    <span class="start-date text-secondary-light">25 Aug 2024</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                    <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="kanban-4">
                                            <div class="radius-8 mb-12 max-h-350-px overflow-hidden">
                                                <img src="assets/images/kanban/kanban-2.png" alt="" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <h6 class="kanban-title text-lg fw-semibold mb-8">Creating a new website</h6>
                                            <p class="kanban-desc text-secondary-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                            <button type="button" class="btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                                <iconify-icon icon="lucide:tag" class="icon"></iconify-icon>
                                                <span class="kanban-tag fw-semibold">UI Design</span>
                                            </button>
                                            <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                    <span class="start-date text-secondary-light">25 Aug 2024</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                    <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Task Button -->
                                    <button type="button" class="d-flex align-items-center gap-2 fw-medium w-100 text-primary-600 justify-content-center text-hover-primary-800 add-task-button">
                                        <iconify-icon icon="ph:plus-circle" class="icon text-xl"></iconify-icon>
                                        Add Task
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 kanban-item radius-12 done-card">
                            <div class="card p-0 radius-12 overflow-hidden shadow-none">
                                <div class="card-body p-0 pb-24">
                                    <div class="d-flex align-items-center gap-2 justify-content-between ps-24 pt-24 pe-24">
                                        <h6 class="text-lg fw-semibold mb-0">Done</h6>
                                        <div class="d-flex align-items-center gap-3 justify-content-between mb-0">
                                            <button type="button" class="text-2xl hover-text-primary add-task-button">
                                                <iconify-icon icon="ph:plus-circle" class="icon"></iconify-icon>
                                            </button>
                                            <div class="dropdown">
                                                <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <iconify-icon icon="entypo:dots-three-vertical" class="text-xl"></iconify-icon>
                                                </button>
                                                <ul class="dropdown-menu p-12 border bg-base shadow">
                                                    <li>
                                                        <a class="duplicate-button dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2" href="javascript:void(0)">
                                                            <iconify-icon class="text-xl" icon="humbleicons:duplicate"></iconify-icon>
                                                            Duplicate
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="delete-button dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2" href="javascript:void(0)">
                                                            <iconify-icon class="text-xl" icon="mingcute:delete-2-line"></iconify-icon>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="connectedSortable ps-24 pt-24 pe-24" id="sortable3">
                                        <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="kanban-5">
                                            <h6 class="kanban-title text-lg fw-semibold mb-8">Creating a new website</h6>
                                            <p class="kanban-desc text-secondary-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                            <button type="button" class="btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                                <iconify-icon icon="lucide:tag" class="icon"></iconify-icon>
                                                <span class="kanban-tag fw-semibold">UI Design</span>
                                            </button>
                                            <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                    <span class="start-date text-secondary-light">25 Aug 2024</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                    <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="kanban-6">
                                            <h6 class="kanban-title text-lg fw-semibold mb-8">Creating a new website</h6>
                                            <p class="kanban-desc text-secondary-light">Lorem ipsum dolor sit amet, consectetur </p>
                                            <button type="button" class="btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                                <iconify-icon icon="lucide:tag" class="icon"></iconify-icon>
                                                <span class="kanban-tag fw-semibold">UI Design</span>
                                            </button>
                                            <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                    <span class="start-date text-secondary-light">25 Aug 2024</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                    <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kanban-card bg-neutral-50 p-16 radius-8 mb-24" id="kanban-7">
                                            <div class="radius-8 mb-12 max-h-350-px overflow-hidden">
                                                <img src="assets/images/kanban/kanban-2.png" alt="" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <h6 class="kanban-title text-lg fw-semibold mb-8">Creating a new website</h6>
                                            <p class="kanban-desc text-secondary-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                            <button type="button" class="btn text-primary-600 border rounded border-primary-600 bg-hover-primary-600 text-hover-white d-flex align-items-center gap-2">
                                                <iconify-icon icon="lucide:tag" class="icon"></iconify-icon>
                                                <span class="kanban-tag fw-semibold">UI Design</span>
                                            </button>
                                            <div class="mt-12 d-flex align-items-center justify-content-between gap-10">
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <iconify-icon icon="solar:calendar-outline" class="text-primary-light"></iconify-icon>
                                                    <span class="start-date text-secondary-light">25 Aug 2024</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-10">
                                                    <button type="button" class="card-edit-button text-success-600">
                                                        <iconify-icon icon="lucide:edit" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                    <button type="button" class="card-delete-button text-danger-600">
                                                        <iconify-icon icon="fluent:delete-24-regular" class="icon text-lg line-height-1"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add Task Button -->
                                    <button type="button" class="d-flex align-items-center gap-2 fw-medium w-100 text-primary-600 justify-content-center text-hover-primary-800 add-task-button">
                                        <iconify-icon icon="ph:plus-circle" class="icon text-xl"></iconify-icon>
                                        Add Task
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 kanban-item radius-12 overflow-hidden">
                            <div class="card p-0 radius-12 overflow-hidden shadow-none">
                                <div class="card-body p-24">
                                    <button type="button" class="add-kanban d-flex align-items-center gap-2 fw-medium w-100 text-primary-600 justify-content-center text-hover-primary-800 line-height-1">
                                        <iconify-icon icon="ph:plus-circle" class="icon text-xl d-flex"></iconify-icon>
                                        Add Task
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Task Modal -->
        <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel">Add New Task</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="taskForm">
                            <input type="hidden" id="editTaskId" value="">
                            <div class="mb-3">
                                <label for="taskTitle" class="form-label fw-semibold text-primary-light text-sm mb-8">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Event Title " id="taskTitle" required>
                            </div>
                            <div class="mb-3">
                                <label for="taskTag" class="form-label fw-semibold text-primary-light text-sm mb-8">Tag</label>
                                <input type="text" class="form-control" placeholder="Enter tag" id="taskTag" required>
                            </div>
                            <div class="mb-3">
                                <label for="startDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Start Date</label>
                                <input type="date" class="form-control" id="startDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="taskDescription" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                <textarea class="form-control" id="taskDescription" rows="3" placeholder="Write some text" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="taskImage" class="form-label fw-semibold text-primary-light text-sm mb-8">Attachments <span class="text-sm">(Jpg, Png format)</span> </label>
                                <input type="file" class="form-control" id="taskImage">
                                <img id="taskImagePreview" src="assets/images/carousel/carousel-img1.png" alt="Image Preview">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-center gap-3">
                        <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary border border-primary-600 text-md px-28 py-12 radius-8" id="saveTaskButton">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
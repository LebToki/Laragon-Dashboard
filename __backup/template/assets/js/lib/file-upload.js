// ********************************** We can use  This code is for by ID ********************************* 
(function ($) {
    var fileUploadCount = 0;

    $.fn.fileUpload = function () {
        return this.each(function () {
            var fileUploadDiv = $(this);
            var fileUploadId = `fileUpload-${++fileUploadCount}`;

            // Creates HTML content for the file upload area.
            var fileDivContent = `
                <label for="${fileUploadId}" class="file-upload image-upload__box">
                    <div class="image-upload__boxInner">
                        <i class="ri-gallery-line image-upload__icon"></i>
                        <p class="text-xs text-secondary-light mt-4 mb-0">Drag & drop image here</p>
                    </div>
                    <input type="file" id="${fileUploadId}" name="[]" multiple hidden />
                </label>
            `;

            fileUploadDiv.html(fileDivContent).addClass("file-container");

            // Adds the information of uploaded files to file upload area.
            function handleFiles(files) {
                if (files.length > 0) {
                    var file = files[0]; // Assuming only one file is selected

                    var fileName = file.name;
                    var fileSize = (file.size / 1024).toFixed(2) + " KB";
                    var fileType = file.type;
                    var preview = fileType.startsWith("image")
                        ? `<img src="${URL.createObjectURL(file)}" alt="${fileName}" class="image-upload__image" height="30">`
                        : ` <span class="image-upload__anotherFileIcon"> <i class="fas fa-file"></i></span>`;

                    // Update the content of the file upload area
                    var fileUploadLabel = fileUploadDiv.find(`label.file-upload`);
                    fileUploadLabel.find('.image-upload__boxInner').html(`
                        ${preview}
                        <button type="button" class="image-upload__deleteBtn"><i class="ri-close-line"></i></button>
                    `);

                    // Attach a click event to the "Delete" button
                    fileUploadLabel.find('.image-upload__deleteBtn').click(function () {
                        fileUploadDiv.html(fileDivContent);
                        initializeFileUpload();
                    });
                }
            }

            function initializeFileUpload() {
                // Events triggered after dragging files.
                fileUploadDiv.on({
                    dragover: function (e) {
                        e.preventDefault();
                        fileUploadDiv.toggleClass("dragover", e.type === "dragover");
                    },
                    drop: function (e) {
                        e.preventDefault();
                        fileUploadDiv.removeClass("dragover");
                        handleFiles(e.originalEvent.dataTransfer.files);
                    },
                });

                // Event triggered when file is selected.
                fileUploadDiv.find(`label.file-upload input[type="file"]`).change(function () {
                    handleFiles(this.files);
                });
            }

            initializeFileUpload();
        });
    };
})(jQuery);

// Apply fileUpload functionality to each container with the class "fileUpload"
$('.fileUpload').fileUpload();

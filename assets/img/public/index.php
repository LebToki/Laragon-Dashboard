<?php require __DIR__ . '/header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<?php require __DIR__ . '/sidebar.php'; ?>
		<div class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<h1 class="mt-5">Chat with Ollama</h1>
			<div id="chatbox" class="mt-3 mb-3 border rounded p-3">
				<!-- Chat messages will be appended here -->
			</div>
			<!--- The Chat Input Form --->
			<form id="chat-form">
				<div class="input-group mb-3">
					<input type="text" id="user-input" class="form-control" placeholder="Type a message...">
					<button class="btn btn-primary" type="submit"><i class="fas fa-arrow-up"></i></button>
				</div>
			</form>
			<!--- The Upload Form --->
			<form id="upload-form" method="post" enctype="multipart/form-data" class="mt-3">
				<label for="custom-file-input" class="custom-file-input">
					<span class="icon"></span>
					Select a file
				</label>
				<input type="file" id="custom-file-input" accept="image/*" style="display: none;">
				
				<div class="file-preview" style="background: url(public/assets/img/file.png)">
					<span class="delete-file">X</span>
				</div>
				
<!--				<div class="input-group">-->
<!--					<input type="file" name="file" class="form-control">-->
<!--					<button type="submit" class="btn btn-primary">Upload File</button>-->
<!--				</div>-->
			</form>
			
		</div>
	</div>
</div>

<script>
    const customFileInput = document.getElementById('custom-file-input');

    customFileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        // Display file preview with a file icon called file.png background: url(public/assets/img/file.png)
				// with an overlaid X allowing deleting that uploaded file or removing it from the chat session
				
    });
</script>

<?php require __DIR__ . '/footer.php'; ?>

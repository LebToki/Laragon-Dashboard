<?php
	/**
	 * Application: Laragon | Server Index Inbox Page
	 * Description: This is the main index page for the Laragon server, displaying server info and applications.
	 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
	 * Contributors: LrkDev in v.2.3.3
	 * Version: 2.3.3
	 */
	
	// Set the directory path (modify as needed)
	const EML_FILE_PATH = 'D:/laragon/bin/sendmail/output/';
	
	function getEmailMetadata($filename) {
		$content = file_get_contents(EML_FILE_PATH . $filename);
		$subject = preg_match('/Subject: (.*)/', $content, $matches) ? $matches[1] : 'No Subject';
		$from = preg_match('/From: (.*)/', $content, $matches) ? $matches[1] : 'Unknown Sender';
		$date = preg_match('/Date: (.*)/', $content, $matches) ? strtotime($matches[1]) : 0;
		return ['subject' => $subject, 'from' => $from, 'date' => $date];
	}
	
	function handleEmailDeletion($directory) {
		if (isset($_GET['delete'])) {
			$fileToDelete = $directory . basename($_GET['delete']);
			if (file_exists($fileToDelete)) {
				unlink($fileToDelete);
			}
			header("Location: " . $_SERVER['PHP_SELF']);
			exit;
		}
	}
	
	function getEmails($directory) {
		if (!is_dir($directory)) {
			echo "<p>Directory does not exist: $directory</p>";
			return [];
		}
		$files = scandir($directory);
		if ($files === false) {
			echo "<p>Failed to scan directory: $directory</p>";
			return [];
		}
		$files = array_diff($files, ['.', '..']);
		$emails = array_filter($files, function ($file) {
			return preg_match('~^mail-\d{8}-\d{6}\.\d{3}\.txt$~', $file);
		});
		
		$emailsWithMetadata = [];
		foreach ($emails as $email) {
			$metadata = getEmailMetadata($email);
			$emailsWithMetadata[] = array_merge(['filename' => $email], $metadata);
		}
		return $emailsWithMetadata;
	}
	
	function sortEmails($emails, $sortBy = 'date', $sortOrder = SORT_DESC) {
		$sortArray = array();
		foreach ($emails as $key => $email) {
			$sortArray[$key] = $email[$sortBy];
		}
		array_multisort($sortArray, $sortOrder, $emails);
		return $emails;
	}
	
	// Handle email deletion if requested
	handleEmailDeletion(EML_FILE_PATH);
	
	// Get and sort emails
	$emails = getEmails(EML_FILE_PATH);
	$sortBy = $_GET['sort'] ?? 'date';
	$sortOrder = $_GET['order'] ?? SORT_DESC;
	$emails = sortEmails($emails, $sortBy, $sortOrder);

?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?? 'en'; ?>">
<head>
	<!-- Your existing head content -->
	<style>
      /* Your existing styles */
      .email-list {
          margin-top: 20px;
          margin-bottom: 60px; /* Add space for footer */
      }
      .email-item {
          background-color: #f8f9fa;
          border: 1px solid #dee2e6;
          border-radius: 5px;
          padding: 10px;
          margin-bottom: 10px;
          cursor: pointer;
      }
      .email-item:hover {
          background-color: #e9ecef;
      }
      .email-sender {
          font-weight: bold;
      }
      .email-subject {
          color: #495057;
      }
      .email-date {
          font-size: 0.9em;
          color: #6c757d;
      }
      .footer {
          position: fixed;
          bottom: 0;
          width: 100%;
          background-color: #0b162c;
          color: #ffffff;
          text-align: center;
          padding: 10px 0;
      }
	</style>
</head>
<body>
<div class="grid-container">
	<main class="main">
		<!-- Your existing server info section -->
		
		<!-- Email List Section -->
		<div class="container mt-5" style="width: 1440px!important;background-color: #f8f9fa;padding: 20px;border-radius: 5px;color:#000000">
			<h1 style="text-align: center;color: #000000"><?php echo $translations['email-list'] ?? 'Logged Messages'; ?></h1>
			
			<!-- Search and Sort Options -->
			<div class="mb-3">
				<input type="text" id="emailSearchInput" class="form-control" placeholder="Search emails...">
			</div>
			<div class="mb-3">
				<select id="emailSortSelect" class="form-select">
					<option value="date">Sort by Date</option>
					<option value="subject">Sort by Subject</option>
					<option value="from">Sort by Sender</option>
				</select>
			</div>
			
			<?php if (empty($emails)): ?>
				<div class="alert alert-info" style="color: #000000"><?php echo $translations['no-emails-found'] ?? 'No Emails Found'; ?></div>
			<?php else: ?>
				<div class="email-list">
					<?php foreach ($emails as $email): ?>
						<div class="email-item" data-email="<?= htmlspecialchars($email['filename']) ?>">
							<div class="email-sender"><?= htmlspecialchars($email['from']) ?></div>
							<div class="email-subject"><?= htmlspecialchars($email['subject']) ?></div>
							<div class="email-date"><?= date('Y-m-d H:i:s', $email['date']) ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		
		<!-- Email Modal -->
		<div class="modal fade" id="emailModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content modal-custom">
					<div class="modal-header">
						<h5 class="modal-title">Email Content</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</main>

<!-- Footer -->
<footer class="footer">
	<div class="footer__copyright">
		<?php echo $translations['default_footer'] ?? "&copy; " . date('Y') . " Tarek Tarabichi"; ?>
	</div>
	<div class="footer__signature">
		<?php echo $translations['made_with_love'] ?? "Made with <span style=\"color: #e25555;\">&hearts;</span> and powered by Laragon"; ?>
	</div>
</footer>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.email-item').click(function() {
            var email = $(this).data('email');
            $.ajax({
                url: 'assets/inbox/open_email.php',
                data: { email: email },
                success: function(data) {
                    $('#emailModal .modal-body').html(data);
                    var emailModal = new bootstrap.Modal(document.getElementById('emailModal'));
                    emailModal.show();
                }
            });
        });

        $('#emailSortSelect').change(function() {
            var sortBy = $(this).val();
            window.location.href = '?sort=' + sortBy;
        });

        $('#emailSearchInput').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('.email-item').each(function() {
                var text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(searchTerm) > -1);
            });
        });

        // Close modal when clicking outside
        $(document).on('click', function(event) {
            if ($(event.target).hasClass('modal')) {
                $('#emailModal').modal('hide');
            }
        });
    });
</script>
</body>
</html>

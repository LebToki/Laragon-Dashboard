<?php
        require_once __DIR__ . '/../../config.php';
	/**
	 * Application: Laragon | Server Index Inbox Page
	 * Description: This is the main index page for the Laragon server, displaying server info and applications.
	 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
	 * Contributors: LrkDev in v.2.3.3
	 * Version: 2.3.3
	 */
	
	// Set the directory path (modify as needed)
        const EML_FILE_PATH = SENDMAIL_OUTPUT_DIR;
	
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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $translations['email_list'] ?? 'Email Inbox'; ?> - Laragon Dashboard</title>
	
	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	
	<style>
		/* Custom scrollbar */
		* {
			scrollbar-width: thin;
			scrollbar-color: #6c757d #f8f9fa;
		}
		
		*::-webkit-scrollbar {
			width: 8px;
		}
		
		*::-webkit-scrollbar-track {
			background: #f8f9fa;
		}
		
		*::-webkit-scrollbar-thumb {
			background-color: #6c757d;
			border-radius: 4px;
		}
		
		/* Email specific styles */
		.email-card {
			transition: all 0.3s ease;
			border-left: 4px solid transparent;
		}
		
		.email-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(0,0,0,0.15);
			border-left-color: #0d6efd;
		}
		
		.email-card.unread {
			border-left-color: #dc3545;
			background-color: #fff5f5;
		}
		
		.email-sender-avatar {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: bold;
			font-size: 14px;
		}
		
		.email-preview {
			max-height: 60px;
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
		}
		
		.email-actions {
			opacity: 0;
			transition: opacity 0.3s ease;
		}
		
		.email-card:hover .email-actions {
			opacity: 1;
		}
		
		.stats-card {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border-radius: 15px;
		}
		
		.stats-card .card-body {
			padding: 1.5rem;
		}
		
		.search-container {
			background: white;
			border-radius: 15px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			padding: 1.5rem;
			margin-bottom: 2rem;
		}
		
		.email-modal .modal-content {
			border-radius: 15px;
			border: none;
			box-shadow: 0 10px 30px rgba(0,0,0,0.2);
		}
		
		.email-modal .modal-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border-radius: 15px 15px 0 0;
		}
		
		.email-content-body {
			background-color: #f8f9fa;
			border-radius: 10px;
			padding: 1.5rem;
			margin-top: 1rem;
		}
		
		.email-header-info {
			background-color: #e9ecef;
			border-radius: 10px;
			padding: 1rem;
			margin-bottom: 1rem;
		}
		
		.badge-unread {
			background-color: #dc3545;
		}
		
		.badge-read {
			background-color: #6c757d;
		}
		
		/* Responsive improvements */
		@media (max-width: 768px) {
			.email-sender-avatar {
				width: 35px;
				height: 35px;
				font-size: 12px;
			}
			
			.email-actions {
				opacity: 1;
			}
			
			.stats-card .card-body {
				padding: 1rem;
			}
		}
	</style>
</head>
<body class="bg-light">
	<div class="container-fluid py-4">
		<!-- Header Section -->
		<div class="row mb-4">
			<div class="col-12">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<strong><p class="h3 mb-1 text-dark"><?php echo $translations['email_list'] ?? 'Email Inbox'; ?></p></strong>
						<p class="text-muted mb-0">Manage your development server emails</p>
					</div>
					<div class="d-flex gap-2">
						<button class="btn btn-outline-primary" onclick="refreshEmails()">
							<i class="bi bi-arrow-clockwise"></i> Refresh
						</button>
						<button class="btn btn-outline-danger" onclick="deleteAllEmails()">
							<i class="bi bi-trash"></i> Clear All
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Statistics Cards -->
		<div class="row mb-4">
			<div class="col-md-3 col-sm-6 mb-3">
				<div class="card stats-card h-100">
					<div class="card-body text-center">
						<i class="bi bi-envelope-fill fs-1 mb-2"></i>
						<strong><p class="h4 mb-1"><?php echo count($emails); ?></p></strong>
						<p class="mb-0">Total Emails</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 mb-3">
				<div class="card stats-card h-100">
					<div class="card-body text-center">
						<i class="bi bi-envelope-open-fill fs-1 mb-2"></i>
						<strong><p class="h4 mb-1"><?php echo count(array_filter($emails, function($email) { return $email['date'] > (time() - 86400); })); ?></p></strong>
						<p class="mb-0">Today</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 mb-3">
				<div class="card stats-card h-100">
					<div class="card-body text-center">
						<i class="bi bi-calendar-week-fill fs-1 mb-2"></i>
						<strong><p class="h4 mb-1"><?php echo count(array_filter($emails, function($email) { return $email['date'] > (time() - 604800); })); ?></p></strong>
						<p class="mb-0">This Week</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 mb-3">
				<div class="card stats-card h-100">
					<div class="card-body text-center">
						<i class="bi bi-folder-fill fs-1 mb-2"></i>
						<strong><p class="h4 mb-1"><?php echo count(array_unique(array_column($emails, 'from'))); ?></p></strong>
						<p class="mb-0">Unique Senders</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Search and Filter Section -->
		<div class="search-container">
			<div class="row">
				<div class="col-md-8 mb-3">
					<div class="input-group">
						<span class="input-group-text"><i class="bi bi-search"></i></span>
						<input type="text" id="emailSearchInput" class="form-control" placeholder="Search emails by sender, subject, or content...">
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<div class="d-flex gap-2">
						<select id="emailSortSelect" class="form-select">
							<option value="date">Sort by Date</option>
							<option value="subject">Sort by Subject</option>
							<option value="from">Sort by Sender</option>
						</select>
						<button class="btn btn-outline-secondary" onclick="toggleView()">
							<i class="bi bi-list-ul" id="viewToggleIcon"></i>
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Email List -->
		<div class="row">
			<div class="col-12">
				<?php if (empty($emails)): ?>
					<div class="card">
						<div class="card-body text-center py-5">
							<i class="bi bi-inbox fs-1 text-muted mb-3"></i>
							<strong><p class="h5 text-muted"><?php echo $translations['no_emails_found'] ?? 'No Emails Found'; ?></p></strong>
							<p class="text-muted">Your inbox is empty. New emails will appear here when they arrive.</p>
						</div>
					</div>
				<?php else: ?>
					<div class="row" id="emailList">
						<?php foreach ($emails as $index => $email): ?>
							<div class="col-12 mb-3 email-item" data-email="<?= htmlspecialchars($email['filename']) ?>">
								<div class="card email-card h-100">
									<div class="card-body">
										<div class="row align-items-center">
											<div class="col-auto">
												<div class="email-sender-avatar">
													<?= strtoupper(substr($email['from'], 0, 1)) ?>
												</div>
											</div>
											<div class="col">
												<div class="d-flex justify-content-between align-items-start">
													<div class="flex-grow-1">
														<div class="d-flex align-items-center mb-1">
															<strong><p class="mb-0 me-2"><?= htmlspecialchars($email['from']) ?></p></strong>
															<span class="badge badge-unread">New</span>
														</div>
														<strong><p class="h6 mb-1 text-dark"><?= htmlspecialchars($email['subject']) ?></p></strong>
														<p class="text-muted small mb-0">
															<i class="bi bi-clock me-1"></i>
															<?= date('M j, Y g:i A', $email['date']) ?>
														</p>
													</div>
													<div class="email-actions">
														<div class="btn-group" role="group">
															<button class="btn btn-sm btn-outline-primary" onclick="viewEmail('<?= htmlspecialchars($email['filename']) ?>')">
																<i class="bi bi-eye"></i>
															</button>
															<button class="btn btn-sm btn-outline-danger" onclick="deleteEmail('<?= htmlspecialchars($email['filename']) ?>')">
																<i class="bi bi-trash"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Email Modal -->
	<div class="modal fade email-modal" id="emailModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<strong><p class="h5 mb-0">Email Details</p></strong>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="emailModalBody">
					<!-- Email content will be loaded here -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger" id="modalDeleteButton">Delete Email</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap 5 JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	
	<script>
		let currentEmail = null;
		let isListView = true;

		// View email function
		function viewEmail(email) {
			currentEmail = email;
			$.ajax({
				url: 'assets/inbox/open_email.php',
				data: { email: email },
				success: function(data) {
					$('#emailModalBody').html(data);
					var emailModal = new bootstrap.Modal(document.getElementById('emailModal'));
					emailModal.show();
				},
				error: function() {
					alert('Error loading email content');
				}
			});
		}

		// Delete email function
		function deleteEmail(email) {
			if (confirm('Are you sure you want to delete this email?')) {
				$.ajax({
					url: '<?php echo $_SERVER['PHP_SELF']; ?>',
					data: { delete: email },
					method: 'GET',
					success: function() {
						location.reload();
					},
					error: function() {
						alert('Error deleting email');
					}
				});
			}
		}

		// Delete all emails
		function deleteAllEmails() {
			if (confirm('Are you sure you want to delete ALL emails? This action cannot be undone.')) {
				<?php foreach ($emails as $email): ?>
					$.ajax({
						url: '<?php echo $_SERVER['PHP_SELF']; ?>',
						data: { delete: '<?= $email['filename'] ?>' },
						method: 'GET',
						async: false
					});
				<?php endforeach; ?>
				location.reload();
			}
		}

		// Refresh emails
		function refreshEmails() {
			location.reload();
		}

		// Toggle view
		function toggleView() {
			isListView = !isListView;
			const icon = document.getElementById('viewToggleIcon');
			if (isListView) {
				icon.className = 'bi bi-list-ul';
				// Switch to list view
			} else {
				icon.className = 'bi bi-grid-3x3-gap-fill';
				// Switch to grid view
			}
		}

		// Search functionality
		$('#emailSearchInput').on('input', function() {
			const searchTerm = $(this).val().toLowerCase();
			$('.email-item').each(function() {
				const text = $(this).text().toLowerCase();
				$(this).toggle(text.indexOf(searchTerm) > -1);
			});
		});

		// Sort functionality
		$('#emailSortSelect').change(function() {
			const sortBy = $(this).val();
			window.location.href = '?sort=' + sortBy;
		});

		// Modal delete button
		$('#modalDeleteButton').click(function() {
			if (currentEmail) {
				deleteEmail(currentEmail);
			}
		});

		// Click to view email
		$('.email-item').click(function(e) {
			if (!$(e.target).closest('.email-actions').length) {
				const email = $(this).data('email');
				viewEmail(email);
			}
		});

		// Keyboard shortcuts
		$(document).keydown(function(e) {
			if (e.key === 'Escape') {
				$('#emailModal').modal('hide');
			}
		});
	</script>
</body>
</html>

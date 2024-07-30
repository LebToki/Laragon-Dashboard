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
      .modal-custom {
          background-color: #ffffff;
          border-radius: 10px;
          padding: 20px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
      /*----------------------------------------*/
      /* ===== Scrollbar CSS ===== */
      /*----------------------------------------*/
      /* Firefox */
      * {
          scrollbar-width: auto;
          scrollbar-color: #ec1c7e #ffffff;
      }

      /* Chrome, Edge, and Safari */
      *::-webkit-scrollbar {
          width: 16px;
      }

      *::-webkit-scrollbar-track {
          background: #ffffff;
      }

      *::-webkit-scrollbar-thumb {
          background-color: #ec1c7e;
          border-radius: 10px;
          border: 3px solid #ffffff;
      }

      /*---------------------------*/
      /* Main Page Container Styling */
      /*---------------------------*/
      .grid-container {
          grid-area: main;
          background: url(assets/background2.jpg) no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
      }

      /*---------------------------*/
      /* Navigation Styling */
      /*---------------------------*/
      nav {
          grid-area: nav;
          align-items: start;
          justify-content: space-between;
          padding: 0 20px;
          background-color: #0B162C !important;
          color: #ffffff !important;
          font-family: "Poppins", Sans-serif, serif !important;
      }

      /*---------------------------*/
      /* Tabs Styling */
      /*---------------------------*/
      .tab {
          align-items: center;
          background-color: #0A66C2;
          border: 0;
          border-radius: 100px;
          box-sizing: border-box;
          color: #ffffff;
          cursor: pointer;
          display: inline-flex;
          font-family: "Poppins", Sans-serif, serif !important;
          font-size: 16px;
          font-weight: 600;
          justify-content: center;
          line-height: 20px;
          max-width: 480px;
          min-height: 40px;
          min-width: 0;
          overflow: hidden;
          padding: 0 20px;
          text-align: center;
          touch-action: manipulation;
          transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
          user-select: none;
          -webkit-user-select: none;
          vertical-align: middle;
      }

      .tab:hover,
      .tab:focus,
      {
          background-color: #16437E;
          color: #ffffff;

      }

      .tab:disabled {
          cursor: not-allowed;
          background: rgba(0, 0, 0, .08);
          color: rgba(0, 0, 0, .3);
      }

      .tab.active {
          background: #09223b;
          color: rgb(255, 255, 255, .7);
      }

      .tab-content {
          display: none;
      }

      .tab-content.active {
          display: block;
      }

      /*---------------------------*/
      /* Language Selector Styling */
      /*---------------------------*/
      select#language-selector {
          background-color: #fff;
          padding: 5px;
          border-radius: 25px;
          border: 1px solid #ccc;
      }

      .main-overview {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
          grid-auto-rows: 71px;
          grid-gap: 20px;
          margin: 10px;
      }


      .wrapper {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
          gap: 10px;
      }

      /*----------------------------------------*/
      /*-------OVERVIEW CARDS--------------*/
      /*----------------------------------------*/
      .overviewcard {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 15px;
          background-color: #00adef;
          font-family: "Rubik", Sans-serif, serif;
          border-radius: 5px 5px;
          font-size: 16px;
          color: #FFFFFF !important;
          line-height: 1;
          height: 31px;
      }

      .overviewcard_sites {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 15px;
          background-color: #023e8a;
          /*-----00adef    -----*/
          font-family: "Rubik", Sans-serif, serif;
          border-radius: 5px 5px;
          font-size: 16px;
          color: #FFFFFF !important;
          line-height: 1;
          height: 31px;
      }

      .overviewcard_info {
          font-family: "Rubik", Sans-serif, serif;
          text-transform: uppercase;
          font-size: 16px !important;
          color: #FFFFFF !important;
      }

      .overviewcard_icon {
          font-family: "Rubik", Sans-serif, serif;
          text-transform: uppercase;
          font-size: 16px !important;
          color: #FFFFFF !important;
      }


      .overviewcard4 {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 15px;
          background-color: #031A24;
          /*-----00adef    -----*/
          font-family: "Rubik", Sans-serif, serif;
          border-radius: 5px 5px;
          font-size: 16px;
          color: #FFFFFF !important;
          line-height: 1;
          height: 31px;
      }

      /*----------------------------------------*/
      /*------CARDS STYLING----------*/
      /*----------------------------------------*/
      .main-cards {
          column-count: 0;
          column-gap: 20px;
          margin: 20px;
      }

      .card {
          display: flex;
          flex-direction: column;
          align-items: center;
          width: 100%;
          background-color: #f1faee;
          margin-bottom: 20px;
          -webkit-column-break-inside: avoid;
          padding: 24px;
          box-sizing: border-box;
      }

      /* Force varying heights to simulate dynamic content */
      .card:first-child {
          height: 300px;
      }

      .card:nth-child(2) {
          height: 200px;
      }

      .card:nth-child(3) {
          height: 265px;
      }

      /*----------------------------------------*/
      /*Image Filter styles*/
      /*----------------------------------------*/
      .saturate {
          filter: saturate(3);
      }

      .grayscale {
          filter: grayscale(100%);
      }

      .contrast {
          filter: contrast(160%);
      }

      .brightness {
          filter: brightness(0.25);
      }

      .blur {
          filter: blur(3px);
      }

      .invert {
          filter: invert(100%);
      }

      .sepia {
          filter: sepia(100%);
      }

      .huerotate {
          filter: hue-rotate(180deg);
      }

      .rss.opacity {
          filter: opacity(50%);
      }

      /*----------------------------------------*/
      /*-- Sites Styling -----*/
      /*----------------------------------------*/
      .sites {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(275px, 1fr));
          grid-gap: 20px;
          margin: 20px;
      }

      .sites li {
          display: flex;
          flex-direction: column;
          align-items: center;
          width: 100%;
          background: #560bad;
          color: #ffffff;
          font-family: 'Rubik', sans-serif;
          font-size: 14px;
          text-align: left;
          text-transform: uppercase;
          margin-bottom: 20px;
          -webkit-column-break-inside: avoid;
          padding: 24px;
          box-sizing: border-box;
      }


      .sites li:hover {
          box-shadow: 0 0 15px 0 #bbb;
      }

      .sites li:hover svg {
          fill: #ffffff;
      }

      .sites li:hover a {
          color: #ffffff;
      }

      .sites li a {
          display: block;
          padding-left: 48px;
          color: #f2f2f2;
          transition: color 250ms ease-in-out;
      }

      .sites img {
          position: absolute;
          margin: 8px 8px 8px -40px;
          fill: #f2f2f2;
          transition: fill 250ms ease-in-out;
      }

      .sites svg {
          position: absolute;
          margin: 16px 16px 16px -40px;
          fill: #f2f2f2;
          transition: fill 250ms ease-in-out;
      }


      .modal-body {
          position: relative;
          flex: 1 1 auto;
          padding: var(--bs-modal-padding);
          --bs-modal-padding: 1.5rem;
          width: 100%;
          max-height: calc(100vh - 210px);
          overflow-y: auto;
          background-color: white;
          border-radius: 20px;
          border: 1px solid black;
      }

      .modal-content {
          position: relative;
          display: flex;
          flex-direction: column;
          width: 100%;
          color: black;
          pointer-events: auto;
          background-color: #ffffff;
          background-clip: padding-box;
          border: 1px solid rgba(0, 0, 0, 0.2);
          border-radius: 0.3rem;
          outline: 0;
      }

      /* Common Class */
      .pd-5 {padding: 5px;}
      .pd-10 {padding: 10px;}
      .pd-20 {padding: 20px;}
      .pd-30 {padding: 30px;}
      .pb-10 {padding-bottom: 10px;}
      .pb-20 {padding-bottom: 20px;}
      .pb-30 {padding-bottom: 30px;}
      .pt-10 {padding-top: 10px;}
      .pt-20 {padding-top: 20px;}
      .pt-30 {padding-top: 30px;}
      .pr-10 {padding-right: 10px;}
      .pr-20 {padding-right: 20px;}
      .pr-30 {padding-right: 30px;}
      .pl-10 {padding-left: 10px;}
      .pl-20 {padding-left: 20px;}
      .pl-30 {padding-left: 30px;}
      .px-30 {padding-left: 30px; padding-right: 30px;}
      .px-20 {padding-left: 20px; padding-right: 20px;}
      .py-30 {padding-top: 30px; padding-bottom: 30px;}
      .py-20 {padding-top: 20px; padding-bottom: 20px;}
      .mb-30 {margin-bottom: 30px;}
      .mb-50 {margin-bottom: 50px;}

      .font-30 {font-size: 30px; line-height: 1.46em;}
      .font-24 {font-size: 24px; line-height: 1.5em;}
      .font-20 {font-size: 20px; line-height: 1.5em;}
      .font-18 {font-size: 18px; line-height: 1.6em;}
      .font-16 {font-size: 16px; line-height: 1.75em;}
      .font-14 {font-size: 14px; line-height: 1.85em;}
      .font-12 {font-size: 12px; line-height: 2em;}

      .weight-300 {font-weight: 300;}
      .weight-400 {font-weight: 400;}
      .weight-500 {font-weight: 500;}
      .weight-600 {font-weight: 600;}
      .weight-700 {font-weight: 700;}
      .weight-800 {font-weight: 800;}

      .text-blue {color: #1b00ff;}
      .text-dark {color: #000000;}
      .text-white {color: #ffffff;}
      .height-100-p {height: 100%;}
      .bg-white {background: #ffffff;}
      .border-radius-10 {
          -webkit-border-radius: 10px;
          -moz-border-radius: 10px;
          border-radius: 10px;
      }
      .border-radius-100 {
          -webkit-border-radius: 100%;
          -moz-border-radius: 100%;
          border-radius: 100%;
      }
      .box-shadow {
          -webkit-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
          -moz-box-shadow 0px 0px 28px rgba(0, 0, 0, .08);
          box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
      }

      .gradient-style1 {
          background-image: linear-gradient(135deg, #43CBFF 10%, #9708CC 100%);
      }
      .gradient-style2 {
          background-image: linear-gradient(135deg, #72EDF2 10%, #5151E5 100%);
      }
      .gradient-style3 {
          background-image: radial-gradient(circle 732px at 96.2% 89.9%, rgba(70,66,159,1) 0%, rgba(187,43,107,1) 92%);
      }
      .gradient-style4 {
          background-image: linear-gradient(135deg, #FF9D6C 10%, #BB4E75 100%);
      }

      /* widget style 1 */
      .widget-style1 {padding: 20px 10px;}
      .widget-style1 .circle-icon {width: 60px;}
      .widget-style1 .circle-icon .icon {
          width: 60px;
          height: 60px;
          background: #ecf0f4;
          display: flex;
          align-items: center;
          justify-content: center;
      }
      .widget-style1 .widget-data {width: calc(100% - 150px);padding: 0 15px;}
      .widget-style1 .progress-data {width: 90px;}
      .widget-style1 .progress-data .apexcharts-canvas {margin: 0 auto;}

      .widget-style2 .widget-data {padding: 20px;}

      .widget-style3 {padding: 30px 20px;}
      .widget-style3 .widget-data {width: calc(100% - 60px);}
      .widget-style3 .widget-icon {
          width: 60px;
          font-size: 45px;
          line-height: 1;
      }

      a.email-link {
          color: black !important;
          text-decoration: none;
      }

      .bg-white.box-shadow.border-radius-10.height-100-p.widget-style1 {
          height: 140px !important;
          overflow-y: scroll;
      }
      .email-list {
          margin-top: 20px;
          margin-bottom: 60px;
      }
      .email-item {
          background-color: #f8f9fa;
          border: 1px solid #dee2e6;
          border-radius: 5px;
          padding: 10px;
          margin-bottom: 10px;
          cursor: pointer;
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
      .email-item:hover {
          background-color: #e9ecef;
      }
      .email-content {
          flex-grow: 1;
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
      .email-delete {
          margin-left: 10px;
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
      .btn-delete {
          background-color: #dc3545;
          color: white;
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
						<div class="email-item">
							<div class="email-content" data-email="<?= htmlspecialchars($email['filename']) ?>">
								<div class="email-sender"><?= htmlspecialchars($email['from']) ?></div>
								<div class="email-subject"><?= htmlspecialchars($email['subject']) ?></div>
								<div class="email-date"><?= date('Y-m-d H:i:s', $email['date']) ?></div>
							</div>
							<button class="btn btn-sm btn-danger email-delete" data-email="<?= htmlspecialchars($email['filename']) ?>">Delete</button>
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
						<button type="button" class="btn btn-delete" id="modalDeleteButton">Delete</button>
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
        let currentEmail;

        $('.email-content').click(function() {
            var email = $(this).data('email');
            currentEmail = email;
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

        $('.email-delete, #modalDeleteButton').click(function(e) {
            e.stopPropagation();
            var email = $(this).hasClass('email-delete') ? $(this).data('email') : currentEmail;
            if (confirm('Are you sure you want to delete this email?')) {
                $.ajax({
                    url: '<?php echo $_SERVER['PHP_SELF']; ?>',
                    data: { delete: email },
                    method: 'GET',
                    success: function() {
                        location.reload();
                    }
                });
            }
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

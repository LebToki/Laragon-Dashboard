<?php
	/**
	 * Application: Laragon | Server Index Inbox Page
	 * Description: This is the main index page for the Laragon server, displaying server info and applications.
	 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
	 * Contributors: LrkDev in v.2.1.2
	 * Version: 2.2.1
	 */
	
	// Set the directory path (modify as needed)
	const EML_FILE_PATH = 'D:/laragon/bin/sendmail/output/';
	
	// Function to handle email deletion
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
	
	// Function to get list of emails
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
		return array_filter($files, function ($file) {
			return preg_match('~^mail-\d{8}-\d{6}\.\d{3}\.txt$~', $file);
		});
	}
	
	// Function to sort emails by date
	function sortEmailsByDate($emails, $directory) {
		usort($emails, function ($a, $b) use ($directory) {
			return filemtime($directory . $b) - filemtime($directory . $a);
		});
		return $emails;
	}
	
	// Handle email deletion if requested
	handleEmailDeletion(EML_FILE_PATH);
	
	// Get and sort emails
	$emails = getEmails(EML_FILE_PATH);
	$emails = sortEmailsByDate($emails, EML_FILE_PATH);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inbox - My Development Server</title>
	<link href="https://fonts.googleapis.com/css?family=Pt+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/style.css">
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evSXBKJEiCTixQwlq2q77hXGdXgjEMeibR0OmCmYPgPQRwBmStN8T9Xk2tJlX0p"
				crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css" integrity="sha512-DJLNx+VLY4aEiEQFjiawXaiceujj5GA7lIY8CHCIGQCBPfsEG0nGz1edb4Jvw1LR7q031zS5PpPqFuPA8ihlRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css" integrity="sha512-i1b/nzkVo97VN5WbEtaPebBG8REvjWeqNclJ6AItj7msdVcaveKrlIIByDpvjk5nwHjXkIqGZscVxOrTb9tsMA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-reboot.min.css" integrity="sha512-HJaQ4y3YcUGCWikWDn8bFeGTy3Z/3IbxFYQ9G3UAWx16PyTL6Nu5P/BDDV9s0WhK3Sq27Wtbk/6IcwGmGSMXYg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
      .modal-body {
          position: relative;
          flex: 1 1 auto;
          padding: var(--bs-modal-padding);
          width: max-content;
          background-color: white;
          border-radius: 20px 20px 20px 20px;
          border: black;
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
          -moz-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
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
	</style>
</head>

<body>
<div class="grid-container">
	<div class="menu-icon">
		<i class="fas fa-bars header__menu"></i>
	</div>
	
	<header class="header">
		<div class="header__search">My Development Server Inbox</div>
		<div class="header__avatar">Welcome Back!</div>
	</header>
	
	<main class="main">
		<!-- Server Info Section -->
		<div class="main-overview">
			
			<div class="row">
				
				<div class="col-xl-3 mb-50">
					<div class="bg-white box-shadow border-radius-10 height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="circle-icon">
								<div class="icon border-radius-100 font-24 text-blue">
									<i class="fa fa-arrow-left" aria-hidden="true"></i>
								</div>
							</div>
							<div class="widget-data">
								<div class="weight-600 font-18">Go Back</div>
								<div class="weight-500">
									<a href="index.php" style="margin-top: 10px;color: #000;!important">
										Back to Home
									</a>
								</div>
							</div>
						
						</div>
					</div>
				</div>
				
				
				<div class="col-xl-3 mb-50">
					<div class="bg-white widget-style1 border-radius-10 height-100-p box-shadow">
						<div class="d-flex flex-wrap align-items-center">
							<div class="circle-icon">
								<div class="icon border-radius-100 font-24 text-blue">
									<i class="fa fa-directory" aria-hidden="true"></i>
								</div>
							</div>
							<div class="widget-data">
								<div class="weight-600 font-18">
									<?php echo "<small>Directory:<p style='color: #000;'> " . EML_FILE_PATH . "</p></small>"; ?>
								</div>
							</div>
						
						</div>
					</div>
				</div>
				
				
				<div class="col-xl-6 mb-50">
					<div class="bg-white box-shadow border-radius-10 height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="circle-icon">
								<div class="icon border-radius-100 font-24 text-blue"><i class="fa fa-dollar" aria-hidden="true"></i></div>
							</div>
							<div class="widget-data">
								<div class="weight-600 font-18" style="color: #000000!important;">
									<?php echo "<small><p style='color: #000;'>Logged Emails: " . count(getEmails(EML_FILE_PATH)) . "<br>" . implode(", ", getEmails(EML_FILE_PATH)) . "</p></small>"; ?>
								</div>
							
							</div>
						
						</div>
					</div>
				</div>
			
			</div>
			
			<!-- Email List Section -->
		</div>
		<br><br><br>
		<!-- Email List Section -->
		<div class="container mt-5" style="width: 1440px!important;background-color: #f8f9fa;padding: 20px;border-radius: 5px;color=#000000">
			<h1 style="text-align: center;color: #000000">Email List</h1>
			
			<?php if (empty($emails)): ?>
				<div class="alert alert-info" style="color: #000000">No emails found.</div>
			<?php else: ?>
				<ul class="list-group" style="color: #000000">
					<?php foreach ($emails as $email): ?>
						<li class="list-group-item d-flex justify-content-between align-items-center" style="color: #000000">
							<a href="#" class="email-link" style="color: #000000" data-email="<?= $email ?>"><?= $email ?></a>
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="d-inline">
								<input type="hidden" name="delete" value="<?= $email ?>">
								<button type="submit" class="btn btn-sm btn-danger">Delete</button>
							</form>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		
		<div class="modal fade" id="emailModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body"></div>
				</div>
			</div>
		</div>
	</main>
	
	<!-- FOOTER STARTS HERE -->
	<footer class="footer">
		<div class="footer__copyright">
			&copy; 2024 <?php echo htmlspecialchars(date('Y')); ?>, Tarek Tarabichi
		</div>
		<div class="footer__signature">
			Made with <span style="color: #e25555;">&hearts;</span> and powered by Laragon
		</div>
	</footer>
	<!--FOOTER END HERE -->

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.email-link').click(function(e) {
            e.preventDefault();
            var email = $(this).data('email');
            $.ajax({
                url: 'open_email.php',
                data: { email: email },
                success: function(data) {
                    $('#emailModal .modal-body').html(data);
                    $('#emailModal').modal('show');
                }
            });
        });
    });
</script>
</body>

</html>

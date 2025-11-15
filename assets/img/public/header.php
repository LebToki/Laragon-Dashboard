<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat with Ollama</title>
	<!-- Bootstrap 5.3.3 -->
	<link rel="stylesheet" href="/public/assets/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/public/assets/libs/bootstrap/css/bootstrap-utilities.min.css">
	<link rel="stylesheet" href="/public/assets/libs/bootstrap/css/bootstrap-grid.min.css">
	<!-- FontAwesome 6.5.2 -->
	<link rel="stylesheet" href="/public/assets/libs/font-awesome/css/all.min.css">
	<link rel="stylesheet" href="/public/assets/libs/font-awesome/css/brands.min.css">
	<link rel="stylesheet" href="/public/assets/libs/font-awesome/css/regular.min.css">
	<link rel="stylesheet" href="/public/assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">
			<img src="/public/assets/img/bot-avatar.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
			Chat with Ollama
		</a>
		<div class="d-flex align-items-center">
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" id="darkSwitch">
				<label class="form-check-label" for="darkSwitch">
					<i class="fas fa-moon"></i><i class="fas fa-sun"></i>
				</label>
			</div>
			<div class="dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="/public/assets/img/user-avatar.png" class="avatar" alt="User Avatar">
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Profile</a></li>
					<li><a class="dropdown-item" href="#">Settings</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<?php

?>

<nav class="navbar NavUp navbar-expand-lg sticky-top text-dark">
	<div class="container-fluid px-3 px-lg-5 py-2">
		<a class="navbar-brand" href="<?php echo App::get('root_uri'); ?>">
			<img src="<?php echo App::get('root_uri') . "/public/img/logo.png" ?>" class="d-inline-block align-text-center" alt="Tertib APP" width="35" height="35">
			Tertib APP</a>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a href="<?php echo App::get('root_uri'); ?>" class="nav-link ">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo App::get('root_uri') . "/stats"; ?>">Stats</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo App::get('root_uri') . "/about"; ?>">About</a>
				</li>
			</ul>

			<?php if (!Session::getInstance()->has('user')) :
			?>
				<a class="btn border-0 rounded-3 fs-6 my-auto bg-primary text-white" href="<?php echo App::get('root_uri') . "/auth/login" ?>" style="width:min(50%,155px);">
					Login
				</a>
			<?php else :
				$user = Session::getInstance()->get('user');
				$role = $user->getRole();
			?>
				<a class="btn border-0 rounded-3 fs-6 my-auto bg-primary text-w hite d-flex align-items-center justify-content-evenly" href="<?php echo App::get('root_uri') . "/" . $role . "/dashboard" ?>" style="width:min(50%,155px)">
					Dashboard
					<img src="<?= $user->getImageUrl() ?>" alt="" class="rounded-circle" style="width:30px;height:30px;">
				</a>
			<?php endif;
			?>
		</div>
	</div>
</nav>
<nav class="navbar NavUp navbar-expand-lg sticky-top text-dark">
	<div class="container-fluid px-5 py-2">
		<a class="navbar-brand" href="/">Tertib APP</a>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a href="<?php echo App::get('root_uri'); ?>" class="nav-link ">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo App::get('root_uri') . "/about"; ?>">About</a>
				</li>
			</ul>

			<?php if (!Session::getInstance()->has('user')) :
			?>
				<a class="btn border-0 rounded-3 fs-6 my-auto bg-primary text-white" href="<?php echo App::get('root_uri') . "/auth/login" ?>" style="width:min(50%,155px);">Login</a>
			<?php else :
			?>
				<a class="btn border-0 rounded-3 fs-6 my-auto bg-primary text-white" href="<?php echo App::get('root_uri') . "/admin/dashboard" ?>" style="width:min(50%,155px)">Dashboard</a>
			<?php endif;
			?>
		</div>
	</div>
</nav>
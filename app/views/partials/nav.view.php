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
				<a class="btn border-0 rounded-3 fs-6 my-auto bg-primary text-white" href="login" style="width:min(50%,155px);">Login</a>
			<?php else :
			?>
				<a class="btn border-0 rounded-3 fs-6 my-auto bg-primary text-white" href="dashboard" style="width:min(50%,155px)">Dashboard</a>
			<?php endif;
			?>
			<div class="d-flex ms-2 align-items-center dropdown color-modes">
				<button class="btn btn-link px-0 text-decoration-none dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
					<div class="my-1 me-2">
						<i class="bi theme-icon-active"></i>
					</div>
				</button>
				<ul class=" dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme" style="--bs-dropdown-min-width: 8rem;">
					<li>
						<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
							<div class="me-2 opacity-50">
								<i class="bi bi-sun-fill theme-icon " title="bi-sun-fill"></i>
							</div>
							Light
						</button>
					</li>
					<li>
						<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
							<div class="me-2 opacity-50">
								<i class="theme-icon bi bi-moon-stars-fill" title="bi-moon-stars-fill"></i>
							</div>
							Dark
						</button>
					</li>
					<li>
						<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
							<div class="me-2 opacity-50">
								<i class="bi bi-circle-half theme-icon" title="bi-circle-half"></i>
							</div>
							Auto
						</button>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
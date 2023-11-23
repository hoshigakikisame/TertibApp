<nav class="navbar navbar-expand-lg sticky-top bg-white">
	<div class="container-fluid px-5 py-2">
		<a class="navbar-brand" href="#">Tertib APP</a>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a href="<?php echo App::get('root_uri'); ?>" title="Home" class="nav-link active">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about">About</a>
				</li>
			</ul>
			<a class="btn border-0 rounded-3 fs-6 my-auto" href="login" style="width:min(50%,155px); background-color:var(--orange); color:var(--white);">Login</a>
		</div>
	</div>
</nav>
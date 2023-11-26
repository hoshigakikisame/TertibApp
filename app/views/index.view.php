<?php require 'partials/nav.view.php'; ?>


<main class=' overflow-hidden'>
	<div class="container">
		<!-- Start Hero Section -->
		<section class="row justify-content-between flex-grow-1 hero-section " style='height:88vh;'>
			<div class="col flex-column align-self-center slide-in-left" title='lefthero'>
				<h1 class="lh-1 display-1" style="font-family:Poppins Extra Bold;">WELCOME TO JTI.TERTIB</h1>
				<div class="d-flex gap-2" style="font-family:Poppins Medium; color:var(--orange-opa)">
					<h6>#JTIdisiplin</h6>
					<h6>#JTItertib</h6>
				</div>
				<p class="py-3" style="font-family:Poppins Medium;width:min(80vw,320px)">Laporkan Para Oknum Kampus yang
					Kurang Tertib dan Disiplin di <span style="color:var(--yellow);">Tertib</span> App</p>
				<!-- link Report Button -->
				<a href="report" class="py-2 px-5 rounded-3 link-underline link-underline-opacity-0" style="color:var(--white);font-family:Poppins Semi Bold; background:var(--btn-gradient);">Report ></a>
			</div>
			<div class="col d-none d-lg-block slide-in-right" title='righthero'>
				<div class="position-relative " style="height:40vh;">
					<div class="cirle rounded-circle position-absolute top-50 end-0 d-none d-lg-block" style='width: 463px;height: 463px;background: linear-gradient(180deg, #FCB216 6.77%, #F3542C 27.6%, rgba(255, 255, 255, 0.32) 65.62%);'></div>
					<img class="position-absolute top-50 end-0 d-none d-lg-block" src="<?php echo App::get("root_uri") . "/public/img/code of conduct image.png" ?>" alt="code of conduct image">
				</div>
			</div>
		</section>
		<!-- End Hero Section -->


		<!-- Start Tingkat Pelanggaran Section -->
		<section class="py-5" title="pelanggaran">
			<div class="container">
				<div class="col">
					<div class="row align-items-center text-center pb-5">
						<h2>Tingkat Pelanggaran</h2>
						<p>Kenali tingkat pelanggaran Mahasiswa</p>
					</div>
					<div class="row gap-5">
						<?php
						// color for border
						$color = array('dark-blue', 'red', 'grey', 'orange-opa', 'yellow');
						?>
						<div class="col">
							<div class="card border-0 align-items-center bg-transparent">
								<div class="card-emblem border border-2 rounded-circle p-2" style="height:100px;width:100px;border-color:var(--dark-blue) !important;"> <!--add color in var for changes color-->
									<h1 class="text-center rounded-circle p-4 p-md-3" style="background-color:var(--white-gray); filter:var(--drop-shadow)">I</h1> <!--for number -->
								</div>
								<div class="card-body text-center" style="width:min(80%,200px);">
									<h5 class="card-title">Pelanggaran Sangat Berat</h5> <!--for text -->
								</div>
							</div>
						</div>
					</div>
				</div>
		</section>
		<!-- End Tingkat Pelanggaran Section -->

		<!-- Start Table Tatib -->
		<section class="py-5" title='tatatertib'>
			<div class="container">
				<div class="col">
					<div class="row align-items-center justify-content-center text-center pb-5">
						<h2 style="width:min(80%,420px);">Klasifikasi Pelanggaran Tata Tertib Mahasiswa</h2>
					</div>
					<div class="row table-responsive">
						<table class="table table-bordered">
							<thead class="table-light">
								<tr>
									<th scope="col">No</th>
									<th scope="col">Pelanggaran</th>
									<th scope="col">Tingkat</th>
								</tr>
							</thead>
							<tbody>
								<tr>

									<th scope="row">1</th> <!--for number-->
									<td>Mark Lorem ipsum dolor sit.</td> <!--for text pelanggaran-->
									<td>Otto</td> <!--for Tingkat-->
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
		<!-- End Table Tatib -->

		<footer class="text-center p-2 bg-white" style="font-size: 12px;">
			<p>Copyright | Privacy Policy</p>
		</footer>
	</div>
</main>
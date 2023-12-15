<?php Helper::importView('partials/nav.view.php'); ?>
<main class="container">

	<div class="row text-center gap-4 justify-content-center">
		<h1>Violation Statistics</h1>
		<div class="col-10 justify-content-center">
			<p class="fw-semibold">Selamat datang di halaman statistik pelanggaran tahunan kami! Di sini, kami menyajikan rangkuman visual mengenai jumlah pelanggaran yang tercatat dalam setahun. Dengan memilah data berdasarkan bulan, anda dapat melihat pola-pola signifikan, tren, dan perbandingan banyaknya pelanggaran dari bulan ke bulan. Informasi ini tidak hanya memberikan gambaran umum tentang jumlah pelanggaran, tetapi juga dapat membantu dalam pengambilan keputusan terkait langkah meminimalisir pelanggaran di masa mendatang. Temukan wawasan berharga melalui tabel di bawah ini.</p>
		</div>

		<!-- Start Table Tatib -->
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr class="table-primary">
						<th scope="col" class="text-start">Tata Tertib</th>
						<th scope="col">Tahun</th>
						<?php for ($i = 1; $i <= 12; $i++) : ?>
							<th scope="col"><?= substr(DateTime::createFromFormat('!m', $i)->format('F'), 0, 3) ?></th>
						<?php endfor; ?>
						<th scope="col">Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php
					/**
					 * @var ViolationRecapModel[] $recaps
					 */
					foreach ($recaps as $recap) : ?>
						<tr>
							<td scope="row" class="text-start"><?= $recap->getCodeOfConductName() ?></td>
							<td scope="row"><?= $recap->getYear() ?></td>
							<td scope="row"><?= $recap->getTotalJanuary() ?></td>
							<td scope="row"><?= $recap->getTotalFebruary() ?></td>
							<td scope="row"><?= $recap->getTotalMarch() ?></td>
							<td scope="row"><?= $recap->getTotalApril() ?></td>
							<td scope="row"><?= $recap->getTotalMay() ?></td>
							<td scope="row"><?= $recap->getTotalJune() ?></td>
							<td scope="row"><?= $recap->getTotalJuly() ?></td>
							<td scope="row"><?= $recap->getTotalAugust() ?></td>
							<td scope="row"><?= $recap->getTotalSeptember() ?></td>
							<td scope="row"><?= $recap->getTotalOctober() ?></td>
							<td scope="row"><?= $recap->getTotalNovember() ?></td>
							<td scope="row"><?= $recap->getTotalDecember() ?></td>
							<td scope="row"><?= $recap->getTotal() ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<!-- End Table Tatib -->

		<div class="col-11 m-4">
			<p> Terima kasih telah mengunjungi halaman statistik pelanggaran kami. Kami berharap informasi yang disajikan di sini memberikan wawasan yang berharga tentang pelanggaran dalam setahun. Analisis data bulanan dapat menjadi panduan yang baik dalam pengambilan keputusan untuk meminimalisir pelanggaran di masa mendatang. Jika Anda memiliki pertanyaan atau memerlukan informasi tambahan, jangan ragu untuk menghubungi tim kami.</p>
		</div>
		<div class="row justify-content-center mb-9">
			<p></p>
		</div>
	</div>
	<footer class="text-center p-2 " style="font-size: 12px;">
		<p>Copyright | Privacy Policy</p>
	</footer>
</main>
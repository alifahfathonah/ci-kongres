<?php $this->load->view('front/layouts/header'); ?>
<div class="row">
	<div class="col">
		<div class="card border-white text-dark shadow mb-4 rounded">
			<div class="card-body text-center">
				<img class="d-block mx-auto lazyload" data-src="<?= base_url('asset/favicon.png') ?>" alt="" width="300" height="150">
				<?php
				if (date('H') >= 03 and date('H') <= 10) {
					echo '<h2>Selamat Pagi</h2>';
				} elseif (date('H') >= 11 and date('H') <= 15) {
					echo '<h2>Selamat Siang</h2>';
				} elseif (date('H') >= 16 and date('H') <= 17) {
					echo '<h2>Selamat Sore</h2>';
				} elseif (date('H') >= 18 or date('H') <= 02) {
					echo '<h2>Selamat Malam</h2>';
				} else {
					echo 'Jam tidak ditemukan';
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<?= $this->session->flashdata('message') ?>
	</div>
</div>
<div class="row">
	<div class="col">
		<h6>Menu</h6>
		<div class="card border-white shadow mb-4 rounded">
			<div class="card-body text-center">
				<div class="row">
					<div class="col-4 v-peserta">
						<i class="fa fa-users text-primary"></i><br>
						<small>Peserta</small>
					</div>
					<div class="col-4 v-galeri">
						<i class="fa fa-file-image-o text-warning"></i><br>
						<small>Galeri</small>
					</div>
					<div class="col-4 v-tor">
						<i class="fa fa-list-alt text-danger"></i><br>
						<small>TOR</small>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-4 v-registrasi">
						<i class="fa fa-file text-secondary"></i><br>
						<small>Registrasi</small>
					</div>
					<div class="col-4 v-kontak">
						<i class="fa fa-whatsapp text-success"></i><br>
						<small>Kontak</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<h6>Terbaru</h6>
		<div class="owl-carousel">
			<?php foreach ($galeris as $galeri) : ?>
				<div class="ml-2"><img class="lazyload" data-src="<?= base_url('upload/galeri/' . $galeri->foto_galeri) ?>" alt="" width="140" height="75"></div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php $this->load->view('front/layouts/footer'); ?>
<script>
	$(document).ready(function() {
		$(".owl-carousel").owlCarousel();
	});
</script>
</body>

</html>
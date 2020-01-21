<?php $this->load->view('front/layouts/header'); ?>
<div id="galeri-all" class="mt-2">
   <div class="row">
      <div class="col">
         <?php foreach ($galeris as $galeri) : ?>
            <div class="card shadow mb-4">
               <p class="card-header bg-white">
                  <a href="<?= base_url('upload/galeri/' . $galeri->foto_galeri) ?>" class="btn btn-sm btn-dark rounded-circle float-right single_image"><i class="fa fa-eye"></i></a>
               </p>
               <img class="card-img-top lazyload" data-src="<?= base_url('upload/galeri/' . $galeri->foto_galeri) ?>" alt="...">
               <div class="card-body">
                  <p class="card-text">
                     <i class="fa fa-commenting text-primary"></i>&nbsp;<span class="text-primary">Caption</span><br>
                     <?= $galeri->judul_galeri ?>
                  </p>
                  <p class="card-text">
                     <i class="fa fa-calendar text-primary"></i>&nbsp;<?= tanggal($galeri->tgl_galeri) . ', ' . $galeri->wkt_galeri ?> WITA
                  </p>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
</div>

<div class="row">
   <div class="col text-center">
      <button type="button" id="btn-load-galeri" class="btn btn-warning text-white" data-posisi="25"></button>
   </div>
</div>

<?php $this->load->view('front/layouts/footer'); ?>
<script>
   var posisi;
   $(document).ready(function() {
      $('#btn-load-galeri').click(function(e) {
         e.preventDefault();
         posisi = parseInt($(this).attr('data-posisi'));
         $.ajax({
            type: "GET",
            url: "<?= site_url('welcome/load_galeri/') ?>" + posisi,
            beforeSend: function() {
               $('#btn-load-galeri').html('<i class="fa fa-hourglass">&nbsp;Sedang Memuat..</i>');
            },
            success: function(response) {
               $('#btn-load-galeri').html('<i class="fa fa-history">&nbsp;Muat Lebih</i>');
               $('#galeri-all').append(response);
               $('#btn-load-galeri').attr('data-posisi', posisi + 25);
            }
         });
      });

      $("a.single_image").fancybox();
   });
</script>
</body>

</html>
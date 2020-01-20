<?php $this->load->view('front/layouts/header'); ?>
<div id="galeri-all">
   <div class="row">
      <div class="col">
         <?php foreach ($galeris as $galeri) : ?>
            <div class="card shadow mb-4">
               <img class="card-img-top lazyload" data-src="<?= base_url('upload/galeri/' . $galeri->foto_galeri) ?>" alt="...">
               <div class="card-body">
                  <p class="card-text"><strong><i class="fa fa-commenting"></i></strong><br><?= $galeri->judul_galeri ?></p>
                  <a href="#" class="card-link"><i class="fa fa-calendar"></i>&nbsp;<?= $galeri->tgl_galeri . ' / ' . $galeri->wkt_galeri ?></a>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
</div>

<div class="row pencarian">
   <div class="col text-center">
      <button type="button" id="btn-load-galeri" class="btn btn-warning text-white" data-posisi="2"></button>
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
               $('#btn-load-galeri').attr('data-posisi', posisi + 2);
            }
         });
      });
   });
</script>
</body>

</html>
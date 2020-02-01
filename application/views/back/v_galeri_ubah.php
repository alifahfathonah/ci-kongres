<?php $this->load->view('back/layouts/header'); ?>
<!-- bagian table data view -->
<div class="card shadow mb-5">
   <div class="card-body">
      <div class="row">
         <div class="col-6">
            <h3><i class="fa fa-file-image-o"></i> Ubah Data Galeri</h3>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <div class="row">
         <div class="col-4">
            <?php if ($galeri->tipe_galeri == 'foto') { ?>
               <img src="<?= base_url('upload/galeri/' . $galeri->foto_galeri) ?>" class="img-fluid" alt="">
            <?php } elseif ($galeri->tipe_galeri == 'video') { ?>
               <video src="<?= base_url('upload/galeri/' . $galeri->foto_galeri) ?>" width="100%" height="250" controls></video>
            <?php } ?>
         </div>
         <div class="col-8">
            <form action="<?= site_url('admin/galeri/update/' . $galeri->id_galeri) ?>" method="POST" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-9">
                     <div class="mb-3">
                        <label for="file">Foto</label>
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="foto" name="foto">
                           <label class="custom-file-label" for="file">File foto disini..</label>
                        </div>
                        <small class="text-muted pl-1">Ukuran Foto Otomatis Menjadi 640x640 Pixel</small>
                     </div>


                  </div>
                  <div class="col-3">
                     <label for="tipe">Tipe Galeri</label>
                     <select name="tipe" id="tipe" class="form-control">
                        <option value="foto" <?= ($galeri->tipe_galeri == 'foto') ? "selected" : "" ?>>Foto</option>
                        <option value="video" <?= ($galeri->tipe_galeri == 'video') ? "selected" : "" ?>>Video</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-3">
                     <label for="judul">Judul Galeri</label>
                     <textarea name="judul" id="judul" cols="30" class="form-control" placeholder="ex: Judul galeri"><?= $galeri->judul_galeri ?></textarea>
                  </div>
               </div>

               <button class="btn btn-primary" type="submit">
                  <i class="fa fa-save"></i> &nbsp; Simpan Perubahan
               </button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- bagian table data view -->

<?php $this->load->view('back/layouts/footer'); ?>
<script>
   $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
   });

   $(document).ready(function() {
      $('#judul').summernote();
   });
</script>
</body>

</html>
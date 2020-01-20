<?php $this->load->view('back/layouts/header'); ?>
<!-- bagian table data view -->
<div class="card shadow mb-5">
   <div class="card-body">
      <div class="row">
         <div class="col-6">
            <h3><i class="fa fa-file-image-o"></i> Tambah Data Galeri</h3>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <div class="row">
         <div class="col">
            <form action="<?= site_url('admin/galeri/create') ?>" method="POST" enctype="multipart/form-data">
               <div class="mb-3">
                  <label for="judul">Judul Galeri</label>
                  <input type="text" class="form-control" name="judul" id="judul" placeholder="ex: Judul galeri" value="<?= set_value('judul') ?>" autocomplete="0">
                  <?= form_error('judul', '<small class="text-danger pl-1">', '</small>') ?>
               </div>

               <div class="mb-3">
                  <label for="file">Foto</label>
                  <div class="custom-file">
                     <input type="file" class="custom-file-input" id="foto" name="foto" required>
                     <label class="custom-file-label" for="file">File foto disini..</label>
                  </div>
                  <small class="text-muted pl-1">Ukuran Foto Otomatis Menjadi 640x640 Pixel</small>
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
</script>
</body>

</html>
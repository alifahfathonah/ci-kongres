<?php $this->load->view('back/layouts/header'); ?>

<!-- bagian alert CRUD -->
<?= $this->session->flashdata('notif') ?>
<!-- bagian alert CRUD -->

<!-- bagian table input dan edit data -->
<div class="card shadow mb-5" id="form-korcab">
   <div class="card-body">
      <div class="row">
         <div class="col">
            <h3><i class="fa fa-list-alt"></i>&nbsp;Data T O R</h3>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <form action="<?= site_url('admin/tor/update/' . $tor->id_tor) ?>" method="POST" enctype="multipart/form-data">
         <div class="row">
            <div class="col-6">
               <div class="custom-file">
                  <input type="file" class="custom-file-input" id="file" name="file" required>
                  <label class="custom-file-label" for="file">Pilih file disini..</label>
               </div>
            </div>
            <div class="col-6">
               <ul class="list-group list-group-flush">
                  <li class="list-group-item">Nama File TOR : <span class="badge badge-primary"><?= $tor->file_tor ?></span> </li>
               </ul>
            </div>
         </div>
         <br>
         <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-save"></i>&nbsp;Simpan Perubahan
         </button>
      </form>
   </div>
</div>
<!-- bagian table input dan edit data -->

<?php $this->load->view('back/layouts/footer'); ?>
<script>
   $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
   });
</script>
</body>

</html>
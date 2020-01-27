<?php $this->load->view('front/layouts/header'); ?>
<div class="py-2 text-center">
   <h2>Form Registrasi</h2>
</div>
<hr>
<div class="row">
   <div class="col">
      <?= $this->session->flashdata('message') ?>
   </div>
</div>
<div class="row">
   <div class="col">
      <form action="<?= site_url('welcome/registrasi') ?>" method="POST" enctype="multipart/form-data">
         <div class="mb-3">
            <label for="delegasi">Delegasi</label>
            <select class="custom-select d-block w-100" name="delegasi" id="delegasi">
               <option value="">Pilih Delegasi...</option>
               <option value="korcab">Pengurus Koordinator Cabang</option>
               <option value="cabang">Pengurus Cabang</option>
            </select>
            <?= form_error('delegasi', '<small class="text-danger pl-1">', '</small>') ?>
         </div>

         <div class="mb-3">
            <label for="asal">Asal Delegasi</label>
            <input type="text" class="form-control" onfocus="loadDelegasi()" name="asal" id="asal" value="<?= set_value('asal') ?>">
            <?= form_error('asal', '<small class="text-danger pl-1">', '</small>') ?>
         </div>

         <div class="mb-3">
            <label for="nama">Nama Peserta</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="ex: panji sukma" value="<?= set_value('nama') ?>" autocomplete="0">
            <?= form_error('nama', '<small class="text-danger pl-1">', '</small>') ?>
         </div>

         <div class="mb-3">
            <label for="telp">No. Telp / WA</label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="ex: 08115544266" value="<?= set_value('telp') ?>">
            <?= form_error('telp', '<small class="text-danger pl-1">', '</small>') ?>
         </div>

         <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="you@example.com" value="<?= set_value('email') ?>">
            <?= form_error('email', '<small class="text-danger pl-1">', '</small>') ?>
         </div>

         <div class="mb-3">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="ex: Ketua Umum" value="<?= set_value('jabatan') ?>">
            <?= form_error('jabatan', '<small class="text-danger pl-1">', '</small>') ?>
         </div>

         <div class="mb-3">
            <label for="periode">Periode</label>
            <select class="custom-select d-block w-100" name="periode" id="periode">
               <option value="">Pilih Periode...</option>
               <?php for ($i = 2017; $i <= 2020; $i++) : ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
               <?php endfor; ?>
            </select>
            <?= form_error('periode', '<small class="text-danger pl-1">', '</small>') ?>
         </div>

         <div class="mb-3">
            <label for="file">Foto</label>
            <div class="custom-file">
               <input type="file" class="custom-file-input" id="foto" name="foto" required>
               <label class="custom-file-label" for="file">File foto disini..</label>
            </div>
            <small class="text-muted pl-1">Ukuran Foto Otomatis Menjadi 750x750 Pixel</small>
         </div>

         <button class="btn border-warning btn-lg btn-block text-warning" type="submit">
            <i class="fa fa-book"></i> &nbsp; KLIK UNTUK DAFTAR
         </button>
      </form>
   </div>
</div>

<?php $this->load->view('front/layouts/footer'); ?>

<script>
   $(document).ready(function() {
      $(".custom-file-input").on("change", function() {
         var fileName = $(this).val().split("\\").pop();
         $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

   });

   function loadDelegasi() {
      var method = $("#delegasi").val();

      if (method == "korcab") {
         $("#asal").attr("placeholder", "ex: Kalimantan Timur");
         url = "<?= site_url('welcome/autocomplete/korcab/') ?>";
      } else {
         $("#asal").attr("placeholder", "ex: Balikpapan");
         url = "<?= site_url('welcome/autocomplete/cabang/') ?>";
      }

      $("#asal").autocomplete({
         source: url
      });
   }
</script>
</body>

</html>
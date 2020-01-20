<?php $this->load->view('back/layouts/header'); ?>
<!-- bagian alert CRUD -->
<div class="alert alert-info alert-dismissible fade show" role="alert" style="display: none;">
   <strong>Selamat ! </strong> data cabang telah ditambahkan.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
   <strong>Selamat ! </strong> data cabang telah diubah.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
   <strong>Selamat ! </strong> data cabang telah dihapus.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<!-- bagian alert CRUD -->

<!-- bagian table data view -->
<div class="card shadow mb-5" id="master-cabang">
   <div class="card-body">
      <div class="row">
         <div class="col-6">
            <h3><i class="fa fa-map"></i> Data Cabang</h3>
         </div>
         <div class="col-6 text-right">
            <button type="button" id="btn-tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white"></i> Tambah Cabang</>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <table class="table table-sm table-bordered table-hover" id="datatable-cabang" width="100%" cellspacing="0">
         <thead class="bg-warning text-white">
            <tr class="text-center">
               <th width="25">#</th>
               <th>Nama Cabang</th>
               <th width="400">Nama Koord.Cabang</th>
               <th width="150">Aksi</th>
            </tr>
         </thead>
         <tbody></tbody>
      </table>
   </div>
</div>
<!-- bagian table data view -->

<!-- bagian table input dan edit data -->
<div class="card shadow mb-5" id="form-cabang" style="display: none;">
   <div class="card-body">
      <div class="row">
         <div class="col">
            <h3>
               <div id="title"></div>
            </h3>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <div class="row">
         <div class="col">
            <form id="form-cabang">
               <input type="hidden" name="id" id="id">
               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label for="nama">Nama Cabang</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="korcab">Koordinator Cabang</label>
                        <select name="korcab" id="korcab" class="form-control" required>
                           <option value="">-- Pilih koordinator cabang --</option>
                           <?php foreach ($korcabs as $korcab) : ?>
                              <option value="<?= $korcab->nama_korcab ?>"><?= $korcab->nama_korcab ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
               </div>
               <button type="submit" class="btn btn-sm btn-primary">
                  <i class="fa fa-save"></i>&nbsp;Simpan Perubahan
               </button>
               <button type="button" id="btn-batal" class="btn btn-sm btn-warning text-white">
                  <i class="fa fa-times"></i>&nbsp;Batal
               </button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- bagian table input dan edit data -->

<?php $this->load->view('back/layouts/footer'); ?>
<script>
   // init variabel
   var table, method;

   $(document).ready(function() {

      // konfigurasi DataTable
      table = $('#datatable-cabang').DataTable({
         "processing": true,
         "serverside": true,
         "ordering": false,
         "ajax": {
            "url": "<?= site_url('admin/cabang/data') ?>",
            "type": "GET"
         },
         "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json",
            "sEmptyTable": "Tidads"
         }
      });

      // form submit
      $('#form-cabang form').submit(function(e) {
         if (!e.isDefaultPrevented()) {

            // id inputan
            var id = $('#id').val();

            // menentukan method url
            if (method == "tambah") url = "<?= site_url('admin/cabang/insert') ?>";
            else url = "<?= site_url('admin/cabang/update/') ?>" + id;

            // request ajax
            $.ajax({
               type: "POST",
               url: url,
               data: {
                  id: $('#id').val(),
                  korcab: $('#korcab').val(),
                  nama: $('#nama').val(),
               },
               success: function(response) {
                  // tutup form
                  $('#form-cabang').hide();
                  $('#master-cabang').fadeIn();

                  // alert notif
                  if (method == "tambah") {
                     $('.alert-info').show();
                  } else {
                     $('.alert-success').show();
                  }

                  // reload table
                  table.ajax.reload();

                  // reset form
                  resetForm();
               },
               error: function() {
                  alert('gagal submit form');
               }
            });
            return false;
         }
      });

      // jika tombol tambah diklik
      $('#btn-tambah').click(function() {
         method = "tambah";
         $('#title').html('<i class="fa fa-map"></i>&nbsp;Tambah Cabang');
         resetForm();
         $('#form-cabang').fadeIn();
         $('#master-cabang').hide();

      });

      // jika tombol batal diklik
      $('#btn-batal').click(function() {
         $('#master-cabang').fadeIn();
         resetForm();
         $('#form-cabang').hide();
      });
   });

   // jika tombol ubah diklik
   function aksiUbah(id) {
      method = "ubah";
      $('#title').html('<i class="fa fa-map"></i>&nbsp;Ubah Cabang');
      $('#form-cabang').fadeIn();
      $('#master-cabang').hide();

      $.ajax({
         type: "GET",
         url: "<?= site_url('admin/cabang/edit/') ?>" + id,
         dataType: "JSON",
         success: function(data) {
            // setting form
            $('#id').val(data.id_cab);
            $('#korcab').val(data.korcab);
            $('#nama').val(data.nama_cab);
         },
         error: function() {
            alert('gagal aksiUbah');
         }
      });
   }

   // jika tombol hapus diklik
   function aksiHapus(id) {
      if (confirm("Apakah yakin ingin menghapus data koord.cabang ? ")) {
         $.ajax({
            type: "POST",
            url: "<?= site_url('admin/cabang/delete/') ?>" + id,
            success: function() {
               table.ajax.reload();
               $('.alert-danger').show();
            },
            error: function() {
               alert('gagal aksiHapus');
            }
         });
      }
   }

   function resetForm() {
      $('#id').val("");
      $('#nama').val("");
   }
</script>
</body>

</html>
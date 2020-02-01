<?php $this->load->view('back/layouts/header'); ?>
<!-- bagian alert CRUD -->
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
   <strong>Selamat ! </strong> data peserta telah dihapus.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<!-- bagian alert CRUD -->

<!-- bagian table data view -->
<div class="card shadow mb-5" id="master-peserta">
   <div class="card-body">
      <div class="row">
         <div class="col-6">
            <h3><i class="fa fa-users"></i> Data Peserta</h3>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <table class="table table-sm table-bordered table-hover" id="datatable-peserta" width="100%" cellspacing="0">
         <thead class="bg-warning text-white">
            <tr class="text-center">
               <th width="25">#</th>
               <th width="100">Foto</th>
               <th>Nama Peserta</th>
               <th width="70">Delegasi</th>
               <th width="180">Asal</th>
               <th width="150">Aksi</th>
            </tr>
         </thead>
         <tbody></tbody>
      </table>
   </div>
</div>
<!-- bagian table data view -->

<!-- bagian detail peserta -->
<div class="card shadow mb-5" id="detail-peserta" style="display: none;">
   <div class="card-body">
      <div class="row">
         <div class="col-6">
            <h3><i class="fa fa-users"></i> Detail Data Peserta</h3>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <div class="row no-gutters">
         <div class="col-md-4" id="foto"></div>
         <div class="col-md-8">
            <div class="card-body">
               <div class="row">
                  <div class="col">
                     <table class="table table-sm">
                        <tr>
                           <td width="25%">ID Peserta</td>
                           <td id="id"></td>
                        </tr>
                        <tr>
                           <td width="25%">Nama Peserta</td>
                           <td id="nama"></td>
                        </tr>
                        <tr>
                           <td width="25%">Delegasi</td>
                           <td id="delegasi"></td>
                        </tr>
                        <tr>
                           <td width="25%">Asal Delegasi</td>
                           <td id="asal"></td>
                        </tr>
                        <tr>
                           <td width="25%">Kontak</td>
                           <td id="telepon"></td>
                        </tr>
                        <tr>
                           <td width="25%">Email</td>
                           <td id="email"></td>
                        </tr>
                        <tr>
                           <td width="25%">Jabatan</td>
                           <td id="jabatan"></td>
                        </tr>
                        <tr>
                           <td width="25%">Periode</td>
                           <td id="periode"></td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col">
                     <button type="button" id="btn-batal" class="btn btn-sm btn-warning text-white">
                        <i class="fa fa-undo"></i>&nbsp;Kembali
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- bagian detail peserta -->

<?php $this->load->view('back/layouts/footer'); ?>
<script>
   // init variabel
   var table, method;

   $(document).ready(function() {

      // konfigurasi DataTable
      table = $('#datatable-peserta').DataTable({
         "processing": true,
         "serverside": true,
         "ordering": false,
         "ajax": {
            "url": "<?= site_url('admin/peserta/data') ?>",
            "type": "GET"
         },
         "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json",
            "sEmptyTable": "Tidads"
         }
      });

      // jika tombol batal diklik
      $('#btn-batal').click(function() {
         $('#master-peserta').fadeIn();
         $('#detail-peserta').hide();
      });
   });

   // jika tombol ubah diklik
   function aksiUbah(id) {
      $('#detail-peserta').fadeIn();
      $('#master-peserta').hide();

      $.ajax({
         type: "GET",
         url: "<?= site_url('admin/peserta/edit/') ?>" + id,
         dataType: "JSON",
         success: function(data) {
            // setting form
            $('#foto').html('<img class="lazyload card-img" data-src="<?= base_url('upload/peserta/') ?>' + data.foto + '">');
            $('#id').html(': <strong>' + data.id + '</strong>');
            $('#nama').html(': <strong>' + data.nama + '</strong>');
            $('#delegasi').html(': <strong>' + data.delegasi + '</strong>');
            $('#asal').html(': <strong>' + data.asal + '</strong>');
            $('#telepon').html(': <strong>' + data.telp + '</strong>');
            $('#email').html(': <strong>' + data.email + '</strong>');
            $('#jabatan').html(': <strong>' + data.jabatan + '</strong>');
            $('#periode').html(': <strong>' + data.periode + '</strong>');
         },
         error: function() {
            alert('gagal aksiUbah');
         }
      });
   }

   // jika tombol hapus diklik
   function aksiHapus(id) {
      if (confirm("Apakah yakin ingin menghapus data peserta ? ")) {
         $.ajax({
            type: "POST",
            url: "<?= site_url('admin/peserta/delete/') ?>" + id,
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
</script>
</body>

</html>
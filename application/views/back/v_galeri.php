<?php $this->load->view('back/layouts/header'); ?>

<?= $this->session->flashdata('message') ?>
<!-- bagian alert CRUD -->
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
   <strong>Selamat ! </strong> data peserta telah dihapus.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<!-- bagian alert CRUD -->

<!-- bagian table data view -->
<div class="card shadow mb-5">
   <div class="card-body">
      <div class="row">
         <div class="col-6">
            <h3><i class="fa fa-file-image-o"></i> Data Galeri</h3>
         </div>
         <div class="col-6 text-right">
            <a href="<?= site_url('admin/galeri/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white"></i> Tambah Galeri</a>
         </div>
      </div>
      <hr> <!-- garis lurus pemisah -->
      <table class="table table-sm table-bordered table-hover" id="datatable-galeri" width="100%" cellspacing="0">
         <thead class="bg-warning text-white">
            <tr class="text-center">
               <th width="25">#</th>
               <th width="100">Foto</th>
               <th>Judul Peserta</th>
               <th width="150">Tanggal/Waktu</th>
               <th width="140">Aksi</th>
            </tr>
         </thead>
         <tbody></tbody>
      </table>
   </div>
</div>
<!-- bagian table data view -->

<?php $this->load->view('back/layouts/footer'); ?>
<script>
   // init variabel
   var table;

   $(document).ready(function() {

      // konfigurasi DataTable
      table = $('#datatable-galeri').DataTable({
         "processing": true,
         "serverside": true,
         "ordering": false,
         "ajax": {
            "url": "<?= site_url('admin/galeri/data') ?>",
            "type": "GET"
         },
         "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json",
            "sEmptyTable": "Tidads"
         }
      });
   });

   // jika tombol hapus diklik
   function aksiHapus(id) {
      if (confirm("Apakah yakin ingin menghapus data peserta ? ")) {
         $.ajax({
            type: "POST",
            url: "<?= site_url('admin/galeri/delete/') ?>" + id,
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
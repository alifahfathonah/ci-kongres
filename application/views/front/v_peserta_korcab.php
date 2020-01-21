<?php $this->load->view('front/layouts/header'); ?>
<div class="input-group mb-3" style="display: none">
   <input type="text" class="form-control border-warning" placeholder="Nama Korcab Atau Cabang..">
   <div class="input-group-append">
      <button class="btn btn-warning text-white" type="submit">
         <i class="fa fa-search"></i> Cari
      </button>
   </div>
</div>
<ul class="nav justify-content-center nav-tabs">
   <li class="nav-item">
      <a class="nav-link v-peserta">
         <i class="fa fa-search"></i>&nbsp;Cari
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link active v-peserta-korcab">
         <i class="fa fa-map"></i>&nbsp;Korcab
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link v-peserta-cabang">
         <i class="fa fa-map-pin"></i>&nbsp;Cabang
      </a>
   </li>
</ul>
<div id="peserta" class="pencarian">
   <?php foreach ($delegasis as $delegasi) : ?>
      <div class="my-3 p-3 bg-white rounded shadow">
         <h6 class="border-bottom border-dark pb-2 mb-0"><?= $delegasi->nama_korcab ?></h6>
         <?php
         $asals = $this->peserta_model->get_join_korcab($delegasi->nama_korcab);
         foreach ($asals as $asal) : ?>
            <div class="media text-muted pt-3">
               <img class="bd-placeholder-img mr-2 rounded lazyload" width="65" height="65" data-src="<?= base_url('upload/peserta/' . $asal->foto) ?>">
               <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-dark">
                  <div class="d-flex justify-content-between align-items-center w-100">
                     <strong class="text-gray-dark"><?= $asal->nama ?></strong>
                     <button class="btn btn-sm btn-success" onclick="getDetail(<?= $asal->id ?>)"><i class="fa fa-eye"></i></button>
                  </div>
                  <span class="d-block"><?= $asal->jabatan ?></span>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   <?php endforeach; ?>
</div>

<div class="row pencarian">
   <div class="col text-center">
      <button type="button" id="btn-load-cabang" class="btn btn-primary" data-posisi="25"></button>
   </div>
</div>

<!-- bagian detail peserta -->
<div class="card shadow mb-5 mt-2" id="detail-peserta" style="display: none;">
   <div class=" row no-gutters">
      <div class="col-md-4" id="foto"></div>
      <div class="col-md-8">
         <div class="card-body">
            <div class="row">
               <div class="col">
                  <table class="table table-sm">
                     <tr>
                        <td width="25%">ID</td>
                        <td width="2%">:</td>
                        <td id="id"></td>
                     </tr>
                     <tr>
                        <td width="25%">Nama</td>
                        <td width="2%">:</td>
                        <td id="nama"></td>
                     </tr>
                     <tr>
                        <td width="25%">Delegasi</td>
                        <td width="2%">:</td>
                        <td id="delegasi-detail"></td>
                     </tr>
                     <tr>
                        <td width="25%">Asal</td>
                        <td width="2%">:</td>
                        <td id="asal-detail"></td>
                     </tr>
                     <tr>
                        <td width="25%">Kontak</td>
                        <td width="2%">:</td>
                        <td id="telepon"></td>
                     </tr>
                     <tr>
                        <td width="25%">Email</td>
                        <td width="2%">:</td>
                        <td id="email"></td>
                     </tr>
                     <tr>
                        <td width="25%">Jabatan</td>
                        <td width="2%">:</td>
                        <td id="jabatan"></td>
                     </tr>
                     <tr>
                        <td width="25%">Periode</td>
                        <td width="2%">:</td>
                        <td id="periode"></td>
                     </tr>
                  </table>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col text-right">
                  <button type="button" id="btn-batal" class="btn btn-sm btn-warning text-white">
                     <i class="fa fa-undo"></i>&nbsp;Kembali
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- bagian detail peserta -->

<?php $this->load->view('front/layouts/footer'); ?>
<script>
   var posisi;
   $(document).ready(function() {
      $('#btn-load-cabang').click(function(e) {
         e.preventDefault();
         posisi = parseInt($(this).attr('data-posisi'));
         $.ajax({
            type: "GET",
            url: "<?= site_url('welcome/load_korcab/') ?>" + posisi,
            beforeSend: function() {
               $('#btn-load-cabang').html('<i class="fa fa-hourglass">&nbsp;Sedang Memuat..</i>');
            },
            success: function(response) {
               $('#btn-load-cabang').html('<i class="fa fa-history">&nbsp;Muat Lebih</i>');
               $('#peserta').append(response);
               $('#btn-load-cabang').attr('data-posisi', posisi + 25);
            }
         });
      });

      // jika tombol batal diklik
      $('#btn-batal').click(function() {
         $('.pencarian').fadeIn();
         $('#detail-peserta').hide();
      });
   });

   function getDetail(id) {
      $('#detail-peserta').fadeIn();
      $('#result').hide();
      $('.pencarian').hide();

      $.ajax({
         type: "GET",
         url: "<?= site_url('welcome/detail_peserta/') ?>" + id,
         dataType: "JSON",
         success: function(data) {
            // setting form
            $('#foto').html('<img class="lazyload card-img" data-src="<?= base_url('upload/peserta/') ?>' + data.foto + '">');
            $('#id').html('<strong>' + data.id + '</strong>');
            $('#nama').html('<strong>' + data.nama + '</strong>');
            $('#delegasi-detail').html('<strong>' + data.delegasi + '</strong>');
            $('#asal-detail').html('<strong>' + data.asal + '</strong>');
            $('#telepon').html('<strong>' + data.telp + '</strong>');
            $('#email').html('<strong>' + data.email + '</strong>');
            $('#jabatan').html('<strong>' + data.jabatan + '</strong>');
            $('#periode').html('<strong>' + data.periode + '</strong>');
         },
         error: function() {
            alert('gagal getDetail');
         }
      });
   }
</script>
</body>

</html>
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
      <a class="nav-link active v-peserta">
         <i class="fa fa-search"></i>&nbsp;Cari
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link v-peserta-korcab">
         <i class="fa fa-map"></i>&nbsp;Korcab
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link v-peserta-cabang">
         <i class="fa fa-map-pin"></i>&nbsp;Cabang
      </a>
   </li>
</ul>
<div class="row mt-2 pencarian">
   <div class="col text-center">
      <h3>
         <span class="badge badge-warning text-white">
            Pencarian Peserta
         </span>
      </h3>
   </div>
</div>
<div class="row pencarian">
   <div class="col">
      <div class="mb-3">
         <label for="delegasi">Delegasi</label>
         <select class="custom-select d-block w-100" name="delegasi" id="delegasi">
            <option value="">Pilih Delegasi...</option>
            <option value="korcab">Pengurus Koordinator Cabang</option>
            <option value="cabang">Pengurus Cabang</option>
         </select>
      </div>

      <div class="mb-3">
         <label for="asal">Asal Delegasi</label>
         <input type="text" class="form-control" onfocus="loadDelegasi()" name="asal" id="asal">
      </div>
      <button onclick="getSearch()" class="btn bg-primary btn-lg btn-block text-white" type="button">
         <i class="fa fa-search"></i> &nbsp; Pencarian
      </button>
   </div>
</div>

<!-- hasil pencarian -->
<div class="row">
   <div class="col" id="result"></div>
</div>
<!-- hasil pencarian -->

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
      // jika tombol batal diklik
      $('#btn-batal').click(function() {
         $('.pencarian').fadeIn();
         $('#result').fadeIn();
         $('#detail-peserta').hide();
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

   function getSearch() {
      var method = $("#delegasi").val();

      if (method == "korcab") {
         url = "<?= site_url('welcome/search_korcab') ?>";
      } else {
         url = "<?= site_url('welcome/search_cabang') ?>";
      }

      // request ajax
      $.ajax({
         type: "POST",
         url: url,
         data: {
            asal: $('#asal').val(),
         },
         beforeSend: function() {
            $('#result').html('<i class="fa fa-hourglass">&nbsp;Sedang Memuat..</i>');
         },
         success: function(response) {
            $('#result').html(response);
            $("#delegasi").val('');
            $("#asal").val('');
            $('#asal').removeAttr('placeholder');
         },
         error: function() {
            alert('gagal getSearch');
         }
      });

      return false;
   }

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
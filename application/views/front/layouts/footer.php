</div>
<?php
$func = $this->uri->segment(2);
$param =  $this->uri->segment(3);
?>
<footer class="pt-2 pb-2 fixed-bottom shadow-lg bg-white">
   <div class="col">
      <nav class="nav nav-pills nav-fill">
         <a class="nav-item nav-link v-beranda <?php if ($func == '' and $param == '') echo 'active' ?>">
            <i class="fa fa-home"></i>
         </a>
         <a class="nav-item nav-link v-peserta <?php if ($func == 'index' and $param == 'peserta' or $param == 'peserta_cabang' or $param == 'peserta_korcab') echo 'active' ?>">
            <i class="fa fa-users"></i>
         </a>
         <a class="nav-item nav-link v-galeri <?php if ($func == 'index' and $param == 'galeri') echo 'active' ?>">
            <i class="fa fa-file-image-o"></i>
         </a>
         <a class="nav-item nav-link v-registrasi <?php if ($func == 'index' and $param == 'registrasi' or $func == 'registrasi') echo 'active' ?>">
            <i class="fa fa-file"></i>
         </a>
         <a class="nav-item nav-link v-tor <?php if ($func == 'index' and $param == 'tor') echo 'active' ?>">
            <i class="fa fa-list-alt"></i>
         </a>
      </nav>
      </small>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.0/lazysizes.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
   $(window).on("load", function() {
      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            $(".se-pre-con").fadeOut("slow");
            $('#btn-load-cabang').html('<i class="fa fa-history">&nbsp;Muat Lebih</i>');
            $('#btn-load-korcab').html('<i class="fa fa-history">&nbsp;Muat Lebih</i>');
            $('#btn-load-galeri').html('<i class="fa fa-history">&nbsp;Muat Lebih</i>');
            $('#btn-load-thumb').html('<i class="fa fa-history">&nbsp;Muat Lebih</i>');
         }
      });
   });

   // redirect ke halaman registrasi
   $('.v-beranda').click(function(e) {
      e.preventDefault();

      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.location.href = "<?= site_url('/') ?>";
            $(".se-pre-con").fadeOut("slow");
         }
      });

   });

   // redirect ke halaman registrasi
   $('.v-registrasi').click(function(e) {
      e.preventDefault();

      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.location.href = "<?= site_url('welcome/index/registrasi') ?>";
            $(".se-pre-con").fadeOut("slow");
         }
      });

   });

   // redirect ke halaman peserta
   $('.v-peserta').click(function(e) {
      e.preventDefault();

      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.location.href = "<?= site_url('welcome/index/peserta') ?>";
            $(".se-pre-con").fadeOut("slow");
         }
      });
   });

   // redirect ke halaman galeri
   $('.v-galeri').click(function(e) {
      e.preventDefault();

      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.location.href = "<?= site_url('welcome/index/galeri') ?>";
            $(".se-pre-con").fadeOut("slow");
         }
      });
   });

   $('.v-peserta-korcab').click(function(e) {
      e.preventDefault();

      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.location.href = "<?= site_url('welcome/index/peserta_korcab') ?>";
            $(".se-pre-con").fadeOut("slow");
         }
      });
   });

   $('.v-peserta-cabang').click(function(e) {
      e.preventDefault();

      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.location.href = "<?= site_url('welcome/index/peserta_cabang') ?>";
            $(".se-pre-con").fadeOut("slow");
         }
      });
   });

   // redirect ke halaman tor
   $('.v-tor').click(function(e) {
      e.preventDefault();
      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.location.href = "<?= site_url('welcome/index/tor') ?>";
            $(".se-pre-con").fadeOut("slow");
         }
      });
   });

   // redirect ke halaman peserta
   $('.v-kontak').click(function(e) {
      e.preventDefault();
      window.location.href = "https://api.whatsapp.com/send?phone=628115544266&text=Hallo%20Sahabat%20Irfan,%20Saya%20ada%20kendala%20dalam%20penggunaan%20aplikasi%20kongres";
   });

   function back() {
      $.ajax({
         type: "GET",
         beforeSend: function() {
            $(".se-pre-con").fadeIn("slow");
         },
         success: function(response) {
            window.history.back();
            $(".se-pre-con").fadeOut("slow");
         }
      });
   }
</script>
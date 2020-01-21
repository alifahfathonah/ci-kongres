<?php $this->load->view('front/layouts/header'); ?>
<div class="py-2 text-center">
   <h2>T O R</h2>
</div>
<hr>
<div class="badge badge-primary text-wrap" style="width: 6rem;">
   Catatan
</div>
<p class="text-muted text-justify">TOR dapat berubah sewaktu-waktu, menyesuaikan situasi dan kondisi berlangsungnya kongres</p>
<div class="row mt-5">
   <div class="col text-center">
      <button type="button" onclick="torDownload" class="btn btn-lg btn-outline-primary">
         <i class="fa fa-download"></i> &nbsp; Download Disini
      </button>
   </div>
</div>

<?php $this->load->view('front/layouts/footer'); ?>
<script>
   function torDownload() {
      $.ajax({
         type: "GET",
         url: "<?= base_url('upload/tor/' . $tor->file_tor) ?>",
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
</body>

</html>
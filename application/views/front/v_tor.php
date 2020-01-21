<?php $this->load->view('front/layouts/header'); ?>
<div class="py-2 text-center">
   <h2>T O R</h2>
</div>
<hr>
<div class="badge badge-danger text-wrap" style="width: 8 rem;">
   Catatan
</div>
<p class="text-muted text-justify">TOR dapat berubah sewaktu-waktu, menyesuaikan situasi dan kondisi berlangsungnya kongres</p>
<div class="row mt-5">
   <div class="col text-center">
      <a href="<?= base_url('upload/tor/' . $tor->file_tor) ?>" class="btn btn-lg btn-outline-primary">
         <i class="fa fa-download"></i> &nbsp; Download Disini
      </a>
   </div>
</div>

<?php $this->load->view('front/layouts/footer'); ?>
</body>

</html>
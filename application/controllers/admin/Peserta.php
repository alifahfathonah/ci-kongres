<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();

      // cek session login
      $session = $this->session->userdata('status');

      if (empty($session) or $session != 'login') {
         redirect(site_url('auth'));
      }
   }

   public function index()
   {
      $this->load->view('back/v_peserta');
   }

   /** 
    * function untuk ambil data dari table database, parsing lewat javascript
    */
   public function data()
   {
      $results    = $this->peserta_model->get_all();
      $data       = array();
      $no         = 1;

      foreach ($results as $list) {
         $row    = array();

         $row[]  = '<div class="text-center">' . $no++ . '</div>';
         $row[]  = '<div class="text-center">
                        <img class="lazyload" data-src="' . base_url('upload/peserta/') . $list->foto . '" width="72" height="72">
                  </div>';
         $row[]  = '<div class="text-center">' . $list->nama . '</div>';
         $row[]  = '<div class="text-center">' . $list->delegasi . '</div>';
         $row[]  = '<div class="text-center">' . $list->asal . '</div>';
         $row[]  = '
                  <div class="text-center">
                     <button onclick="aksiUbah(' . $list->id . ')"  class="btn btn-sm btn-success">
                        <i class="fa fa-eye"></i> Detail
                     </button>
                     <button onclick="aksiHapus(' . $list->id . ')"  class="btn btn-sm btn-danger">
                           <i class="fa fa-trash"></i> Hapus
                     </button>
                  </div>
         ';

         $data[] = $row;
      }

      $output = array("data" => $data);
      echo json_encode($output);
   }

   public function edit($id)
   {
      $edit = $this->peserta_model->get_id($id);
      echo json_encode($edit);
   }

   public function delete($id)
   {
      $this->peserta_model->go_delete($id);
   }
}

/* End of file Peserta.php */

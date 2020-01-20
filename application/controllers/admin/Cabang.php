<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
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
      $parsing['korcabs'] = $this->korcab_model->get_all();
      $this->load->view('back/v_cabang', $parsing);
   }

   /** 
    * function untuk ambil data dari table database, parsing lewat javascript
    */
   public function data()
   {
      $results    = $this->cabang_model->get_join();
      $data       = array();
      $no         = 1;

      foreach ($results as $list) {
         $row    = array();

         $row[]  = '<div class="text-center">' . $no++ . '</div>';
         $row[]  = '<div class="text-center">' . $list->nama_cab . '</div>';
         $row[]  = '<div class="text-center">' . $list->korcab . '</div>';
         $row[]  = '
                  <div class="text-center">
                        <button onclick="aksiUbah(' . $list->id_cab . ')"  class="btn btn-sm btn-success">
                           <i class="fa fa-edit"></i> Ubah
                        </button>
                     <button onclick="aksiHapus(' . $list->id_cab . ')"  class="btn btn-sm btn-danger">
                           <i class="fa fa-trash"></i> Hapus
                     </button>
                  </div>
         ';

         $data[] = $row;
      }

      $output = array("data" => $data);
      echo json_encode($output);
   }

   public function insert()
   {
      $this->cabang_model->go_insert();
   }

   public function edit($id)
   {
      $edit = $this->cabang_model->get_id($id);
      echo json_encode($edit);
   }

   public function update($id)
   {
      $this->cabang_model->go_update($id);
   }

   public function delete($id)
   {
      $this->cabang_model->go_delete($id);
   }
}

/* End of file Cabang.php */

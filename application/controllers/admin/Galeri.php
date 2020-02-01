<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Galeri extends CI_Controller
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
      $this->load->view('back/v_galeri');
   }

   public function create()
   {
      $this->form_validation->set_rules(
         'judul',
         'Judul Galeri',
         'required|trim',
         array(
            'required' => '%s harus diisi.'
         )
      );

      if ($this->form_validation->run() == FALSE) {
         $this->load->view('back/v_galeri_tambah');
      } else {
         $this->galeri_model->go_insert();
         $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Selamat, </strong> data galeri berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
         redirect(site_url('admin/galeri'));
      }
   }

   /** 
    * function untuk ambil data dari table database, parsing lewat javascript
    */
   public function data()
   {
      $results    = $this->galeri_model->get_all();
      $data       = array();
      $no         = 1;

      foreach ($results as $list) {
         $row    = array();

         $row[]  = '<div class="text-center">' . $no++ . '</div>';
         if ($list->tipe_galeri == 'foto') {
            $row[]  = '<div class="text-center">
                         <img class="lazyload" data-src="' . base_url('upload/galeri/') . $list->foto_galeri . '" width="72" height="72">
                   </div>';
         } elseif ($list->tipe_galeri == 'video') {
            $row[]  = '<div class="text-center">
                        <video width="80px" height="70px">
                           <source src="' . base_url('upload/galeri/') . $list->foto_galeri . '" type="video/mp4">
                        </video>
                   </div>';
         }
         $row[]  = '<div class="text-left">' . substr($list->judul_galeri, 0, 100) . '</div>';
         $row[]  = '<div class="text-center">' . $list->tgl_galeri . ' / ' . $list->wkt_galeri . '</div>';
         $row[]  = '
                   <div class="text-center">
                      <a href="' . site_url('admin/galeri/edit/') . $list->id_galeri . '"  class="btn btn-sm btn-success">
                         <i class="fa fa-edit"></i> Ubah
                      </a>
                      <button onclick="aksiHapus(' . $list->id_galeri . ')"  class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> Hapus
                      </button>
                   </div>
          ';

         $data[] = $row;
      }

      $output = array("data" => $data);
      echo json_encode($output);
   }

   public function edit($id_galeri)
   {
      $parsing['galeri'] = $this->galeri_model->get_id($id_galeri);
      $this->load->view('back/v_galeri_ubah', $parsing);
   }

   public function update($id_galeri)
   {
      $this->galeri_model->go_update($id_galeri);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Selamat, </strong> data galeri berhasil diperbaharui ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect(site_url('admin/galeri'));
   }

   public function delete($id_galeri)
   {
      // mengambil data terpilih dari database
      $row = $this->galeri_model->get_id($id_galeri);

      // menghapus gambar dari data yang terpilih
      unlink("./upload/galeri/$row->foto_galeri");

      // delete dari controller ke model untuk dieksekusi
      $this->galeri_model->go_delete($id_galeri);
   }
}

/* End of file Galeri.php */

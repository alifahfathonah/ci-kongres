<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tor extends CI_Controller
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
      $parsing['tor'] = $this->tor_model->get_id(1);
      $this->load->view('back/v_tor', $parsing);
   }

   public function update($id)
   {
      $this->tor_model->go_update($id);
      $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert""><strong>Selamat ! </strong> data TOR telah diperbarui.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect(site_url('admin/tor'));
   }
}

/* End of file Tor.php */

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
      $this->load->view('back/v_welcome');
   }
}

/* End of file Beranda.php */

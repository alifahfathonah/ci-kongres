<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

   public function index()
   {
      $this->load->view('back/v_login');
   }

   public function login()
   {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      if ($username == "mirf4npermana" && $password == "irfan020412") {

         $arr_sess = array(
            'status' => 'login'
         );

         $this->session->set_userdata($arr_sess);

         redirect(site_url('admin/beranda'));
      } else {
         redirect(site_url('auth'));
      }
   }

   public function logout()
   {
      $this->session->sess_destroy();
      redirect(site_url('auth'));
   }
}

/* End of file Auth.php */

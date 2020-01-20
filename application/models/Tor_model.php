<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tor_model extends CI_Model
{
   private $_table = 'tor';

   public function get_id($id)
   {
      return $this->db->get_where($this->_table, array('id_tor' => $id))->row();
   }

   public function go_update($id)
   {
      $data = array(
         'file_tor' => $this->_upload_file()
      );

      // menghapus file sebelumnya
      $cache = $this->tor_model->get_id($id);
      unlink("./upload/tor/$cache->file_tor");

      return $this->db->where('id_tor', $id)->update($this->_table, $data);
   }

   /**
    * function membuat upload image yang hanya dapat diakses di dalam class ini
    */
   private function _upload_file()
   {
      $config['upload_path']          = './upload/tor';
      $config['allowed_types']        = 'pdf|doc|docx';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('file')) {
         return $this->upload->data("file_name");
      }
   }
}

/* End of file Tor_model.php */

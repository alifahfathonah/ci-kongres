<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peserta_model extends CI_Model
{
   private $_table = 'peserta';

   public function get_all()
   {
      return $this->db->order_by('id', 'DESC')->get($this->_table)->result();
   }

   public function get_id($id)
   {
      return $this->db->get_where($this->_table, array('id' => $id))->row();
   }

   public function get_join_cabang($asal)
   {
      $this->db->select('*');
      $this->db->from($this->_table);
      $this->db->join('cabang', 'cabang.nama_cab = peserta.asal');
      $this->db->where('peserta.asal', $asal);
      return $this->db->get()->result();
   }

   public function get_join_korcab($asal)
   {
      $this->db->select('*');
      $this->db->from($this->_table);
      $this->db->join('korcab', 'korcab.nama_korcab = peserta.asal');
      $this->db->where('peserta.asal', $asal);
      return $this->db->get()->result();
   }

   public function go_insert()
   {
      $data = array(
         'id'        => rand(111111, 199999),
         'delegasi'  => ucwords($this->input->post('delegasi', true)),
         'asal'      => ucwords($this->input->post('asal', true)),
         'nama'      => ucwords($this->input->post('nama', true)),
         'telp'      => $this->input->post('telp', true),
         'email'     => $this->input->post('email', true),
         'jabatan'   => ucwords($this->input->post('jabatan', true)),
         'periode'   => $this->input->post('periode', true),
         'foto'      => $this->_upload_image()
      );

      return $this->db->insert($this->_table, $data);
   }

   public function go_delete($id)
   {
      $row = $this->peserta_model->get_id($id);
      unlink("./upload/peserta/$row->foto");
      return $this->db->delete($this->_table, array('id' => $id));
   }

   /**
    * function membuat upload image yang hanya dapat diakses di dalam class ini
    * dan terdapat fitur untuk compress ukuran pixel gambar
    */
   private function _upload_image()
   {
      $config['upload_path']          = './upload/peserta';
      $config['allowed_types']        = 'jpg|png|jpeg';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('foto')) {
         $gbr = $this->upload->data();

         // config compress image
         $config['image_library'] = 'gd2';
         $config['source_image'] = './upload/peserta/' . $gbr['file_name'];
         $config['create_thumb'] = FALSE;
         $config['maintain_ratio'] = FALSE;
         $config['quality'] = '100%';
         $config['width'] = 750;
         $config['height'] = 750;
         $config['new_image'] = './upload/peserta/' . $gbr['file_name'];

         // load library resize codeigniter
         $this->load->library('image_lib', $config);
         $this->image_lib->resize();

         return $this->upload->data("file_name");
      }
   }

   public function count_asal($asal)
   {
      return $this->db->get_where($this->_table, array('asal' => $asal))->num_rows();
   }
}

/* End of file Peserta_model.php */

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Galeri_model extends CI_Model
{
   private $_table = 'galeri';

   public function get_all()
   {
      $this->db->order_by('tgl_galeri', 'DESC');
      return $this->db->order_by('wkt_galeri', 'DESC')->get($this->_table)->result();
   }

   public function get_id($id)
   {
      return $this->db->get_where($this->_table, array('id_galeri' => $id))->row();
   }

   public function get_limit($limit)
   {
      $this->db->limit($limit);
      $this->db->order_by('tgl_galeri', 'DESC');
      return $this->db->order_by('wkt_galeri', 'DESC')->get($this->_table)->result();
   }

   public function get_load($posisi)
   {

      $this->db->order_by('tgl_galeri', 'DESC');
      return $this->db->order_by('wkt_galeri', 'DESC')->get($this->_table, 2, $posisi)->result();
   }

   public function go_insert()
   {
      $data = array(
         'judul_galeri' => ucfirst($this->input->post('judul', true)),
         'foto_galeri'  => $this->_upload_image(),
         'tgl_galeri'   => date('Y-m-d'),
         'wkt_galeri'   => date('H:i:s')
      );

      return $this->db->insert($this->_table, $data);
   }

   public function go_update($id)
   {
      $data_foto_ada = array(
         'judul_galeri' => ucfirst($this->input->post('judul', true)),
         'foto_galeri'  => $this->_upload_image()
      );

      $data_foto_kosong = array(
         'judul_galeri' => ucfirst($this->input->post('judul', true)),
      );

      // jika inputan post file gambar tidak kosong
      if (!empty($_FILES["foto"]["name"])) {
         // mengambil data terpilih dari database
         $row = $this->galeri_model->get_id($id);

         // menghapus gambar dari data yang terpilih
         unlink("./upload/galeri/$row->foto_galeri");

         $this->db->where('id_galeri', $id);
         return $this->db->update($this->_table, $data_foto_ada);
      }
      // jika inputan post file gambar kosong
      else {
         $this->db->where('id_galeri', $id);
         return $this->db->update($this->_table, $data_foto_kosong);
      }
   }

   public function go_delete($id)
   {
      return $this->db->delete($this->_table, array('id_galeri' => $id));
   }

   /**
    * function membuat upload image yang hanya dapat diakses di dalam class ini
    * dan terdapat fitur untuk compress ukuran pixel gambar
    */
   private function _upload_image()
   {
      $config['upload_path']          = './upload/galeri';
      $config['allowed_types']        = 'jpg|png|jpeg';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('foto')) {
         $gbr = $this->upload->data();

         // config compress image
         $config['image_library'] = 'gd2';
         $config['source_image'] = './upload/galeri/' . $gbr['file_name'];
         $config['create_thumb'] = FALSE;
         $config['maintain_ratio'] = FALSE;
         $config['quality'] = '100%';
         $config['new_image'] = './upload/galeri/' . $gbr['file_name'];

         // load library resize codeigniter
         $this->load->library('image_lib', $config);
         $this->image_lib->resize();

         return $this->upload->data("file_name");
      }
   }
}

/* End of file Galeri_model.php */

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cabang_model extends CI_Model
{
   private $_table = 'cabang';

   public function get_join()
   {
      return $this->db->order_by('id_cab', 'DESC')->get($this->_table)->result();
   }

   public function get_id($id)
   {
      return $this->db->get_where($this->_table, array('id_cab' => $id))->row();
   }

   public function get_limit()
   {
      $this->db->limit(2);
      return $this->db->order_by('id_cab', 'DESC')->get($this->_table)->result();
   }

   public function get_load($posisi)
   {
      return $this->db->order_by('id_cab', 'DESC')->get($this->_table, 2, $posisi)->result();
   }

   public function get_where($where)
   {
      return $this->db->limit(1)->get_where($this->_table, array('nama_cab' => $where))->row();
   }

   public function go_insert()
   {
      $data = array(
         'korcab'    => $this->input->post('korcab'),
         'nama_cab'  => ucwords($this->input->post('nama'))
      );

      return $this->db->insert($this->_table, $data);
   }

   public function go_update($id)
   {
      $data = array(
         'korcab'    => $this->input->post('korcab'),
         'nama_cab' => ucwords($this->input->post('nama'))
      );

      return $this->db->where('id_cab', $id)->update($this->_table, $data);
   }

   public function go_delete($id)
   {
      return $this->db->delete($this->_table, array('id_cab' => $id));
   }

   function get_autocomplete($title)
   {
      $this->db->like('nama_cab', $title, 'both');
      $this->db->order_by('nama_cab', 'ASC');
      $this->db->limit(5);
      return $this->db->get($this->_table)->result();
   }
}

/* End of file Cabang_model.php */

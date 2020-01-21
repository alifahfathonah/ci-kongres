<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Korcab_model extends CI_Model
{
   private $_table = 'korcab';

   public function get_all()
   {
      return $this->db->order_by('id_korcab', 'DESC')->get($this->_table)->result();
   }

   public function get_id($id)
   {
      return $this->db->get_where($this->_table, array('id_korcab' => $id))->row();
   }

   public function get_limit()
   {
      $this->db->limit(25);
      return $this->db->order_by('id_korcab', 'DESC')->get($this->_table)->result();
   }

   public function get_load($posisi)
   {
      return $this->db->order_by('id_korcab', 'DESC')->get($this->_table, 25, $posisi)->result();
   }

   public function get_where($where)
   {
      return $this->db->limit(1)->get_where($this->_table, array('nama_korcab' => $where))->row();
   }

   public function go_insert()
   {
      $data = array(
         'nama_korcab' => ucwords($this->input->post('nama'))
      );

      return $this->db->insert($this->_table, $data);
   }

   public function go_update($id)
   {
      $data = array(
         'nama_korcab' => ucwords($this->input->post('nama'))
      );

      return $this->db->where('id_korcab', $id)->update($this->_table, $data);
   }

   public function go_delete($id)
   {
      return $this->db->delete($this->_table, array('id_korcab' => $id));
   }

   function get_autocomplete($title)
   {
      $this->db->like('nama_korcab', $title, 'both');
      $this->db->order_by('nama_korcab', 'ASC');
      $this->db->limit(5);
      return $this->db->get($this->_table)->result();
   }
}

/* End of file Korcab_model.php */

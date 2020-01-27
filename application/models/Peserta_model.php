<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peserta_model extends CI_Model
{
   private $_table = 'peserta';

   public function get_all()
   {
      $this->db->where('aktif', 1);
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
      $this->db->where('peserta.aktif', 1);
      $this->db->where('peserta.asal', $asal);
      return $this->db->get()->result();
   }

   public function get_join_korcab($asal)
   {
      $this->db->select('*');
      $this->db->from($this->_table);
      $this->db->join('korcab', 'korcab.nama_korcab = peserta.asal');
      $this->db->where('peserta.aktif', 1);
      $this->db->where('peserta.asal', $asal);
      return $this->db->get()->result();
   }

   public function go_insert($data = array())
   {
      return $this->db->insert($this->_table, $data);
   }

   public function go_delete($id)
   {
      $row = $this->peserta_model->get_id($id);
      unlink("./upload/peserta/$row->foto");
      return $this->db->delete($this->_table, array('id' => $id));
   }

   public function count_asal($asal)
   {
      return $this->db->get_where($this->_table, array('asal' => $asal))->num_rows();
   }
}

/* End of file Peserta_model.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {

  public function getData() 
  {
    return $this->db->query('select * from siswa')->result_array();
  }

  public function getDataById($id)
  {
    return $this->db->get_where('siswa', ['id' => $id])->row_array();
  }

  public function insertData($data)
  {
    return $this->db->insert('siswa', $data);
  }

  public function updateData($id, $data)
  {
    return $this->db->where('id', $id)->update('siswa', $data);
  }

}
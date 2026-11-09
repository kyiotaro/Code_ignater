<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	public function getAll()
	{
		return $this->db->order_by('id', 'DESC')->get('barang')->result_array();
	}

	public function getById($id)
	{
		return $this->db->get_where('barang', ['id' => $id])->row_array();
	}

	public function insert($data)
	{
		return $this->db->insert('barang', $data);
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update('barang', $data);
	}

	public function updateStatus($id, $status)
	{
		return $this->db->where('id', $id)->update('barang', ['aktif' => $status]);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete('barang');
	}
}

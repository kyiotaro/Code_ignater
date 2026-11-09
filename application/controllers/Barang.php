<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Barang_model');
	}

	public function index()
	{
		$data['barang'] = $this->Barang_model->getAll();
		$data['pesan'] = $this->session->flashdata('pesan');
		$data['jenis_pesan'] = $this->session->flashdata('jenis_pesan');

		$this->load->view('Barang/index', $data);
	}

	public function tambah()
	{
		if ($this->input->method() === 'post') {
			$data = $this->getValidBarang();

			if ($data === FALSE) {
				$this->setPesan('Nama, kategori, dan harga harus diisi dengan benar.', 'error');
				redirect('Barang/tambah');
			}

			$this->Barang_model->insert($data);
			$this->setPesan('Barang berhasil ditambahkan.', 'success');
			redirect('Barang');
		}

		$this->load->view('Barang/form', [
			'judul' => 'Tambah Barang',
			'action' => 'Barang/tambah',
			'item' => ['nama' => '', 'kategori' => '', 'harga' => ''],
		]);
	}

	public function edit($id = NULL)
	{
		$id = (int) $id;
		$item = $this->Barang_model->getById($id);

		if (empty($item)) {
			$this->setPesan('Barang tidak ditemukan.', 'error');
			redirect('Barang');
		}

		if ($this->input->method() === 'post') {
			$data = $this->getValidBarang();

			if ($data === FALSE) {
				$this->setPesan('Nama, kategori, dan harga harus diisi dengan benar.', 'error');
				redirect('Barang/edit/' . $id);
			}

			$this->Barang_model->update($id, $data);
			$this->setPesan('Barang berhasil diperbarui.', 'success');
			redirect('Barang');
		}

		$this->load->view('Barang/form', [
			'judul' => 'Edit Barang',
			'action' => 'Barang/edit/' . $id,
			'item' => $item,
		]);
	}

	public function hapus($id = NULL)
	{
		if ($this->input->method() !== 'post') {
			show_404();
		}

		$id = (int) $id;
		if ($id < 1 || !$this->Barang_model->getById($id)) {
			$this->setPesan('Barang tidak ditemukan.', 'error');
			redirect('Barang');
		}

		$this->Barang_model->delete($id);
		$this->setPesan('Barang berhasil dihapus.', 'success');
		redirect('Barang');
	}

	public function ubah_status($id = NULL)
	{
		if ($this->input->method() !== 'post') {
			show_404();
		}

		$id = (int) $id;
		$status = $this->input->post('aktif');
		$item = $this->Barang_model->getById($id);

		if (empty($item) || !in_array($status, ['0', '1'], TRUE)) {
			$this->setPesan('Status barang tidak dapat diperbarui.', 'error');
			redirect('Barang');
		}

		$this->Barang_model->updateStatus($id, (int) $status);
		$pesan = $status === '1' ? 'Barang diaktifkan.' : 'Barang dinonaktifkan.';
		$this->setPesan($pesan, 'success');
		redirect('Barang');
	}

	private function getValidBarang()
	{
		$nama = trim($this->input->post('nama'));
		$kategori = trim($this->input->post('kategori'));
		$harga = $this->input->post('harga');

		if ($nama === '' || strlen($nama) > 100 || $kategori === '' || strlen($kategori) > 60
			|| !is_numeric($harga) || (float) $harga < 0 || (float) $harga > 999999999
			|| (float) $harga != (int) $harga) {
			return FALSE;
		}

		return [
			'nama' => $nama,
			'kategori' => $kategori,
			'harga' => (int) $harga,
		];
	}

	private function setPesan($pesan, $jenis)
	{
		$this->session->set_flashdata('pesan', $pesan);
		$this->session->set_flashdata('jenis_pesan', $jenis);
	}
}

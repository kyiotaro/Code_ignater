<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Beranda_model');
		$this->load->library('session');
	}

	public function index($nama = null, $umur = null)
	{
		$data['ambilData'] = $this->Beranda_model->getData();
    $data['nama'] = $nama;
    $data['umur'] = $umur;
		$data['pesan'] = $this->session->flashdata('pesan');

		$this->load->view('Beranda/index', $data);
	}

	public function tambah()
	{
		if ($this->input->method() !== 'post') {
			$this->load->view('Beranda/tambah');
			return;
		}

		$nama = trim($this->input->post('nama'));
		$umur = (int) $this->input->post('umur');

		if ($nama === '' || $umur < 1 || $umur > 120) {
			$this->session->set_flashdata('pesan', 'Nama dan umur harus diisi dengan benar.');
			redirect('Beranda');
		}

		$this->Beranda_model->insertData([
			'nama' => $nama,
			'umur' => $umur,
		]);

		$this->session->set_flashdata('pesan', 'Data siswa berhasil ditambahkan.');
		redirect('Beranda');
	}

	public function edit($id = null)
	{
		$id = (int) $id;
		$siswa = $this->Beranda_model->getDataById($id);

		if (empty($siswa)) {
			$this->session->set_flashdata('pesan', 'Data siswa tidak ditemukan.');
			redirect('Beranda');
		}

		if ($this->input->method() === 'post') {
			$nama = trim($this->input->post('nama'));
			$umur = (int) $this->input->post('umur');

			if ($nama === '' || $umur < 1 || $umur > 120) {
				$this->session->set_flashdata('pesan', 'Nama dan umur harus diisi dengan benar.');
				redirect('Beranda/edit/' . $id);
			}

			$this->Beranda_model->updateData($id, [
				'nama' => $nama,
				'umur' => $umur,
			]);

			$this->session->set_flashdata('pesan', 'Data siswa berhasil diperbarui.');
			redirect('Beranda');
		}

		$data['siswa'] = $siswa;
		$this->load->view('Beranda/edit', $data);
	}

	public function Kelas($jurasan = null, $semester = null)
	{
		$data['jurasan'] = $jurasan;
		$data['semester'] = $semester;

		$this->load->view('Beranda/kelas', $data);
	}

	public function alamat($kota = null, $provinsi = null)
	{
		$data['kota'] = $kota;
		$data['provinsi'] = $provinsi;

		$this->load->view('Beranda/alamat', $data);
	}
	
	public function Guru($nama = null, $mapel = null)
	{
		$data['nama'] = $nama;
		$data['mapel'] = $mapel;

		$this->load->view('Beranda/guru', $data);
	}

	public function hapus($id = null)
	{
		$sql_hapus = $this->db->query("DELETE FROM siswa WHERE id = $id");
		$this->session->set_flashdata('pesan', 'Data siswa berhasil dihapus.');
		redirect('Beranda');
	}
}
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangmasuk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// cek_login();

		$this->load->model('Admin_model', 'admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = "Barang Masuk";

		$id_user = $this->session->userdata('id_user');
		$currentRole = $this->admin->get_user_role_by_id($id_user);

		$data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

		$start_date = $this->input->get('start_date') ?? null;
		$end_date = $this->input->get('end_date') ?? null;

		$data['barangmasuk'] = $this->admin->getBarangMasuk(null, null, $start_date, $end_date);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('dashboard/barang_masuk/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// public function filter()
	// {
	// 	$this->load->model('Barang_masuk_model', 'BarangMasuk');

	// 	$barangMasuk = $this->BarangMasuk->filterBarangMasuk();
	// 	if (!$barangMasuk) {
	// 		$result = [
	// 			'status' => false,
	// 			'msg' => 'barang masuk kosong',
	// 		];
	// 	} else {
	// 		$result = [
	// 			'status' => true,
	// 			'data' => $barangMasuk
	// 		];
	// 	}
	// 	echo json_encode($result);
	// }


	private function _validasi()
	{
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
		// $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
		$this->form_validation->set_rules('barang_id', 'Sparepart', 'required');
		$this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
	}

	public function tambah()
	{
		error_reporting(0);
		$data['title'] = "Sparepart Masuk";

		$this->_validasi();
		if ($this->form_validation->run() == false) {
			// $data['supplier'] = $this->admin->get('supplier');
			$data['barang'] = $this->admin->get('barang');

			// Mendapatkan dan men-generate kode transaksi barang masuk
			$kode = 'T-SM-' . date('ymd');
			$kode_terakhir = $this->admin->getMax('barang_masuk', 'id_barang_masuk', $kode);

			if ($kode_terakhir === null) {
				$kode_tambah = 1;
			} else {
				$kode_tambah = (int) substr($kode_terakhir, -5, 5);
				$kode_tambah++;
			}

			$number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
			$data['id_barang_masuk'] = $kode . $number;

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('dashboard/barang_masuk/tambah', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$input = $this->input->post(null, true);

			// Fetch the selected barang's price from the database
			$barang = $this->admin->get('barang', ['id_barang' => $input['barang_id']]);
			if ($barang) {
				$total_harga = $barang['harga'] * $input['jumlah_masuk'];
				$input['total_harga'] = $total_harga;

				$insert = $this->admin->insert('barang_masuk', $input);

				if ($insert) {
					$this->session->set_flashdata('flash', 'Data berhasil di tambahkan!');
					redirect('Barangmasuk');
				} else {
					$this->session->set_flashdata('error', 'Opps ada kesalahan!');
					redirect('Barangmasuk/tambah');
				}
			} else {
				$this->session->set_flashdata('error', 'Barang tidak ditemukan!');
				redirect('Barangmasuk/tambah');
			}
		}
	}

	public function delete($getId)
	{
		$id = encode_php_tags($getId);
		if ($this->admin->delete('barang_masuk', 'id_barang_masuk', $id)) {
			$this->session->set_flashdata('flash', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus.', false);
		}
		redirect('Barangmasuk');
	}
}

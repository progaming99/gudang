<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aki_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        // $this->load->model('Aki_model');
        $this->load->model('Aki_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Aki Masuk";

        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->Aki_model->get_user_role_by_id($id_user);

        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

        $data['currentRole'] = $currentRole; // Tambahkan ini
        // Cek apakah ada filter tanggal yang dikirimkan
        $dateRange = $this->input->get('date_range');
        if (!empty($dateRange)) {
            // Jika ada filter tanggal, parse dan gunakan dalam query
            list($start_date, $end_date) = explode(' - ', $dateRange);
            $range = [
                'mulai' => date('Y-m-d', strtotime($start_date)),
                'akhir' => date('Y-m-d', strtotime($end_date)),
            ];
            $data['aki_masuk'] = $this->Aki_model->getAkiMasuk(null, null, $range);
        } else {
            // Jika tidak ada filter tanggal, muat data tanpa filter
        $data['aki_masuk'] = $this->Aki_model->getAkiMasuk(); // Menggunakan null untuk parameter lain jika tidak diperlukan
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/transaksi/aki/aki_masuk/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function filter()
    {
        // Metode ini akan menangani permintaan AJAX untuk filter tanggal
        // Anda dapat menggunakan kode yang sama dengan di atas untuk memfilter data
        // dan mengembalikan data yang difilter dalam format JSON
        $dateRange = $this->input->get('date_range');
        if (!empty($dateRange)) {
            list($start_date, $end_date) = explode(' - ', $dateRange);
            $range = [
                'mulai' => date('Y-m-d', strtotime($start_date)),
                'akhir' => date('Y-m-d', strtotime($end_date)),
            ];
            $filteredData = $this->Aki_model->getBarangMasuk(null, null, $range);
        } else {
            // Jika tidak ada filter, kembalikan semua data
            $filteredData = $this->Aki_model->getBarangMasuk();
        }

        // Kembalikan data dalam format JSON
        $jsonData = json_encode($filteredData);

        // Atur header Content-Type
        header('Content-Type: application/json');

        // Mengirimkan respons JSON
        echo $jsonData;
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        // $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('aki_id', 'Aki', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function tambah()
    {
        error_reporting(0);
        $data['title'] = "Aki Masuk";

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            // $data['supplier'] = $this->Aki_model->get('supplier');
            $data['aki'] = $this->Aki_model->get('aki');

            // Mendapatkan dan men-generate kode transaksi aki masuk
            $kode = 'T-AM-' . date('ymd');
            $kode_terakhir = $this->Aki_model->getMax('aki_masuk', 'id_aki_masuk', $kode);

            if ($kode_terakhir === null) {
                $kode_tambah = 1;
            } else {
                $kode_tambah = (int) substr($kode_terakhir, -5, 5);
                $kode_tambah++;
            }

            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_aki_masuk'] = $kode . $number;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/transaksi/aki/aki_masuk/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);

            // Fetch the selected aki's price from the database
            $aki = $this->Aki_model->get('aki', ['id_aki' => $input['aki_id']]);
            if ($aki) {
                $total_harga = $aki['harga'] * $input['jumlah_masuk'];
                $input['total_harga'] = $total_harga;
    
                $insert = $this->Aki_model->insert('aki_masuk', $input);
    
                if ($insert) {
                    $this->session->set_flashdata('flash', 'Data berhasil di tambahkan!');
                    redirect('aki_masuk');
                } else {
                    $this->session->set_flashdata('error', 'Opps ada kesalahan!');
                    redirect('aki_masuk/tambah');
                }
            } else {
                $this->session->set_flashdata('error', 'aki tidak ditemukan!');
                redirect('aki_masuk/tambah');
            }
        }
    }  

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->Aki_model->delete('aki_masuk', 'id_aki_masuk', $id)) {
            $this->session->set_flashdata('flash', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus.', false);
        }
        redirect('Aki_masuk');
    }
}
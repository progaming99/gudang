<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ban_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Ban Masuk";

        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->admin->get_user_role_by_id($id_user);

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
            $data['ban_masuk'] = $this->admin->getBanMasuk(null, null, $range);
        } else {
            // Jika tidak ada filter tanggal, muat data tanpa filter
        $data['ban_masuk'] = $this->admin->getBanMasuk(); // Menggunakan null untuk parameter lain jika tidak diperlukan
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/transaksi/ban/ban_masuk/index', $data);
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
            $filteredData = $this->admin->getBanMasuk(null, null, $range);
        } else {
            // Jika tidak ada filter, kembalikan semua data
            $filteredData = $this->admin->getBanMasuk();
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
        $this->form_validation->set_rules('ban_id', 'Ban', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function tambah()
    {
        // error_reporting(0);
        $data['title'] = "Ban Masuk";

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            // $data['supplier'] = $this->admin->get('supplier');
            $data['ban'] = $this->admin->get('ban');

            // Mendapatkan dan men-generate kode transaksi ban masuk
            $kode = 'T-BM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('ban_masuk', 'id_ban_masuk', $kode);

            if ($kode_terakhir === null) {
                $kode_tambah = 1;
            } else {
                $kode_tambah = (int) substr($kode_terakhir, -5, 5);
                $kode_tambah++;
            }

            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_ban_masuk'] = $kode . $number;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/transaksi/ban/ban_masuk/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);

            // Fetch the selected ban's price from the database
            $ban = $this->admin->get('ban', ['id_ban' => $input['ban_id']]);
            if ($ban) {
                $total_harga = $ban['harga'] * $input['jumlah_masuk'];
                $input['total_harga'] = $total_harga;
    
                $insert = $this->admin->insert('ban_masuk', $input);
             
                if ($insert) {
                    $this->session->set_flashdata('flash', 'Data berhasil di tambahkan!');
                    redirect('Ban_masuk');
                } else {
                    $this->session->set_flashdata('error', 'Opps ada kesalahan!');
                    redirect('Ban_masuk/tambah');
                }
            } else {
                $this->session->set_flashdata('error', 'Ban tidak ditemukan!');
                redirect('Ban_masuk/tambah');
            }
        }
    }  

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('ban_masuk', 'id_ban_masuk', $id)) {
            $this->session->set_flashdata('flash', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus.', false);
        }
        redirect('Ban_masuk');
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oli_keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Oli_model');
        $this->load->library('form_validation');
    }

    public function index()
    {        
        $data['title'] = "Oli keluar";
        
         // Cek peran pengguna saat ini
         $id_user = $this->session->userdata('id_user');
         $currentRole = $this->Oli_model->get_user_role_by_id($id_user);
 
         $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

         $data['currentRole'] = $currentRole; // Tambahkan ini
 
         $start_date = $this->input->get('start_date') ?? null;
         $end_date = $this->input->get('end_date') ?? null;

         $data['oli_keluar'] = $this->Oli_model->getOlikeluar(null, null, $start_date, $end_date);
 
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('dashboard/transaksi/oli/oli_keluar/index', $data);
         $this->load->view('templates/footer', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('oli_id', 'Oli', 'required');
    
        $input = $this->input->post('oli_id', true);

        // Pengecekan apakah $input adalah string sebelum menggunakan trim()
    if (isset($input) && is_string($input)) {
        $result = $this->Oli_model->get('oli', ['id_oli' => $input]);

        if ($result !== null && isset($result['stok'])) {
            $stok = $result['stok'];
            $stok_valid = $stok + 1;
    
            $this->form_validation->set_rules(
                'jumlah_keluar',
                'Jumlah Keluar',
                "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
                [
                    'less_than' => "Jumlah Keluar tidak boleh lebih dari {$stok}"
                ]
            );
        } else {
            // Tangani kasus di mana $result adalah null atau 'stok' tidak ada dalam $result
            // Anda bisa menampilkan pesan kesalahan atau mengambil tindakan lain sesuai kebutuhan
            $this->form_validation->set_rules('jumlah_keluar', 'Jumlah Keluar', 'required|trim|numeric|greater_than[0]');
        } 
    } else {
            // Tangani kasus di mana $input bukan string
            // Anda bisa menampilkan pesan kesalahan atau mengambil tindakan lain sesuai kebutuhan
            $this->form_validation->set_rules('jumlah_keluar', 'Jumlah Keluar', 'required|numeric|greater_than[0]');
        }
    }
    
    public function tambah()
    {
        $data['title'] = "Oli Keluar";
        error_reporting(0);
    
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['oli'] = $this->Oli_model->get('oli', null, ['stok >' => 0]);
            $data['armada'] = $this->Oli_model->get('armada');
    
            // Mendapatkan dan men-generate kode transaksi barang keluar
            $kode = 'T-OL-' . date('ymd');
            $kode_terakhir = $this->Oli_model->getMax('oli_keluar', 'id_oli_keluar', $kode);
    
            if ($kode_terakhir !== null) {
                $kode_tambah = substr($kode_terakhir, -5, 5);
                $kode_tambah++;
            } else {
                $kode_tambah = 1;
            }
    
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_oli_keluar'] = $kode . $number;
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/transaksi/oli/oli_keluar/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // Ambil data input
            $input = $this->input->post(null, true);
            
            // Insert data ke dalam tabel aki_keluar
            $insert = $this->Oli_model->insert('oli_keluar', $input);
    
            if ($insert) {
                $this->session->set_flashdata('flash', 'Data berhasil ditambahkan!');
                redirect('oli_keluar');
            } else {
                $this->session->set_flashdata('error', 'Oops, ada kesalahan!');
                redirect('oli_keluar/tambah');
            }
        }
    }
    

    public function delete($getId)
    {
          // Cek peran pengguna saat ini
          $id_user = $this->session->userdata('id_user');
          $currentRole = $this->Oli_model->get_user_role_by_id($id_user);

          if ($currentRole !== 'gudang') {
        $id = encode_php_tags($getId);
        if ($this->Oli_model->delete('oli_keluar', 'id_oli_keluar', $id)) {
            $this->session->set_flashdata('flash', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus.', false);
        }
    } else {
        $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk menghapus data.', false);
    }
        redirect('oli_keluar');
    }
}
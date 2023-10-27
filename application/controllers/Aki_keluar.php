<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aki_keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model');
        $this->load->library('form_validation');
    }

    public function index()
    {        
        $data['title'] = "Aki keluar";
        
         // Cek peran pengguna saat ini
         $id_user = $this->session->userdata('id_user');
         $currentRole = $this->Admin_model->get_user_role_by_id($id_user);
 
         $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

         $data['currentRole'] = $currentRole; // Tambahkan ini
 
         $data['aki_keluar'] = $this->Admin_model->getAkikeluar();
 
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('dashboard/transaksi/aki/aki_keluar/index', $data);
         $this->load->view('templates/footer', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('aki_id', 'Aki', 'required');
    
        $input = $this->input->post('aki_id', true);

        // Pengecekan apakah $input adalah string sebelum menggunakan trim()
    if (isset($input) && is_string($input)) {
        $result = $this->Admin_model->get('aki', ['id_aki' => $input]);

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
        $data['title'] = "Aki Keluar";
        // error_reporting(0);
    
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['aki'] = $this->Admin_model->get('aki', null, ['stok >' => 0]);
            $data['armada'] = $this->Admin_model->get('armada');
            $data['supir'] = $this->Admin_model->get('supir');
            $data['montir'] = $this->Admin_model->get('montir');
    
            // Mendapatkan dan men-generate kode transaksi barang keluar
            $kode = 'T-AK-' . date('ymd');
            $kode_terakhir = $this->Admin_model->getMax('aki_keluar', 'id_aki_keluar', $kode);
    
            if ($kode_terakhir !== null) {
                $kode_tambah = substr($kode_terakhir, -5, 5);
                $kode_tambah++;
            } else {
                $kode_tambah = 1;
            }
    
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_aki_keluar'] = $kode . $number;
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/transaksi/aki/aki_keluar/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // Ambil data input
            $input = $this->input->post(null, true);
    
            // Menghitung lama pemakaian
            $tgl_pasang_baru = strtotime($input['tgl_pasang_baru']);
            $tgl_pasang_lama = strtotime($input['tgl_pasang_lama']);
            $lama_pemakaian_detik = $tgl_pasang_lama - $tgl_pasang_baru;
            $lama_pemakaian_hari = floor($lama_pemakaian_detik / (60 * 60 * 24)); // Pembulatan ke bawah
            $input['lama_pemakaian_hari'] = $lama_pemakaian_hari;
    
            // Menambahkan lama pemakaian ke dalam data input
            $lama_pemakaian_tahun = $lama_pemakaian_hari / 365; //anggap 1 tahun = 365 haari
            $input['lama_pemakaian_tahun'] = $lama_pemakaian_tahun;
    
            // Menambahkan kolom nomor_armada, nama_supir, masalah, dan keterangan ke dalam data input
            // $input['nama_armada'] = $this->input->post('nama_armada');
            // $input['nama_supir'] = $this->input->post('nama_supir');
            // $input['masalah'] = $this->input->post('masalah');
            // $input['keterangan'] = $this->input->post('keterangan');
    
            // Insert data ke dalam tabel aki_keluar
            $insert = $this->Admin_model->insert('aki_keluar', $input);
    
            if ($insert) {
                $this->session->set_flashdata('flash', 'Data berhasil ditambahkan!');
                redirect('aki_keluar');
            } else {
                $this->session->set_flashdata('error', 'Oops, ada kesalahan!');
                redirect('aki_keluar/tambah');
            }
        }
    }
    

    public function delete($getId)
    {
          // Cek peran pengguna saat ini
          $id_user = $this->session->userdata('id_user');
          $currentRole = $this->Admin_model->get_user_role_by_id($id_user);

          if ($currentRole !== 'gudang') {
        $id = encode_php_tags($getId);
        if ($this->Admin_model->delete('aki_keluar', 'id_aki_keluar', $id)) {
            $this->session->set_flashdata('flash', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus.', false);
        }
    } else {
        $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk menghapus data.', false);
    }
        redirect('Aki_keluar');
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ban_keluar extends CI_Controller
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
        $data['title'] = "Ban keluar";
        
         // Cek peran pengguna saat ini
         $id_user = $this->session->userdata('id_user');
         $currentRole = $this->Admin_model->get_user_role_by_id($id_user);
 
         $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

         $data['currentRole'] = $currentRole; // Tambahkan ini
 
        //  var_dump(  $data['ban_keluar'] = $this->Admin_model->getBanKeluar());
        //  die;
         $data['ban_keluar'] = $this->Admin_model->getBanKeluar();
 
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('dashboard/transaksi/ban/ban_keluar/index', $data);
         $this->load->view('templates/footer', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('ban_id', 'Ban', 'required');
    
        $input = $this->input->post('ban_id', true);

        // Pengecekan apakah $input adalah string sebelum menggunakan trim()
    if (isset($input) && is_string($input)) {
        $result = $this->Admin_model->get('ban', ['id_ban' => $input]);

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
        $data['title'] = "Ban Keluar";
        // error_reporting(0);

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['ban'] = $this->Admin_model->get('ban', null, ['stok >' => 0]);
            $data['armada'] = $this->Admin_model->get('armada');
            $data['supir'] = $this->Admin_model->get('supir');
            $data['montir'] = $this->Admin_model->get('montir');

            // Mendapatkan dan men-generate kode transaksi ban keluar
            $kode = 'T-BK-' . date('ymd');
            $kode_terakhir = $this->Admin_model->getMax('ban_keluar', 'id_ban_keluar', $kode);
           
            // $kode_tambah = substr($kode_terakhir, -5, 5);
            // $kode_tambah++;
            if ($kode_terakhir !== null) {
                $kode_tambah = substr($kode_terakhir, -5, 5);
                $kode_tambah++;
            } else {
                $kode_tambah = 1;
            }

            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_ban_keluar'] = $kode . $number;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/transaksi/ban/ban_keluar/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->Admin_model->insert('ban_keluar', $input);

            if ($insert) {
                $this->session->set_flashdata('flash', 'Data berhasil di tambahkan!');
                redirect('Ban_keluar');
            } else {
                $this->session->set_flashdata('error', 'Opps ada kesalahan!');
                redirect('Ban_keluar/tambah');
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
        if ($this->Admin_model->delete('ban_keluar', 'id_ban_keluar', $id)) {
            $this->session->set_flashdata('flash', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus.', false);
        }
    } else {
        $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk menghapus data.', false);
    }
        redirect('Ban_keluar');
    }
}
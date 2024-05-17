<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";

        $data['total_sparepart'] = $this->admin->totalSparepart();
        $data['total_aki'] = $this->admin->totalAki();
        $data['total_ban'] = $this->admin->totalBan();
        $data['total_oli'] = $this->admin->totalOli();
        $data['barang'] = $this->admin->count('barang');
        $data['stok'] = $this->admin->sum('barang', 'stok');
        $data['ban'] = $this->admin->sum('ban', 'stok');
        $data['aki'] = $this->admin->sum('aki', 'stok');
        $data['oli'] = $this->admin->sum('oli', 'stok');
        // $data['total'] = $this->admin->sum('barang', 'stok');
        $data['barang_masuk'] = $this->admin->count('barang_masuk');
        $data['barang_keluar'] = $this->admin->count('barang_keluar');
        $data['supplier'] = $this->admin->count('supplier');
        $data['user'] = $this->admin->count('user');
        $data['barang_min'] = $this->admin->min('barang', 'stok', 10);
        $data['transaksi'] = [
            'barang_masuk' => $this->admin->getBarangMasuk(5),
            'barang_keluar' => $this->admin->getBarangKeluar(5)
        ];        

        // Line Chart
        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $data['cbm'] = [];
        $data['cbk'] = [];

        foreach ($bln as $b) {
            $data['cbm'][] = $this->admin->chartBarangMasuk($b);
            $data['cbk'][] = $this->admin->chartBarangKeluar($b);
        }

        $total_pengeluaran = $this->admin->sum('barang_masuk', 'total_harga');
        $data['jumlah_pengeluaran'] = $total_pengeluaran;

        // Hitung total harga dari tabel aki, ban, dan barang
        $this->load->database();
        $query_aki = $this->db->query('SELECT SUM(harga * stok) as total_aki FROM aki');
        $result_aki = $query_aki->row();
        $query_ban = $this->db->query('SELECT SUM(harga * stok) as total_ban FROM ban');
        $result_ban = $query_ban->row();
        $query_barang = $this->db->query('SELECT SUM(harga * stok) as total_barang FROM barang');
        $result_barang = $query_barang->row();
        $query_oli = $this->db->query('SELECT SUM(harga * stok) as total_oli FROM oli');
        $result_oli = $query_oli->row();
        $total_harga = $result_aki->total_aki + $result_ban->total_ban + $result_barang->total_barang + $result_oli->total_oli;
        $data['total_harga'] = $total_harga;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
        Akses telah dirubah !! </div>');
    }
}
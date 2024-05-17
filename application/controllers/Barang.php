<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
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
        $data['title'] = "Barang";

        // Cek peran pengguna saat ini
        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->admin->get_user_role_by_id($id_user);

        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

        $data['currentRole'] = $currentRole; // Tambahkan ini
         
        $data['barang'] = $this->admin->getBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/barang/barang/index', $data);
        $this->load->view('templates/footer', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('jenis_id', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('satuan_id', 'Satuan Barang', 'required');
    }

    public function tambah()
    {
        error_reporting(0);
        $data['title'] = "Barang";

        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
            $data['supplier'] = $this->admin->get('supplier');

            // Mengenerate ID Barang
            $kode_terakhir = $this->admin->getMax('barang', 'id_barang');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_barang'] = 'S' . $number;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/barang/barang/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);

            // Hitung total_harga
            // $input['total_harga'] = $input['harga'] * $input['stok'];
        
            // var_dump($input);
            // die();
            
             // Tambahkan var_dump di sini
            $insert = $this->admin->insert('barang', $input);

            if ($insert) {
                $this->session->set_flashdata('flash', 'Master sparepart berhasil di tambahkan!');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('flash', 'Master sparepart gagal di tambahkan!');
                redirect('Barang/tambah');
            }
        }
    }

    public function edit($getId)
    {
        $data['title'] = "Barang";

        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
            $data['supplier'] = $this->admin->get('supplier');
            
            $data['barang'] = $this->admin->get('barang', ['id_barang' => $id]);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/barang/barang/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('barang', 'id_barang', $id, $input);

            if ($update) {
                $this->session->set_flashdata('flash', 'Data barang berhasil di edit!');
                redirect('Barang');
            } else {
                $this->session->set_flashdata('flash', 'Data barang gagal di edit!');
                redirect('Barang/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang', 'id_barang', $id)) {
            $this->session->set_flashdata('flash', 'Data barang berhasil di hapus!');
        } else {
            $this->session->set_flashdata('flash', 'Data barang gagal di hapus!');
        }
        redirect('Barang');
    }

    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStok($id);
        output_json($query);
    }
}
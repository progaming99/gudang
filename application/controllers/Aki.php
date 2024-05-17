<?php

class Aki extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Aki_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Aki";

        // Cek peran pengguna saat ini
        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->Aki_model->get_user_role_by_id($id_user);
            
        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
        
        $data['currentRole'] = $currentRole; // Tambahkan ini

        $data['aki'] = $this->Aki_model->getAki();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/aki/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        error_reporting(0);
        $data['title'] = 'Form Tambah Data Aki';

        $this->form_validation->set_rules('merk', 'Merk Aki', 'required');
        $this->form_validation->set_rules('harga', 'Harga Aki', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['supplier'] = $this->Aki_model->get('supplier');
            
            // Mengenerate ID Barang
            $kode_terakhir = $this->Aki_model->getMax('aki', 'id_aki');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_aki'] = 'AK' . $number;
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/aki/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            
            $insert = $this->Aki_model->insert('aki', $input);

            if ($insert) {
                $this->session->set_flashdata('flash', 'Master aki berhasil di tambahkan!');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('flash', 'Master aki gagal di tambahkan!');
                redirect('Aki/tambah');
            }
        }
    }

    public function edit($getId)
    {
        $data['title'] = 'Form Edit Data Aki';

        $id = encode_php_tags($getId);
        $data['kondisi'] = ['Baru', 'Bekas'];

        $this->form_validation->set_rules('merk', 'Merk Aki', 'required');
        $this->form_validation->set_rules('harga', 'Harga Aki', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['jenis'] = $this->Aki_model->get('jenis');
            $data['satuan'] = $this->Aki_model->get('satuan');
            $data['aki'] = $this->Aki_model->get('aki', ['id_aki' => $id]);
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/aki/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->Aki_model->update('aki', 'id_aki', $id, $input);

            if ($update) {
                $this->session->set_flashdata('flash', 'Data aki berhasil di edit!');
                redirect('Aki');
            } else {
                $this->session->set_flashdata('flash', 'Data aki gagal di edit!');
                redirect('Aki/edit/' . $id);
            }
        }
    }

    public function hapus($id_aki)
    {
        $this->Aki_model->hapusDataAki($id_aki);
        $this->session->set_flashdata('flash', 'Data aki berhasil di hapus!');
        redirect('aki');
    }

    public function detail($id_ban)
    {
        $data['title'] = 'Detail Data Aki';

        $data['aki'] = $this->Aki_model->getAkiById($id_ban);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/aki/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->Aki_model->cekStok($id);
        output_json($query);
    }
}
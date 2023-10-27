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

        $data['aki'] = $this->Aki_model->getAki();

        $this->load->view('templates/header', $data);  
        $this->load->view('templates/sidebar', $data);  
        $this->load->view('dashboard/aki/index', $data);  
        $this->load->view('templates/footer', $data); 
    }

    public function tambah()
    {
        $data['title'] = 'Form Tambah Data Aki';

        $this->form_validation->set_rules('nomor_armada', 'Nomor Armada', 'required');
        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'required');
        $this->form_validation->set_rules('tanggal_pasang_baru', 'Tanggal Pasang Baru', 'required');
        $this->form_validation->set_rules('tanggal_pasang_lama', 'Tanggal Pasang Aki Lama', 'required');
        $this->form_validation->set_rules('lama_pemakaian_hari', 'Lama Pemakaian (Hari)', 'required');
        $this->form_validation->set_rules('lama_pemakaian_tahun', 'Lama Pemakaian (Tahun)', 'required');
        $this->form_validation->set_rules('masalah', 'Masalah', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan Lain', 'required');

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/aki/tambah', $data);  
            $this->load->view('templates/footer', $data); 
        } else {
            $this->Aki_model->tambahDataAki();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Aki');
        }
    }

    public function edit($id_aki)
    {
        $data['title'] = 'Form Edit Data Aki';

        $data['aki'] = $this->Aki_model->getAkiById($id_aki);

        $this->form_validation->set_rules('nomor_armada', 'Nomor Armada', 'required');
        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'required');
        $this->form_validation->set_rules('tanggal_pasang_baru', 'Tanggal Pasang Baru', 'required');
        $this->form_validation->set_rules('tanggal_pasang_lama', 'Tanggal Pasang Aki Lama', 'required');
        $this->form_validation->set_rules('lama_pemakaian_hari', 'Lama Pemakaian (Hari)', 'required');
        $this->form_validation->set_rules('lama_pemakaian_tahun', 'Lama Pemakaian (Tahun)', 'required');
        $this->form_validation->set_rules('masalah', 'Masalah', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan Lain', 'required');

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/aki/edit', $data);  
            $this->load->view('templates/footer', $data); 
        } else {
            $this->Aki_model->editDataAki();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Aki');
        }
    }

    public function hapus($id_aki)
    {
        $this->Aki_model->hapusDataAki($id_aki);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Aki');
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
}
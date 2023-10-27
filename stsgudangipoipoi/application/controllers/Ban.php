<?php

class Ban extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Ban_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Ban";

        $data['ban'] = $this->Ban_model->getBan();

        $this->load->view('templates/header', $data);  
        $this->load->view('templates/sidebar', $data);  
        $this->load->view('dashboard/ban/index', $data);  
        $this->load->view('templates/footer', $data);  
    }

    public function detail($id_ban)
    {        
        $data['title'] = "Detail Ban";

        $data['ban'] = $this->Ban_model->getBanById($id_ban);

        $this->load->view('templates/header', $data);  
        $this->load->view('templates/sidebar', $data);  
        $this->load->view('dashboard/ban/detail', $data);  
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Form Tambah Data Ban';
        
        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/ban/tambah', $data);  
            $this->load->view('templates/footer', $data);
        } else {
            $this->Ban_model->tambahDataBan();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Ban');
        }
    }

    public function edit($id_ban)
    {
        $data['title'] = "Edit Ban";
        
        $data['ban'] = $this->Ban_model->getBanById($id_ban);

        $data['posisi'] = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11'];
        $data['type'] = ['Vulkanisir', 'ORI'];
        $data['keterangan'] = ['OK', 'NOT'];

        $this->form_validation->set_rules('nomor_armada', 'Nomor Armada', 'required');
        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'required');
        $this->form_validation->set_rules('tanggal_pasang', 'Tanggal Pasang', 'required');
        $this->form_validation->set_rules('tanggal_ganti', 'Tanggal Ganti', 'required');
        $this->form_validation->set_rules('rencana_ganti', 'Rencana Ganti', 'required');
        $this->form_validation->set_rules('km_pasang', 'KM Pasang', 'required');
        $this->form_validation->set_rules('km_ganti', 'KM Ganti', 'required');
        $this->form_validation->set_rules('nomor_posisi', 'Nomor Posisi', 'required');
        $this->form_validation->set_rules('merk', 'Merk Ban', 'required');
        $this->form_validation->set_rules('type', 'Jenis Ban', 'required');
        $this->form_validation->set_rules('ukuran', 'Ukuran', 'required');
        $this->form_validation->set_rules('nomor_seri_baru', 'Nomor Seri Baru', 'required');
        $this->form_validation->set_rules('nomor_seri_lama', 'Nomor Seri Lama', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/ban/edit', $data);  
            $this->load->view('templates/footer', $data);
        } else {
            $this->Ban_model->editDataBan();
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('Ban');
        }
    }

    public function hapus($id_ban)
    {
        $this->Ban_model->hapusDataBan($id_ban);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Ban');
    }

    public function print($id)
    {
        // $data['ban'] = $this->admin->get('ban')->result();
        // $data['ban'] = $this->admin->get('ban');
        $data['ban'] = $this->admin->getBanId($id);

        $this->load->view('dashboard/ban/print', $data);  
    }
}
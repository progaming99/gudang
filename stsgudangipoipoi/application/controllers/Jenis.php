<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
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
        $data['title'] = "Jenis";
        $data['jenis'] = $this->admin->get('jenis');
       
        $this->load->view('templates/header', $data);  
        $this->load->view('templates/sidebar', $data);  
        $this->load->view('dashboard/barang/jenis/index', $data);  
        $this->load->view('templates/footer', $data);  
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required|trim');
    }

    public function tambah()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis";

            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/barang/jenis/tambah', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('jenis', $input);
            if ($insert) {
                $this->session->set_flashdata('flash', 'Data jenis berhasil di tambahkan!');
                redirect('Jenis');
            } else {
                $this->session->set_flashdata('flash', 'Data jenis gagal di tambahkan!');
                redirect('Jenis/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis";
            $data['jenis'] = $this->admin->get('jenis', ['id_jenis' => $id]);
            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/barang/jenis/edit', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('jenis', 'id_jenis', $id, $input);
            if ($update) {
                $this->session->set_flashdata('flash', 'Data jenis berhasil di edit!');
                redirect('Jenis');
            } else {
                $this->session->set_flashdata('flash', 'Data satuan gagal di edit!');
                redirect('Jenis/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('jenis', 'id_jenis', $id)) {
            $this->session->set_flashdata('flash', 'Data jenis berhasil di hapus!');
        } else {
            $this->session->set_flashdata('flash', 'Data jenis gagal di hapus!');
        }
        redirect('Jenis');
    }
}
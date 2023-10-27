<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
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
        $data['title'] = "Satuan";

         // Cek peran pengguna saat ini
         $id_user = $this->session->userdata('id_user');
         $currentRole = $this->admin->get_user_role_by_id($id_user);
             
         $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
         
         $data['currentRole'] = $currentRole; // Tambahkan ini
         
        $data['satuan'] = $this->admin->get('satuan');

        $this->load->view('templates/header', $data);  
        $this->load->view('templates/sidebar', $data);  
        $this->load->view('dashboard/barang/satuan/index', $data);  
        $this->load->view('templates/footer', $data);  

    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required|trim');
    }

    public function tambah()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Satuan";
            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/barang/satuan/tambah', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('satuan', $input);
            if ($insert) {
                $this->session->set_flashdata('flash', 'Data satuan berhasil di tambahkan!');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('flash', 'Data satuan gagal di tambahkan!');
                redirect('Satuan/tambah');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Satuan";
            $data['satuan'] = $this->admin->get('satuan', ['id_satuan' => $id]);
            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/barang/satuan/edit', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('satuan', 'id_satuan', $id, $input);
            if ($update) {
                $this->session->set_flashdata('flash', 'Data satuan berhasil di edit!');
                redirect('Satuan');
            } else {
                $this->session->set_flashdata('error', 'Data satuan gagal di edit!');
                redirect('Satuan/edit');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('satuan', 'id_satuan', $id)) {
            $this->session->set_flashdata('flash', 'Data satuan berhasil di hapus!');
        } else {
            $this->session->set_flashdata('flash', 'Data satuan gagal di hapus!');
        }
        redirect('Satuan');
    }
}
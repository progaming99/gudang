<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
        $data['title'] = "Supplier";

          // Cek peran pengguna saat ini
          $id_user = $this->session->userdata('id_user');
          $currentRole = $this->admin->get_user_role_by_id($id_user);
  
          $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
 
          $data['currentRole'] = $currentRole; // Tambahkan ini

        $data['supplier'] = $this->admin->get('supplier');
        
        $this->load->view('templates/header', $data);  
        $this->load->view('templates/sidebar', $data);  
        $this->load->view('dashboard/supplier/index', $data);  
        $this->load->view('templates/footer', $data);         
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
    }

    public function tambah()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Supplier";
            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/supplier/tambah', $data);  
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('supplier', $input);
            if ($save) {
                $this->session->set_flashdata('flash', 'Data supplier berhasil di tambahkan!');
                // redirect('Supplier');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('error', 'Data supplier gagal di tambahkan');
                redirect('Supplier/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Supplier";
            $data['supplier'] = $this->admin->get('supplier', ['id_supplier' => $id]);
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/supplier/edit', $data);  
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('supplier', 'id_supplier', $id, $input);

            if ($update) {
                $this->session->set_flashdata('flash', 'Data supplier berhasil di edit!');
                redirect('Supplier');
            } else {
                $this->session->set_flashdata('error', 'Data supplier berhasil di tambahkan!');
                redirect('Supplier/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('supplier', 'id_supplier', $id)) {
            $this->session->set_flashdata('flash', 'Data supplier berhasil di hapus!');
            } else {
            $this->session->set_flashdata('error', 'Data supplier gagal dihapus!');
                
        }
        redirect('Supplier');
    }
}
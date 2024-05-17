<?php 

class Supir extends CI_Controller
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
        $data['title'] = "Supir";

        // Cek peran pengguna saat ini
        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->admin->get_user_role_by_id($id_user);
            
        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
        
        $data['currentRole'] = $currentRole; // Tambahkan ini
        
       $data['supir'] = $this->admin->get('supir');

       $this->load->view('templates/header', $data);  
       $this->load->view('templates/sidebar', $data);  
       $this->load->view('dashboard/menu/supir/index', $data);  
       $this->load->view('templates/footer', $data);  

    }

    public function tambah()
    {
        $data['title'] = "Tambah Supir";

        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'required');

        if ($this->form_validation->run() == false) {            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/menu/supir/tambah', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('supir', $input);
            if ($insert) {
                $this->session->set_flashdata('flash', 'Data supir berhasil di tambahkan!');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('flash', 'Data satuan gagal di tambahkan!');
                redirect('Supir/tambah');
            }
        }
    }

    public function edit($getId)
    {
        $data['title'] = "Edit Supir";

        $id = encode_php_tags($getId);

        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'required');

        if ($this->form_validation->run() == false) {
            $data['supir'] = $this->admin->get('supir', ['id_supir' => $id]);            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/menu/supir/edit', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('supir', 'id_supir', $id, $input);
            if ($update) {
                $this->session->set_flashdata('flash', 'Data supir berhasil di edit!');
                redirect('Supir');
            } else {
                $this->session->set_flashdata('error', 'Data supir gagal di edit!');
                redirect('Supir/edit');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('supir', 'id_supir', $id)) {
            $this->session->set_flashdata('flash', 'Data supir berhasil di hapus!');
        } else {
            $this->session->set_flashdata('flash', 'Data supir gagal di hapus!');
        }
        redirect('supir');
    }
}
?>
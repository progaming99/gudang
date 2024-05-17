<?php 

class Kru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Kru_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Kru";

        // Cek peran pengguna saat ini
        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->Kru_model->get_user_role_by_id($id_user);
            
        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
        
        $data['currentRole'] = $currentRole; // Tambahkan ini
        
       $data['crew'] = $this->Kru_model->get('crew');

       $this->load->view('templates/header', $data);  
       $this->load->view('templates/sidebar', $data);  
       $this->load->view('dashboard/menu/kru/index', $data);  
       $this->load->view('templates/footer', $data);  

    }

    public function tambah()
    {
        $data['title'] = "Tambah Kru";

        if ($this->input->post('nama_crew')) {
        $this->form_validation->set_rules('nama_crew', 'Nama Kru', 'required');
        }

        if ($this->form_validation->run() == false) {            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/menu/kru/tambah', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $this->Kru_model->tambah();
            $this->session->set_flashdata('flash', 'Data kru berhasil di tambahkan!');
            echo '<script>window.history.go(-2);</script>';
        }
    }

    public function edit($getId)
    {
        $data['title'] = "Edit Kru";

        $id = encode_php_tags($getId);
        
        $this->form_validation->set_rules('nama_crew', 'Nama Kru', 'required');

        if ($this->form_validation->run() == false) {  
            $data['crew'] = $this->Kru_model->get('crew', ['id_crew' => $id]);              
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/menu/kru/edit', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $update = $this->Kru_model->update('crew', 'id_crew', $id, $input);
            if ($update) {
                $this->session->set_flashdata('flash', 'Data kru berhasil di edit!');
                redirect('kru');
            } else {
                $this->session->set_flashdata('error', 'Data kru gagal di edit!');
                redirect('kru/edit');
            }
        }
    }

        public function delete($getId)
        {
            $id = encode_php_tags($getId);
            if ($this->Kru_model->delete('crew', 'id_crew', $id)) {
                $this->session->set_flashdata('flash', 'Data crew berhasil di hapus!');
            } else {
                $this->session->set_flashdata('flash', 'Data crew gagal di hapus!');
            }
            redirect('kru');
        }

    }
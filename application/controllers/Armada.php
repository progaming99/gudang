<?php 

class Armada extends CI_Controller
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
        $data['title'] = "Armada";

        // Cek peran pengguna saat ini
        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->admin->get_user_role_by_id($id_user);
            
        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
        
        $data['currentRole'] = $currentRole; // Tambahkan ini
        
       $data['armada'] = $this->admin->get('armada');

       $this->load->view('templates/header', $data);  
       $this->load->view('templates/sidebar', $data);  
       $this->load->view('dashboard/menu/armada/index', $data);  
       $this->load->view('templates/footer', $data);  

    }

    public function tambah()
    {
        $data['title'] = "Tambah Armada";

        $this->form_validation->set_rules('nama_armada', 'Nama Armada', 'required|trim');

        if ($this->form_validation->run() == false) {            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/menu/armada/tambah', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('armada', $input);
            if ($insert) {
                $this->session->set_flashdata('flash', 'Data armada berhasil di tambahkan!');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('flash', 'Data satuan gagal di tambahkan!');
                redirect('Armada/tambah');
            }
        }
    }

    public function edit($getId)
    {
        $data['title'] = "Edit Armada";

        $id = encode_php_tags($getId);
        
        $this->form_validation->set_rules('nama_armada', 'Nama Armada', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['armada'] = $this->admin->get('armada', ['id_armada' => $id]);            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/barang/armada/edit', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('armada', 'id_armada', $id, $input);
            if ($update) {
                $this->session->set_flashdata('flash', 'Data armada berhasil di edit!');
                redirect('Armada');
            } else {
                $this->session->set_flashdata('error', 'Data armada gagal di edit!');
                redirect('Armada/edit');
            }
        }
    }
}
?>
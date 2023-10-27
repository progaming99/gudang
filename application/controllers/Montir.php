<?php 

class Montir extends CI_Controller
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
        $data['title'] = "Montir";

        // Cek peran pengguna saat ini
        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->admin->get_user_role_by_id($id_user);
            
        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
        
        $data['currentRole'] = $currentRole; // Tambahkan ini
        
       $data['montir'] = $this->admin->get('montir');

       $this->load->view('templates/header', $data);  
       $this->load->view('templates/sidebar', $data);  
       $this->load->view('dashboard/menu/montir/index', $data);  
       $this->load->view('templates/footer', $data);  

    }

    public function tambah()
    {
        $data['title'] = "Tambah Montir";

        $this->form_validation->set_rules('nama_montir', 'Nama Montir', 'required|trim');

        if ($this->form_validation->run() == false) {            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/menu/montir/tambah', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('montir', $input);
            if ($insert) {
                $this->session->set_flashdata('flash', 'Data montir berhasil di tambahkan!');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('flash', 'Data satuan gagal di tambahkan!');
                redirect('Montir/tambah');
            }
        }
    }

    public function edit($getId)
    {
        $data['title'] = "Edit Montir";

        $id = encode_php_tags($getId);
        
        $this->form_validation->set_rules('nama_montir', 'Nama Montir', 'required');

        if ($this->form_validation->run() == false) {
            $data['montir'] = $this->admin->get('montir', ['id_montir' => $id]);            
            $this->load->view('templates/header', $data);  
            $this->load->view('templates/sidebar', $data);  
            $this->load->view('dashboard/barang/montir/edit', $data);  
            $this->load->view('templates/footer', $data);  
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('montir', 'id_montir', $id, $input);
            if ($update) {
                $this->session->set_flashdata('flash', 'Data montir berhasil di edit!');
                redirect('Montir');
            } else {
                $this->session->set_flashdata('error', 'Data montir gagal di edit!');
                redirect('Montir/edit');
            }
        }
    }
}
?>
<?php

class Ban extends CI_Controller
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
        $data['title'] = "Data Ban";

        // Cek peran pengguna saat ini
        $id_user = $this->session->userdata('id_user');
        $currentRole = $this->admin->get_user_role_by_id($id_user);
    
        $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');
   
        $data['currentRole'] = $currentRole; // Tambahkan ini

        $data['ban'] = $this->admin->getBan();

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

    private function _validasi()
    {
        $this->form_validation->set_rules('merk', 'Merk Ban', 'required|trim');
        $this->form_validation->set_rules('type', 'Type Ban', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        // $this->form_validation->set_rules('jenis_id', 'Jenis Ban', 'required');
        // $this->form_validation->set_rules('satuan_id', 'Satuan Ban', 'required');
    }

    public function tambah()
    {
        error_reporting(0);
        $data['title'] = "Form Tambah Data Ban";

        $this->_validasi();

        if ($this->form_validation->run() == false) {
            // $data['jenis'] = $this->admin->get('jenis');
            // $data['satuan'] = $this->admin->get('satuan');
            $data['supplier'] = $this->admin->get('supplier');

            // Mengenerate ID Ban
            $kode_terakhir = $this->admin->getMax('ban', 'id_ban');

            if ($kode_terakhir) {
                $kode_tambah = substr($kode_terakhir, -6, 6);
                $kode_tambah++;
                $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
                $data['id_ban'] = 'B' . $number;
            } else {
                // Menangani jika $kode_terakhir kosong atau tidak valid
                $data['id_ban'] = 'B000001'; // Nilai default jika tidak ada data sebelumnya
            }
            
            // $data['jenis'] = $this->admin->get('jenis');
            // $data['satuan'] = $this->admin->get('satuan');

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/ban/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);

            // Hitung total_harga
            // $input['total_harga'] = $input['harga'] * $input['stok'];
        
            // var_dump($input);
            // die();
            
             // Tambahkan var_dump di sini
            $insert = $this->admin->insert('ban', $input);

            if ($insert) {
                $this->session->set_flashdata('flash', 'Master ban berhasil di tambahkan!');
                // redirect('ban_masuk/tambah');
                echo '<script>window.history.go(-2);</script>';
            } else {
                $this->session->set_flashdata('flash', 'Master ban gagal di tambahkan!');
                redirect('Ban/tambah');
            }
        }
    }

    public function edit($getId)
    {
        $data['title'] = "Ban";

        $id = encode_php_tags($getId);
        $data['type'] = ['ORI', 'Vulkanisir'];
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            // $data['jenis'] = $this->admin->get('jenis');
            // $data['satuan'] = $this->admin->get('satuan');
            $data['ban'] = $this->admin->get('ban', ['id_ban' => $id]);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/ban/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('ban', 'id_ban', $id, $input);

            if ($update) {
                $this->session->set_flashdata('flash', 'Data ban berhasil di edit!');
                redirect('Ban');
            } else {
                $this->session->set_flashdata('flash', 'Data ban gagal di edit!');
                redirect('Ban/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('ban', 'id_ban', $id)) {
            $this->session->set_flashdata('flash', 'Data ban berhasil di hapus!');
        } else {
            $this->session->set_flashdata('flash', 'Data ban gagal di hapus!');
        }
        redirect('Ban');
    }

    public function print($id)
    {
        // $data['ban'] = $this->admin->get('ban')->result();
        // $data['ban'] = $this->admin->get('ban');
        $data['ban'] = $this->admin->getBanId($id);

        $this->load->view('dashboard/ban/print', $data);
    }

    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStokBan($id);
        output_json($query);
    }
}
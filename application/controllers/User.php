<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (!is_admin()) {
            redirect('dashboard');
        }

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "User Management";
        $data['users'] = $this->admin->getUsers(userdata('id_user'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    private function _validasi($mode)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($mode == 'tambah') {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|alpha_numeric');
            // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim');
        } else {
            $db = $this->admin->get('user', ['id_user' => $this->input->post('id_user', true)]);
            $username = $this->input->post('username', true);
            // $email = $this->input->post('email', true);

            $uniq_username = $db['username'] == $username ? '' : '|is_unique[user.username]';
            // $uniq_email = $db['email'] == $email ? '' : '|is_unique[user.email]';

            $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric' . $uniq_username);
            // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $uniq_email);
        }
    }

    public function tambah()
    {
        error_reporting(0);

        $this->_validasi('tambah');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah User";

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $input_data = [
                'nama'          => $input['nama'],
                'username'      => $input['username'],
                // 'email'         => $input['email'],
                'no_telp'       => $input['no_telp'],
                'role'          => $input['role'],
                'password'      => password_hash($input['password'], PASSWORD_DEFAULT),
                'created_at'    => time(),
                'foto'          => 'user.png'
            ];

            if ($this->admin->insert('user', $input_data)) {
                $this->session->set_flashdata('flash', 'User berhasil ditambahkan!');
                redirect('user');
            } else {
                $this->session->set_flashdata('error', 'User gagal ditambahkan!');
                redirect('user/tambah');
            }
        }
    }

    public function edit($getId)
    {
        error_reporting(0);

        $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit User";
            $data['user'] = $this->admin->get('user', ['id_user' => $id]);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $input_data = [
                'nama'          => $input['nama'],
                'username'      => $input['username'],
                // 'email'         => $input['email'],
                'no_telp'       => $input['no_telp'],
                'role'          => $input['role']
            ];

            if ($this->admin->update('user', 'id_user', $id, $input_data)) {
                $this->session->set_flashdata('flash', 'User berhasil di edit!');
                redirect('user');
            } else {
                $this->session->set_flashdata('error', 'User gagal di edit!');
                redirect('user/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('user', 'id_user', $id)) {
            $this->session->set_flashdata('flash', 'User berhasil di hapus!');
        } else {
            $this->session->set_flashdata('error', 'User gagal di hapus!');
        }
        redirect('user');
    }

    public function toggle($getId)
    {
        $id = encode_php_tags($getId);
        $status = $this->admin->get('user', ['id_user' => $id])['is_active'];
        $toggle = $status ? 0 : 1; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
        $pesan = $toggle ? 'user diaktifkan.' : 'user dinonaktifkan.';

        if ($this->admin->update('user', 'id_user', $id, ['is_active' => $toggle])) {
            set_pesan($pesan);
        }
        redirect('user');
    }
}
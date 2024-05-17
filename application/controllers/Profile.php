<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');

        $userId = $this->session->userdata('login_session')['user'];
        $this->user = $this->admin->get('user', ['id_user' => $userId]);
    }

    public function index()
    {
        $data['title'] = "Profile";
        $data['user'] = $this->user;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer', $data);

        // $this->template->load('templates/dashboard', 'profile/user', $data);
    }

    private function _validasi()
    {
        $db = $this->admin->get('user', ['id_user' => $this->input->post('id_user', true)]);
        $username = $this->input->post('username', true);
        // $email = $this->input->post('email', true);

        $uniq_username = $db['username'] == $username ? '' : '|is_unique[user.username]';
        // $uniq_email = $db['email'] == $email ? '' : '|is_unique[user.email]';

        $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric' . $uniq_username);
        // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $uniq_email);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric');
    }

    private function _config()
    {
        $config['upload_path']      = "./assets/img/avatar";
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['encrypt_name']     = TRUE;
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);
    }

    public function setting()
    {
        error_reporting(0);

        $this->_validasi();
        $this->_config();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Profile";
            $data['user'] = $this->user;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('profile/setting', $data);
            $this->load->view('templates/footer', $data);

            // $this->template->load('templates/dashboard', 'profile/setting', $data);
        } else {
            $input = $this->input->post(null, true);
            if (empty($_FILES['foto']['name'])) {
                $insert = $this->admin->update('user', 'id_user', $input['id_user'], $input);
                if ($insert) {
                    $this->session->set_flashdata('flash', 'Profile berhasil diperbarui!');
                } else {
                    $this->session->set_flashdata('error', 'Profile gagal diperbarui!');
                }
                redirect('profile');
            } else {
                if ($this->upload->do_upload('foto') == false) {
                    $this->session->set_flashdata('error', 'Size foto terlalu besar!');
                    redirect('profile/setting');
                } else {
                    if (userdata('foto') != 'user.png') {
                        $old_image = FCPATH . 'assets/img/avatar/' . userdata('foto');
                        if (!unlink($old_image)) {
                            $this->session->set_flashdata('error', 'Foto lama gagal di hapus!');
                            redirect('profile/setting');
                        }
                    }

                    $input['foto'] = $this->upload->data('file_name');
                    $update = $this->admin->update('user', 'id_user', $input['id_user'], $input);
                    if ($update) {
                        $this->session->set_flashdata('flash', 'Profile berhasil diperbarui!');
                    } else {
                        $this->session->set_flashdata('error', 'Profile gagal diperbarui!');
                    }
                    redirect('profile/setting');
                }
            }
        }
    }

    public function ubahpassword()
    {
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[3]|differs[password_lama]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'matches[password_baru]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Ubah Password";

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('profile/ubahpassword', $data);
            $this->load->view('templates/footer', $data);

            // $this->template->load('templates/dashboard', 'profile/ubahpassword', $data);
        } else {
            $input = $this->input->post(null, true);
            if (password_verify($input['password_lama'], userdata('password'))) {
                $new_pass = ['password' => password_hash($input['password_baru'], PASSWORD_DEFAULT)];
                $query = $this->admin->update('user', 'id_user', userdata('id_user'), $new_pass);

                if ($query) {
                    $this->session->set_flashdata('flash', 'Password berhasil diperbarui!');
                } else {
                    $this->session->set_flashdata('error', 'Password gagal diperbarui!');
                }
            } else {
                $this->session->set_flashdata('error', 'Password lama salah!');
            }
            redirect('profile/ubahpassword');
        }
    }
}
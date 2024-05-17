<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_check_list extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Perbaikan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
    $data['title'] = "Lap Check List";

    // Cek peran pengguna saat ini
    $id_user = $this->session->userdata('id_user');
    $currentRole = $this->Perbaikan_model->get_user_role_by_id($id_user);

    $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

    $start_date = $this->input->get('start_date') ?? null;
    $end_date = $this->input->get('end_date') ?? null;

    $data['currentRole'] = $currentRole; // Tambahkan ini

    $data['check_list'] = $this->Perbaikan_model->getLapPerbaikan(null, null, $start_date, $end_date);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dashboard/bengkel/check_list/laporan', $data);
    $this->load->view('templates/footer', $data);
    }

    public function delete($id_check_list)
    {
    $this->Perbaikan_model->hapusDatacheck_list($id_check_list);
    $this->session->set_flashdata('flash', 'Data check_list berhasil di hapus!');
    redirect('check_list');
    }

}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_perbaikan extends CI_Controller
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
    $data['title'] = "Perbaikan";

    // Cek peran pengguna saat ini
    $id_user = $this->session->userdata('id_user');
    $currentRole = $this->Perbaikan_model->get_user_role_by_id($id_user);

    $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

    $start_date = $this->input->get('start_date') ?? null;
    $end_date = $this->input->get('end_date') ?? null;

    $data['currentRole'] = $currentRole; // Tambahkan ini
     
    $data['lap_perbaikan'] = $this->Perbaikan_model->getPerbaikan(null, null, $start_date, $end_date);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dashboard/bengkel/perbaikan/laporan', $data);
    $this->load->view('templates/footer', $data);
    }

    public function delete($id_perbaikan)
    {
    $this->Perbaikan_model->hapusDataPerbaikan($id_perbaikan);
    $this->session->set_flashdata('flash', 'Data perbaikan berhasil di hapus!');
    redirect('perbaikan');
    }

}
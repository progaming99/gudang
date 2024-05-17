<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perbaikan extends CI_Controller
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
     
    $data['perbaikan'] = $this->Perbaikan_model->getPerbaikan(null, null, $start_date, $end_date);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dashboard/bengkel/perbaikan/index', $data);
    $this->load->view('templates/footer', $data);
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Perbaikan';


        $start_date = $this->input->get('start_date') ?? null;
        $end_date = $this->input->get('end_date') ?? null;    

        $data['lap_perbaikan'] = $this->Perbaikan_model->getPerbaikan(null, null, $start_date, $end_date);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/perbaikan/laporan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail($id_perbaikan)
    {
        $data['title'] = 'Detail Perbaikan';

        $data['perbaikan'] = $this->Perbaikan_model->getPerbaikanById($id_perbaikan);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/perbaikan/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
    error_reporting(0);
    $data['title'] = 'Form Tambah Data Perbaikan';

    $data['armada'] = $this->Perbaikan_model->get('armada');
    $data['montir'] = $this->Perbaikan_model->get('montir');
    $data['crew'] = $this->Perbaikan_model->get('crew');
    $data['status'] = ['Selesai', 'Belum Selesai'];
    $data['level_kebutuhan'] = $this->Perbaikan_model->get('level_kebutuhan');

    $this->form_validation->set_rules('tgl_laporan', 'Tanggal Laporan', 'required');
    $this->form_validation->set_rules('armada_id', 'Armada', 'required');
    $this->form_validation->set_rules('crew_id', 'Nama Kru', 'required');
    $this->form_validation->set_rules('jenis_kerusakan', 'Kerusakan', 'required');
    $this->form_validation->set_rules('tgl_masuk', 'Tanggal', 'required');
    $this->form_validation->set_rules('tgl_pengerjaan', 'Tanggal', 'required');
    $this->form_validation->set_rules('montir_1', 'Montir', 'required');
    // $this->form_validation->set_rules('montir_2', 'Montir', 'required');
    $this->form_validation->set_rules('level_kebutuhan_id', 'Level Kebutuhan', 'required');
    $this->form_validation->set_rules('progress', 'Progress', 'required');
    $this->form_validation->set_rules('tahapan', 'Tahapan', 'required');
    $this->form_validation->set_rules('masalah', 'Masalah', 'required');
    $this->form_validation->set_rules('rencana_selesai', 'Rencana', 'required');
    // $this->form_validation->set_rules('tgl_selesai', 'Tanggal', 'required');
    $this->form_validation->set_rules('lama_pengerjaan', 'Lama Pengerjaan', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/perbaikan/tambah', $data);
        $this->load->view('templates/footer', $data);
    } else {
            $input = $this->input->post(null, true);
            $insert = $this->Perbaikan_model->insert('lap_perbaikan', $input);

            if ($insert) {
                $this->session->set_flashdata('flash', 'Data berhasil di tambahkan!');
                redirect('perbaikan');
            } else {
                $this->session->set_flashdata('error', 'Opps ada kesalahan!');
                redirect('perbaikan/tambah');
            }
    }
    }

    public function edit($getId)
    {
    error_reporting(0);
    $data['title'] = 'Form Edit Data Perbaikan';

    $id = encode_php_tags($getId);

    $data['montir'] = $this->Perbaikan_model->get('montir');
    $data['level_kebutuhan'] = $this->Perbaikan_model->get('level_kebutuhan');
    
    $data['status'] = ['Selesai', 'Belum Selesai'];
    
    $data['armada'] = $this->Perbaikan_model->get('armada');
    $data['crew'] = $this->Perbaikan_model->get('crew');
    
    $data['perbaikan'] = $this->Perbaikan_model->get('lap_perbaikan', ['id_perbaikan' => $id]);

    $this->form_validation->set_rules('tgl_laporan', 'Tanggal Laporan', 'required');
    $this->form_validation->set_rules('armada_id', 'Armada', 'required');
    $this->form_validation->set_rules('crew_id', 'Nama Kru', 'required');
    $this->form_validation->set_rules('jenis_kerusakan', 'Kerusakan', 'required');
    $this->form_validation->set_rules('tgl_masuk', 'Tanggal', 'required');
    $this->form_validation->set_rules('tgl_pengerjaan', 'Tanggal', 'required');
    $this->form_validation->set_rules('montir_1', 'Montir', 'required');
    $this->form_validation->set_rules('montir_2', 'Montir', 'required');
    $this->form_validation->set_rules('level_kebutuhan_id', 'Level Kebutuhan', 'required');
    $this->form_validation->set_rules('progress', 'Progress', 'required');
    $this->form_validation->set_rules('tahapan', 'Tahapan', 'required');
    $this->form_validation->set_rules('masalah', 'Masalah', 'required');
    $this->form_validation->set_rules('rencana_selesai', 'Rencana', 'required');
    // $this->form_validation->set_rules('tgl_selesai', 'Tanggal', 'required');
    $this->form_validation->set_rules('lama_pengerjaan', 'Lama Pengerjaan', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/perbaikan/edit', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $input = $this->input->post(null, true);
        $update = $this->Perbaikan_model->update('lap_perbaikan', 'id_perbaikan', $id, $input);

            if ($update) {
                $this->session->set_flashdata('flash', 'Data berhasil di tambahkan!');
                redirect('perbaikan');
            } else {
                $this->session->set_flashdata('error', 'Opps ada kesalahan!');
                redirect('perbaikan/edit/' . $id);
            }
    }
    }

    public function delete($id_perbaikan)
    {
    $this->Perbaikan_model->hapusDataPerbaikan($id_perbaikan);
    $this->session->set_flashdata('flash', 'Data perbaikan berhasil di hapus!');
    redirect('perbaikan');
    }

}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Check_list extends CI_Controller
{

public function __construct()
{
        parent::__construct();
        cek_login();

        $this->load->model('Check_list_model');
        $this->load->library('form_validation');
}

public function index()
{
    $data['title'] = "Check List";

    // Cek peran pengguna saat ini
    $id_user = $this->session->userdata('id_user');
    $currentRole = $this->Check_list_model->get_user_role_by_id($id_user);

    $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

    $start_date = $this->input->get('start_date') ?? null;
    $end_date = $this->input->get('end_date') ?? null;

    $data['currentRole'] = $currentRole; // Tambahkan ini    

    $data['check_list'] = $this->Check_list_model->getCheckPerbaikan(null, null, $start_date, $end_date);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dashboard/bengkel/check_list/index', $data);
    $this->load->view('templates/footer', $data);
}

public function detail($id_check_list)
{
    $data['judul'] = 'Detail Perbaikan';

    $data['check_list'] = $this->Check_list_model->getCheckListById($id_check_list);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dashboard/bengkel/check_list/detail', $data);
    $this->load->view('templates/footer', $data);
}

public function tambah()
{
    error_reporting(0);
    
    $data['title'] = 'Form Tambah Check List';

    $data['armada'] = $this->Check_list_model->get('armada');
    $data['supir'] = $this->Check_list_model->get('supir');
    $data['kernet'] = $this->Check_list_model->get('kernet');

    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('armada_id', 'Armada', 'required');
    $this->form_validation->set_rules('supir_id', 'Supir', 'required');
    $this->form_validation->set_rules('kernet_id', 'Kernet', 'required');
    $this->form_validation->set_rules('kebersihan_armada', 'Kebersihan Armada', 'required');
    $this->form_validation->set_rules('kelayakan_box', 'Kelayakan Box', 'required');
    $this->form_validation->set_rules('tekanan_ban_depan', 'Tekanan Ban Depan', 'required');
    $this->form_validation->set_rules('tekanan_ban_belakang_1', 'Tekanan Ban Belakang 1', 'required');
    $this->form_validation->set_rules('tekanan_ban_belakang_2', 'Tekanan Ban Belakang 2', 'required');
    $this->form_validation->set_rules('lampu_utama', 'Lampu Utama', 'required');
    $this->form_validation->set_rules('lampu_kota', 'Lampu Kota', 'required');
    $this->form_validation->set_rules('lampu_sein', 'Lampu Sein', 'required');
    $this->form_validation->set_rules('level_oli', 'Level Oli', 'required');
    $this->form_validation->set_rules('level_aki', 'Level Aki', 'required');
    $this->form_validation->set_rules('kelayakan_ban', 'Kelayakan Ban', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/check_list/tambah', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $input = $this->input->post(null, true);

        // Hitung total nilai berdasarkan pilihan yang dipilih
        $total_nilai = 0;
        $nilai_pilihan = [
            'kebersihan_armada' => ['OK' => 1, 'NO' => 0],
            'kelayakan_box' => ['OK' => 1, 'NO' => 0],
            'tekanan_ban_depan' => ['OK' => 1, 'NO' => 0],
            'tekanan_ban_belakang_1' => ['OK' => 1, 'NO' => 0],
            'tekanan_ban_belakang_2' => ['OK' => 1, 'NO' => 0],
            'lampu_utama' => ['OK' => 1, 'NO' => 0],
            'lampu_kota' => ['OK' => 1, 'NO' => 0],
            'lampu_sein' => ['OK' => 1, 'NO' => 0],
            'level_oli' => ['OK' => 1, 'NO' => 0],
            'level_aki' => ['OK' => 1, 'NO' => 0],
            'kelayakan_ban' => ['OK' => 1, 'NO' => 0, 'NO' => 0],
        ];

        foreach ($nilai_pilihan as $field => $values) {
            if (isset($input[$field]) && isset($values[$input[$field]])) {
                $total_nilai += $values[$input[$field]];
            }
        }

        // Tentukan nilai kelayakan berdasarkan total nilai yang dihitung
        $kelayakan = '';
        if ($total_nilai == 11) {
            $kelayakan = 'LAYAK JALAN';
        } elseif ($total_nilai < 11) {
            $kelayakan = 'TIDAK LAYAK JALAN';
        }

        // Masukkan nilai kelayakan ke dalam input sebelum disimpan ke database
        $input['kelayakan'] = $kelayakan;
       
            $insert = $this->Check_list_model->insert('check_list', $input);

            if ($insert) {
                $this->session->set_flashdata('flash', 'Data berhasil di tambahkan!');
                redirect('check_list');
            } else {
                $this->session->set_flashdata('error', 'Opps ada kesalahan!');
                redirect('check_list/tambah');
            }
    }
}

public function edit($getId)
{
    error_reporting(0);
    
    $data['title'] = 'Form Edit Data Check List Armada';

    $id = encode_php_tags($getId);

    $data['armada'] = $this->Check_list_model->get('armada');
    $data['supir'] = $this->Check_list_model->get('supir');
    $data['kernet'] = $this->Check_list_model->get('kernet');
    $data['check'] = $this->Check_list_model->get('check_list');
    
    $data['kondisi'] = ['NO', 'OK'];
    $data['ban'] = ['NO', 'NO', 'OK'];
    $data['ban2'] = ['30%', '50%', '80% - 100%'];

    $data['check_list'] = $this->Check_list_model->get('check_list', ['id_check_list' => $id]);

    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('armada_id', 'Armada', 'required');
    $this->form_validation->set_rules('supir_id', 'Supir', 'required');
    $this->form_validation->set_rules('kernet_id', 'Kernet', 'required');
    $this->form_validation->set_rules('kebersihan_armada', 'Kebersihan Armada', 'required');
    $this->form_validation->set_rules('kelayakan_box', 'Kelayakan Box', 'required');
    $this->form_validation->set_rules('tekanan_ban_depan', 'Tekanan Ban Depan', 'required');
    $this->form_validation->set_rules('tekanan_ban_belakang_1', 'Tekanan Ban Belakang 1', 'required');
    $this->form_validation->set_rules('tekanan_ban_belakang_2', 'Tekanan Ban Belakang 2', 'required');
    $this->form_validation->set_rules('lampu_utama', 'Lampu Utama', 'required');
    $this->form_validation->set_rules('lampu_kota', 'Lampu Kota', 'required');
    $this->form_validation->set_rules('lampu_sein', 'Lampu Sein', 'required');
    $this->form_validation->set_rules('level_oli', 'Level Oli', 'required');
    $this->form_validation->set_rules('level_aki', 'Level Aki', 'required');
    $this->form_validation->set_rules('kelayakan_ban', 'Kelayakan Ban', 'required');

    if ($this->form_validation->run() == FALSE) {     
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/check_list/edit', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $input = $this->input->post(null, true);

        $total_nilai = 0;
        $nilai_pilihan = [
            'kebersihan_armada'      => ['OK' => 1, 'NO' => 0],
            'kelayakan_box'          => ['OK' => 1, 'NO' => 0],
            'tekanan_ban_depan'      => ['OK' => 1, 'NO' => 0],
            'tekanan_ban_belakang_1' => ['OK' => 1, 'NO' => 0],
            'tekanan_ban_belakang_2' => ['OK' => 1, 'NO' => 0],
            'lampu_utama'            => ['OK' => 1, 'NO' => 0],
            'lampu_kota'             => ['OK' => 1, 'NO' => 0],
            'lampu_sein'             => ['OK' => 1, 'NO' => 0],
            'level_oli'              => ['OK' => 1, 'NO' => 0],
            'level_aki'              => ['OK' => 1, 'NO' => 0],
            'kelayakan_ban'          => ['OK' => 1, 'NO' => 0, 'NO' => 0],
        ];

        foreach ($nilai_pilihan as $field => $values) {
            if (isset($input[$field]) && isset($values[$input[$field]])) {
                $total_nilai += $values[$input[$field]];
            }
        }

        // Tentukan nilai kelayakan berdasarkan total nilai yang dihitung
        $kelayakan = '';
        if ($total_nilai == 11) {
            $kelayakan = 'LAYAK JALAN';
        } elseif ($total_nilai < 11) {
            $kelayakan = 'TIDAK LAYAK JALAN';
        }

        // Masukkan nilai kelayakan ke dalam input sebelum disimpan ke database
        $input['kelayakan'] = $kelayakan;

        $update = $this->Check_list_model->update('check_list', 'id_check_list', $id, $input);

        if ($update) {
            $this->session->set_flashdata('flash', 'Data check_list berhasil di edit!');
            redirect('check_list');
        } else {
            $this->session->set_flashdata('flash', 'Opps ada kesalahan!');
            redirect('check_list/edit/' . $id);
        }
    }
}

public function delete($id_check_list)
{
    $this->Check_list_model->hapusCheckList($id_check_list);
    $this->session->set_flashdata('flash', 'Data checklist berhasil di hapus!');
    redirect('check_list');
}

}
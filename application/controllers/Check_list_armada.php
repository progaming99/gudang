<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Check_list_armada extends CI_Controller
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
    $data['title'] = "Check List Armada";

    // Cek peran pengguna saat ini
    $id_user = $this->session->userdata('id_user');
    $currentRole = $this->Check_list_model->get_user_role_by_id($id_user);

    $data['is_admin_or_finance'] = ($currentRole == 'admin' || $currentRole == 'finance');

    $start_date = $this->input->get('start_date') ?? null;
    $end_date = $this->input->get('end_date') ?? null;

    $data['currentRole'] = $currentRole; // Tambahkan ini    

    $data['check_list_armada'] = $this->Check_list_model->getCheckListArmada(null, null, $start_date, $end_date);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('dashboard/bengkel/check_list/check_list_armada/index', $data);
    $this->load->view('templates/footer', $data);
}

public function tambah()
{
    error_reporting(0);
    
    $data['title'] = 'Tambah Check List Armada';

    $data['armada'] = $this->Check_list_model->get('armada');
    $data['montir'] = $this->Check_list_model->get('montir');

    $this->form_validation->set_rules('tgl_laporan', 'Tanggal', 'required');
    $this->form_validation->set_rules('armada_id', 'Armada', 'required');
    $this->form_validation->set_rules('montir_1', 'Montir', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/check_list/check_list_armada/tambah', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['upload_path']          = './assets/images/montir';

        $this->load->library('upload', $config);

        if (empty($_FILES['image']['name'])) {
            //if image is not uploaded
            $this->session->set_flashdata('error', 'Gambar belum berhasil diupload!');
            redirect('check_list_armada/tambah');
        } elseif (isset($_FILES['image']['size']) && $_FILES['image']['size'] > (2 * 1024 * 1024)) {
            // If image size is greater than 2MB
            $this->session->set_flashdata('error', 'Ukuran gambar terlalu besar! Maksimum 2MB.');
            redirect('check_list_armada/tambah');
        } elseif (!$this->upload->do_upload('image')) {
            // If upload fails
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('flash', $error);
            redirect('check_list_armada/tambah');
        } else {    
            //upload success
            $image = $this->upload->data('file_name');            
            
            $input = $this->input->post(null, true);
            if ($input) {
                foreach ($input as $key => $value) {
                    $input[$key] = trim($value);
                }
                $input['image'] = $image;
                $insert = $this->Check_list_model->insert_checklist('check_list_armada' , $input);
                if ($insert) {
                    $this->session->set_flashdata('flash', 'Data berhasil ditambahkan!');
                    redirect('check_list_armada');
                } else {
                    $this->session->set_flashdata('error', 'Data gagal ditambahkan!');
                    redirect('check_list_armada/tambah');
                }
            } else {
                // Handle if input is null
                $this->session->set_flashdata('error', 'Data input tidak valid!');
                redirect('check_list_armada/tambah');
            }
        }
    }
}

public function edit($getId)
{
    error_reporting(0);
    
    $data['title'] = 'Form Edit Data Check List Armada';

    $id = encode_php_tags($getId);

    $data['armada'] = $this->Check_list_model->get('armada');
    $data['montir'] = $this->Check_list_model->get('montir');   

    $data['check_list'] = $this->Check_list_model->get('check_list_armada', ['id_check_list_armada' => $id]);

    $this->form_validation->set_rules('tgl_laporan', 'Tanggal', 'required');
    $this->form_validation->set_rules('armada_id', 'Armada', 'required');
    $this->form_validation->set_rules('montir_1', 'Montir', 'required');

    if ($this->form_validation->run() == FALSE) {     
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/bengkel/check_list/check_list_armada/edit', $data);
        $this->load->view('templates/footer', $data);
    } else {
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 2048;
            $config['upload_path']          = './assets/images/montir';
    
            $this->load->library('upload', $config);
    
            $input = $this->input->post(null, true);
            if (empty($_FILES['image']['name'])) {
                $insert = $this->Check_list_model->update('check_list_armada', 'id_check_list_armada', $input['id_check_list_armada'], $input);
                if ($insert) {
                    $this->session->set_flashdata('flash', 'Armada berhasil diperbarui!');
                } else {
                    $this->session->set_flashdata('error', 'Armada gagal diperbarui!');
                }
                redirect('check_list_armada');
            } else {
                if ($this->upload->do_upload('image') == false) {
                    $this->session->set_flashdata('error', 'Size foto terlalu besar!');
                    redirect('check_list_armada/edit');           
            } else {      
                // if (userdata('image') != 'default.jpg') {
                //     $old_image = FCPATH . 'assets/iamges/montir/' . userdata('image');
                //     if (unlink($old_image)) {
                //          $this->session->set_flashdata('error', 'Foto gagal di hapus!');
                //          redirect('check_list_armada/edit');                    
                // }
                $old_image = FCPATH . 'assets/images/montir/' . $data['check_list']['image'];
                if (file_exists($old_image) && $data['check_list']['image'] != 'default.jpg') {
                    unlink($old_image);
                }

                $input['image'] = $this->upload->data('file_name');
                
                $update = $this->Check_list_model->update('check_list_armada','id_check_list_armada',$id, $input);
                
                if ($update) {
                    $this->session->set_flashdata('flash', 'Data berhasil diedit!');
                    redirect('check_list_armada');
                } else {
                    $this->session->set_flashdata('error', 'Data gagal diedit!');
                    redirect('check_list_armada/edit');
                
            }
        }
        }
    }    

}

public function delete($id)
{
    $id = $this->security->xss_clean($id);

    // Get check list data
    $check_list = $this->Check_list_model->get('check_list_armada', ['id_check_list_armada' => $id]);
    
    // Check if the data exists
    if (!$check_list) {
        $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        redirect('check_list_armada');
    }

    // Delete the data from the database
    $delete = $this->Check_list_model->delete($id);
    
    if ($delete) {
        // Check if image file exists before deleting
        $image_path = FCPATH . 'assets/images/montir/' . $check_list['image'];
        if (file_exists($image_path) && $check_list['image'] != 'default.jpg') {
            // Attempt to delete the image file
            if (unlink($image_path)) {
                $this->session->set_flashdata('flash', 'Data berhasil dihapus!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus file gambar.');
            }
        }
    } else {
        $this->session->set_flashdata('error', 'Data gagal dihapus dari database!');
    }
    
    redirect('check_list_armada');
}
}
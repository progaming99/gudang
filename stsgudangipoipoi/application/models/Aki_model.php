<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aki_model extends CI_Model
{
    public function getAki()
    {
        return $this->db->get('aki')->result(); 
    }

    public function getAkiById($id_aki)
    {
        return $this->db->get_where('aki', ['id_aki' => $id_aki])->row();
    }

    public function tambahDataAki()
    {
         $tanggal_pasang_baru = $this->input->post('tanggal_pasang_baru');
        $tanggal_pasang_lama = $this->input->post('tanggal_pasang_lama');
        $lama_pemakaian_hari = (strtotime($tanggal_pasang_lama) - strtotime($tanggal_pasang_baru)) / (60 * 60 * 24);

         // Menghitung lama pemakaian dalam tahun
         $lama_pemakaian_tahun = $lama_pemakaian_hari / 365;

        $data = [
            "nomor_armada" => $this->input->post('nomor_armada', true),
            "nama_supir" => $this->input->post('nama_supir', true),
            "tanggal_pasang_baru" => $this->input->post('tanggal_pasang_baru', true),
            "tanggal_pasang_lama" => $this->input->post('tanggal_pasang_lama', true),
            "lama_pemakaian_hari" => $this->input->post('lama_pemakaian_hari', true),
            "lama_pemakaian_tahun" => $this->input->post('lama_pemakaian_tahun', true),
            "masalah" => $this->input->post('masalah', true),
            "keterangan" => $this->input->post('keterangan', true)
        ];    

        $this->db->insert('aki', $data);
    }

    public function editDataAki()
    {
        $data = [
            "nomor_armada" => $this->input->post('nomor_armada', true),
            "nama_supir" => $this->input->post('nama_supir', true),
            "tanggal_pasang_baru" => $this->input->post('tanggal_pasang_baru', true),
            "tanggal_pasang_lama" => $this->input->post('tanggal_pasang_lama', true),
            "lama_pemakaian_hari" => $this->input->post('lama_pemakaian_hari', true),
            "lama_pemakaian_tahun" => $this->input->post('lama_pemakaian_tahun', true),
            "masalah" => $this->input->post('masalah', true),
            "keterangan" => $this->input->post('keterangan', true)
        ];

        $this->db->where('id_aki', $this->input->post('id_aki'));
        $this->db->update('Aki', $data);
    }

    public function hapusDataAki($id_aki)
    {
        $this->db->where('id_aki', $id_aki);
        $this->db->delete('Aki');
    }
}
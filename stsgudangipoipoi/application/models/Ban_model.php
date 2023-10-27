<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ban_model extends CI_Model
{
    public function getBan()
    {
        return $this->db->get('ban')->result(); 
    }

    public function getBanById($id_ban)
    {
        return $this->db->get_where('ban', ['id_ban' => $id_ban])->row();
    }

    public function tambahDataBan()
    {
        $data = [
            "nomor_armada" => $this->input->post('nomor_armada', true),
            "nama_supir" => $this->input->post('nama_supir', true),
            "tanggal_pasang" => $this->input->post('tanggal_pasang', true),
            "tanggal_ganti" => $this->input->post('tanggal_ganti', true),
            "rencana_ganti" => $this->input->post('rencana_ganti', true),
            "km_pasang" => $this->input->post('km_pasang', true),
            "km_ganti" => $this->input->post('km_ganti', true),
            "nomor_posisi" => $this->input->post('nomor_posisi', true),
            "merk" => $this->input->post('merk', true),
            "type" => $this->input->post('type', true),
            "ukuran" => $this->input->post('ukuran', true),
            "nomor_seri_baru" => $this->input->post('nomor_seri_baru', true),
            "nomor_seri_lama" => $this->input->post('nomor_seri_lama', true),
            "keterangan" => $this->input->post('keterangan', true),
            "harga" => $this->input->post('harga', true)
        ];

        $this->db->insert('ban', $data);
    }

    public function editDataBan()
    {
        $data = [
            "nomor_armada" => $this->input->post('nomor_armada', true),
            "nama_supir" => $this->input->post('nama_supir', true),
            "tanggal_pasang" => $this->input->post('tanggal_pasang', true),
            "tanggal_ganti" => $this->input->post('tanggal_ganti', true),
            "rencana_ganti" => $this->input->post('rencana_ganti', true),
            "km_pasang" => $this->input->post('km_pasang', true),
            "km_ganti" => $this->input->post('km_ganti', true),
            "nomor_posisi" => $this->input->post('nomor_posisi', true),
            "merk" => $this->input->post('merk', true),
            "type" => $this->input->post('type', true),
            "ukuran" => $this->input->post('ukuran', true),
            "nomor_seri_baru" => $this->input->post('nomor_seri_baru', true),
            "nomor_seri_lama" => $this->input->post('nomor_seri_lama', true),
            "keterangan" => $this->input->post('keterangan', true),
            "harga" => $this->input->post('harga', true)
        ];

        $this->db->where('id_ban', $this->input->post('id_ban'));
        $this->db->update('Ban', $data);
    }

    public function hapusDataBan($id_ban)
    {
        $this->db->where('id_ban', $id_ban);
        $this->db->delete('Ban');
    }
}
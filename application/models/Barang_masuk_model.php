<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk_model extends CI_Model
{
    public function getBarangMasuk($id_barang_masuk)
    {
        return $this->db->get_where('barang_masuk', ['id_barang_masuk' => $id_barang_masuk])->row();
    }

    public function hapusBarangMasuk($id_barang_masuk)
    {
        $this->db->where('id_barang_masuk', $id_barang_masuk);
        $this->db->delete('barang_masuk');
    }
}
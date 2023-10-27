<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    // Method untuk mengambil data pengguna berdasarkan ID
    public function get_user_by_id($id_user) {
        $query = $this->db->get_where('user', array('id_user' => $id_user));
        return $query->row_array();
    }

    // Method untuk mengambil peran (role) pengguna berdasarkan ID
    public function get_user_role_by_id($id_user) {
        $query = $this->db->select('role')->get_where('user', array('id_user' => $id_user));
        $result = $query->row();
        return $result ? $result->role : null;
    }
    
    public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user', 'barang_keluar.user_id = user.id_user');
        $this->db->join('barang', 'barang_keluar.barang_id = barang.id_barang');
        $this->db->join('satuan', 'barang.satuan_id = satuan.id_satuan');
        $this->db->join('armada', 'barang.armada_id = armada.id_armada');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }
        if ($range != null) {
            $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
            $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_barang_keluar', 'DESC');
        return $this->db->get('barang_keluar bk')->result_array();
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }
}
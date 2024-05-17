<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Check_list_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
	{
		if ($data != null) {
			return $this->db->get_where($table, $data)->row_array();
		} else {
			return $this->db->get_where($table, $where)->result_array();
		}
	}
   
    public function hitungTotalKelayakan()
    {
        $this->db->select('(CASE 
                                WHEN kebersihan_armada = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN kelayakan_box = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN tekanan_ban_depan = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN tekanan_ban_belakang_1 = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN tekanan_ban_belakang_2 = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN lampu_utama = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN lampu_kota = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN lampu_sein = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN level_oli = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN level_aki = "Layak" THEN 1
                                ELSE 0
                            END) +
                            (CASE 
                                WHEN kelayakan_ban = "Layak" THEN 1
                                ELSE 0
                            END) AS total_kelayakan');
    
        return $this->db->get('check_list')->result();
    }  
    
    public function getCheckPerbaikan($limit = null,  $id_check_list = null, $start_date = null, $end_date = null)
    {
        $this->db->select('*'); // Menghapus alias yang digunakan sebelumnya
        // $this->db->from('lap_perbaikan');
		$this->db->join('user', 'check_list.user_id = user.id_user');
        $this->db->join('armada', 'check_list.armada_id = armada.id_armada');
        $this->db->join('supir', 'check_list.supir_id = supir.id_supir');
        $this->db->join('kernet', 'check_list.kernet_id = kernet.id_kernet');

        if ($limit != null) {
			$this->db->limit($limit);
		}

        if ($id_check_list != null) {
			$this->db->where('check_list', $id_check_list);
		}

		if ($start_date != null) {
			if ($start_date == $end_date) {
				$this->db->where('check_list.tanggal', $start_date);
			} else {
				$this->db->where('check_list.tanggal >=', $start_date);
				$this->db->where('check_list.tanggal <=', $end_date);
			}
		}

        $this->db->order_by('id_check_list', 'DESC');

        return $this->db->get('check_list')->result(); 
    }
    
    public function getCheckListArmada($limit = null,  $id_check_list_armada = null, $start_date = null, $end_date = null)
    {
        $this->db->select('*'); // Menghapus alias yang digunakan sebelumnya
        // $this->db->from('lap_perbaikan');
		$this->db->join('user', 'check_list_armada.user_id = user.id_user');
        $this->db->join('armada', 'check_list_armada.armada_id = armada.id_armada');

        if ($limit != null) {
			$this->db->limit($limit);
		}

        if ($id_check_list_armada != null) {
			$this->db->where('check_list_armada', $id_check_list_armada);
		}

		// if ($start_date != null) {
		// 	if ($start_date == $end_date) {
		// 		$this->db->where('check_list_armada.tgl_laporan', $start_date);
		// 	} else {
		// 		$this->db->where('check_list_armada.tgl_laporan >=', $start_date);
		// 		$this->db->where('check_list_armada.tgl_laporan <=', $end_date);
		// 	}
		// }

        if ($start_date != null && $end_date != null) {
            $this->db->where('check_list_armada.tgl_laporan >=', $start_date);
            $this->db->where('check_list_armada.tgl_laporan <=', $end_date);
        } elseif ($start_date != null) {
            $this->db->where('check_list_armada.tgl_laporan', $start_date);
        }
        

        $this->db->order_by('id_check_list_armada', 'DESC');

        return $this->db->get('check_list_armada')->result(); 
    }

    public function getCheckListById($id_check_list)
    {
        $this->db->select('*'); // Menghapus alias yang digunakan sebelumnya
        // $this->db->from('lap_perbaikan');
		$this->db->join('user', 'check_list.user_id = user.id_user');
        $this->db->join('armada', 'check_list.armada_id = armada.id_armada');
        $this->db->join('supir', 'check_list.supir_id = supir.id_supir');
        $this->db->join('kernet', 'check_list.kernet_id = kernet.id_kernet');
        
        return $this->db->get_where('check_list', ['id_check_list' => $id_check_list])->row();
    }

    public function insert($table, $data, $batch = false)
	{
		return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
	}

    // public function getCheckListtById($id_check_list)
    // {
    //     return $this->db->get_where('check_list', ['id_check_list' => $id_check_list])->row();
    // }

    // public function tambah()
    // {
    //     $data = [
    //         "nomor_armada" => $this->input->post('nomor_armada', true),
    //         "nama_supir" => $this->input->post('nama_supir', true),
    //         "tanggal_pasang" => $this->input->post('tanggal_pasang', true),
    //         "tanggal_ganti" => $this->input->post('tanggal_ganti', true),
    //         "rencana_ganti" => $this->input->post('rencana_ganti', true),
    //         "km_pasang" => $this->input->post('km_pasang', true),
    //         "km_ganti" => $this->input->post('km_ganti', true),
    //         "nomor_posisi" => $this->input->post('nomor_posisi', true),
    //         "merk" => $this->input->post('merk', true),
    //         "type" => $this->input->post('type', true),
    //         "ukuran" => $this->input->post('ukuran', true),
    //         "nomor_seri_baru" => $this->input->post('nomor_seri_baru', true),
    //         "nomor_seri_lama" => $this->input->post('nomor_seri_lama', true),
    //         "keterangan" => $this->input->post('keterangan', true),
    //         "harga" => $this->input->post('harga', true)
    //     ];

    //     $this->db->insert('perbaikan', $data);
    // }

    public function update($table, $pk, $id, $data)
	{
		$this->db->where($pk, $id);
		return $this->db->update($table, $data);
	}

    // public function edit()
    // {
    //     $data = [
    //         "nomor_armada" => $this->input->post('nomor_armada', true),
    //         "nama_supir" => $this->input->post('nama_supir', true),
    //         "tanggal_pasang" => $this->input->post('tanggal_pasang', true),
    //         "tanggal_ganti" => $this->input->post('tanggal_ganti', true),
    //         "rencana_ganti" => $this->input->post('rencana_ganti', true),
    //         "km_pasang" => $this->input->post('km_pasang', true),
    //         "km_ganti" => $this->input->post('km_ganti', true),
    //         "nomor_posisi" => $this->input->post('nomor_posisi', true),
    //         "merk" => $this->input->post('merk', true),
    //         "type" => $this->input->post('type', true),
    //         "ukuran" => $this->input->post('ukuran', true),
    //         "nomor_seri_baru" => $this->input->post('nomor_seri_baru', true),
    //         "nomor_seri_lama" => $this->input->post('nomor_seri_lama', true),
    //         "keterangan" => $this->input->post('keterangan', true),
    //         "harga" => $this->input->post('harga', true)
    //     ];

    //     $this->db->where('id_ban', $this->input->post('id_ban'));
    //     $this->db->update('Ban', $data);
    // }

    public function hapusCheckList($id_check_list)
    {
        $this->db->where('id_check_list', $id_check_list);
        $this->db->delete('check_list');
    }

    public function delete($id_check_list_armada)
    {
        // Get data before deleting
        $check_list = $this->db->get_where('check_list_armada', ['id_check_list_armada' => $id_check_list_armada])->row_array();
    
        // Check if the data exists
        if (!$check_list) {
            return false;
        }
    
        // Delete the data from the database
        $this->db->where('id_check_list_armada', $id_check_list_armada);
        $result = $this->db->delete('check_list_armada');
    
        return $result;
    }  

    // public function delete($id_check_list_armada)
    // {
    //    //get data before deleting
    //    $check_list = $this->db->get_where('check_list_armada', ['id_check_list_armada' => $id_check_list_armada])->row_array();
    //    $image_path = FCPATH . 'assets/images/montir/' . $check_list['image'];

    //    // check if the image dile exists before deleting
    //    if (file_exists($image_path) && $check_list['image'] != 'default.jpg') {
    //     unlink($image_path); //delete the image file
    //    }

    //    //delete the data from the database
    //     $this->db->where('id_check_list_armada', $id_check_list_armada);
    //     $result = $this->db->delete('check_list_armada');

    //     return $result;
    // }

    // Method untuk mengambil peran (role) pengguna berdasarkan ID
    public function get_user_role_by_id($id_user) 
    {
            $query = $this->db->select('role')->get_where('user', array('id_user' => $id_user));
            $result = $query->row();
            return $result ? $result->role : null;
    }

    public function insert_checklist($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }


}
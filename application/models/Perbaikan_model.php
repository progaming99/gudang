    <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perbaikan_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
	{
		if ($data != null) {
			return $this->db->get_where($table, $data)->row_array();
		} else {
			return $this->db->get_where($table, $where)->result_array();
		}
	}

    public function insert($table, $data, $batch = false)
	{
		return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
	}
   
    public function getPerbaikan($limit = null,  $id_perbaikan = null, $start_date = null, $end_date = null)
    {
        $this->db->select('*'); // Menghapus alias yang digunakan sebelumnya
        // $this->db->from('lap_perbaikan');
		$this->db->join('user', 'lap_perbaikan.user_id = user.id_user');
        $this->db->join('armada', 'lap_perbaikan.armada_id = armada.id_armada');
        // $this->db->join('montir', 'lap_perbaikan.montir_1 = montir.id_montir');        
        $this->db->join('crew', 'lap_perbaikan.crew_id = crew.id_crew');
        $this->db->join('level_kebutuhan', 'lap_perbaikan.level_kebutuhan_id = level_kebutuhan.id_level_kebutuhan');

        if ($limit != null) {
			$this->db->limit($limit);
		}

        if ($id_perbaikan != null) {
			$this->db->where('lap_perbaikan', $id_perbaikan);
		}

		if ($start_date != null) {
			if ($start_date == $end_date) {
				$this->db->where('lap_perbaikan.tgl_laporan', $start_date);
			} else {
				$this->db->where('lap_perbaikan.tgl_laporan >=', $start_date);
				$this->db->where('lap_perbaikan.tgl_laporan <=', $end_date);
			}
		}

        $this->db->order_by('id_perbaikan', 'DESC');

        return $this->db->get('lap_perbaikan')->result(); 
    }

    public function getLapPerbaikan($limit = null,  $id_check_list = null, $start_date = null, $end_date = null)
    {
        $this->db->select('*'); // Menghapus alias yang digunakan sebelumnya
        // $this->db->from('lap_check_list');
		$this->db->join('user', 'check_list.user_id = user.id_user');
        $this->db->join('armada', 'check_list.armada_id = armada.id_armada');
        $this->db->join('supir', 'check_list.supir_id = supir.id_supir');
        $this->db->join('kernet', 'check_list.kernet_id = kernet.id_kernet');
        // $this->db->join('supir', 'check_list.supir_id = supir.id_supir');

        if ($limit != null) {
			$this->db->limit($limit);
		}

        if ($id_check_list != null) {
			$this->db->where('check_list', $id_check_list);
		}

		if ($start_date != null) {
			if ($start_date == $end_date) {
				$this->db->where('check_list.tgl_laporan', $start_date);
			} else {
				$this->db->where('check_list.tgl_laporan >=', $start_date);
				$this->db->where('check_list.tgl_laporan <=', $end_date);
			}
		}

        $this->db->order_by('id_check_list', 'DESC');

        return $this->db->get('check_list')->result(); 
    }

    public function getPerbaikanById($id_perbaikan)
    {
        $this->db->select('*'); // Menghapus alias yang digunakan sebelumnya
        // $this->db->from('lap_perbaikan');
		$this->db->join('user', 'lap_perbaikan.user_id = user.id_user');
        $this->db->join('armada', 'lap_perbaikan.armada_id = armada.id_armada');
        $this->db->join('crew', 'lap_perbaikan.crew_id = crew.id_crew');
        $this->db->join('level_kebutuhan', 'lap_perbaikan.level_kebutuhan_id = level_kebutuhan.id_level_kebutuhan');
        
        return $this->db->get_where('lap_perbaikan', ['id_perbaikan' => $id_perbaikan])->row();
    }

    public function update($table, $pk, $id, $data)
	{
		$this->db->where($pk, $id);
		return $this->db->update($table, $data);
	}

    public function hapusDataPerbaikan($id_perbaikan)
    {
        $this->db->where('id_perbaikan', $id_perbaikan);
        $this->db->delete('lap_perbaikan');
    }

        // Method untuk mengambil peran (role) pengguna berdasarkan ID
    public function get_user_role_by_id($id_user) 
    {
        $query = $this->db->select('role')->get_where('user', array('id_user' => $id_user));
        $result = $query->row();
        return $result ? $result->role : null;
    }
}
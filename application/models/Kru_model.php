<?php

class Kru_model extends CI_model 
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
			return $this->db->get_where($table, $data)->row_array();
		} else {
			return $this->db->get_where($table, $where)->result_array();
		}
    }

    public function get_user_role_by_id($id_user)
	{
		$query = $this->db->select('role')->get_where('user', array('id_user' => $id_user));
		$result = $query->row();
		return $result ? $result->role : null;
	}

    public function tambah()
    {
        $data = [
            "nama_crew" => $this->input->post('nama_crew', true)
        ];

        $this->db->insert('crew', $data);
    }

    public function delete($table, $pk, $id)
	{
		return $this->db->delete($table, [$pk => $id]);
	}

    public function getId($getId)
    {
        return $this->db->get_where('crew', ['id_crew' => $getId])->row();
    }

    public function edit()
    {
        $data = [
            "nama_crew" => $this->input->post('nama_crew', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('crew', $data);
    }

    public function update($table, $pk, $id, $data)
	{
		$this->db->where($pk, $id);
		return $this->db->update($table, $data);
	}
}
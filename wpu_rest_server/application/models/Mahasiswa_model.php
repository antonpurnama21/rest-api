<?php 


/**
 * 
 */
class Mahasiswa_model extends CI_Model
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }

	public function getMahasiswa($id = null)
	{

		if ($id === null) {
			return $this->db->get('mahasiswa')->result_array();	
		}else{
			return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
		}
		
	}

	public function delMahasiswa($id = null)
	{
		$this->db->delete('mahasiswa',['id'=>$id]);
		return $this->db->affected_rows();
	}

	public function createMahasiswa($data = null)
	{
		$this->db->insert('mahasiswa',$data);
		return $this->db->affected_rows();
	}

	public function updateMahasiswa($data = null, $id = null)
	{
		$this->db->update('mahasiswa', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	    public function searchMahasiswa($keyword=null)
    {
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}
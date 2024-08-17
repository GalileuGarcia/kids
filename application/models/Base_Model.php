<?php

class Base_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function create($tabela, $data)
	{
		$this->db->insert($tabela, $data);

		return $this->db->insert_id();
	}
        
        public function getBy($tabela, $condicao) {
            $this->db->order_by('id', 'DESC');
            $this->db->where($condicao);
            return $this->db->get($tabela)->result();
        }
        
	// Leitura (Read)
	public function getAll($tabela)
	{
		$query = $this->db->get($tabela);
		return $query->result();
	}

	public function getById($tabela, $id)
	{
		$query = $this->db->get_where($tabela, array('id' => $id));
		return $query->row_array();
	}

	// Atualização (Update)
	public function update($tabela, $data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update($tabela, $data);
	}

	// Exclusão (Delete)
	public function delete($tabela, $id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($tabela);
	}
}

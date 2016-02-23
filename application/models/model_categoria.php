<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_categoria extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }

	public function lista_categorias($termo = ""){
		$sql = "SELECT * FROM categoria WHERE nome_categoria like '%".$termo."%' ORDER BY nome_categoria ";
		$res = $this->db->query($sql);
		return $res->result_array();
	}

	public function lista_categorias_sem_pai($termo = ""){
		$sql = "SELECT c.* FROM categoria c WHERE c.id_categoria NOT IN (SELECT filha FROM categoria_pai) ORDER BY c.nome_categoria ";
		$res = $this->db->query($sql);
		return $res->result_array();
	}

	public function lista_categorias_com_pai($termo = ""){
		$sql = "SELECT c.id_categoria as id_pai, c.nome_categoria as nome_pai, c.termo_categoria as termo_pai, c1.id_categoria, c1.nome_categoria, c1.termo_categoria FROM categoria c, categoria c1, categoria_pai cp WHERE c.id_categoria = cp.pai AND c1.id_categoria = cp.filha ";
		$res = $this->db->query($sql);
		return $res->result_array();
	}

	public function lista_geral_por_pai($pai = 0){
		$sql = "SELECT c.* FROM categoria c WHERE c.id_categoria NOT IN (SELECT filha FROM categoria_pai) ORDER BY c.nome_categoria";

		if($pai != 0)
			$sql = "SELECT c.* FROM categoria c, categoria_pai cp WHERE c.id_categoria  = cp.filha and cp.pai = $pai ORDER BY c.nome_categoria";
		
		$res = $this->db->query($sql, array('pai' => $pai));
		return $res->result_array();
	}

	public function busca_categoria_por_nome($nome = ""){
		$sql = "SELECT * FROM categoria WHERE nome_categoria = '".$nome."'";
		$res = $this->db->query($sql);
		return $res->row_array();
	}

	public function busca_categoria_por_id($id = 0){
		$sql = "SELECT c.nome_categoria, c.termo_categoria, c.id_categoria, cp.pai FROM categoria c LEFT JOIN categoria_pai cp on c.id_categoria = cp.filha WHERE c.id_categoria = $id";
		$res = $this->db->query($sql);
		return $res->row_array();
	}

	public function insere_categoria($dados = null){
		try{
			$res = $this->db->insert('categoria', $dados);
			if($res) return true; 
			return false;
		}catch(Exception $e){
			$e->getMessage();
			return false;
		}
	}

	public function update_categoria($dados = null){
		try{
			$this->db->where('id_categoria', $dados['id_categoria']);
			$res = $this->db->update('categoria', $dados);
			if($res) return true; 
			return false;
		}catch(Exception $e){
			$e->getMessage();
			return false;
		}
	}

	public function insere_amarracao($dados = null){
		try{
			$res = $this->db->insert('categoria_pai', $dados);
			if($res) return true; 
			return false;
		}catch(Exception $e){
			$e->getMessage();
			return false;
		}
	}

	public function remove_categoria($id = 0){
		try{
			$res = $this->db->delete('categoria', array('id_categoria' => $id));
			if($res) return true;
			return false;
		}catch(Exception $e){
			$e->getMessage();
			return false;
		}
	}

	public function remove_amarracao($dados = null){
		try{
			$res = $this->db->delete('categoria_pai', $dados);
			if($res) return true;
			return false;
		}catch(Exception $e){
			$e->getMessage();
			return false;
		}
	}
}

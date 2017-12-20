<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Auxiliar extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function selectSimples($tabela){
		$this->db->from($tabela);
		$query = $this->db->get();
		$colecao = $query->result_array();
		return $colecao;
	}

	function selectCampos($tabela,$campos){
		$this->db->select($campos);
		$this->db->from($tabela);
		$query = $this->db->get();
		$colecao = $query->result_array();
		return $colecao;
	}
	
	function selectClausula($tabela,$campos,$clausulas){
		$this->db->select($campos);
		$this->db->from($tabela);
		$this->db->where($clausulas);
		$query = $this->db->get();

		$colecao = $query->result_array();
		return $colecao;
	}

	function selectOrdem($tabela,$campos,$clausulas,$ordem){
		$this->db->select($campos);
		$this->db->from($tabela);
		$this->db->where($clausulas);
		$this->db->order_by($ordem);
		$query = $this->db->get();
		$colecao = $query->result_array();
		return $colecao;
	}

	function inserir($tabela,$conteudo){
		$this->db->insert($tabela, $conteudo);
			if($this->db->affected_rows() > 0) {
			    return true; 
			}else {
				return false;
			}
				$this->db->close(); 
	}
	 function atualizar2(){
       echo "model";
       $this->db->where('id', 1);
       $conteudo = array('nome'=>'don pedroka');
       $this->db->update('aluno', $conteudo);
       echo $this->db->last_query(); 
       if($this->db->affected_rows() > 0) {
		    return TRUE; 
		}else {
		    return FALSE;
		}
	
    }

	function atualizar($tabela,$data,$where){
		$this->db->where($where);
		$this->db->update($tabela,$data);
			if($this->db->affected_rows() > 0) {
			    return TRUE; 
			}else {
			    return FALSE;
			}
	}
	function atualizar_string($tabela,$data,$where){
		if($this->db->query("UPDATE $tabela SET $data WHERE $where")){
			echo $this->db->last_query();
				return TRUE;
			} else { 
				return FALSE;
			}
		//$this->db->close();
	}

		function excluir($tabela,$where){
			$this->db->where($where);
			$this->db->delete($tabela);
				if($this->db->affected_rows() > 0) {
			    	return TRUE; 
				}else {
			    	return FALSE;
				}	 
	}


}

?>